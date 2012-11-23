<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ajax/admin/users/list');

        $this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() > 0);
    }
}
