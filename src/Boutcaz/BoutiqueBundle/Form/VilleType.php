<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class VilleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('region',  		'entity' , array(  'empty_value' => 'Choisissez votre Region...',
		            									   'class' 		 => 'BoutiqueBundle:Region',
		            									   'property' 	 => 'region',
		            									   'label'  	 => false,))
                ->add('departement', 	'entity',  array(  'empty_value' => 'Choisissez votre département...',
		            									   'class' 		 => 'BoutiqueBundle:Departement',
		            									   'property' 	 => 'Departement',
		            									   'label'  	 => false, ))
                ->add('ville', 			'entity',  array(  'empty_value' => 'Choisissez votre ville...',
				            							   'class'		 => 'BoutiqueBundle:Ville',
				            							   'property'    => 'Ville',
				            							   'label' 		 => false))
				->add('postal');
				            							   
			            									  
    		
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutcaz\BoutiqueBundle\Entity\Ville'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Boutcaz_BoutiqueBundle_ville';
    }
}
