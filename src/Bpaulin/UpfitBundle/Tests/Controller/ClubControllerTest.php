<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClubControllerTest extends WebTestCase
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

    public function testUserCanCreateHisOwnClub()
    {
        $client = static::createClientUser();
        $crawler = $client->request('GET', '/user/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('a#user_club_create')->count());

        $link = $crawler->filter('a#user_club_create')->first()->link();
        $uri = $link->getUri();

        $crawler = $client->click($link);
        $crawler = $client->followRedirect();

        $this->assertEquals(1, $crawler->filter('table#members tbody tr')->count());

        $crawler = $client->request('GET', $uri);
        $crawler = $client->followRedirect();
        $this->assertEquals(1, $crawler->filter('table#members tbody tr')->count());
    }
}
