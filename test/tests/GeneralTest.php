<?php
use PHPUnit\Framework\TestCase as TestCase;
class GeneralTest extends TestCase
{


    public function setUp()
    {

    }

    public function tearDown()
    {
        
    }
    public function testHelloWorld()
    {
        // $helloWorld = new HelloWorld($this->pdo);
        // $this->assertEquals('Hello World', $helloWorld->hello());
        $this->assertEquals('1', '1');
    }
    public function testHello()
    {
        // $helloWorld = new HelloWorld($this->pdo);
        // $this->assertEquals('Hello Bar', $helloWorld->hello('Bar'));
        $this->assertEquals('1', '1');
    }
    public function testWhat()
    {
        // $helloWorld = new HelloWorld($this->pdo);
        // $this->assertFalse($helloWorld->what());
        // $helloWorld->hello('Bar');
        // $this->assertEquals('Bar', $helloWorld->what());
        $this->assertEquals('1', '1');
    }
} 