<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Assert;

// On rajoute ce use pour le context ( le callback pour le titre ):
use Symfony\Component\Validator\ExecutionContextInterface;
use Gedmo\Mapping\Annotation as Gedmo;

use Boutcaz\BoutiqueBundle\Validator\CheckPostal;

/**
 * GuestAnnonces
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\BoutiqueBundle\Entity\GuestAnnonceRepository")
 * @Assert\Callback(methods={"titreValide"})
 */
class GuestAnnonce
{   
	
	// Lien vers l'image en relation
	/**
    * @ORM\OneToOne(targetEntity="Image", cascade={"remove", "persist"})
    */
	private $image;
	
	// DANS QUEL CATEGORIE EST L'ANNONCE
	/**
    * @ORM\ManyToOne(targetEntity="Categorie")
    */
	private $categorie;
	
	// C'EST UNE OFFRE, UNE DEMANDE OU UN DON
	/**
    * @ORM\ManyToOne(targetEntity="Proposition")
    */
	private $proposition;
	
	/**
    * @ORM\ManyToOne(targetEntity="Region")
    */
	private $region;
	
	/**
    * @ORM\ManyToOne(targetEntity="Departement")
    */
	private $departement;
	
	/**
    * @ORM\ManyToOne(targetEntity="Ville")
    */
	private $ville;
	
	// PROFESSIONNEL OU PARTICULIER
	/**
    * @ORM\ManyToOne(targetEntity="Type")
    */
	private $type;
	
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
	
	/**
	* @Gedmo\Slug(fields={"titre"})
	* @ORM\Column(length=250)
	*/
	private $slug;
	
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tarif", type="integer", nullable=true)
     */
    private $tarif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;
    
    /**
    * @var boolean
    *
    * @ORM\Column(name="published", type="boolean")
    */
    private $published;
    
    /**
    * @var string
    *
    * @ORM\Column(name="ipadress")
    */
    private $ipadress;
    
	/**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     * @Assert\Regex(pattern = "/^[a-zA-Z0-9-]+$/")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "L'email '{{ value }}' n'est pas une adresse email valide" )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     * @Assert\Regex(pattern= "/[0-9]/", message = "Veuillez utiliser le format : 0102030405" )
     */
    private $phone;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showphone", type="boolean")
     */
     private $showphone;
     
     /**
     * @var string
     * @CheckPostal()
     * @ORM\Column(name="postal", type="string")
     */
    private $postal;

	public function __construct()
	{
    	$this->date  = new \DateTime();
		$this->updated  = new \DateTime();
		$this->published  = TRUE;
		$this->showphone = FALSE;
	}
	
	 public function titreValide(ExecutionContextInterface $context)
     {
	    $mots_interdits = array('Vend', 'Vends','vend' , 'Achete', 'achete', 'donne');
	    
	    // On vérifie que le contenu ne contient pas l'un des mots
		if (preg_match('#'.implode('|', $mots_interdits).'#', $this->getTitre())) 
		{
			// La règle est violée, on définit l'erreur et son message
			// 1er argument : on dit quel attribut l'erreur concerne, ici « contenu »
			// 2e argument : le message d'erreur
			$context->addViolationAt('titre', 'Veuillez ne pas inclure " vends, achete ou donne " dans votre titre, merci.', array(), null);
		}
	    
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
     * Set titre
     *
     * @param string $titre
     * @return GuestAnnonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return GuestAnnonce
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return GuestAnnonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tarif
     *
     * @param integer $tarif
     * @return GuestAnnonce
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return integer 
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return GuestAnnonce
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return GuestAnnonce
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return GuestAnnonce
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set ipadress
     *
     * @param string $ipadress
     * @return GuestAnnonce
     */
    public function setIpadress($ipadress)
    {
        $this->ipadress = $ipadress;

        return $this;
    }

    /**
     * Get ipadress
     *
     * @return string 
     */
    public function getIpadress()
    {
        return $this->ipadress;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return GuestAnnonce
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return GuestAnnonce
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return GuestAnnonce
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return GuestAnnonce
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set showphone
     *
     * @param boolean $showphone
     * @return GuestAnnonce
     */
    public function setShowphone($showphone)
    {
        $this->showphone = $showphone;

        return $this;
    }

    /**
     * Get showphone
     *
     * @return boolean 
     */
    public function getShowphone()
    {
        return $this->showphone;
    }

    /**
     * Set postal
     *
     * @param string $postal
     * @return GuestAnnonce
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get postal
     *
     * @return string 
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set image
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Image $image
     * @return GuestAnnonce
     */
    public function setImage(\Boutcaz\BoutiqueBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Categorie $categorie
     * @return GuestAnnonce
     */
    public function setCategorie(\Boutcaz\BoutiqueBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set proposition
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Proposition $proposition
     * @return GuestAnnonce
     */
    public function setProposition(\Boutcaz\BoutiqueBundle\Entity\Proposition $proposition = null)
    {
        $this->proposition = $proposition;

        return $this;
    }

    /**
     * Get proposition
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Proposition 
     */
    public function getProposition()
    {
        return $this->proposition;
    }

    /**
     * Set region
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Region $region
     * @return GuestAnnonce
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
     * Set departement
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Departement $departement
     * @return GuestAnnonce
     */
    public function setDepartement(\Boutcaz\BoutiqueBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set ville
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Ville $ville
     * @return GuestAnnonce
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
     * @return GuestAnnonce
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
