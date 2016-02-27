<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class JokeController extends Controller
{

    /**
     * 
     * @Route("/jokes", name="app_jokes")
     * @template("joke/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $jokes = $this->get('app.joke_repository')->findBy(array(), array(), 5, 0);

        return [
          'jokes' => $jokes
        ];
    }

    /**
     * 
     * @Route("/jokes/new", name="app_jokes_new")
     * @template("joke/new.html.twig")
     */
    public function newAction()
    {
        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class);

        return [
          'form' => $form->createView()
        ];
    }

    /**
     * 
     * @Route("/jokes/create", name="app_jokes_create")
     * @Method({"POST"})
     * @template("joke/new.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $obj = $this->get('app.joke_repository')->insert($form->getData());

            return $this->redirect($this->generateUrl('app_jokes_show', array('id' => $obj->getId())));
        }

        return [
          'form' => $form->createView()
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}/edit", name="app_jokes_edit")
     * @template("joke/edit.html.twig")
     * @param integer $id
     */
    public function editAction($id)
    {
        $joke = $this->get('app.joke_repository')->findOneBy(array('id' => $id));

        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class, $joke);

        return [
          'joke' => $joke,
          'form' => $form->createView()
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}/update", name="app_jokes_update")
     * @template("joke/edit.html.twig")
     * @Method({"POST"})
     */
    public function updateAction(Request $request, $id)
    {
        $joke = $this->get('app.joke_repository')->findOneBy(array('id' => $id));

        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class, $joke);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->get('app.joke_repository')->update();

            return $this->redirect($this->generateUrl('app_jokes_show', array('id' => $joke->getId())));
        }

        return [
          'form' => $form->createView(),
          'joke' => $joke
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}", name="app_jokes_show")
     * @template("joke/show.html.twig")
     */
    public function showAction(Request $request, $id)
    {
        $joke = $this->get('app.joke_repository')->findOneBy(array('id' => $id));

        return [
              'joke' => $joke
        ];
    }

}
