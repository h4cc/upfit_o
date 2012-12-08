<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSocial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\UserSocialRepository")
 */
class UserSocial
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="invited_date", type="datetime")
     */
    private $invitedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=255)
     */
    private $groupName;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     *@ORM\ManyToOne(targetEntity="User", inversedBy="userSocials")
     */
    private $user;

    /**
     *@ORM\ManyToOne(targetEntity="Social", inversedBy="userSocials")
     */
    private $social;

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
     * Set name
     *
     * @param  string     $name
     * @return UserSocial
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set invitedDate
     *
     * @param  \DateTime  $invitedDate
     * @return UserSocial
     */
    public function setInvitedDate($invitedDate)
    {
        $this->invitedDate = $invitedDate;

        return $this;
    }

    /**
     * Get invitedDate
     *
     * @return \DateTime
     */
    public function getInvitedDate()
    {
        return $this->invitedDate;
    }

    /**
     * Set groupName
     *
     * @param  string     $groupName
     * @return UserSocial
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get groupName
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set status
     *
     * @param  integer    $status
     * @return UserSocial
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param  \Bpaulin\UpfitBundle\Entity\User $user
     * @return UserSocial
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
     * Set social
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Social $social
     * @return UserSocial
     */
    public function setSocial(\Bpaulin\UpfitBundle\Entity\Social $social = null)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Get social
     *
     * @return \Bpaulin\UpfitBundle\Entity\Social
     */
    public function getSocial()
    {
        return $this->social;
    }
}
