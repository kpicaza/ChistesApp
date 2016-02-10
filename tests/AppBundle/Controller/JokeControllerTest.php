<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class JokeControllerTest extends WebTestCase
{

    public function testJoke()
    {
        $client = $this->createClient();
        
        $crawler = $client->request('GET', '/jokes');
        
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');
        
        $this->assertEquals(5, $crawler->filter('.joke')->count(), 'Expect Right number of jokes');
        
        $this->assertEquals(1, $crawler->filter('.joke:contains("A bad joke")')->count(), 'Expected joke is in jokes');
    }

}
