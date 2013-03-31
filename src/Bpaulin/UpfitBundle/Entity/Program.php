<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Program
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\ProgramRepository")
 */
class Program
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     *@ORM\ManyToOne(targetEntity="Club", inversedBy="programs")
     */
    private $club;

    /**
     * @ORM\OneToMany(targetEntity="Stage", mappedBy="program", cascade={"persist"})
     */
    private $stages;

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
     * @return Program
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
        $this->stages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add stages
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Stage $stages
     * @return Program
     */
    public function addStage(\Bpaulin\UpfitBundle\Entity\Stage $stages)
    {
        $this->stages[] = $stages;
        $stages->setProgram($this);
        return $this;
    }

    /**
     * Remove stages
     *
     * @param \Bpaulin\UpfitBundle\Entity\Stage $stages
     */
    public function removeStage(\Bpaulin\UpfitBundle\Entity\Stage $stages)
    {
        $this->stages->removeElement($stages);
    }

    /**
     * Get stages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * Set club
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Club $club
     * @return Program
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
}