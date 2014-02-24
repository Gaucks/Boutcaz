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
	
	// A quel profile il appartient
	/**
    * @ORM\OneToOne(targetEntity="Boutcaz\UserBundle\Entity\ProfilePerso", cascade={"persist"})
    */
	private $profile;
    

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
     * Set profile
     *
     * @param \Boutcaz\UserBundle\Entity\ProfilePerso $profile
     * @return User
     */
    public function setProfile(\Boutcaz\UserBundle\Entity\ProfilePerso $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Boutcaz\UserBundle\Entity\ProfilePerso 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
