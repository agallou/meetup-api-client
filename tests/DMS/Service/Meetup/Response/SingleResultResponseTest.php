<?php

namespace DMS\Service\Meetup\Response;

use Guzzle\Common\Collection;

class SingleResultResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testSerialization()
    {
        $code = 200;

        $headers = new Collection(array(
            'Content-Type' => 'application/json',
        ));

        $content = json_encode(array(
            array('id' => 1),
            array('id' => 2),
        ));

        $response = new SingleResultResponse($code, $headers, $content);

        $serialized = serialize($response);

        $this->assertNotContains('data', $serialized);
        $this->assertNotContains('metadata', $serialized);

        $unserialized = unserialize($serialized);

        $this->assertEquals($response->getData(), $unserialized->getData());
        $this->assertEquals($response->getMetadata(), $unserialized->getMetadata());

        $this->assertInternalType('array', $unserialized->getData());
    }
}
