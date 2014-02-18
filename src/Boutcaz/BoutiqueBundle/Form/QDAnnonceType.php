<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QDAnnonceType extends AnnonceType
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
																	   					 'class' => 'radio') 
															 )
					  )
	            ->remove('auteurid')
	            ->remove('date')
	            ->remove('updated')
	            ->remove('auteurtype')
	            
        ;
        
		}	
	}
