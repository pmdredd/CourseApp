<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\CourseWork;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Coursework name'])
            ->add('deadline', DateTimeType::class, [
                'widget' => 'choice',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
                'html5' => false,
            ])
            ->add('creditWeight')
            ->add('feedbackDueDate', DateTimeType::class, [
                'widget' => 'choice',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
                'html5' => false,
            ])
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CourseWork::class,
        ]);
    }
}
