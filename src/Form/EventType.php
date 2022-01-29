<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
            ->add('sdate')
            ->add('edate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
