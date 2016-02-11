<?php

namespace AppBundle\Entity;

/**
 * JokeFactory
 */
class JokeFactory
{

    public function makeOne(Joke $rawJoke)
    {   
        return $this->make($rawJoke);
    }

    public function makeAll(array $rawJokes = null)
    {
        foreach ($rawJokes as $rawJoke) {
            $jokes[$rawJoke->getId()] = $this->make($rawJoke);
        }

        return $jokes;
    }

    private function make(Joke $rawJoke)
    {
        // You can format object, in this case we left it to return as raw object, feedback is welcome!
        return $rawJoke;
    }

}
