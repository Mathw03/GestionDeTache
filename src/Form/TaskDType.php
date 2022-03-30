<?php

namespace App\Form;

use App\Entity\GtUser;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->cat = $options['cat'];
        $builder
            ->add('taskToDO', EntityType::class,[
                'class' => Task::class,
                    'query_builder' => function (TaskRepository  $tr) {
                        return $tr->createQueryBuilder('u')
                        ->andWhere('u.user IS  NULL')
                        ->andWhere('u.category = :cat')
                        ->setParameter('cat',$this->cat )
                        ->orderBy('u.id', 'ASC');
                },
                'required'=> false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GtUser::class,
            'cat' => null,
        ]);
    }
}
