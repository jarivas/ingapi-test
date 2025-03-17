<?php

namespace INGApi\Tests;

use INGApi\Currency;
use INGApi\Payment;
use INGApi\Requests\CreatePayment;

class CreatePaymentRequestTest extends Base
{


    public function testCreatePaymentRequestOk(): void
    {
        $instance = new Payment($this->getLogger(), $this->getIngData());

        $url = $instance->createPaymentRequest($this->getCreateRequest());

        $this->assertIsString($url);

    }//end testCreatePaymentRequestOk()


    private function getCreateRequest(): CreatePayment
    {
        return new CreatePayment(50.0, Currency::Eur, 'test', 'Order #12345', 'https://yourdomain.com/payment/callback');

    }//end getCreateRequest()


}//end class
