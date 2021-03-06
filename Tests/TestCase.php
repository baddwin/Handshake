<?php

namespace IrishTitan\Handshake\Tests;

use Magento\Framework\App\Bootstrap;
use PHPUnit\Framework\TestCase as PHPUnit;

class TestCase extends PHPUnit
{

    /**
     * Bootstrap Magento and get our class ready for testing.
     *
     * @return void
     */
    protected function setUp()
    {
        require './app/bootstrap.php';

        $bootstrap = Bootstrap::create(BP, $_SERVER);
        $app = $bootstrap->createApplication('Magento\Framework\App\Http');
        $bootstrap->run($app);

        parent::setUp();
    }

}