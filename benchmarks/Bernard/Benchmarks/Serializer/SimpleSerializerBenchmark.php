<?php

namespace Bernard\Benchmarks\Serializer;

use Bernard\Serializer\SimpleSerializer;
use Bernard\Envelope;
use Bernard\Message\DefaultMessage;

class SimpleSerializerBenchmark extends \Athletic\AthleticEvent
{
    public function setUp()
    {
        $this->serializer = new SimpleSerializer;
    }

    /**
     * @iterations 10000
     */
    public function serialize()
    {
        $this->serializer->serialize(new Envelope(new DefaultMessage('ImportUsers')));
    }

    /**
     * @iterations 10000
     */
    public function deserialize()
    {
        $this->serializer->deserialize('{"args":{"name":"SendNewsletter"},"class":"Bernard:Message:DefaultMessage","timestamp":1373547293,"retries":0}');
    }

    /**
     * @iterations 10000
     */
    public function deserializeUnknown()
    {
        $this->serializer->deserialize('{"args":{"newsletterId":10},"class":"Fixtures:SendNewsletterMessage","timestamp":1373547293,"retries":0}');
    }
}
