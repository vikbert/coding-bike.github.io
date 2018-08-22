<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Pool\Tests;

use DesignPatterns\Creational\Pool\StringReverseWorker;
use DesignPatterns\Creational\Pool\WorkerPool;
use PHPUnit\Framework\TestCase;

class WorkerPoolTest extends TestCase
{
    /** @var WorkerPool */
    private $pool;

    public function setUp(): void
    {
        $this->pool = new WorkerPool();
    }

    public function testCountable(): void
    {
        $this->assertEquals(0, count($this->pool));

        $this->pool->getWorker();
        $this->pool->getWorker();
        $this->assertEquals(2, count($this->pool));
    }

    public function testCanGetAnCorrectInstance()
    {
        $this->assertInstanceOf(StringReverseWorker::class, $this->pool->getWorker());
    }

    public function testCanGetTheSameInstanceIfDisposedPreviousInstance()
    {
        $workerFoo = $this->pool->getWorker();
        $this->pool->dispose($workerFoo);

        $workerBar = $this->pool->getWorker();

        $this->assertSame($workerFoo, $workerBar);
    }
}
