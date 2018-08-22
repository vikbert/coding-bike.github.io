<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Pool;

class WorkerPool implements \Countable
{
    private $freeWorkers = [];
    private $occupiedWorkers = [];

    public function count(): int
    {
        return count($this->freeWorkers) + count($this->occupiedWorkers);
    }

    public function getWorker(): StringReverseWorker
    {
        if (count($this->freeWorkers) === 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker): void
    {
        $hashKey = spl_object_hash($worker);
        if (array_key_exists($hashKey, $this->occupiedWorkers)) {
            unset($this->occupiedWorkers[$hashKey]);
            $this->freeWorkers[$hashKey] = $worker;
        }
    }
}