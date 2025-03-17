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
        [
            $headers,
            $reqDate,
            $digest,
        ]        = $this->getCommonHeaders(json_encode($body));

        $signature = $this->getSignature($reqDate, $digest, 'post', $reqPath);

        $headers[] = "Signature: $signature";
        $headers[] = 'X-ING-ReqID: '.Uuid::uuid4();

        $client = new Post($this->data->baseUrl);

        $response = $client->sendJson($reqPath, $body, $headers);

        $data = $this->processResponse($response);

        return $data ? $data['paymentInitiationUrl'] : false;

    }//end createPaymentRequest()


}//end class
