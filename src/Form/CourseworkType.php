<?php

namespace App\Form;

use App\Entity\Coursework;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Coursework name'])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'input'=>'string',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('creditWeight')
            ->add('feedbackDueDate', DateType::class, [
                'widget' => 'single_text',
                'input'=>'string',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('course')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coursework::class,
        ]);
    }
}
