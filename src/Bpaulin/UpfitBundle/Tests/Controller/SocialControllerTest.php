<?php

namespace Bpaulin\UpfitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SocialControllerTest extends WebTestCase
{
    public function createClientUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(
            array(
            '_username'       => 'user1',
            '_password'         => 'user1'
            )
        );
        $client->submit($form);

        return $client;
    }

    public function testSocialAccessAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/social');
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/login', $client->getRequest()->getUri());
    }

    public function testSocialAccessLogged()
    {
        $client = $this->createClientUser();

        $crawler = $client->request('GET', '/user/social');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLinkToSocialCreation()
    {
        $client = $this->createClientUser();

        $crawler = $client->request('GET', '/user/social');
        $this->assertGreaterThan(
            0,
            $crawler->filter('a[href="/user/social/new"]')->count()
        );
    }

    public function testSocialValidCreation()
    {
        $client = $this->createClientUser();

        $crawler = $client->request('GET', '/user/social/new');

        $form = $crawler->selectButton('submit-social-new')->form(
            array(
            'bpaulin_upfitbundle_socialtype[name]'       => 'social1'
            )
        );
        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $crawler = $client->followRedirect();
        $this->assertEquals('http://localhost/user/social', $client->getRequest()->getUri());
        $this->assertEquals(1, $crawler->filter('.alert-success')->count());
        $this->assertTrue($crawler->filter('td:contains("social1")')->count() > 0);
    }

    public function testSocialInvalidCreation()
    {
        $client = $this->createClientUser();

        $crawler = $client->request('GET', '/user/social/new');

        $form = $crawler->selectButton('submit-social-new')->form(
            array(
                'bpaulin_upfitbundle_socialtype[name]'  => ''
            )
        );

        $crawler = $client->submit($form);
        $this->assertFalse($client->getResponse()->isRedirect());
        $this->assertEquals(1, $crawler->filter('.alert-error')->count());
    }
}
