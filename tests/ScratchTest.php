<?php


use Mockery as m;

class ScratchTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testLiving()
    {
        $this->assertTrue(true);
    }
}