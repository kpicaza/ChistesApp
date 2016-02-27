<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * JokeRepository
 */
class JokeRepository
{

    /**
     * @var \AppBundle\Entity\JokeGateway 
     */
    private $gateway;
    
    /**
     * @var \AppBundle\Entity\JokeFactory 
     */
    private $factory;

    /**
     * 
     * @param \AppBundle\Entity\JokeGateway $gateway
     * @param \AppBundle\Entity\JokeFactory $factory
     */
    public function __construct(JokeGateway $gateway, JokeFactory $factory)
    {
        $this->gateway = $gateway;
        $this->factory = $factory;
    }

    /**
     * 
     * @return array
     */
    public function findAll()
    {
        $jokes = $this->gateway->findAll();

        return null === $jokes ? array() : $this->factory->makeAll($jokes);
    }

    /**
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findBy(array $criteria = array(), array $orderBy = array('created_at' => 'ASC'), $limit = null, $offset = null)
    {
        $jokes = $this->gateway->findBy($criteria, $orderBy, $limit, $offset);

        return null === $jokes ? array() : $this->factory->makeAll($jokes);
    }

    /**
     * 
     * @param array $criteria
     * @param array $orderBy
     * @return Joke
     * @throws NotFoundHttpException
     */
    public function findOneBy(array $criteria, array $orderBy = array())
    {
        $joke = $this->gateway->findOneBy($criteria, $orderBy);

        if (null === $joke) {
            throw new NotFoundHttpException('Entity Joke not Found');
        }

        return $this->factory->makeOne($joke);
    }

    /**
     * 
     * @param array $params
     * @return Joke
     */
    public function insert(array $params)
    {
        $joke = Joke::fromArray($params);
                
        $rawJoke = $this->gateway->insert($joke);
        
        return $this->factory->makeOne($rawJoke);
        
    }

    /**
     * 
     */
    public function update()
    {
        $this->gateway->update();
    }
}
