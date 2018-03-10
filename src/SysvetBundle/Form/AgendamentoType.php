<?php

namespace SysvetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AgendamentoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $atual = date('Y');

        $builder->add('horario', DateTimeType::class, array(
                    'date_format' => 'ddMMMyyyy',
                    'years' => range($atual, $atual + 5)
                ))
                ->add('cliente')
                ->add('servico');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'SysvetBundle\Entity\Agendamento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'sysvetbundle_agendamento';
    }

}
