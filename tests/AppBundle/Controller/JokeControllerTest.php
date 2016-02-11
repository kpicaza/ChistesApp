<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class JokeControllerTest extends WebTestCase
{

    const ID = 3;
    const JOKE = 'A bad joke';
    const NEW_JOKE = 'My new Joke';

    public function testJokeIndex()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/jokes');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');

        $this->assertEquals(5, $crawler->filter('.joke')->count(), 'Expect Right number of jokes');

        $this->assertEquals(1, $crawler->filter('.joke:contains("' . self::JOKE . '")')->count(), 'Expected joke is in jokes');
    }

    public function testJokeShow()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/jokes/' . self::ID);

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');

        $this->assertEquals(1, $crawler->filter('.joke')->count(), 'Expect Right number of jokes');

        $this->assertEquals(1, $crawler->filter('.joke:contains("' . self::JOKE . '")')->count(), 'Expected joke is in jokes');
    }

    public function testJokeNew()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/jokes/new');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');

        $this->assertEquals(1, $crawler->filter('#joke_form_joke')->count(), 'Expect Joke input');
        $this->assertEquals(1, $crawler->filter('#joke_form_published')->count(), 'Expect publish input');
        $this->assertEquals(1, $crawler->filter('#joke_form_submit')->count(), 'Expect submit button');
    }

    public function testJokeCreateWithValidValues()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/jokes/new');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');

        $form = $crawler->selectButton('Submit')->form();

        $form['joke_form[joke]'] = self::NEW_JOKE;
        $form['joke_form[published]']->tick();

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();
        
        $this->assertContains(
            self::NEW_JOKE, $client->getResponse()->getContent()
        );
    }

    public function testJokeCreateWithInvalidValues()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/jokes/new');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');

        $form = $crawler->selectButton('Submit')->form();

        $form['joke_form[joke]'] = self::NEW_JOKE;
        $form['joke_form[published]']->tick();
        $form['joke_form[_token]'] = 'sdafasdfasfdas';

        $client->submit($form);
        
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Expect Succesfull HTTP request');
        $this->assertEquals(1, $crawler->filter('#joke_form_joke')->count(), 'Expect Joke input');
        $this->assertEquals(1, $crawler->filter('#joke_form_published')->count(), 'Expect publish input');
        $this->assertEquals(1, $crawler->filter('#joke_form_submit')->count(), 'Expect submit button');
    }
    
}
