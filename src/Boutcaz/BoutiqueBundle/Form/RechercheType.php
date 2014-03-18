<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RechercheType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recherche',	'text', 		array('label' 		=> false,
            										  'required'	=> false, 
            										  'attr' 		=> array(
																			  'class' 		=> 'recherche',
																			  'placeholder' => 'Rechercher une annonce...'
            																)
            										 )
            	  )
            ->add('region',		'entity', 		array('class' 		=> 'BoutiqueBundle:Region',
            										  'property' 	=> 'region',
            										  'label' 		=> false,
            										  'required' 	=> false , 
            										  'empty_value' => 'Choisissez votre région...',
            										  'attr' 		=> array( 
            										  						  'class' => 'recherche'
            										  						)
            										  )
            	 )
            ->add('categorie',	'entity', 		array('class' 		=> "BoutiqueBundle:Categorie",
            										  'property' 	=> 'categorie',
            										  'required' 	=> false ,
            										  'group_by' 	=> 'parentcategorie.parent',
            										  'empty_value' => 'Choisissez votre catégorie...',
            										  'label' 		=> false,
            										  'attr' 		=> array( 
            										  						 'class' => 'recherche'
            										  						 )
            										  )
            	);
    }
   

    /**
     * @return string
     */
    public function getName()
    {
        return 'Boutcaz_BoutiqueBundle_recherche';
    }
    
}
