<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

use DesignPatterns\Creational\Builder\Parts\Engine;
use DesignPatterns\Creational\Builder\Parts\Wheel;

final class MotorbikeBuilder implements VehicleBuilder
{
    /** @var Motorbike */
    private $motorbike;

    public function createVehicle()
    {
        $this->motorbike = new Motorbike();
    }

    public function addEngine()
    {
        $this->motorbike->setPart('engine', new Engine());
    }

    public function addDoors()
    {
    }

    public function addWheels()
    {
        $this->motorbike->setPart('wheel-1', new Wheel());
        $this->motorbike->setPart('wheel-2', new Wheel());
    }

    public function getVehicle(): Vehicle
    {
        return $this->motorbike;
    }
}