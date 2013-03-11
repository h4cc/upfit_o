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

        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username' => 'user1',
            '_password' => 'user1'
            )
        );
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/', $client->getRequest()->getUri());
    }
    /*
    public function testLoginInvalide()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username' => 'user1',
            '_password' => 'qsdfqsdfqsdfqsdf'
            )
        );
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
    }
    */
}
