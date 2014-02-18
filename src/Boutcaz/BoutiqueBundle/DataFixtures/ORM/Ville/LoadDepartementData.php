<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadDepartementsData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Ville;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Boutcaz\BoutiqueBundle\Entity\Departement;


class LoadDepartementData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    
    public function load(ObjectManager $manager)
	{	
	
		// Création des départements PACA
		$bouches_du_rhone 	= $this->createDepartement('Bouches-du-Rhone', 13 , $this->getReference('region-pa') );
		$var 				= $this->createDepartement('Var',			   83 , $this->getReference('region-pa') );
		$vaucluse 			= $this->createDepartement('Vaucluse', 		   84 , $this->getReference('region-pa') );
		$haute_alpes 		= $this->createDepartement('Hautes-Alpes', 	   05 , $this->getReference('region-pa') );
		$alpes_maritimes 	= $this->createDepartement('Alpes-Maritime',   06 , $this->getReference('region-pa') );
		
		
		// Enregistrement dans doctrine
		$manager->persist($bouches_du_rhone);
		$manager->persist($var);
		$manager->persist($vaucluse);
		$manager->persist($haute_alpes);
		$manager->persist($alpes_maritimes);
		
		// Enregistrement en BDD
		$manager->flush();

		// Ajout des références pour transmettre aux villes
		$this->addReference('departement-bdr', $bouches_du_rhone);
		$this->addReference('departement-var', $var);
		$this->addReference('departement-vau', $vaucluse);
		$this->addReference('departement-hlp', $haute_alpes);
		$this->addReference('departement-alm', $alpes_maritimes);			
	}
	
	// Fonction de création golbale
	private function createDepartement($nom, $num, $region_id ) {
		$departements = new Departement();
		$departements->setDepartement($nom);
		$departements->setNumero($num);
		$departements->setRegion($region_id);
 
		return $departements;
	}
    
    // Fonction de mise en ordre
    public function getOrder()
	{
		return 2; 
	}
    
}