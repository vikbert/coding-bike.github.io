<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

interface VehicleBuilder
{
    public function createVehicle();

    public function addEngine();
    public function addDoors();
    public function addWheels();

    public function getVehicle(): Vehicle;
}