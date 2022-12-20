<?php

namespace App\Tests\Controller\Api;

use App\Tests\WallabagApiTestCase;

class WallabagRestControllerTest extends WallabagApiTestCase
{
    public function testGetVersion()
    {
        // create a new client instead of using $this->client to be sure client isn't authenticated
        $client = static::createClient();
        $client->request('GET', '/api/version');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertSame($client->getContainer()->getParameter('wallabag.version'), $content);
    }

    public function testGetInfo()
    {
        // create a new client instead of using $this->client to be sure client isn't authenticated
        $client = static::createClient();
        $client->request('GET', '/api/info');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $content = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('appname', $content);
        $this->assertArrayHasKey('version', $content);
        $this->assertArrayHasKey('allowed_registration', $content);

        $this->assertSame('wallabag', $content['appname']);
    }
}
