<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class NavigationController extends AbstractController
{
     /**
     * @Route("/", name="home")
      */
    public function home(Session $session,AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $utilisateur = $this->getUser();
        if(!$utilisateur)
        {
            $session->set("message", "Merci de vous connecter");
            return $this->redirectToRoute('app_login');
        }
        else if(in_array('ROLE_ADMIN', $utilisateur->getRoles())){
            return $this->redirectToRoute('gtAdmin');
        }
        else if(in_array('ROLE_USER', $utilisateur->getRoles())){
            return $this->redirectToRoute('user');;
        }
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/user", name="user")
      */
    public function membre(Session $session)
    {
        $utilisateur = $this->getUser();
        if(!$utilisateur)
        {
            $session->set("message", "Merci de vous connecter");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('navigation/user.html.twig');
    }

}
