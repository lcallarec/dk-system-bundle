<?php

namespace Dk\Bundle\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class RulesetAssetCollectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('submit', 'submit');
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            
            $form = $event->getForm();
            
            $form->add('assets', 'collection', [
                'type'  => new Type\RulesetAssetType($event->getData()),
                'label' => false,
                'by_reference' => false,
            ]);
            
        });
   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Ruleset'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruleset';
    }
}