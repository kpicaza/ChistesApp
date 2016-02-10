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

    private $gateway;
    private $repository;

    public function setUp()
    {
        self::bootKernel();
        parent::setUp();
        $gatewayClassname = 'AppBundle\Entity\JokeGateway';
        $this->gateway = $this->prophesize($gatewayClassname);
        $factory = new JokeFactory();
        $this->repository = new JokeRepository($this->gateway->reveal(), $factory);
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

}
