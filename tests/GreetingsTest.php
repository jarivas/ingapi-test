<?php

namespace INGApi\Tests;

use INGApi\Base as IngBase;

class GreetingsTest extends Base
{


    public function testGreetingsOk(): void
    {
        $instance = new IngBase($this->getLogger(), $this->getIngData());

        $result = $instance->greetings();

        $this->assertIsArray($result);

    }//end testGreetingsOk()


}//end class
