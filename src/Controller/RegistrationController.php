<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use http\Url;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;


class RegistrationController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;


    public function __construct(VerifyEmailHelperInterface $helper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
    }



    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $token = bin2hex(openssl_random_pseudo_bytes(16));


            $user->setApiToken($token);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // after validating the user and saving them to the database
            // authenticate the user and use onAuthenticationSuccess on the authenticator
            $this->addFlash("success", "Successfully registered!");
            // do anything else you need here, like send an email


            //Email functie test
            /**
             * Display & process form to request an account register.
             *
             * @Route("check_register", name="app_check_register")
             * @param Request $request
             * @param MailerInterface $mailer
             * @return Response
             */
            $email = (new TemplatedEmail())
                ->from(new Address('pwmaintenancemediatastisch@gmail.com', 'Mediatastisch'))
                ->to($user->getEmail())
                ->subject('Your account authentication request')
                ->htmlTemplate('security/email.html.twig')
                ->context([
                    'authToken' => $token,
                ]);
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                $this->addFlash("failure", "Error in sending activation e-mail. Please try again.");
            }
            return($this->render('security/check_register.html.twig'));

//            return new Response($this->render('security/check_register.html.twig', [
//                'registrationForm' => $form->createView(),
//            ]));


            //Email functie test end
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),

        ]);
    }

        /**
        * @Route("/activate/{token}", name="app_activate")
        */
        public function activate($token)
        {

            $repository = $this->getDoctrine()->getRepository(User::Class);
            $user = $repository->findOneBy(['apiToken' => $token]);
            if ($user != null) {
                $user->setActivationCheck(true);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->render('security/activate.html.twig');
            }
              else {
                  $this->addFlash("failure", "Error; no account found. Please try again or contact the creators.");
                  return $this->redirectToRoute('home');
             }
        }
}

