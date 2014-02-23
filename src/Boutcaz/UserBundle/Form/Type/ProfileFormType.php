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
				->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => array('class' => 'signup')))
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
														  'multiple' 	   		=> false
														  ))											   
				->add('current_password','password',array(
														   'label' 				    => 'form.current_password',
												           'translation_domain' 	=> 'FOSUserBundle',
												           'mapped' 				=> false,
												           'constraints'			=> $constraint,
												           'attr'					=> array('class' => 'signup')
        ));
    }
    
    public function getName()
    {
        return 'fos_user_profile';
    }

}