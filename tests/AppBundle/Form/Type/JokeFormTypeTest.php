<?php

namespace Tests\AppBundle\Form\Type;

use AppBundle\Form\Type\JokeFormType;
use AppBundle\Model\JokeObject;
use Symfony\Component\Form\Test\TypeTestCase;

class JokeFormTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $formData = array(
          'joke' => 'It is a new Joke',
          'published' => true,
        );

        $form = $this->factory->create(JokeFormType::class, new JokeObject());

        $object = JokeObject::fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
