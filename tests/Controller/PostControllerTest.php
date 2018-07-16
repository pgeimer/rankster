<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'testUser',
            'PHP_AUTH_PW' => '1234',
        ]);
        $client->followRedirects();

        $client->request('GET', '/post/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}