<?php

namespace Boutcaz\BoutiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Boutcaz\BoutiqueBundle\Entity\CategorieRepository")
 */
class Categorie
{    
	/**
     * @ORM\ManyToOne(targetEntity="Boutcaz\BoutiqueBundle\Entity\ParentCategorie", cascade={"persist"}))
     * @ORM\JoinColumn(nullable = false)
     */
    private $parentcategorie;
    
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
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

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
     * Set categorie
     *
     * @param string $categorie
     * @return Categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set parentcategorie
     *
     * @param \Boutcaz\BoutiqueBundle\Entity\ParentCategorie $parentcategorie
     * @return Categorie
     */
    public function setParentcategorie(\Boutcaz\BoutiqueBundle\Entity\ParentCategorie $parentcategorie)
    {
        $this->parentcategorie = $parentcategorie;

        return $this;
    }

    /**
     * Get parentcategorie
     *
     * @return \Boutcaz\BoutiqueBundle\Entity\ParentCategorie 
     */
    public function getParentcategorie()
    {
        return $this->parentcategorie;
    }
}
