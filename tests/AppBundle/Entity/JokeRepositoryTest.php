<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Joke;
use AppBundle\Entity\JokeFactory;
use AppBundle\Entity\JokeGateway;
use AppBundle\Entity\JokeRepository;
use Prophecy\Prophet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * JokeRepositoryTest
 */
class JokeRepositoryTest extends WebTestCase
{

    const ID = 25;
    const JOKE = 'A random joke';

    private $gateway;
    private $repository;

    public function setUp()
    {
        self::bootKernel();
        parent::setUp();
        $gatewayClassname = 'AppBundle\Entity\JokeGateway';
        $this->gateway = $this->prophesize($gatewayClassname);
        $this->factory = new JokeFactory();
        $this->repository = new JokeRepository($this->gateway->reveal(), $this->factory);
    }

    public function testFindAllJokesFromRepository()
    {
        $jokes = $this->repository->findAll();

        $this->assertTrue(is_array($jokes));
    }

    public function testFindByJokesFromRepositoryWithEmptyParams()
    {
        $jokes = $this->repository->findBy();

        $this->assertTrue(is_array($jokes));
    }

    public function testFindByJokesFromRepositoryWithValidParams()
    {
        $jokes = $this->repository->findBy(array('published' => true));

        $this->assertTrue(is_array($jokes));
    }

    public function testFindOneByWithParams()
    {
        $fakeJoke = new Joke(self::JOKE, true);

        $this->gateway->findOneBy(['joke' => self::JOKE], [])->willReturn($fakeJoke);
        $fakeJoke = $this->factory->makeOne($fakeJoke);

        $joke = $this->repository->findOneBy(array('joke' => self::JOKE));

        $this->assertTrue($joke instanceof Joke);
        $this->assertEquals($joke, $fakeJoke);
    }

    public function testFindOneByWithBadParams()
    {
        $this->setExpectedException('\Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
        $this->repository->findOneBy(['joke' => 'jhkjgkjh'], [])->willThrow();
    }

    public function testInsertWithValidParams()
    {
        $fakeJoke = new Joke(self::JOKE, true);
        
        $this->gateway->insert($fakeJoke)->willReturn($fakeJoke);
        
        $this->factory->makeOne($fakeJoke);

        $joke = $this->repository->insert(array('joke' => self::JOKE, 'published' => true));

        $this->gateway->findAll()->willReturn(array($fakeJoke));
        
        $jokes = $this->repository->findAll();
        $foundJoke = $jokes[$joke->getId()];

        $this->assertTrue($joke instanceof Joke);
        $this->assertEquals($foundJoke->getJoke(), $fakeJoke->getJoke());
        $this->assertEquals($foundJoke->getPublished(), $fakeJoke->getPublished());
    }

    protected function tearDown()
    {
        $prophet = new Prophet();
        $prophet->checkPredictions();
    }

}
