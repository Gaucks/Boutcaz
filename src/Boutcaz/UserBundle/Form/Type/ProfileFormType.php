<?php
 
namespace Boutcaz\UserBundle\Form\Type;
 
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	 if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class
            $constraint = new OldUserPassword();
        }
        
        parent::buildForm($builder, $options);
        $builder
				->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'signup')))
				->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' 				=> 'signup',
																																   'placeholder' 		=> 'Nom d\'utilisateur'
																																   )))
				->add('region', 		'entity',    array('class' 	       		=> 'BoutiqueBundle:Region',
														   'property' 	   		=> 'region',
														   'label' 		   		=> 'Region:',
														   'group_by' 	   		=> 'departement.departement',
														   'empty_value'   		=> 'Choisissez votre département...', 
													       'attr'		   		=> array('class' => 'signup')
														   ))
				->add('type', 		'entity',    	array('class' 	   	   		=> 'BoutiqueBundle:Type',
														  'property' 	   		=> 'type',
														  'label' 		   		=> 'Status:',
														  'expanded' 	   		=> false, 
														  'multiple' 	   		=> false))											   
				->add('current_password','password',array(
														   'label' 				    => 'form.current_password',
												           'translation_domain' 	=> 'FOSUserBundle',
												           'mapped' 				=> false,
												           'constraints'			=> $constraint,
												           'attr'					=> array('class' => 'signup')
														   ))
        		->add('surname', 'text' , array('required' => FALSE, 'attr' => array('class' 			=> 'login',
            																	 'placeholder' 		=> 'Prénom')))
            																	 
	            ->add('firstname', 'text' , array('required' => FALSE, 'attr' => array('class' 			=> 'login',
	            																	   'placeholder' 	=> 'Nom')))
	            
	            ->add('phone', 'text' , array('required' => FALSE,  'attr' => array('class' 		    => 'login',
	            																	  'placeholder'     => 'Ex: 0102030405')))
	            ->add('showphone','choice', array( 'choices' => array(
							                							'1' => 'Maquer mon numéro',
																		'2' => 'Toujours afficher mon numéro')))
																		
	            ->add('description', 'textarea' , array('required' => FALSE, 'attr' => array('class' => 'login', 'placeholder'     => 'Une description de votre proile')))
	            
	            ->add('departement', 		'entity',    	array('required' => FALSE,'class' 	        => 'BoutiqueBundle:Departement',
															   'property' 	   		=> 'departement',
															   'label' 		   		=> 'Departement:',
															   'empty_value'   		=> 'Choisissez votre département...', 
														       'attr'		   		=> array('class' => 'login')))
														       
	            ->add('ville', 				'entity',       array( 'required'		 	=> FALSE,
	            												   'class' 	        	=> 'BoutiqueBundle:Ville',
																   'property' 	   		=> 'ville',
																   'label' 		   		=> 'Ville:',
																   'empty_value'   		=> 'Choisissez votre ville...', 
															       'attr'		   		=> array('class' => 'login')
															   ))
        ;
    }
    
    public function getName()
    {
        return 'fos_user_profile';
    }

}