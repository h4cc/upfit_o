<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Exercise;
use Bpaulin\UpfitBundle\Entity\Program;
use Bpaulin\UpfitBundle\Form\ProgramType;

/**
 * Program controller.
 *
 * @Route("club/{idClub}/program")
 */
class ProgramController extends Controller
{
    /**
     * Lists all Program entities.
     *
     * @Route("/", name="program")
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

        $entities = $em->getRepository('BpaulinUpfitBundle:Program')->findBy(
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
     * Displays a form to create a new Program entity.
     *
     * @Route("/new", name="program_new")
     * @Method("GET")
     * @Template("BpaulinUpfitBundle:Program:edit.html.twig")
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

        $entity = new Program();
        $entity->setClub($club);
        $form   = $this->createForm(new ProgramType(), $entity);

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
     * @Template("BpaulinUpfitBundle:Program:edit.html.twig")
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

        $entity = new Program();
        $entity->setClub($club);
        $form   = $this->createForm(new ProgramType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', "Program created");

            return $this->redirect($this->generateUrl('program', array('idClub'=>$club->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Finds and displays a Program entity.
     *
     * @Route("/{id}", name="program_show")
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

        $entity = $em->getRepository('BpaulinUpfitBundle:Program')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Program entity.');
        }

        return array(
            'entity'      => $entity,
            'club'        => $club,
        );
    }

}
