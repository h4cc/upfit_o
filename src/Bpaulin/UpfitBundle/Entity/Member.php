<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="user_club", columns={"user_id", "club_id"})})
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\MemberRepository")
 */
class Member
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="admin", type="boolean", nullable=true, options={"default" = false})
     */
    private $admin;

    /**
     * @ORM\Column(name="owner", type="boolean", nullable=true, options={"default" = false})
     */
    private $owner;

    /**
     *@ORM\ManyToOne(targetEntity="User", inversedBy="members")
     */
    private $user;

    /**
     *@ORM\ManyToOne(targetEntity="Club", inversedBy="members")
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="member")
     */
    private $sessions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param  \Bpaulin\UpfitBundle\Entity\User $user
     * @return Member
     */
    public function setUser(\Bpaulin\UpfitBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bpaulin\UpfitBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set club
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Club $club
     * @return Member
     */
    public function setClub(\Bpaulin\UpfitBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Bpaulin\UpfitBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Add sessions
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Session $sessions
     * @return Member
     */
    public function addSession(\Bpaulin\UpfitBundle\Entity\Session $sessions)
    {
        $this->sessions[] = $sessions;

        return $this;
    }

    /**
     * Remove sessions
     *
     * @param \Bpaulin\UpfitBundle\Entity\Session $sessions
     */
    public function removeSession(\Bpaulin\UpfitBundle\Entity\Session $sessions)
    {
        $this->sessions->removeElement($sessions);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set admin
     *
     * @param  boolean $admin
     * @return Member
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set owner
     *
     * @param  boolean $owner
     * @return Member
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return boolean
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
