<?php

namespace Boutcaz\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfilePersoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', 'text' , array('required' => FALSE, 'attr' => array('class' 			=> 'login',
            																	 'placeholder' 		=> 'Prénom',
            																	 'invalid_message'  => 'On teste')))
            																	 
            ->add('firstname', 'text' , array('required' => FALSE, 'attr' => array('class' 			=> 'login',
            																	 'placeholder' 		=> 'Nom')))
            
            ->add('phone', 'number' , array('required' => FALSE, 'invalid_message'=> 'Le numéro ne peut contenir que des chiffres','attr' => array('class' 		=> 'login',
            																																	  'placeholder'	=> 'Ex: 0102030405',
            																    )))
            ->add('showphone','choice', array( 'choices' => array(
						                							'1' => 'Maquer mon numéro',
																	'2' => 'Toujours afficher mon numéro')))
            ->add('description', 'textarea' , array('required' => FALSE, 'attr' => array('class' => 'login')))
            ->add('departement', 		'entity',    	array('required' => FALSE,'class' 	        => 'BoutiqueBundle:Departement',
														   'property' 	   		=> 'departement',
														   'label' 		   		=> 'Departement:',
														   'empty_value'   		=> 'Choisissez votre département...', 
													       'attr'		   		=> array('class' => 'login')
				))
            ->add('ville', 				'entity',       array( 'required'		 	=> FALSE,
            												   'class' 	        	=> 'BoutiqueBundle:Ville',
															   'property' 	   		=> 'ville',
															   'label' 		   		=> 'Ville:',
															   'empty_value'   		=> 'Choisissez votre ville...', 
														       'attr'		   		=> array('class' => 'login')
														   ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutcaz\UserBundle\Entity\ProfilePerso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'boutcaz_userbundle_profileperso';
    }
}
