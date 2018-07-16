<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSignup()
    {
        $client = static::createClient();

        $client->request('GET', '/signup');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLogin()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}