<?php
namespace Dk\PlayerBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends PlayerType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('roles', 'choice', [
                'choices' => ['ROLE_PLAYER' => 'joueur', 'ROLE_MASTER' => 'maître']
            ])
            ->add('email')
            ->add('submit', 'submit', ['label' => 'créer son compte'])
        ;
    }
  

    /**
     * @return string
     */
    public function getName()
    {
        return 'register';
    }
}
