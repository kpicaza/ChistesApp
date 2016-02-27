<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * JokeGateway
 */
class JokeGateway extends EntityRepository
{

    /**
     * 
     * @param \AppBundle\Entity\Joke $joke
     * @return \AppBundle\Entity\Joke
     */
    public function insert(Joke $joke)
    {
        $this->_em->persist($joke);
        $this->_em->flush();
        
        return $joke;
    }

    /**
     * 
     */
    public function update()
    {
        $this->_em->flush();
    }
}
