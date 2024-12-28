<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function home(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('home/home.html.twig', ['current_menu' => 'home',]);
    }
    /**
     * @Route("/", name="home")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // récupère les évantuelles erreur de connexion
        $error = $authenticationUtils->getLastAuthenticationError();
        // dernier nom entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('home/home.html.twig', ['lastUsername'=>$lastUsername,'error' => $error,'current_menu' => 'home',]);
    }
}
