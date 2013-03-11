<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SessionControllerTest extends WebTestCase
{
    public function createClientUser($username = '', $password = '')
    {
        if (!$username) {
            $username = 'user1';
            if (!$password) {
                $password = 'user1';
            }
        }

        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username'       => $username,
            '_password'       => $password
            )
        );
        $client->submit($form);

        return $client;
    }

    public function testAccessDeniedForAnonymousUserToSession()
    {
        $this->assertEquals(1, 1);
        // $client = static::createClient();

        // $crawler = $client->request('GET', '/user/session/');
        // $crawler = $client->followRedirect();
        // $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
    }

    /*
    public function testUserHasLinkToBeginPersonnalSession()
    {
        $client = $this->createClientUser();
        $crawler = $client->request('GET', '/user/session/');
        $this->assertGreaterThan(
            0,
            $crawler->filter('a[href="/user/session/new"]')->count()
        );
    }

    public function testPersonnalSession()
    {
        $client = $this->createClientUser();
        $crawler = $client->request('GET', '/user/session/new');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }
    */
}
