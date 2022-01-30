<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'You should add title first.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your title should be at least {{ limit }} characters',
                       
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('description')
            ->add('sdate', DateType::class, [
                
                'widget' => 'single_text',
              
                'constraints' => [
                    new NotNull([
                        'message' => 'You should add Start Date first.',
                    ])
                ],
            ])
            ->add('edate', DateType::class, [
               
                'widget' => 'single_text',
                
                'constraints' => [
                    new NotNull([
                        'message' => 'You should add  End Date first.',
                    ])
                    ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
