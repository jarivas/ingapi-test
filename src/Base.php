<?php


declare(strict_types=1);

namespace INGApi;

use Psr\Log\LoggerInterface;
use HttpClient\Post;
use HttpClient\Get;
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
     * Summary of greetings
     * @return array<string, string>|false
     */
    public function greetings(): false|array
    {
        $reqPath = '/greetings/single';
        $dummy   = $this->getCommonHeaders('');

        if (!$dummy) {
            return false;
        }

        [
            $headers,
            $reqDate,
            $digest,
        ] = $dummy;

        $signature = $this->getSignature($reqDate, $digest, 'post', $reqPath);

        $headers[] = "Signature: $signature";
        $data      = &$this->data;

        $client = new Get($data->baseUrl);

        $client->sslCertificates($data->tlsCertificate, $data->tlsPrivateKey);

        $response = $client->send($reqPath, null, $headers, true);

        return $this->processResponse($response);

    }//end greetings()


    /**
     * Summary of getCommonHeaders
     * @param string $json
     * @return array<string|string[]>|false
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
     * @return array<string|string[]>
     */
    protected function getCommonHeadersHelper(string $body): array
    {
        $digest  = openssl_digest($body, 'SHA256', true);
        $digest  = 'SHA-256='.base64_encode($digest);
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
     * @param mixed $scope
     * @return array<array{grant_type: string|IngData|Post|string>}
     */
    protected function requestAccessTokenHelper(?string $scope): array
    {
        $data    = &$this->data;
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
     * @param array $body
     * @param string $httpMethod
     * @param string $reqPath
     * @return bool|string|string[]
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
        $privateKey = $this->checkPrivateKeySignature();
        if (!$privateKey) {
            $this->logger->error('Invalid signing certificates');
        }

        $pKeyid = openssl_get_privatekey($privateKey);

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
     * @return array<bool|string>|bool
     */
    protected function checkPrivateKeySignature(): false|array
    {
        $certFile      = file_get_contents($this->data->signingCertificate);
        $keyFile       = file_get_contents($this->data->signingPrivateKey);
        $keyPassphrase = $this->data->signingPrivatePass;
        $privateKey    = [
            $keyFile,
            $keyPassphrase,
        ];
        $success       = openssl_x509_check_private_key($certFile,$privateKey);

        return $success ? $privateKey : false;

    }//end checkPrivateKeySignature()


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
     * @param array $response
     * @return false|array
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
