<?php

namespace ITWB\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestControllerTest extends WebTestCase
{
    public function testGetby()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getBy');
    }

}
