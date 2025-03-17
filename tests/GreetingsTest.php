<?php

namespace INGApi\Tests;

use INGApi\Greetings;

class GreetingsTest extends Base
{


    public function testGreetingsOk(): void
    {
        $instance = new Greetings($this->getLogger(), $this->getIngData());

        $result = $instance->greetings();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('messageTimestamp', $result);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('id', $result);

    }//end testGreetingsOk()


}//end class
