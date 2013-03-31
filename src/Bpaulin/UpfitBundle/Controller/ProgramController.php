<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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

        $repoExercise = $em->getRepository('BpaulinUpfitBundle:Exercise');
        $exercises = $repoExercise->findBy(
            array(
                'club'=>$club
            )
        );

        $entity = new Program();
        $form   = $this->createForm(new ProgramType(), $entity);

        return array(
            'club'   => $club,
            'entity' => $entity,
            'form'   => $form->createView(),
            'exercises' => $exercises
        );
    }
}
