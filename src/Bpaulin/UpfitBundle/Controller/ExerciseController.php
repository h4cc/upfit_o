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
            'club'     => $club
        );
    }

    /**
     * Displays a form to create a new Exercise entity.
     *
     * @Route("/new", name="exercise_new")
     * @Method("GET")
     * @Template("BpaulinUpfitBundle:Exercise:edit.html.twig")
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
     * @Template("BpaulinUpfitBundle:Exercise:edit.html.twig")
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
    public function showAction($idClub, $id)
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

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        return array(
            'entity'      => $entity,
            'club'        =>$club,
        );
    }

    /**
     * Displays a form to edit an existing Exercise entity.
     *
     * @Route("/{id}/edit", name="exercise_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($idClub, $id)
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

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }

        $editForm = $this->createForm(new ExerciseType(), $entity);

        return array(
            'club'        => $club,
            'entity'      => $entity,
            'form'        => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Exercise entity.
     *
     * @Route("/{id}/update", name="exercise_update")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Exercise:edit.html.twig")
     */
    public function updateAction(Request $request, $idClub, $id)
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

        $entity = $em->getRepository('BpaulinUpfitBundle:Exercise')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exercise entity.');
        }
        $editForm = $this->createForm(new ExerciseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', "Exercise updated");

            return $this->redirect($this->generateUrl('exercise', array('idClub'=>$club->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
}
