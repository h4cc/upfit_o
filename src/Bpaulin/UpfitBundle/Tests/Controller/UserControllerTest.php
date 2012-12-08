<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function createClientAdmin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username'       => 'admin',
            '_password'         => 'admin'
            )
        );
        $client->submit($form);
        return $client;
    }

    public function testList()
    {
        $client = $this->createClientAdmin();

        $crawler = $client->request('GET', '/admin/users/list');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $this->assertTrue($crawler->filter('#userslist')->count() > 0);
    }

    public function testAjax()
    {
        $client = $this->createClientAdmin();

        $crawler = $client->request('GET', '/admin/users/ajax');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() > 0);

        $crawler = $client->request('GET', '/admin/users/ajax?sSearch=user2&bSearchable_0=true');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() == 0);

        $crawler = $client->request('GET', '/admin/users/ajax?sSearch=user2');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("user1@upfit.com")')->count() > 0);
    }
}
