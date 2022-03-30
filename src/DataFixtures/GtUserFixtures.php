<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\GtUser;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GtUserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * GtUserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $category = new Category();

        $category->setCategoryName('Dev Back-end');
        $category->setCategoryDescription('assurer la fonctionnement coté back');



        $task = new Task();

        $task->setTaskName('tache1');
        $task->setTaskDescription('description du tache');
        $task->setIsDone(false);
        $task->setCategory($category);

        $user = new GtUser();

        $user->setEmail('mathieurakotoseheno@gmail.com');
        $user->setFullName('Mathieu Rakotoseheno');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setCategory($category);
        $user->setGtImage('math.JPG');
        $user->setTask($task);



        $manager->persist($category);
        $manager->persist($task);
        $manager->persist($user);


        $manager->flush();
    }
}
