<?php 
// src/Boutcaz/BoutiqueBundle/DataFixtures/ORM/LoadCategorieData.php


namespace Boutcaz\BoutiqueBundle\DataFixtures\ORM\Categories;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Boutcaz\BoutiqueBundle\Entity\Categorie;



class LoadCategorieData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
    	// Creation des categories Multimédia
		$informatique  		= $this->createCategorie('Informatique'				, $this->getReference('parents-1'));
		$console_jeux  		= $this->createCategorie('Consoles & Jeux vidéo'	, $this->getReference('parents-1'));
		$image_son  		= $this->createCategorie('Image & Son'				, $this->getReference('parents-1'));
		$telephonie  		= $this->createCategorie('Téléphonie'				, $this->getReference('parents-1'));
		
		// Creation des categories Véhicules
		$voiture  			= $this->createCategorie('Voitures'					, $this->getReference('parents-2'));
		$moto  				= $this->createCategorie('Moto'						, $this->getReference('parents-2'));
		$caravane  			= $this->createCategorie('Caravanes'				, $this->getReference('parents-2'));
		$utilitaire  		= $this->createCategorie('Utilitaires'				, $this->getReference('parents-2'));
		$equip_auto  		= $this->createCategorie('Equipement Auto'			, $this->getReference('parents-2'));
		$equip_moto  		= $this->createCategorie('Equipement Moto'			, $this->getReference('parents-2'));
		$nautisme  			= $this->createCategorie('Nautisme'					, $this->getReference('parents-2'));
		$equip_nautisme  	= $this->createCategorie('Equipement Nautisme'		, $this->getReference('parents-2'));
		
		// Creation des categories Immobiliers
		$locations  		= $this->createCategorie('Locations'				, $this->getReference('parents-3'));
		$colocations  		= $this->createCategorie('Colocations'				, $this->getReference('parents-3'));
		$vente_immo			= $this->createCategorie('Ventes Immobilières'		, $this->getReference('parents-3'));
		$location_vac  		= $this->createCategorie('Location de vacances'		, $this->getReference('parents-3'));
		$commerce			= $this->createCategorie('Bureaux & Commerces'		, $this->getReference('parents-3'));
		
		// Creation des categories Immobiliers
		$meuble  			= $this->createCategorie('Ameublement'				, $this->getReference('parents-4'));
		$electro  			= $this->createCategorie('Electromenager'			, $this->getReference('parents-4'));
		$art_table			= $this->createCategorie('Arts de la table'			, $this->getReference('parents-4'));
		$linges_maison  	= $this->createCategorie('Linges de maison'			, $this->getReference('parents-4'));
		$bricolage			= $this->createCategorie('Bricolage'				, $this->getReference('parents-4'));
		$jardinage			= $this->createCategorie('Jardinage'				, $this->getReference('parents-4'));
		$vetements			= $this->createCategorie('Vêtements'				, $this->getReference('parents-4'));
		$chaussures			= $this->createCategorie('Chaussures'				, $this->getReference('parents-4'));
		$equip_bebe			= $this->createCategorie('Equipement bébé'			, $this->getReference('parents-4'));
		$montres_bij		= $this->createCategorie('Montres & Bijoux'			, $this->getReference('parents-4'));
		$vetements_bebe		= $this->createCategorie('Vêtements bébés'			, $this->getReference('parents-4'));
		$acc_bagage			= $this->createCategorie('Accessoires et Bagagerie'	, $this->getReference('parents-4'));
		
		// Creation des categories Loisirs
		$dvd  				= $this->createCategorie('DVD / Films'				, $this->getReference('parents-5'));
		$cd  				= $this->createCategorie('Cd & Musique'				, $this->getReference('parents-5'));
		$livres				= $this->createCategorie('Livres'					, $this->getReference('parents-5'));
		$animaux  			= $this->createCategorie('Animaux'					, $this->getReference('parents-5'));
		$commerce			= $this->createCategorie('Vélos'					, $this->getReference('parents-5'));
		$sports  			= $this->createCategorie('Sports & Hobbies'			, $this->getReference('parents-5'));
		$instrument  		= $this->createCategorie('Instruments de musique'	, $this->getReference('parents-5'));
		$collection			= $this->createCategorie('Collections'				, $this->getReference('parents-5'));
		$jouets  			= $this->createCategorie('Jouets'					, $this->getReference('parents-5'));
		$vins				= $this->createCategorie('Gastronomie & Vins'		, $this->getReference('parents-5'));
		
		// Creation des categories Immobiliers
		$materiel  			= $this->createCategorie('Materiel Agricole'		, $this->getReference('parents-6'));
		$trans_manut 		= $this->createCategorie('Transport & Manutention'	, $this->getReference('parents-6'));
		$btp				= $this->createCategorie('BTP'						, $this->getReference('parents-6'));
		$outillage  		= $this->createCategorie('Outillage'				, $this->getReference('parents-6'));
		$equip_indu			= $this->createCategorie('Equipement industriel'	, $this->getReference('parents-6'));
		$resto_hotel  		= $this->createCategorie('Restauration - Hotellerie', $this->getReference('parents-6'));
		$comm_marche  		= $this->createCategorie('Commerces & Marchés'		, $this->getReference('parents-6'));
		$fourniture			= $this->createCategorie('Fourniture de bureau'		, $this->getReference('parents-6'));
		$medical  			= $this->createCategorie('Materiel Medical'			, $this->getReference('parents-6'));
		
		// Creation des categories Emplois et Services
		$emplois  			= $this->createCategorie('Emplois'					, $this->getReference('parents-7'));
		$services  			= $this->createCategorie('Services'					, $this->getReference('parents-7'));
		$billeteries		= $this->createCategorie('Billeteries'				, $this->getReference('parents-7'));
		$evenement  		= $this->createCategorie('Evenements'				, $this->getReference('parents-7'));
		$cours				= $this->createCategorie('Cours particuliers'		, $this->getReference('parents-7'));
		
		// Creation des categories Divers
		$divers  			= $this->createCategorie('Divers'					, $this->getReference('parents-8'));
		
		// Enregistrement des categories Multimédia
		$manager->persist($informatique);
		$manager->persist($console_jeux);
		$manager->persist($image_son);
		$manager->persist($telephonie);
		
		// Enregistrement des categories Vehicules
		$manager->persist($voiture);
		$manager->persist($moto);
		$manager->persist($caravane);
		$manager->persist($utilitaire);
		$manager->persist($equip_auto);
		$manager->persist($equip_moto);
		$manager->persist($nautisme);
		$manager->persist($equip_nautisme);
		
		// Enregistrement des categories Immobiliers
		$manager->persist($locations);
		$manager->persist($colocations);
		$manager->persist($vente_immo);
		$manager->persist($location_vac);
		$manager->persist($commerce);
		
		// Enregistrement des categories Maison
		$manager->persist($meuble);
		$manager->persist($electro);
		$manager->persist($art_table);
		$manager->persist($linges_maison);
		$manager->persist($bricolage);
		$manager->persist($jardinage);
		$manager->persist($vetements);
		$manager->persist($chaussures);
		$manager->persist($equip_bebe);
		$manager->persist($montres_bij);
		$manager->persist($vetements_bebe);
		$manager->persist($acc_bagage);
		
		// Enregistrement des categories Loisirs
		$manager->persist($dvd);
		$manager->persist($cd);
		$manager->persist($livres);
		$manager->persist($animaux);
		$manager->persist($commerce);
		$manager->persist($sports);
		$manager->persist($instrument);
		$manager->persist($collection);
		$manager->persist($jouets);
		$manager->persist($vins);
		
		// Enregistrement des Materiels Professionnel
		$manager->persist($materiel);
		$manager->persist($trans_manut);
		$manager->persist($btp);
		$manager->persist($outillage);
		$manager->persist($equip_indu);
		$manager->persist($resto_hotel);
		$manager->persist($comm_marche);
		$manager->persist($fourniture);
		$manager->persist($medical);
		
		// Enregistrement des categories Emplois et Service
		$manager->persist($emplois);
		$manager->persist($services);
		$manager->persist($billeteries);
		$manager->persist($evenement);
		$manager->persist($cours);
		
		// Enregistrement des categories Autres
		$manager->persist($divers);
				
		$manager->flush();
	}	
			
	
	// Fonction de création globale
	private function createCategorie($nom, $parent) {
		$categorie = new  Categorie();
		$categorie->setCategorie($nom);
		$categorie->setParentcategorie($parent);
 
		return $categorie;
	}
	
	public function getOrder()
	{
		return 2; 
	}   
    
}