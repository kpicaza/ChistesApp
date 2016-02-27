<?php

namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

class JokeObject
{

    /**
     * 
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
     * 
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

    /**
     * 
     * @param string $joke
     * @param boolean $publish
     */
    public function __construct($joke = null, $publish = false)
    {
        $this->joke = $joke;
        $this->published = (bool) $publish;
    }

    /**
     * 
     * @param array $params
     * @return \AppBundle\Model\JokeObject
     */
    public static function fromArray(array $params)
    {
        return new JokeObject($params['joke'], (bool) $params['published']);
    }

    /**
     * 
     * @return string
     */
    public function getJoke()
    {
        return $this->joke;
    }

    /**
     * 
     * @param string $joke
     */
    public function setJoke($joke)
    {
        $this->joke = $joke;
    }

    /**
     * 
     * @return boolean
     */
    public function getPublished()
    {
        return (bool) $this->published;
    }

    /**
     * 
     * @param int|boolean $published
     */
    public function setPublished($published)
    {
        $this->published = (bool) $published;
    }

}
