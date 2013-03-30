<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bpaulin\UpfitBundle\Entity\Club;
use Bpaulin\UpfitBundle\Entity\Member;

/**
 * Club controller.
 *
 * @Route("/user/club")
 */
class ClubController extends Controller
{
    /**
     * Create user personnal club
     *
     * @Route("/create", name="user_club_create")
     * @Method("GET")
     */
    public function createAction()
    {
        $referer = $this->getRequest()->headers->get('referer');

        $em = $this->getDoctrine()->getManager();
        $repoMember = $em->getRepository('BpaulinUpfitBundle:Member');
        $user = $this->getUser();

        // Check if club exists
        $member = $repoMember->findOneBy(
            array(
                'user'  => $user,
                'owner' => true,
            )
        );
        if ($member) {
            // club exists
            $this->get('session')->getFlashBag()->add('info', 'Club already exist');
        } else {
            // club does not exist
            $club = new Club();
            $club->setName($user->getUsername());
            $em->persist($club);

            $member = new Member();
            $member
                ->setClub($club)
                ->setUser($user)
                ->setOwner(true)
                ->setAdmin(true);
            $em->persist($member);

            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Club created');
        }

        return $this->redirect($referer);
    }

    /**
     * @Route("/{idClub}/admin/", name="user_club_admin")
     * @Method("GET")
     * @Template()
     */
    public function adminAction($idClub)
    {
        $em = $this->getDoctrine()->getManager();

        $repoMember = $em->getRepository('BpaulinUpfitBundle:Member');
        $repoClub = $em->getRepository('BpaulinUpfitBundle:Club');
        $club = $repoClub->find($idClub);
        $member = $repoMember->findOneBy(
            array(
                "club"  => $club,
                "admin" => 1
            )
        );
        if (!$member){
            $this->get('session')->getFlashBag()->add('error', "You're not admin in this club");
            return $this->redirect($this->generateUrl('user_home'));
        }
        return array(
            'club' => $club
        );
    }
}
