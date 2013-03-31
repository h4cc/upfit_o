<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\StageRepository")
 */
class Stage
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
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint")
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="smallint")
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="repetition", type="smallint")
     */
    private $repetition;

    /**
     *@ORM\ManyToOne(targetEntity="Program", inversedBy="stages")
     */
    private $program;

    /**
     *@ORM\ManyToOne(targetEntity="Exercise", inversedBy="stages")
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
     * Set position
     *
     * @param  integer $position
     * @return Stage
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set program
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Program $program
     * @return Stage
     */
    public function setProgram(\Bpaulin\UpfitBundle\Entity\Program $program = null)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return \Bpaulin\UpfitBundle\Entity\Program
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set exercise
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Exercise $exercise
     * @return Stage
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

    /**
     * Set number
     *
     * @param integer $number
     * @return Stage
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set repetition
     *
     * @param integer $repetition
     * @return Stage
     */
    public function setRepetition($repetition)
    {
        $this->repetition = $repetition;
    
        return $this;
    }

    /**
     * Get repetition
     *
     * @return integer 
     */
    public function getRepetition()
    {
        return $this->repetition;
    }
}