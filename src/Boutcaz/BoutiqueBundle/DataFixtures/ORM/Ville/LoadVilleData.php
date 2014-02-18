<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadVilleData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Ville;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\Departement;
use Boutcaz\BoutiqueBundle\Entity\Region;
use Boutcaz\BoutiqueBundle\Entity\Ville;


class LoadVilleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Bouches du rhone
		$marseille  	= $this->createVille('Marseille'			, $this->getReference('departement-bdr'));
		$aix_en_pce  	= $this->createVille('Aix en Provence'		, $this->getReference('departement-bdr'));
		$eguilles  		= $this->createVille('Eguilles'				, $this->getReference('departement-bdr'));
		$aubagne  		= $this->createVille('Aubagne'				, $this->getReference('departement-bdr'));
		$trets  		= $this->createVille('Trets'				, $this->getReference('departement-bdr'));
		$gardanne  		= $this->createVille('Gardanne'				, $this->getReference('departement-bdr'));
		$septemes  		= $this->createVille('Septemes les vallons'	, $this->getReference('departement-bdr'));
		
		
		// Var
		$st_julien 		= $this->createVille('St Julien'			, $this->getReference('departement-var'));
		$ginasservis 	= $this->createVille('Ginasservis'			, $this->getReference('departement-var'));
		$la_verdiere 	= $this->createVille('La verdiere'			, $this->getReference('departement-var'));
		$vinon 			= $this->createVille('Vinon sur Verdon'		, $this->getReference('departement-var'));
		
		// Hautes Alpes
		$manosque 		= $this->createVille('Manosque'				, $this->getReference('departement-hlp'));
		$volx 			= $this->createVille('Volx'					, $this->getReference('departement-hlp'));
		$st_tulle 		= $this->createVille('Sainte Tulle'			, $this->getReference('departement-hlp'));
		
		
		// Persist des objets
		$manager->persist($marseille);
		$manager->persist($aix_en_pce);
		$manager->persist($eguilles);
		$manager->persist($aubagne);
		$manager->persist($trets);
		$manager->persist($gardanne);
		$manager->persist($vinon);
		$manager->persist($st_julien);
		$manager->persist($la_verdiere);
		$manager->persist($ginasservis);
		$manager->persist($st_tulle);
		$manager->persist($volx);
		$manager->persist($septemes);

		
		$manager->flush();
	}	
	
	// Fonction de création golbale
	private function createVille($nom, $num ) {
		$ville = new Ville();
		$ville->setVille($nom);
		$ville->setDepartement($num);
 
		return $ville;
	}		

	public function getOrder()
	{
		return 3; 
	}   
    
}