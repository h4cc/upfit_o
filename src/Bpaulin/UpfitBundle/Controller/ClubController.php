<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Bpaulin\UpfitBundle\Entity\Club;
use Bpaulin\UpfitBundle\Form\ClubType;
use Bpaulin\UpfitBundle\Entity\Member;
use Bpaulin\UpfitBundle\Form\MemberType;

/**
 * Club controller
 */
class ClubController extends AbstractController
{
    /**
     * Lists all Club entities.
     * @Route("/admin/club/", name="admin_club")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/admin/club/ajax", name="admin_ajax_clubs_list")
     * @Template()
     */
    public function clubsAjaxAction(Request $request)
    {
        return $this->abstractAjaxAction(
            $request,
            'BpaulinUpfitBundle:Club',
            array('id', 'name')
        );
    }

    /**
     * @Route("/admin/club/{id}/member/ajax", name="admin_ajax_member_list")
     * @Template()
     */
    public function membersAjaxAction(Request $request, Club $entity)
    {
        return $this->abstractAjaxAction(
            $request,
            'BpaulinUpfitBundle:Member',
            array('id','user.username','user.email','admin'),
            'club = '.$entity->getId()
        );
    }

    /**
     * Displays a form to create a new Club entity.
     *
     * @Route("/admin/club/new", name="admin_club_new")
     * @Method("GET")
     * @Template("BpaulinUpfitBundle:Club:edit.html.twig")
     */
    public function newAction()
    {
        $entity = new Club();
        $form   = $this->createForm(new ClubType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Club entity.
     *
     * @Route("/admin/club/create", name="admin_club_create")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Club:edit.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Club();
        $form = $this->createForm(new ClubType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_club', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Club entity.
     *
     * @Route("/admin/club/{id}/show", name="admin_club_show", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function showAction(Club $entity)
    {
        return array(
            'entity'  => $entity,
        );
    }

    protected function commonMember(Club $entity, Member $member)
    {
        $em = $this->getDoctrine()->getManager();
        $members = $em->getRepository('BpaulinUpfitBundle:Member')->findBy(
            array(
                'club' => $entity
            )
        );

        $form   = $this->createForm(
            new MemberType(),
            $member,
            array(
                'em' => $this->getDoctrine()->getManager(),
            )
        );

        return array(
            'entity'  => $entity,
            'members' => $members,
            'member' => $member,
            'form'   => $form,
        );
    }

    /**
     * Display club's members.
     *
     * @Route("/admin/club/{id}/members", name="admin_club_members", options={"expose"=true})
     * @Method("GET")
     * @Template("BpaulinUpfitBundle:Club:members.html.twig")
     */
    public function membersAction(Club $entity)
    {
        $member = new Member();
        $return = $this->commonMember($entity, $member);
        $return['form'] = $return['form']->createView();
        return $return;
    }

    /**
     * Edit a club member.
     *
     * @Route("/admin/club/{id}/member/{member_id}", name="admin_club_member", options={"expose"=true})
     * @ParamConverter("member", class="BpaulinUpfitBundle:Member", options={"id" = "member_id"})
     * @Method("GET")
     * @Template("BpaulinUpfitBundle:Club:members.html.twig")
     */
    public function memberAction(Club $entity, Member $member)
    {
        $return = $this->commonMember($entity, $member);
        $return['form'] = $return['form']->createView();
        return $return;
    }

    /**
     * Update a club member.
     *
     * @Route("/admin/club/{id}/member/{member_id}", name="admin_club_update_member")
     * @ParamConverter("member", class="BpaulinUpfitBundle:Member", options={"id" = "member_id"})
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Club:members.html.twig")
     */
    public function updateMemberAction(Request $request, Club $entity, Member $member)
    {
        $return = $this->commonMember($entity, $member);

        $return['form']->bind($request);
        if ($return['form']->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_club_members', array('id'=>$entity->getId())));
        }

        $return['form'] = $return['form']->createView();
        return $return;
    }

    /**
     * Add a member to an existing Club entity.
     *
     * @Route("/admin/club/{id}/add", name="admin_club_add_member")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Club:members.html.twig")
     */
    public function addMemberAction(Request $request, Club $entity)
    {
        $member = new Member();
        $member->setClub($entity);
        $return = $this->commonMember($entity, $member);

        $return['form']->bind($request);
        if ($return['form']->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();
            return $this->redirect($this->generateUrl('admin_club_members', array('id'=>$entity->getId())));
        }

        $return['form'] = $return['form']->createView();
        return $return;
    }

    /**
     * Displays a form to edit an existing Club entity.
     *
     * @Route("/admin/club/{id}/edit", name="admin_club_edit", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function editAction(Club $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createForm(new ClubType(), $entity);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Club entity.
     *
     * @Route("/admin/club/{id}", name="admin_club_update")
     * @Method("POST")
     * @Template("BpaulinUpfitBundle:Club:edit.html.twig")
     */
    public function updateAction(Request $request, Club $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createForm(new ClubType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_club'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
}
