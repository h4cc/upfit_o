<?php

namespace Bpaulin\UpfitBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
