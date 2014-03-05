<?php

namespace Boutcaz\BoutiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Boutcaz\BoutiqueBundle\Entity\Annonce;
use Boutcaz\BoutiqueBundle\Entity\Guest;
use Boutcaz\BoutiqueBundle\Entity\Image;
use Boutcaz\BoutiqueBundle\Entity\AuteurType;

use Boutcaz\BoutiqueBundle\Form\QDGuestType;
use Boutcaz\BoutiqueBundle\Form\QDAnnonceType;
use Boutcaz\BoutiqueBundle\Form\RechercheType;
use Boutcaz\BoutiqueBundle\Form\ImageType;

class BoutiqueController extends Controller
{
    public function indexAction()
    {
    	//Création du formulaire de recherche
    	$form_recherche = $this->createForm(new rechercheType());
    	
    	//Récupération de toutes les régions limité a 9 affichage ( à modifier )
    	$region = $this->getDoctrine()
				       ->getRepository("BoutiqueBundle:Region")
				       ->findBy(array(), null,  9);
    	
    	return $this->render('BoutiqueBundle:Public:accueil.html.twig', array(  'recherche'=> $form_recherche->createView(), 
														    					'regions'  => $region));
    }
    
    public function deposerAction()
    {
    	$entete		= FALSE; /* Retire toutes les entetes */
    	
		// Création des objets requis
    	$annonce 	= new Annonce;
    	$guest 		= new Guest;		
		
    	$form_annonce 	= $this->createForm(new QDAnnonceType, $annonce);	 /* On créer le formulaire d'annonce */
    	$form_guest   	= $this->createForm(new QDGuestType, $guest);	 /* On créer le formulaire d'annonce */
    	
    	$request = $this->get('request');
		
		if($request->getMethod() == 'POST')
		{
				
			// On bind les formulaires
			$form_annonce->bind($request);
			$form_guest->bind($request);
			
			$em = $this->getDoctrine()->getManager();
			
		    
			// Le formulaire est il valide
			if ($form_annonce->isValid()) {
				
				// On récupere les parametres de sécurité
				$securityContext = $this->container->get('security.context');
		
					// L'utilisateur est connecté donc on récupère ses informations
					if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
						
						$user = $securityContext->getToken()->getUser();
						//On passe par la fonction hydrate pour enregistrer les données supplémentaires.
						$this->hydrate($annonce, $request->server->get('REMOTE_ADDR'), $user);
					}
					
					/*
// L'UTILISATEUR N'EST PAS CONNECTÉ ON FAIT CE QUI SUIT :
if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') == FALSE  ){

// Sinon l'utilisateur est un invité	 
if ($form_guest->isValid()){
// On crée l'objet Guest en fonction du formulaire transmis
$guest->setPseudo($form_guest->getData()->getPseudo());
$guest->setEmail($form_guest->getData()->getEmail());
$guest->setPassword($form_guest->getData()->getPassword());
$guest->setType($form_guest->getData()->getType());
$guest->setVille($form_guest->getData()->getVille());

// On enregistre le Guest
$em->persist($guest);
$em->flush();


// On met le type d'utilisateur à invité
$annonce->setAuteurType($em->getRepository('BoutiqueBundle:AuteurType')->findOneByid(2) );
// On met la valeur de Auteurid en fonction du mode d'envoi ( connecté ou non ) 	
$annonce->setAuteurid($guest->getId());
$annonce->setIpadress($ip);
}
else{
	return $this->render('BoutiqueBundle:Public:deposer.html.twig', array(  'form_annonce' 	=> $form_annonce->createView(), 
																			'form_guest' 	=> $form_guest->createView(),
																			'form_image' 	=> $form_image->createView(),
																			'entete'		=> $entete  ));
	 }

}
*/					


			// On enregistre le tout
			$this->saveBdd($annonce);
			
			return $this->redirect(($this->generateUrl('region_homepage', array('slug' => $user->getRegion()->getSlug() ))));			
		}
	 
	 }
		
		return $this->render('BoutiqueBundle:Public:deposer.html.twig', array('form_annonce'  => $form_annonce->createView(), 
																			  'form_guest'    => $form_guest->createView(),
																			  'entete'  	  => $entete ));
	}
	
	public function regionCheckAction()
	{
		//=======================================================
		//! Utiliser pour récupérer la région de l'utilisateur, 
		//!	utilisé lors des redirections des connectés
		//======================================================

		$securityContext = $this->container->get('security.context');
		
		// L'utilisateur est connecté donc on récupère ses informations
		if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
			
			$slug = $securityContext->getToken()->getUser();
			
			return $this->redirect($this->generateUrl('region_homepage', array('slug' => $slug->getRegion()->getSlug()) ));
		}
		
		// On envoi une erreur si il n'est pas connecté
		throw new \Exception('Quelque chose a mal tourné, vous n\'êtes pas connecté apparemment!');			
		
	}
	
    public function regionAction($slug)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$region = $em->getRepository('BoutiqueBundle:Region')->findOneBySlug($slug);
    	$annonces = $em->getRepository('BoutiqueBundle:Annonce')->findByRegion($region->getId());
    	
        return $this->render('BoutiqueBundle:Public:accueil_region.html.twig', array('region' => $region->getRegion() ,'slug' => $slug, 'annonces' => $annonces));
    }
    
    public function showAction()//Annonce $anonce à rajouter
    {
        return $this->render('BoutiqueBundle:Public:show_annonce.html.twig');
    }
    
    public function signinAction()
    {
        return $this->render('BoutiqueBundle:Public:signin.html.twig');
    }
    
	public function signupAction()
	{
		return $this->render('BoutiqueBundle:Public:signup.html.twig');
	}
    
    public function footerAction()
    {
        return $this->render('BoutiqueBundle:Template:footer.html.twig');
    }
    
    public function navigationAction()
    {
	    return $this->render('BoutiqueBundle:Template:navigation.html.twig');
    }
    
    protected function hydrate($annonce, $ip, $user)
	{
		$annonce->setUser($user);
		$annonce->setIpadress($ip);
		$annonce->setDepartement($user->getDepartement());
		$annonce->setRegion($user->getRegion());
		$annonce->setVille($user->getVille());
		
		// Concernant l'image transmise
		$annonce->getImage()->upload();

		return $annonce;
	}
	
	protected function saveBdd($annonce)
	{
		$em = $this->getDoctrine()->getEntityManager();
		
		$em->persist($annonce);
		$em->flush();
	}
}
