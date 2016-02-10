<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class Joke
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $joke;

    /**
     * @var boolean
     */
    protected $published;

    /**
     * @var datetime
     */
    protected $created_at;

    /**
     * @var datetime
     */
    protected $updated_at;

    /**
     * 
     * @param type $joke
     * @param type $published
     */
    public function __construct($joke, $published)
    {
        $this->joke = $joke;
        $this->published = $published;
        $this->created_at = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if (!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }

}
