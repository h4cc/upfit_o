<?php

namespace Bpaulin\UpfitBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FosUserTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }   
}
