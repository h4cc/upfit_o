<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workout
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\WorkoutRepository")
 */
class Workout
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
     *@ORM\ManyToOne(targetEntity="Session", inversedBy="workouts")
     */
    private $session;

    /**
     *@ORM\ManyToOne(targetEntity="Exercise", inversedBy="exercises")
     */
    private $exercise;

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
     * Set session
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Session $session
     * @return Workout
     */
    public function setSession(\Bpaulin\UpfitBundle\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \Bpaulin\UpfitBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set exercise
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Exercise $exercise
     * @return Workout
     */
    public function setExercise(\Bpaulin\UpfitBundle\Entity\Exercise $exercise = null)
    {
        $this->exercise = $exercise;

        return $this;
    }

    /**
     * Get exercise
     *
     * @return \Bpaulin\UpfitBundle\Entity\Exercise
     */
    public function getExercise()
    {
        return $this->exercise;
    }
}
