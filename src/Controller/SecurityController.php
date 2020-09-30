<?php

namespace App\Controller;

use App\EventSubscriber\ActivationSubscriber;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class SecurityController extends AbstractController
{

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @param ControllerEvent $event
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, ActivationSubscriber $event): Response
    {

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();



          return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);

   }


}
