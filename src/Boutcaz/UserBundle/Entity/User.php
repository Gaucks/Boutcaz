<?php 

namespace Boutcaz\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;	
/**
 * @ORM\Entity
 * @ORM\Table(name="qd_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    // DANS QUEL Region IL SE SITUE
    /**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Region")
    */
	private  $region;
	
	// PROFESSIONNEL OU PARTICULIER
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Type")
    */
	private $type;
    

    public function __construct()
    {
        parent::__construct();
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
     * Set type
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Type $type
     * @return User
     */
    public function setType(\Boutcaz\BoutiqueBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set region
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Region $region
     * @return User
     */
    public function setRegion(\Boutcaz\BoutiqueBundle\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }
}
