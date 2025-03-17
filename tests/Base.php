<?php

namespace INGApi\Tests;

use PHPUnit\Framework\TestCase;
use INGApi\IngData;
use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

class Base extends TestCase
{


    public function getIngData(): IngData
    {
        return new IngData(
            $_ENV['ING_BASE_URL'],
            $_ENV['PERCHASE_PREFIX'],
            $_ENV['ING_CLIENT_ID'],
            $_ENV['ING_TLS_CERTIFICATE'],
            $_ENV['ING_TLS_PRIVATE_KEY'],
            $_ENV['ING_SIGNING_CERTIFICATE'],
            $_ENV['ING_SIGNING_PRIVATE_KEY'],
            $_ENV['ING_SIGNING_PASS'],
        );

    }//end getIngData()


    public function getLogger(): LoggerInterface
    {
        $logger = new Logger('test');

        $logger->pushHandler(new StreamHandler(ROOT_DIR.'/log/test.log', Level::Debug));

        return $logger;

    }//end getLogger()


}//end class
