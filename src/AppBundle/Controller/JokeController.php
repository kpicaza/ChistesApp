<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class JokeController extends Controller
{

    /**
     * @Route("/jokes", name="app_jokes")
     */
    public function indexAction(Request $request)
    {
        $jokes = $this->get('app.joke_repository')->findBy(array(), array(), 5, 0);

        return $this->render('joke/index.html.twig', [
              'jokes' => $jokes
        ]);
    }

    /**
     * @Route("/jokes/new", name="app_jokes_new")
     */
    public function newAction()
    {
        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class);

        return $this->render('joke/new.html.twig', [
              'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/jokes/create", name="app_jokes_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $obj = $this->get('app.joke_repository')->insert($form->getData());

            return $this->redirect($this->generateUrl('app_jokes_show', array('id' => $obj->getId())));
        }

        return $this->render('joke/new.html.twig', [
              'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/jokes/{id}", name="app_jokes_show")
     */
    public function showAction(Request $request, $id)
    {
        $joke = $this->get('app.joke_repository')->findOneBy(array('id' => $id));

        return $this->render('joke/show.html.twig', [
              'joke' => $joke
        ]);
    }

}
