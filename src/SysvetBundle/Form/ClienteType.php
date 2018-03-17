<?php

namespace SysvetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ClienteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('nome', TextType::class)
                ->add('documento', EmailType::class)
                ->add('sexo', ChoiceType::class, array(
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array(
                        'Masculino' => 'M',
                        'Feminino' => 'F'
                    )
                ))
                ->add('email')
                ->add('telefone');
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'SysvetBundle\Entity\Cliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {

        return 'sysvetbundle_cliente';
    }

}
