<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder\Tests;

use DesignPatterns\Creational\Builder\Car;
use DesignPatterns\Creational\Builder\CarBuilder;
use DesignPatterns\Creational\Builder\Director;
use DesignPatterns\Creational\Builder\Motorbike;
use DesignPatterns\Creational\Builder\MotorbikeBuilder;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
    public function testBuildMotorbike()
    {
        $vehicle = (new Director())->build(new MotorbikeBuilder());

        $this->assertInstanceOf(Motorbike::class, $vehicle);
    }

    public function testBuildCar()
    {
        $vehicle =(new Director())->build(new CarBuilder());

        $this->assertInstanceOf(Car::class, $vehicle);
    }
}
