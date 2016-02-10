<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
}
