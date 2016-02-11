<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class JokeObject
{

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $joke;

    /**
     * @var boolean
     * 
     * @Assert\Range(
     *      min = 0,
     *      max = 1,
     *      minMessage = "You must set $offset betwen {{ limit }} and 1",
     *      maxMessage = "You must set $offset betwen 0 and {{ limit }}"
     * )
     */
    private $published = false;

    public function __construct($joke = null, $publish = false)
    {
        $this->joke = $joke;
        $this->published = (bool) $publish;
    }

    public static function fromArray(array $params)
    {
        return new JokeObject($params['joke'], (bool) $params['published']);
    }

    public function getJoke()
    {
        return $this->joke;
    }

    public function setJoke($joke)
    {
        $this->joke = $joke;
    }

    public function getPublished()
    {
        return (bool) $this->published;
    }

    public function setPublished($published)
    {
        $this->published = (bool) $published;
    }

}
