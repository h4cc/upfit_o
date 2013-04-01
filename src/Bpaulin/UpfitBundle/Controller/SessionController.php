<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Session;

/**
 * Session controller.
 *
 * @Route("session/{idClub}")
 */
class SessionController extends Controller
{
    /**
     * Select program
     *
     * @Route("/program", name="user_session_program")
     * @Method("GET")
     * @Template()
     */
    public function programAction($idClub)
    {
        $em = $this->getDoctrine()->getManager();

        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);

        $securityContext = $this->get('security.context');

        // check for member access
        if (false === $securityContext->isGranted('VIEW', $club)) {
            $this->get('session')->getFlashBag()->add('error', "You're not a member of this club");

            return $this->redirect($this->generateUrl('user_home'));
        }

        $programs = $em->getRepository('BpaulinUpfitBundle:Program')->findBy(
            array(
                'club' => $club
            )
        );

        return array(
            'club' => $club,
            'programs' => $programs,
        );
    }

    /**
     * Begin session
     *
     * @Route("/program/{idProgram}/begin", name="user_session_begin")
     * @Method("GET")
     * @Template()
     */
    public function beginAction($idClub, $idProgram)
    {
        $em = $this->getDoctrine()->getManager();

        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);

        $securityContext = $this->get('security.context');

        // check for member access
        if (false === $securityContext->isGranted('VIEW', $club)) {
            $this->get('session')->getFlashBag()->add('error', "You're not a member of this club");

            return $this->redirect($this->generateUrl('user_home'));
        }

        $session = new Session();
        $session->setMember($member);
        $em->persist($session);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', "Session Created");

        return $this->forward('BpaulinUpfitBundle:Session:exercise', array('idSession'=>$session->getId()));
    }

    /**
     * End session
     *
     * @Route("/{idSession}/end", name="user_session_end")
     * @Method("GET")
     * @Template()
     */
    public function endAction($idSession)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $em->getRepository('BpaulinUpfitBundle:Session')->find($idSession);

        if (!$session || $session->getMember()->getUser() != $this->getUser()) {
            $this->get('session')->getFlashBag()->add('error', "This session is not yours");

            return $this->redirect('BpaulinUpfitBundle:Default:user', array());
        }

        $session->setEnd(new \DateTime());
        $em->persist($session);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', "Session Ended");

        return $this->forward('BpaulinUpfitBundle:Default:user', array());
    }

    /**
     * Select Exercise to session
     *
     * @Route("/{idSession}/exercise", name="user_session_exercise")
     * @Method("GET")
     * @Template()
     */
    public function exerciseAction($idSession)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $em->getRepository('BpaulinUpfitBundle:Session')->find($idSession);

        if (!$session || $session->getMember()->getUser() != $this->getUser()) {
            $this->get('session')->getFlashBag()->add('error', "This session is not yours");

            return $this->redirect('BpaulinUpfitBundle:Default:user', array());
        }

        return array(
            'session' => $session,
        );
    }

    /**
     * Create Exercise to session
     *
     * @Route("/{idSession}/exercise/new", name="session_new_exercise")
     * @Method("GET")
     * @Template()
     */
    public function createExerciseAction($idSession)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $em->getRepository('BpaulinUpfitBundle:Session')->find($idSession);

        if (!$session || $session->getMember()->getUser() != $this->getUser()) {
            $this->get('session')->getFlashBag()->add('error', "This session is not yours");

            return $this->redirect('BpaulinUpfitBundle:Default:user', array());
        }

        if ($session->getMember()->getAdmin()) {
            $this->get('session')->getFlashBag()->add('error', "You can't create exercise for this club");

            return $this->redirect('BpaulinUpfitBundle:Default:user', array());
        }

        $entity = new Exercise();
        $form   = $this->createForm(new ExerciseType(), $entity);

        return array(
            'entity'  => $entity,
            'form'    => $form->createView(),
            'session' => $session,
        );
    }

    /**
     * Lists all Session entities.
     *
     * @Route("/", name="session")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BpaulinUpfitBundle:Session')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Session entity.
     *
     * @Route("/{id}", name="session_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BpaulinUpfitBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
