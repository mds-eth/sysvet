<?php

namespace SysvetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProdutoType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('nome')
                ->add('descricao')
                ->add('preco')
                ->add('quantidade')
                ->add('imagem', FileType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'SysvetBundle\Entity\Produto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        
        return 'sysvetbundle_produto';
    }

}
