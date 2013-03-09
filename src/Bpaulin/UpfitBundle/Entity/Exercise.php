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
     * @ORM\OneToMany(targetEntity="Workout", mappedBy="exercices")
     */
    private $exercises;


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
     * @param string $name
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
     * Constructor
     */
    public function __construct()
    {
        $this->exercises = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exercises
     *
     * @param \Bpaulin\UpfitBundle\Entity\Workout $exercises
     * @return Exercise
     */
    public function addExercise(\Bpaulin\UpfitBundle\Entity\Workout $exercises)
    {
        $this->exercises[] = $exercises;

        return $this;
    }

    /**
     * Remove exercises
     *
     * @param \Bpaulin\UpfitBundle\Entity\Workout $exercises
     */
    public function removeExercise(\Bpaulin\UpfitBundle\Entity\Workout $exercises)
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
