<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Club
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\ClubRepository")
 */
class Club
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
     * @ORM\OneToMany(targetEntity="Member", mappedBy="club")
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="Exercise", mappedBy="club")
     */
    private $exercises;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param  string $name
     * @return Club
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
     * Add members
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Member $members
     * @return Club
     */
    public function addMember(\Bpaulin\UpfitBundle\Entity\Member $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Bpaulin\UpfitBundle\Entity\Member $members
     */
    public function removeMember(\Bpaulin\UpfitBundle\Entity\Member $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add exercises
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Exercise $exercises
     * @return Club
     */
    public function addExercise(\Bpaulin\UpfitBundle\Entity\Exercise $exercises)
    {
        $this->exercises[] = $exercises;

        return $this;
    }

    /**
     * Remove exercises
     *
     * @param \Bpaulin\UpfitBundle\Entity\Exercise $exercises
     */
    public function removeExercise(\Bpaulin\UpfitBundle\Entity\Exercise $exercises)
    {
        $this->exercises->removeElement($exercises);
    }

    /**
     * Get exercises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExercises()
    {
        return $this->exercises;
    }
}
