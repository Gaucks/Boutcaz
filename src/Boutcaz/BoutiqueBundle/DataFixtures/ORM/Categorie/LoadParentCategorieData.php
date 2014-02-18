<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadParentCategorieData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Categories;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\ParentCategorie;


class LoadParentCategorieData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Creation des categories parents
		$multimedia  		= $this->createParentsCategorie('Multimédia');
		$vehicules  		= $this->createParentsCategorie('Véhicules');
		$immobilier  		= $this->createParentsCategorie('Immobilier');
		$maison  			= $this->createParentsCategorie('Maison');
		$loisir  			= $this->createParentsCategorie('Loisir');
		$emploi_services  	= $this->createParentsCategorie('Emploi & services');
		$pro_equipement  	= $this->createParentsCategorie('Equipement professionnel');
		$autres  			= $this->createParentsCategorie('Autres');

		$manager->persist($multimedia);
		$manager->persist($vehicules);
		$manager->persist($immobilier);
		$manager->persist($maison);
		$manager->persist($loisir);
		$manager->persist($emploi_services);
		$manager->persist($pro_equipement);
				
		$manager->flush();
		
		$this->addReference('parents-1', $multimedia);
		$this->addReference('parents-2', $vehicules);
		$this->addReference('parents-3', $immobilier);
		$this->addReference('parents-4', $maison);
		$this->addReference('parents-5', $loisir);
		$this->addReference('parents-6', $emploi_services);
		$this->addReference('parents-7', $pro_equipement);
		$this->addReference('parents-8', $autres);
	}	
	
	// Fonction de création globale
	private function createParentsCategorie($nom) {
		$parents_categorie = new ParentCategorie();
		$parents_categorie->setParent($nom);
 
		return $parents_categorie;
	}		

	public function getOrder()
	{
		return 1; 
	}   
    
}