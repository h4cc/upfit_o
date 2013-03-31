<?php

namespace Bpaulin\UpfitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adjustment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\AdjustmentRepository")
 */
class Adjustment
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
     *@ORM\ManyToOne(targetEntity="Adjustment", inversedBy="adjustments")
     */
    private $machine;

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
     * @param  string     $name
     * @return Adjustment
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
     * Set machine
     *
     * @param  \Bpaulin\UpfitBundle\Entity\Adjustment $machine
     * @return Adjustment
     */
    public function setMachine(\Bpaulin\UpfitBundle\Entity\Adjustment $machine = null)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \Bpaulin\UpfitBundle\Entity\Adjustment
     */
    public function getMachine()
    {
        return $this->machine;
    }
}
