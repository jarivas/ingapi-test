<?php

namespace INGApi\Tests;

use INGApi\Base as IngBase;

class RequestAccessTokenTest extends Base
{


    public function testRequestAccessTokenNotSigned(): void
    {
        $instance = new IngBase($this->getLogger(), $this->getIngData());

        $accessToken = $instance->requestAccessToken();

        $this->assertIsString($accessToken);

    }//end testRequestAccessTokenNotSigned()


    public function testRequestAccessTokenSigned(): void
    {
        $instance = new IngBase($this->getLogger(), $this->getIngData());

        $accessToken = $instance->requestAccessTokenHttpSigned();

        $this->assertIsString($accessToken);

    }//end testRequestAccessTokenSigned()


}//end class
