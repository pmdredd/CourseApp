<?php

namespace App\Form;

use App\Entity\CourseWork;
use App\Entity\Student;
use App\Entity\Submission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('coursework', EntityType::class, [
                'class' => CourseWork::class,
                'choice_label' => 'name'
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Submission::class,
        ]);
    }
}
