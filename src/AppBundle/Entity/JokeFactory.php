<?php

namespace AppBundle\Entity;

/**
 * JokeFactory
 */
class JokeFactory
{

    /**
     * 
     * @param \AppBundle\Entity\Joke $rawJoke
     * @return \AppBundle\Entity\Joke
     */
    public function makeOne(Joke $rawJoke)
    {   
        return $this->make($rawJoke);
    }

    /**
     * 
     * @param array $rawJokes
     * @return array
     */
    public function makeAll(array $rawJokes)
    {
        foreach ($rawJokes as $rawJoke) {
            $jokes[$rawJoke->getId()] = $this->make($rawJoke);
        }

        return $jokes;
    }

    /**
     * 
     * @param \AppBundle\Entity\Joke $rawJoke
     * @return \AppBundle\Entity\Joke
     */
    private function make(Joke $rawJoke)
    {
        // You can format object, in this case we left it to return as raw object, feedback is welcome!
        return $rawJoke;
    }

}
