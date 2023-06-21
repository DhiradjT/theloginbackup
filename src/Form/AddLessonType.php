<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddLessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'attr' => [
                    'placeholder' => 'Select the date',
                ],
            ])
            ->add('time', DateTimeType::class, [
                'label' => 'Time',
                'attr' => [
                    'placeholder' => 'Select the time',
                ],
            ])
            // Add other fields here
            ->add('location', TextType::class, [
                'label' => 'Location',
                'attr' => [
                    'placeholder' => 'Enter the location',
                ],
            ])
            ->add('max_persons', TextType::class, [
                'label' => 'Max Persons',
                'attr' => [
                    'placeholder' => 'Enter the maximum number of persons',
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'placeholder' => 'Enter the title',
                ],
            ])
            ->add('training', TextType::class, [
                'label' => 'Training',
                'attr' => [
                    'placeholder' => 'Enter the training name',
                ],
            ])

            ->add('instructor', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
                'multiple' => true,
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.roles LIKE :role')
                        ->setParameter('role', '%ROLE_INSTRUCTOR%');
                },
                'label' => 'Instructor',
                'attr' => [
                    'placeholder' => 'Select the instructor(s)',
                ],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
