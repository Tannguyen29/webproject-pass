<?php

namespace App\Form;

use App\Entity\Userdetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class UserdetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,
        [
            'label' => 'User Name',
            'attr' => [
                'minlength' => 3,
                'maxlength' => 30
            ]
        ])
        ->add('age', IntegerType::class,
        [
            'label' => 'User age',
            'attr' => [
                'min' => 15,
                'max' => 80
            ]
        ])
        ->add('address',TextType::class,
        [
            'label' => 'User address',
            'attr' => [
                'minlength' => 3,
                'maxlength' => 50
            ]
        ])
        ->add('Phone',TextType::class,
            [
                'label' => 'Phone number',
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ->add('image' ,TextType::class,
        [
            'label' => 'User image',
            'attr' => [
                'maxlength' => 255
            ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Userdetail::class,
        ]);
    }
}
