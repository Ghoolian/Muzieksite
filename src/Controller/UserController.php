<?php
// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     *@Route("/login", name="User_login")
     */
    public function register(Request $request)
    {
        $task = new User();
        // ...

        $form = $this->createForm(User::class, $task);
        $form->handleRequest($request);

        return $this->render('user.html.twig', [
        'form' => $form->createView(),

        ]);

    }
}