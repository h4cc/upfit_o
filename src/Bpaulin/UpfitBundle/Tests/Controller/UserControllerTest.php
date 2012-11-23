<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/users/list');

        $this->assertTrue($crawler->filter('#userlist')->count() > 0);
    }
}
