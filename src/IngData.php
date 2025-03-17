<?php

declare(strict_types=1);

namespace INGApi;

class IngData
{


    public function __construct(
        public readonly string $baseUrl,
        public readonly string $purchasePrefix,
        public readonly string $clientId,
        public readonly string $tlsCertificate,
        public readonly string $tlsPrivateKey,
        public readonly string $signingCertificate,
        public readonly string $signingPrivateKey,
        public readonly string $signingPrivatePass,
    ){

    }//end __construct()


    /**
     * Summary of toArray
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return (array) $this;

    }//end toArray()


}//end class
