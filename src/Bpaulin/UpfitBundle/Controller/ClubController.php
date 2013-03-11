<?php

namespace Bpaulin\UpfitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        if (!$member) {
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
        }

        return $this->redirect($referer);
    }
}
