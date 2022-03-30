<?php

namespace App\Controller\Admin;

use App\Entity\GtUser;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotNull;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="gtAdmin")
     */
    public function session(Session $session): Response
    {
        $repoGtUser= $this->getDoctrine()->getRepository(GtUser::class);
        $repoTask = $this->getDoctrine()->getRepository(Task::class);

        $tasks=  $repoTask->findBy(
            array(
                'isDone'=> false

            )
        );
        $pendingTasks= $repoTask->findByNotNull();


        $users = $repoGtUser->findByNotNull();

        $members=count($repoGtUser->findAll());

        $utilisateur = $this->getUser();
        if(!$utilisateur)
        {
            $session->set("message", "Merci de vous connecter");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'members'=> $members,
            'tasks'=> $tasks,
            'pendingTasks'=> $pendingTasks,
        ]);
    }
}
