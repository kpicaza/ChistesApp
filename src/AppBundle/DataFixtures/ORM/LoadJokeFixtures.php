<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Joke;

class LoadJokeData implements FixtureInterface
{

    const JOKES = array(
      'A joke!', 'A nice joke', 'A bad joke', 'A random joke', 'A confused joke',
    );

    /**
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::JOKES as $joke) {
            $this->createJoke($manager, $joke);
        }
    }

    /**
     * 
     * @param ObjectManager $manager
     * @param type $n
     */
    private function createJoke(ObjectManager $manager, $joke)
    {
        $obj = new Joke($joke, true);

        $manager->persist($obj);
        $manager->flush();
    }

}
