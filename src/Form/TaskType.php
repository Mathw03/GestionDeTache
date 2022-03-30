<?php

namespace App\Form;

use App\Entity\GtUser;
use App\Entity\Task;
use Doctrine\DBAL\Types\DateIntervalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taskName')
            ->add('taskDescription')
            ->add('category')
            ->add('remainTime',\Symfony\Component\Form\Extension\Core\Type\DateIntervalType::class,[
             'with_years'  => false,
             'with_months' => false,
             'with_days'   => false,
             'with_hours'  => true,
                'with_minutes'  => true,
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
