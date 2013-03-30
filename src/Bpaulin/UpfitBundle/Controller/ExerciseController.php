<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Exercise;
use Bpaulin\UpfitBundle\Form\ExerciseType;

/**
 * Exercise controller.
 *
 * @Route("club/{idClub}/exercise")
 */
class ExerciseController extends Controller
{
    /**
     * Lists all Exercise entities.
     *
     * @Route("/", name="exercise")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($idClub)
    {
        $em = $this->getDoctrine()->getManager();

        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('MASTER', $club)) {
            $this->get('session')->getFlashBag()->add('error', "You're not admin in this club");
            return $this->redirect($this->generateUrl('user_home'));
        }

        $entities = $em->getRepository('BpaulinUpfitBundle:Exercise')->findBy(
            array(
                'club' => $club
            )
        );

        return array(
            'entities' => $entities,
            'club' => $club
        );
    }

    /**
     * Displays a form to create a new Exercise entity.
     *
     * @Route("/new", name="exercise_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($idClub)
    {
        $em = $this->getDoctrine()->getManager();

        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('MASTER', $club)) {
            $this->get('session')->getFlashBag()->add('error', "You're not admin in this club");
            return $this->redirect($this->generateUrl('user_home'));
        }

        $entity = new Exercise();
        $form   = $this->createForm(new ExerciseType(), $entity);

        return array(
            'club'   => $club,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Exercise entity.
     *
     * @Route("/", name="exercise_create")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Exercise:new.html.twig")
     */
    public function createAction($idClub, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);

        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted('MASTER', $club)) {
            $this->get('session')->getFlashBag()->add('error', "You're not admin in this club");
            return $this->redirect($this->generateUrl('user_home'));
        }

        $entity  = new Exercise();
        $entity->setClub($club);
        $form = $this->createForm(new ExerciseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', "Exercise created");
            return $this->redirect($this->generateUrl('exercise', array('idClub'=>$club->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Exercise entity.
     *
     * @Route("/{id}", name="exercise_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Exercise entity.
     *
     * @Route("/{id}/edit", name="exercise_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        $editForm = $this->createForm(new ExerciseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Exercise entity.
     *
     * @Route("/{id}", name="exercise_update")
     * @Method("PUT")
     * @Template("BpaulinUpfitBundle:Exercise:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ExerciseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('exercise_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Exercise entity.
     *
     * @Route("/{id}", name="exercise_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Exercise entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('exercise'));
    }

    /**
     * Creates a form to delete a Exercise entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
