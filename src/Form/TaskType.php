<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\TaskList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title' , TextType::class, ['label' => 'Title', ])
            ->add('description', TextType::class, ['label' => 'Description', ])
            ->add('date' , DateTimeType::class, ['label' => 'Date',     'widget' => 'single_text', ])
            ->add('status', TextType::class, ['label' => 'Status', ])
            ->add('taskList', EntityType::class, [
                'class' => TaskList::class, 
                'choice_label' => 'name', 
                'label' => 'Choose Task List',
                'placeholder' => 'Select a task list',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
