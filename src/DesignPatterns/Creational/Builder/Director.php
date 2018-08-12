<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

final class Director
{
    public function build(VehicleBuilder $builder): Vehicle
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheels();

        return $builder->getVehicle();
    }
}