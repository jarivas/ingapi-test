<?php


declare(strict_types=1);

namespace INGApi;

use Psr\Log\LoggerInterface;
use HttpClient\Post;
use Carbon\Carbon;

class Base
{

    protected const string SIGNING_ALGO = 'RSA-SHA256';


    public function __construct(
        protected readonly LoggerInterface $logger,
        protected readonly IngData $data
    )
    {

    }//end __construct()


    public function requestAccessToken(?string $scope=null): false|string
    {
        [
            $data,
            $client,
            $body,
            $reqPath,
        ] = $this->requestAccessTokenHelper($scope);

        $client->sslCertificates($data->tlsCertificate, $data->tlsPrivateKey);

        $body['client_id'] = $data->clientId;

        $response = $client->sendForm($reqPath, $body);

        return $this->processAccessTokenResponse($response);

    }//end requestAccessToken()


    public function requestAccessTokenHttpSigned(?string $scope=null): false|string
    {
        [
            $data,
            $client,
            $body,
            $reqPath,
        ] = $this->requestAccessTokenHelper($scope);

        $headers = $this->getRequesAccessHeaders($body, 'post', $reqPath);

        if (!$headers) {
            return false;
        }

        $client->sslCertificates($data->tlsCertificate, $data->tlsPrivateKey);

        $response = $client->sendForm($reqPath, $body, $headers);

        return $this->processAccessTokenResponse($response);

    }//end requestAccessTokenHttpSigned()


    /**
     * Summary of getCommonHeaders
     * @param string $json
     * @return array{non-empty-array<int,string>, string, string}
     */
    protected function getCommonHeaders(string $json): false|array
    {
        $accessToken = $this->requestAccessToken();

        if (!$accessToken) {
            return false;
        }

        [
            $headers,
            $reqDate,
            $digest,
        ] = $this->getCommonHeadersHelper($json);

        $headers[] = "Authorization: Bearer $accessToken";

        return [
            $headers,
            $reqDate,
            $digest,
        ];

    }//end getCommonHeaders()


    /**
     * Summary of getCommonHeadersHelper
     * @param string $body
     * @return array{non-empty-array<int,string>, string, string}
     */
    protected function getCommonHeadersHelper(string $body): array
    {
        $digest  = openssl_digest($body, 'SHA256', true);
        $digest  = 'SHA-256='.base64_encode(strval($digest));
        $reqDate = Carbon::now()->toRfc7231String();

        return [
            [
                'Accept: application/json',
                "Date: $reqDate",
                "Digest: $digest",
            ],
            $reqDate,
            $digest,
        ];

    }//end getCommonHeadersHelper()


    /**
     * Summary of requestAccessTokenHelper
     * @param null|string $scope
     * @return array<int,mixed>
     */
    protected function requestAccessTokenHelper(?string $scope): array
    {
        $data    = $this->data;
        $client  = new Post($data->baseUrl);
        $body    = ['grant_type' => 'client_credentials'];
        $reqPath = '/oauth2/token';

        if ($scope) {
            $body['scope'] = $scope;
        }

        return [
            $data,
            $client,
            $body,
            $reqPath,
        ];

    }//end requestAccessTokenHelper()


    /**
     * Summary of getRequesAccessHeaders
     * @param array<string,string> $body
     * @param string $httpMethod
     * @param string $reqPath
     * @return array<int,string>|false
     */
    protected function getRequesAccessHeaders(array $body, string $httpMethod, string $reqPath): false|array
    {
        [
            $headers,
            $reqDate,
            $digest,
        ] = $this->getCommonHeadersHelper(http_build_query($body));

        $signature = $this->getSignature($reqDate, $digest, $httpMethod, $reqPath);

        if (!$signature) {
            $this->logger->error('error getting signature', $headers);

            return false;
        }

        $authorization = <<<EOT
authorization: Signature keyId="{$this->data->clientId}",algorithm="rsa-sha256",headers="(request-target) date digest",signature="$signature"
EOT;

        $headers[] = $authorization;

        return $headers;

    }//end getRequesAccessHeaders()


    protected function getSignature(string $reqDate, string $digest, string $httpMethod, string $reqPath): false|string
    {
        if (! $this->checkPrivateKeySignature()) {
            $this->logger->error('Invalid signing certificates');
            return false;
        }

        $pKeyid = openssl_get_privatekey("file://{$this->data->signingPrivateKey}", $this->data->signingPrivatePass);

        if (!$pKeyid) {
            $this->logger->error("error getting private key: {$this->data->signingPrivateKey}");
            return false;
        }

        if ($reqPath[0] != '/') {
            $reqPath = "/$reqPath";
        }

        $data = "(request-target): $httpMethod {$reqPath}\ndate: {$reqDate}\ndigest: $digest";

        $success = openssl_sign($data, $signature, $pKeyid, self::SIGNING_ALGO);

        if ($success) {
            return base64_encode($signature);
        }

        $this->logger->error('error on the signature');

        return false;

    }//end getSignature()


    /**
     * Summary of checkPrivateKeySignature
     * @return bool
     */
    protected function checkPrivateKeySignature(): bool
    {
        $certFile = file_get_contents($this->data->signingCertificate);

        if (!$certFile) {
            $this->logger->error("file does not exists: {$this->data->signingCertificate}");
            return false;
        }

        $keyFile = file_get_contents($this->data->signingPrivateKey);
        $this->logger->error("file does not exists: {$this->data->signingPrivateKey}");
        if (!$keyFile) {
            return false;
        }

        $keyPassphrase = $this->data->signingPrivatePass;
        $privateKey    = [
            $keyFile,
            $keyPassphrase,
        ];

        return openssl_x509_check_private_key($certFile,$privateKey);

    }//end checkPrivateKeySignature()


    /**
     * Summary of processAccessTokenResponse
     * @param array<string,mixed> $response
     * @return false|string
     */
    protected function processAccessTokenResponse(array $response): false|string
    {
        $data = $this->processResponse($response);

        if (!empty($data['message'])) {
            $this->logger->error($data['message']);

            return false;
        }

        return $data ? $data['access_token'] : false;

    }//end processAccessTokenResponse()


    /**
     * Summary of processResponse
     * @param array<string,mixed> $response
     * @return false|array<string,mixed>
     */
    protected function processResponse(array $response): false|array
    {
        if (!$response['success']) {
            $this->logger->error($response['result']);
            return false;
        }

        $data = is_string($response['result']) ? json_decode($response['result'], true) : $response['result'];

        if (empty($data)) {
            $this->logger->error('invalid json returned');

            return false;
        }

        return $data;

    }//end processResponse()


}//end class
