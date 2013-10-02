<?php

namespace Bernard\Benchmarks;

use Bernard\Message\DefaultMessage;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Producer;
use Bernard\QueueFactory\InMemoryFactory;

class ProducerBenchmark extends \Athletic\AthleticEvent
{
    public function setUp()
    {
        $this->producer = new Producer(new InMemoryFactory(), new MiddlewareBuilder);
    }

    /**
     * @iterations 10000
     */
    public function produce()
    {
        $this->producer->produce(new DefaultMessage('ImportUsers'));
    }
}
