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
    	$postal = '13100';
    	// Bouches du rhone
		$marseille  	= $this->createVille('Marseille'			, $this->getReference('departement-bdr'), $postal);
		$aix_en_pce  	= $this->createVille('Aix en Provence'		, $this->getReference('departement-bdr'), $postal);
		$eguilles  		= $this->createVille('Eguilles'				, $this->getReference('departement-bdr'), $postal);
		$aubagne  		= $this->createVille('Aubagne'				, $this->getReference('departement-bdr'), $postal);
		$trets  		= $this->createVille('Trets'				, $this->getReference('departement-bdr'), $postal);
		$gardanne  		= $this->createVille('Gardanne'				, $this->getReference('departement-bdr'), $postal);
		$septemes  		= $this->createVille('Septemes les vallons'	, $this->getReference('departement-bdr'), $postal);
		
		
		// Var
		$st_julien 		= $this->createVille('St Julien'			, $this->getReference('departement-var'), $postal);
		$ginasservis 	= $this->createVille('Ginasservis'			, $this->getReference('departement-var'), $postal);
		$la_verdiere 	= $this->createVille('La verdiere'			, $this->getReference('departement-var'), $postal);
		$vinon 			= $this->createVille('Vinon sur Verdon'		, $this->getReference('departement-var'), $postal);
		
		// Hautes Alpes
		$manosque 		= $this->createVille('Manosque'				, $this->getReference('departement-hlp'), $postal);
		$volx 			= $this->createVille('Volx'					, $this->getReference('departement-hlp'), $postal);
		$st_tulle 		= $this->createVille('Sainte Tulle'			, $this->getReference('departement-hlp'), $postal);
		
		
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
	private function createVille($nom, $num, $postal ) {
		$ville = new Ville();
		$ville->setVille($nom);
		$ville->setDepartement($num);
		$ville->setPostal($postal);
 
		return $ville;
	}		

	public function getOrder()
	{
		return 3; 
	}   
    
}