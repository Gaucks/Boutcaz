<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// On rajoute ce use pour le context :
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Annonces
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\BoutiqueBundle\Entity\AnnonceRepository")
 * @Assert\Callback(methods={"titreValide"})
 */
class Annonce
{   
	
	// Qui est l'auteur
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\UserBundle\Entity\User")
    */
	private $user;
	
	// DANS QUEL CATEGORIE EST L'ANNONCE
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Categorie")
    */
	private $categorie;
	
	// C'EST UNE OFFRE, UNE DEMANDE OU UN DON
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Proposition")
    */
	private $proposition;
	
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Region")
    */
	private $region;
	
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Departement")
    */
	private $departement;
	
	/**
    * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\Ville")
    */
	private $ville;
	
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


	public function __construct()
	{
    	$this->date  = new \DateTime();
		$this->updated  = new \DateTime();
		$this->published  = TRUE;
	}
	
	 public function titreValide(ExecutionContextInterface $context)
     {
	    $mots_interdits = array('Vend', 'Vends', 'Achete', 'achete', 'donne');
	    
	    // On vérifie que le contenu ne contient pas l'un des mots
		if (preg_match('#'.implode('|', $mots_interdits).'#', $this->getTitre())) 
		{
			// La règle est violée, on définit l'erreur et son message
			// 1er argument : on dit quel attribut l'erreur concerne, ici « contenu »
			// 2e argument : le message d'erreur
			$context->addViolationAt('titre', 'Titre invalide car il contient un mot interdit.', array(), null);
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
     * @return Annonce
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
     * Set description
     *
     * @param string $description
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * Set user
     *
     * @param \Boutcaz\UserBundle\Entity\User $user
     * @return Annonce
     */
    public function setUser(\Boutcaz\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Boutcaz\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categorie
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\Categorie $categorie
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
     * @return Annonce
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
}
