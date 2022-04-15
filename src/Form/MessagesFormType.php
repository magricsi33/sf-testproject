<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessagesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'w-100 py-3 text-white bg2 border-0 mb-3 ps-2',
                    'placeholder' => 'Név'
                ),
                'label' => false
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'class' => 'w-100 py-3 text-white bg2 border-0 mb-3 ps-2',
                    'placeholder' => 'E-mail cím'
                ),
                'label' => false
            ])
            ->add('comment', TextareaType::class, [
                'attr' => array(
                    'class' => 'w-100 py-3 text-white bg2 border-0 mb-3 ps-2',
                    'placeholder' => 'Üzenet'
                ),
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
