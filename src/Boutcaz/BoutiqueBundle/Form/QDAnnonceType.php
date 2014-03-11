<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Boutcaz\BoutiqueBundle\Entity\Departement;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Doctrine\ORM\EntityRepository;

class QDAnnonceType extends AnnonceType
{
	private $securityContext;

	public function __construct(SecurityContext $securityContext)
	{
	    $this->securityContext = $securityContext;
	}
		
		public function buildForm(FormBuilderInterface $builder, array $options)
        {
		// On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
	     parent::buildForm($builder, $options);	
	     
	     $builder->add('titre',			'text', 		array('label' 			=> 'Titre',
	     												      'attr' 			=> array(
	     												      							 'class' 			=> 'annonce_txt',
		 													  							 'placeholder' 		=> 'Titre de l\'annonce',
		 													  							 'invalid_message' 	=> 'Je sais pas')
	     												      )				
		 			  )
            	 ->add('tarif',			'text' , 		array('label' 			=> 'Tarif', 
            	 											  'required' 		=> false ,
            	 											  'invalid_message' => 'Je sais pas',
            	 											  'attr' 			=> array(
            	 											  							 'class' 		=> 'annonce_tarif',
            	 											  							 'placeholder' 	=> 'Votre tarif ( facultatif )')
            	 											 )
                      )
				 ->add('description',	'textarea', 	array('label' 			=> 'Description de l\'annonce', 
				 											  'attr' 			=> array(
				 											    						 'class' 		=> 'annonce',
				 											    						 'placeholder' 	=> 'Description de votre annonce')
				 											 )
					  )
				 ->add('categorie', 	'entity', 		array('class' 			=> "BoutiqueBundle:Categorie",
				 											  'property' 		=> 'categorie',
				 											  'group_by' 		=> 'parentcategorie.parent',
				 											  'empty_value' 	=> 'Choisissez votre catégorie...',
				 											  'label' 			=> 'Categorie',
				 											  'attr' 			=> array( 
				 											  							 'class' => 'annonce')
				 											  )
					  )
			     ->add('proposition', 	'entity',       array('class' 			=> "BoutiqueBundle:Proposition",
			     											  'property' 		=> 'proposition',
															  'expanded' 		=> true, 
															  'multiple' 		=> false,
															  'label'			=> 'Vous faites un(e)',
															  'attr' 	  		=> array( 
																	   					 'class' => 'radio') 
															 )
					  )
				->add('image',  new QDImageType)
	            ->remove('auteurid')
	            ->remove('date')
	            ->remove('updated')
	            ->remove('auteurtype');  

				// récupère le user et vérifie rapidement qu'il existe bien
		$user = $this->securityContext->getToken()->getUser();
		if (!$user) {
			throw new \LogicException( 'Le FriendMessageFormType ne peut pas être utilisé sans utilisateur connecté!');
		}
		
		$builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($user) {
            	$form = $event->getForm();
            	
            	$formOptions = array(
                    'class' 		=> 'BoutiqueBundle:Departement',
                    'property' 		=> 'departement',
                    'empty_value'   => 'Choisissez votre département...', 
                    'query_builder' => function(EntityRepository $er) use ($user) {
                        // construit une requête personnalisée
                        return $er->createQueryBuilder('u')->where('u.region = :region')->setParameter('region', $user->getRegion());
                        // ou appelle une méthode d'un repository qui retourne un query builder
                        // l'instance $er est une instance de UserRepository
                        // retourne $er->createOrderByFullNameQueryBuilder();
                    },
                    'attr' => array('class' => 'annonce'));
				
				
				//=====================================================
				//! AFFICHAGE DES VILLES SI CA N'EST PAS DÉJA REMPLI
				//=====================================================

				$formOptionsVille = array(
                    'class' 		=> 'BoutiqueBundle:Ville',
                    'property' 		=> 'ville',
                    'empty_value'   => 'Choisissez votre ville...', 
                    'query_builder' => function(EntityRepository $er) use ($user) {
                        // construit une requête personnalisée
                        return $er->createQueryBuilder('u')->where('u.departement = :departement')->setParameter('departement', $user->getDepartement());
                        // ou appelle une méthode d'un repository qui retourne un query builder
                        // l'instance $er est une instance de UserRepository
                        // retourne $er->createOrderByFullNameQueryBuilder();
                    },
                    'attr' => array('class' => 'annonce'));
				
				
				if( $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
					if($user->getDepartement() === NULL)
					{
						// crée le champ, cela équivaut à  $builder->add()
						$form->add('departement', 'entity', $formOptions);
					}
					elseif( ( $user->getDepartement() != NULL ) AND ( $user->getVille() === NULL) ){
						$form->add('ville', 'entity', $formOptionsVille);

					}
				}	
            
            }
		);
		
		}	
	}
