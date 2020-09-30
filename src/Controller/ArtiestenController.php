<?php

namespace App\Controller;

use App\Entity\Artiesten;
use App\Form\ArtiestenType;
use App\Repository\ArtiestenRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artiesten")
 */
class ArtiestenController extends AbstractController
{
    /**
     * @Route("/", name="artiesten_index", methods={"GET"})
     */
    public function index(ArtiestenRepository $artiestenRepository): Response
    {
        return $this->render('artiesten/index.html.twig', [
            'artiestens' => $artiestenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artiesten_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artiesten = new Artiesten();
        $form = $this->createForm(ArtiestenType::class, $artiesten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artiesten);
            $entityManager->flush();

            return $this->redirectToRoute('artiesten_index');
        }

        return $this->render('artiesten/new.html.twig', [
            'artiesten' => $artiesten,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiesten_show", methods={"GET"})
     */
    public function show(Artiesten $artiesten): Response
    {
        return $this->render('artiesten/show.html.twig', [
            'artiesten' => $artiesten,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artiesten_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Artiesten $artiesten): Response
    {
        $form = $this->createForm(ArtiestenType::class, $artiesten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artiesten_index');
        }

        return $this->render('artiesten/edit.html.twig', [
            'artiesten' => $artiesten,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiesten_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Artiesten $artiesten): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artiesten->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artiesten);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artiesten_index');
    }
}
