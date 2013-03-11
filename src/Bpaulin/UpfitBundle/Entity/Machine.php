<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Machine
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\MachineRepository")
 */
class Machine
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
     * @ORM\OneToMany(targetEntity="Adjustment", mappedBy="machine")
     */
    private $adjustments;

    /**
     * @ORM\OneToMany(targetEntity="Exercise", mappedBy="machine")
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
     * @param  string  $name
     * @return Machine
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
        $this->adjustments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add adjustments
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Adjustment $adjustments
     * @return Machine
     */
    public function addAdjustment(\Bpaulin\UpfitBundle\Entity\Adjustment $adjustments)
    {
        $this->adjustments[] = $adjustments;

        return $this;
    }

    /**
     * Remove adjustments
     *
     * @param \Bpaulin\UpfitBundle\Entity\Adjustment $adjustments
     */
    public function removeAdjustment(\Bpaulin\UpfitBundle\Entity\Adjustment $adjustments)
    {
        $this->adjustments->removeElement($adjustments);
    }

    /**
     * Get adjustments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdjustments()
    {
        return $this->adjustments;
    }

    /**
     * Add exercises
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Exercise $exercises
     * @return Machine
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
