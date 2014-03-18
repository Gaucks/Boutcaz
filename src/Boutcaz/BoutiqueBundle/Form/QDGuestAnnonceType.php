<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QDGuestAnnonceType extends GuestAnnonceType
{	
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
																   					 'class' => 'radio'))
				  )
		    ->add('postal', 		'text',			array('label' => 'Code Postal',
		    											  'attr'  => array('class' 			=> 'annonce_postal', 
		    															   'placeholder'	=> 'Code Postal' )))
			->add('image',  new QDImageType )
			->add('email', 'email', array('label' => FALSE, 'attr' => array('class' => 'annonce_txt', 
																			'placeholder' => 'Adresse email'))
				 )
			->add('username', null, array('label' => 'Nom et Email', 'attr' => array('class' => 'annonce_txt',
																	 'placeholder' => 'Nom d\'utilisateur')))	
			->add('password', 'repeated',  array('type' => 'password',
												 'first_options' 	=> array('label' => 'Mot de passe', 
													    					 'attr'	 => array('class' 		=> 'annonce_txt',
													    					 				  'placeholder' => 'Mot de passe')),
												  'second_options' 	=> array('label' => 'Confirmation', 
																			 'attr' => array('class' => 'annonce_txt',
																			 				 'placeholder' => 'Confirmer le mot de passe')),
												'invalid_message' => 'Les mots de passe doivent être identique'))
			->add('type', 		'entity',    	array('class' 	   	   		=> 'BoutiqueBundle:Type',
													  'property' 	   		=> 'type',
													  'label' 		   		=> 'Status:',
													  'expanded' 	   		=> true, 
													  'multiple' 	   		=> false
														  )
	    	    )
    	    ->remove('region')
    	    ->remove('departement')
        	->remove('ville')
            ->remove('date')
            ->remove('phone')
            ->remove('showphone')
            ->remove('date')
            ->remove('updated')
            ->remove('auteurtype')
            ->remove('published')
            ->remove('slug')
            ->remove('ipadress');	
	}	
}