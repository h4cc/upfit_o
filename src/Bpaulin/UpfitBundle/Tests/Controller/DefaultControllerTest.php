<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
