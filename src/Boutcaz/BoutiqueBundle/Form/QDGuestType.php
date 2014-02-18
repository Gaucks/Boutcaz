<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QDGuestType extends GuestType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
	// On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
     parent::buildForm($builder, $options);	
     
     $builder
        ->add('phone', 		'text',  			array('label' 	  	=> 'Téléphone', 
        											  'required' 	=> false,
        											  'attr' 		=> array(
        											  						 'class' 		=> 'login',
        											  						 'placeholder' 	=> 'Votre téléphone ( 0102030405 )')
        											  ))
        ->add('showphone',	'checkbox',			array('label'		=> false,
        											  'required'  	=> false, 
        											  'data' 		=> true
        											  ))
        ->add('pseudo', 	'text', 			array('label' 		=> 'Nom d\'utilisateur',
        											  'attr' 		=> array(
        											  						 'class' 		=> 'login',
        											  						 'placeholder' 	=> 'Pseudo')
        											  ))
        ->add('email', 		'email', 			array('label'		=> 'Adresse Email',
        											  'required' 	=> true,
        											  'attr' 		=> array(
        											  						 'class' 		=> 'login',
        											  						 'placeholder' 	=> 'Adresse E-mail')
        											  ))
        ->add('password',	'repeated', 		array('type'  			=> 'password',
													  'invalid_message' => 'Les mots de passe doivent correspondre',
													  'options' 		=> array(
													  							 'required' => false),
												      'first_options'  	=> array(
												      							 'label' 	=> 'Mot de passe',
												      							  'attr' => array( 
												      							  				  'class' 		=> 'login',
												      							  				  'placeholder' => 'Mot de passe')),
													  'second_options' 	=> array(
													  							 'label' => 'Confirmer le passe ',
													  							 'attr'  => array(
													  							 				  'class' 		=> 'login',
													  							 				  'placeholder' => 'Confirmation')),
													  'attr' 		   => array( 'class' => 'login'))
													  
													  )
        ->add('ville', 		'entity',    		array('class' 		   => 'BoutiqueBundle:Ville',
        											  'property' 	   => 'ville',
        											  'label' 		   => 'Ville',
        											  'group_by' 	   => 'departement.departement',
        											  'empty_value'	   => 'Choisissez votre ville...',
        											  'attr'		   => array('class'  => 'annonce')
        											 )
            )
       ->add('type', 		'entity',    		array('class' 		   => 'BoutiqueBundle:Type',
        											  'property' 	   => 'type',
        											  'label' 		   => 'Type',
        											  'expanded' 	   => true, 
													  'multiple' 	   => false,
        											 )
        	 )

		
	    ->remove('date');
     }
}