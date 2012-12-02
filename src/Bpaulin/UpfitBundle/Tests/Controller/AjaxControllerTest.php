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

        $crawler = $client->request('GET', '/ajax/admin/users/list?sSearch=user2&bSearchable_0=true');
		$this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() == 0);

        $crawler = $client->request('GET', '/ajax/admin/users/list?sSearch=user2');
        $this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() > 0);
    }
}
