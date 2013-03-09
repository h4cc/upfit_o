<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SessionControllerTest extends WebTestCase
{
    public function createClientUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username' => 'user1',
            '_password' => 'user1'
            )
        );
        $client->submit($form);

        return $client;
    }

    public function testAccessDeniedForAnonymousUserToSession()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/session/');
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
    }
}
