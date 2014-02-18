<?php 

namespace Boutcaz\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
    
    // DANS QUEL VILLE IL SE SITUE
    /**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Ville")
    */
	private $ville;
	
	// PROFESSIONNEL OU PARTICULIER
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Type")
    */
	private $type;
    

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set ville
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Ville $ville
     * @return User
     */
    public function setVille(\Boutcaz\BoutiqueBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
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
}
