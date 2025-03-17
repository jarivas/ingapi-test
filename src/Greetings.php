<?php


declare(strict_types=1);

namespace INGApi;
use HttpClient\Get;

class Greetings extends Base
{


    /**
     * Summary of greetings
     * @return array<string, string>|false
     */
    public function greetings(): false|array//phpcs:ignore Generic.NamingConventions.ConstructorName.OldStyle
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
        $data      = $this->data;

        $client = new Get($data->baseUrl);

        $client->sslCertificates($data->tlsCertificate, $data->tlsPrivateKey);

        $response = $client->send($reqPath, null, $headers, true);

        return $this->processResponse($response);

    }//end greetings()


}//end class
