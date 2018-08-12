<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Parts\Door;
use DesignPatterns\Creational\Builder\Parts\Engine;
use DesignPatterns\Creational\Builder\Parts\Wheel;

class CarBuilder implements VehicleBuilder
{
    /** @var Car */
    private $car;

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    public function addDoors()
    {
        $this->car->setPart('door-1', new Door());
        $this->car->setPart('door-2', new Door());
        $this->car->setPart('door-3', new Door());
        $this->car->setPart('door-4', new Door());
    }

    public function addWheels()
    {
        $this->car->setPart('wheel-1', new Wheel());
        $this->car->setPart('wheel-2', new Wheel());
        $this->car->setPart('wheel-3', new Wheel());
        $this->car->setPart('wheel-4', new Wheel());
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
}