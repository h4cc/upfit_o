<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Muscle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\MuscleRepository")
 */
class Muscle
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
     * @ORM\OneToMany(targetEntity="Exercise", mappedBy="muscle")
     */
    private $exercises;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exercises = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Muscle
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
     * Add exercises
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Exercise $exercises
     * @return Muscle
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
