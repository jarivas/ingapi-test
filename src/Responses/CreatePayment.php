<?php

declare(strict_types=1);

namespace INGApi\Responses;

class CreatePayment
{


    public function __construct(public readonly string $id, public readonly string $paymentInitiationUrl)
    {

    }//end __construct()


}//end class
