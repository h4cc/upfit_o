<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Social;
use Bpaulin\UpfitBundle\Entity\UserSocial;
use Bpaulin\UpfitBundle\Form\SocialType;
use Bpaulin\UpfitBundle\Form\InvitationType;

/**
 * @Route("/user/social")
 */
class SocialController extends Controller
{
    /**
     * @Route("", name="user_social_list")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('BpaulinUpfitBundle:UserSocial')->findByUser(
            $this->get('security.context')->getToken()->getUser()
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * @Route("/new", name="user_social_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Social();
        $form   = $this->createForm(new SocialType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Social entity and invite current user.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Route("/create", name="user_social_create")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Social:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Social();
        $form = $this->createForm(new SocialType(), $entity);

        $form->bind($request);
        if ($form->isValid()) {
            $entity->setCreatedDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $userSocial = new UserSocial();
            $userSocial->setSocial($entity)
                        ->setUser($this->get('security.context')->getToken()->getUser())
                        ->setGroupName($entity->getName())
                        ->setInvitedDate(new \DateTime('now'))
                        ->setStatus(2);
            $em->persist($userSocial);

            $em->flush();
            $this->get('session')->setFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('user_social_list'));
        }
        $this->get('session')->setFlash(
            'error',
            'Problem!'
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * @Route("/{socialId}/invite", name="user_social_invite")
     * @Template()
     */
    public function inviteAction($socialId)
    {
        $entity = new Social();
        $form   = $this->createForm(new InvitationType());

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'socialId' => $socialId,
        );
    }

    /**
     * @Route("/{socialId}/checkinvite", name="user_social_checkinvite")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Social:invite.html.twig")
     */
    public function checkInviteAction(Request $request, $socialId)
    {
        $entity  = new Social();
        $form = $this->createForm(new InvitationType());

        $form->bind($request);
        if ($form->isValid()) {
            $entity->setCreatedDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $userSocial = new UserSocial();
            $userSocial->setSocial($entity)
                        ->setUser($this->get('security.context')->getToken()->getUser())
                        ->setGroupName($entity->getName())
                        ->setInvitedDate(new \DateTime('now'))
                        ->setStatus(2);
            $em->persist($userSocial);

            $em->flush();
            $this->get('session')->setFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('user_social_list'));
        }
        $this->get('session')->setFlash(
            'error',
            'Problem!'
        );

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'socialId' => $socialId,
        );
    }
}
