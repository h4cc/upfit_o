<?php

namespace Bpaulin\UpfitBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Bpaulin\UpfitBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Renvoie le tableau des elements à inclure dans une réponse Json pour datatables
     */
    public function getArrayForJson()
    {
        return array(
                $this->getId(),
                $this->getUsername(),
                $this->getEmail(),
                $this->getGravatarurl(24),
                );
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s     Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d     Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r     Maximum rating (inclusive) [ g | pg | r | x ]
     *
     * @return String containing a URL
     */
    public function getGravatarUrl($s = 40, $d = 'identicon', $r = 'g')
    {
        $url = 'http://www.gravatar.com/avatar/'
             . md5(strtolower(trim($this->getEmail())))
             . "?s=$s&d=$d&r=$r";

        return $url;
    }
}
