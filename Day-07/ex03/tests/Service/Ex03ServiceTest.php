<?php

namespace App\Tests\Service;

use App\Service\Ex03Service;
use PHPUnit\Framework\TestCase;

class Ex03ServiceTest extends TestCase
{
    public function testUppercaseWords()
    {
        $service = new Ex03Service();

        $this->assertEquals('Hello World', $service->uppercaseWords('hello world'));
        $this->assertEquals('Symfony 5', $service->uppercaseWords('symfony 5'));
        $this->assertEquals('42 Rocks', $service->uppercaseWords('42 rocks'));
    }

    public function testCountNumbers()
    {
        $service = new Ex03Service();
		
		$this->assertEquals(4, $service->countNumbers('Year 2025!'));
        $this->assertEquals(4, $service->countNumbers('a1b2c3d4'));
        $this->assertEquals(0, $service->countNumbers('No digits!'));
    }
}
