<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Social
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\SocialRepository")
 */
class Social
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private $createdDate;

    /**
     *@ORM\OneToMany(targetEntity="UserSocial", mappedBy="socialGroup")
     */
    private $userSocials;

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
     * Set createdDate
     *
     * @param  \DateTime   $createdDate
     * @return SocialGroup
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userSocials = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add userSocials
     *
     * @param  \Bpaulin\UpfitBundle\Entity\UserSocial $userSocials
     * @return SocialGroup
     */
    public function addUserSocial(\Bpaulin\UpfitBundle\Entity\UserSocial $userSocials)
    {
        $this->userSocials[] = $userSocials;

        return $this;
    }

    /**
     * Remove userSocials
     *
     * @param \Bpaulin\UpfitBundle\Entity\UserSocial $userSocials
     */
    public function removeUserSocial(\Bpaulin\UpfitBundle\Entity\UserSocial $userSocials)
    {
        $this->userSocials->removeElement($userSocials);
    }

    /**
     * Get userSocials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserSocials()
    {
        return $this->userSocials;
    }
}
