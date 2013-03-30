<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercise
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\ExerciseRepository")
 */
class Exercise
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
     * @ORM\OneToMany(targetEntity="Workout", mappedBy="exercise")
     */
    private $workouts;

    /**
     *@ORM\ManyToOne(targetEntity="Muscle", inversedBy="exercises")
     */
    private $muscle;

    /**
     *@ORM\ManyToOne(targetEntity="Machine", inversedBy="exercises")
     */
    private $machine;

    /**
     *@ORM\ManyToOne(targetEntity="Club", inversedBy="exercises")
     */
    private $club;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workouts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * string representation
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
     * @param  string   $name
     * @return Exercise
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
     * Add workouts
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Workout $workouts
     * @return Exercise
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
     * Set muscle
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Muscle $muscle
     * @return Exercise
     */
    public function setMuscle(\Bpaulin\UpfitBundle\Entity\Muscle $muscle = null)
    {
        $this->muscle = $muscle;

        return $this;
    }

    /**
     * Get muscle
     *
     * @return \Bpaulin\UpfitBundle\Entity\Muscle
     */
    public function getMuscle()
    {
        return $this->muscle;
    }

    /**
     * Set club
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Club $club
     * @return Exercise
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
     * Set machine
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Machine $machine
     * @return Exercise
     */
    public function setMachine(\Bpaulin\UpfitBundle\Entity\Machine $machine = null)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \Bpaulin\UpfitBundle\Entity\Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }
}
