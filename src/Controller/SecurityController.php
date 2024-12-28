<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\EditUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends AbstractController
{
    /**
     * @Route("/registration", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            //l'objet $em sera affecté automatiquement grâce à l'injection de dépendance de symfony 4
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('security_login');

        }
        return $this->render('security/registration.html.twig', ['form' => $form->createView()]);
        return $this->render('security/registration.html.twig',['current_menu' => 'home',]);
    }

//    /**
//     * Permet de créer un compte utilisateur
//     * @Route("/registration", name="security_registration")
//     * @param EntityManagerInterface $manager
//     * @param Request $request
//     * @param UserPasswordEncoderInterface $encoder
//     * @return Response
//     */
//    public function create(EntityManagerInterface $manager, Request $request, UserPasswordEncoderInterface $encoder): Response
//    {
//        $user = new User();
//        $form = $this->createForm(RegistrationType::class, $user);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            $hash = $encoder->encodePassword($user, $user->getPassword());
//            $user->setPassword($hash);
//            $user->setValidate(false);
//            $user->setLastLogin(new DateTime);
//            $manager->persist($user);
//            $manager->flush();
//
//            $this->addFlash('success', "Votre compte a bien été créée");
//            return $this->redirectToRoute("security_login");
//        }
//        return $this->render('security/login.html.twig', ['form' => $form->createView(),]);
//    }

       /**
        * Permet de se connecter
        * @Route ("/login", name="security_login")
        * @param AuthenticationUtils $utils
        * @return Response
       */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // récupère les évantuelles erreur de connexion
        $error = $authenticationUtils->getLastAuthenticationError();
        // dernier nom entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['lastUsername'=>$lastUsername,'error' => $error]);
    }
//    /**
//     * Permet de se connecter
//     * @Route ("/login", name="security_login")
//     * @param AuthenticationUtils $utils
//     * @return Response
//     */
//    public function login(AuthenticationUtils $utils): Response
//    {
//        $error = $utils->getLastAuthenticationError();
//        $user = $utils->getLastUsername();
//        return $this->render("security/login.html.twig", ['error' => $error !== null, 'username' => $user]);
//    }
    /**
     * @Route("/logout",name="security_logout")
     */
    public function logout(): void
    { }
}