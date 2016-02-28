<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Joke;

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
     * @ParamConverter("joke", class="AppBundle:Joke", options={
     *   "repository_method" = "findOneBy", 
     *   "mapping": {
     *     "id": "id"
     *   }, 
     * })
     * @template("joke/edit.html.twig")
     * @param Joke $joke
     */
    public function editAction(Joke $joke)
    {
        $form = $this->createForm(\AppBundle\Form\Type\JokeFormType::class, $joke);

        return [
          'joke' => $joke,
          'form' => $form->createView()
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}/update", name="app_jokes_update")
     * @Method({"POST"})
     * @ParamConverter("joke", class="AppBundle:Joke", options={
     *   "repository_method" = "findOneBy", 
     *   "mapping": {
     *     "id": "id"
     *   }, 
     * })
     * @template("joke/edit.html.twig")
*/
    public function updateAction(Request $request, Joke $joke)
    {
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
     * @ParamConverter("joke", class="AppBundle:Joke", options={
     *   "repository_method" = "findOneBy", 
     *   "mapping": {
     *     "id": "id"
     *   }, 
     * })
     * @template("joke/show.html.twig")
     */
    public function showAction(Request $request, Joke $joke)
    {
        return [
          'joke' => $joke
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}/delete", name="app_jokes_delete")
     * @ParamConverter("joke", class="AppBundle:Joke", options={
     *   "repository_method" = "findOneBy", 
     *   "mapping": {
     *     "id": "id"
     *   }, 
     * })
     * @template("joke/delete.html.twig")
     * @param Joke $joke
     */
    public function deleteController(Joke $joke)
    {
        return [
          'joke' => $joke,
          'form' => $this->createDeleteForm($joke->getId())->createView()
        ];
    }

    /**
     * 
     * @Route("/jokes/{id}/delete/confirm", name="app_jokes_delete_confirm")
     * @Method({"DELETE"})
     * @ParamConverter("joke", class="AppBundle:Joke", options={
     *   "repository_method" = "findOneBy", 
     *   "mapping": {
     *     "id": "id"
     *   }, 
     * })
     * @param Request $request
     * @param Joke $joke
     * @return RedirectResponse
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function deleteConfirmController(Request $request, Joke $joke)
    {
        $form = $this->createDeleteForm($joke->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->get('app.joke_repository')->remove($joke);

            return $this->redirect($this->generateUrl('app_jokes'));
        }

        throw new \Symfony\Component\Form\Exception\InvalidConfigurationException('Invalid delete form submision.');
    }

    /**
     * 
     * @param integer $id
     * @return Form $form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                ->setAction($this->generateUrl('app_jokes_delete_confirm', array('id' => $id)))
                ->setMethod('DELETE')
                ->add('delete', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => 'Delete'))
                ->getForm()
        ;
    }

}
