<?php

namespace Bernard\Benchmarks;

use Bernard\Consumer;
use Bernard\Envelope;
use Bernard\Message\DefaultMessage;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\QueueFactory\InMemoryFactory;
use Bernard\Router\SimpleRouter;
use Bernard\Tests\Fixtures;

class ConsumerBenchmark extends \Athletic\AthleticEvent
{
    public function setUp()
    {
        $router = new SimpleRouter;
        $router->add('ImportUsers', new Fixtures\Service);

        $this->queues = new InMemoryFactory();

        // Create a lot of messages.
        for ($i = 0;$i < 100000;$i++) {
            $this->queues->create('send-newsletter')->enqueue(
                new Envelope(new DefaultMessage('SendNewsletter'))
            );
        }

        $this->consumer = new Consumer($router, new MiddlewareBuilder);
    }

    /**
     * @iterations 100000
     */
    public function consume()
    {
        $this->consumer->tick($this->queues->create('send-newsletter'));
    }
}
