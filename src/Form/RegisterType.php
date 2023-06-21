<?php

namespace App\Form;

use App\Entity\person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Enter your email',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => ['placeholder' => 'Enter your password',
                ],
            ])
            ->add('street', TextType::class, [
                'label' => 'Street',
                'attr' => ['placeholder' => 'Enter your street',
                ],
            ])
            ->add('place', TextType::class, [
                'label' => 'Place',
                'attr' => ['placeholder' => 'Enter your place',
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Firstname',
                'attr' => ['placeholder' => 'Enter your firstname',
                ],
            ])
            ->add('preprovision', TextType::class, [
                'label' => 'Preprovision',
                'attr' => ['placeholder' => 'Enter your preprovision',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Lastname',
                'attr' => ['placeholder' => 'Enter your lastname',
                ],
            ])
            ->add('dateofbirth', TextType::class, [
                'label' => 'Date of Birth',
                'attr' => ['placeholder' => 'Enter your Date of birth',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => person::class,
        ]);
    }
}
