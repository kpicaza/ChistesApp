<?php

namespace AppBundle\Entity;

class JokeRepository
{
    private $gateway;
    private $factory;

    public function __construct(JokeGateway $gateway, JokeFactory $factory)
    {
        $this->gateway = $gateway;
        $this->factory = $factory;
    }

    public function findAll()
    {
        $jokes = $this->gateway->findAll();

        return $this->factory->makeAll($jokes);
    }

    public function findBy(array $criteria = array(), $orderBy = array('created_at' => 'ASC'), $limit = null, $offset = null)
    {
        $jokes = $this->gateway->findBy($criteria, $orderBy, $limit, $offset);

        return $this->factory->makeAll($jokes);
    }

    public function findOneBy(array $criteria, array $orderBy = array())
    {
        $jokes = $this->gateway->findOneBy($criteria, $orderBy);

        return $this->factory->makeOne($jokes);
    }
}