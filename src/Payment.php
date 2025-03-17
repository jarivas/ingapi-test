<?php


declare(strict_types=1);

namespace INGApi;

use INGApi\Requests\CreatePayment;
use HttpClient\Post;
use Ramsey\Uuid\Uuid;


class Payment extends Base
{


    public function createPaymentRequest(CreatePayment $request): false|string
    {
        $reqPath = '/payment-requests';
        $body    = $request->toArray();
        $json    = json_encode($body);

        if (!$json) {
            $this->logger->error('invalid request');
            return false;
        }

        $dummy = $this->getCommonHeaders($json);

        if (!$dummy) {
            return false;
        }

        [
            $headers,
            $reqDate,
            $digest,
        ] = $dummy;

        $signature = $this->getSignature($reqDate, $digest, 'post', $reqPath);

        $data      = &$this->data;
        $headers[] = "Signature: $signature";
        $headers[] = 'X-ING-ReqID: '.Uuid::uuid4();

        $client = new Post($data->baseUrl);

        $client->sslCertificates($data->tlsCertificate, $data->tlsPrivateKey);

        $response = $client->sendJson($reqPath, $body, $headers);

        $data = $this->processResponse($response);

        return $data ? $data['paymentInitiationUrl'] : false;

    }//end createPaymentRequest()


}//end class
