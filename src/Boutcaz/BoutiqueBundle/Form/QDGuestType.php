<?php

namespace Boutcaz\BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QDGuestType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);
    	
        $builder
				->add('email', 'email', array('label' => FALSE, 'attr' => array('class' => 'annonce_txt', 
																				'placeholder' => 'Adresse email')))
				->add('username', null, array('label' => 'Nom et Email', 'attr' => array('class' => 'annonce_txt',
																		 'placeholder' => 'Nom d\'utilisateur')))	
				->add('password', 'repeated',  array('type' => 'password',
													 'first_options' 	=> array('label' => 'Mot de passe', 
														    					 'attr'	 => array('class' 		=> 'annonce_txt',
														    					 				  'placeholder' => 'Mot de passe')),
													  'second_options' 	=> array('label' => 'Confirmation', 
																				 'attr' => array('class' => 'annonce_txt',
																				 				 'placeholder' => 'Confirmer le mot de passe')),

															))
				->add('region', 		'entity',    	array('class' 	       	=> 'BoutiqueBundle:Region',
														   'property' 	   		=> 'region',
														   'label' 		   		=> 'Region:',
														   'group_by' 	   		=> 'departement.departement',
														   'empty_value'   		=> 'Choisissez votre Region...', 
													       'attr'		   		=> array('class' => 'annonce_txt')
														   ))
				->add('departement',   'entity',   array('class' 	       	=> 'BoutiqueBundle:departement',
														   'property' 	   		=> 'departement',
														   'label' 		   		=> 'Département:',
														   'empty_value'   		=> 'Choisissez votre département...', 
													       'attr'		   		=> array('class' => 'annonce_txt')
														   ))
				->add('ville', 		'entity',    	array('class' 	       		=> 'BoutiqueBundle:ville',
														   'property' 	   		=> 'ville',
														   'label' 		   		=> 'Ville:',
														   'empty_value'   		=> 'Choisissez votre ville...', 
													       'attr'		   		=> array('class' => 'annonce_txt')
														   ))
				->add('type', 		'entity',    	array('class' 	   	   		=> 'BoutiqueBundle:Type',
														  'property' 	   		=> 'type',
														  'label' 		   		=> 'Status:',
														  'expanded' 	   		=> true, 
														  'multiple' 	   		=> false
														  )
        	    )
            ->remove('date')
            ->remove('phone')
            ->remove('showphone');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutcaz\BoutiqueBundle\Entity\Guest'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boutcaz_boutiquebundle_guest';
    }
}
