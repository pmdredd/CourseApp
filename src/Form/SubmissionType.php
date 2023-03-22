<?php

namespace App\Form;

use App\Entity\Submission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mark')
            ->add('handInDate')
            ->add('resubmitted')
            ->add('grade')
            ->add('coursework')
            ->add('student')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Submission::class,
        ]);
    }
}
