<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\SessionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Session
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
     *@ORM\ManyToOne(targetEntity="Member", inversedBy="sessions")
     */
    private $member;

    /**
     * @ORM\OneToMany(targetEntity="Workout", mappedBy="session")
     */
    private $workouts;

    /**
     * @ORM\Column(name="begin", type="datetime")
     */
    private $begin;

    /**
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workouts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->begin = new \DateTime();
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
     * Set member
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Member $member
     * @return Session
     */
    public function setMember(\Bpaulin\UpfitBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Bpaulin\UpfitBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Add workouts
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Workout $workouts
     * @return Session
     */
    public function addWorkout(\Bpaulin\UpfitBundle\Entity\Workout $workouts)
    {
        $this->workouts[] = $workouts;

        return $this;
    }

    /**
     * Remove workouts
     *
     * @param \Bpaulin\UpfitBundle\Entity\Workout $workouts
     */
    public function removeWorkout(\Bpaulin\UpfitBundle\Entity\Workout $workouts)
    {
        $this->workouts->removeElement($workouts);
    }

    /**
     * Get workouts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkouts()
    {
        return $this->workouts;
    }

    /**
     * Set begin
     *
     * @param  \DateTime $begin
     * @return Session
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param  \DateTime $end
     * @return Session
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}
