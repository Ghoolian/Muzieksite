<?php

namespace App\Controller;

use App\Entity\Nummers;

use App\Form\NummersType;
use App\Repository\NummersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nummers")
 */
class NummersController extends AbstractController
{
    /**
     * @Route("/", name="nummers_index", methods={"GET"})
     * @param NummersRepository $nummersRepository
     * @return Response
     */
    public function index(NummersRepository $nummersRepository): Response
    {
        return $this->render('nummers/index.html.twig', [
            'nummers' => $nummersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nummers_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $nummer = new Nummers();
        $form = $this->createForm(NummersType::class, $nummer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nummer);
            $entityManager->flush();

            return $this->redirectToRoute('nummers_index');
        }

        return $this->render('nummers/new.html.twig', [
            'nummer' => $nummer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nummers_show", methods={"GET"})
     * @param Nummers $nummer
     * @return Response
     */
    public function show(Nummers $nummer): Response
    {
        return $this->render('nummers/show.html.twig', [
            'nummer' => $nummer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nummers_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Nummers $nummer
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Nummers $nummer): Response
    {
        $form = $this->createForm(NummersType::class, $nummer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nummers_index');
        }

        return $this->render('nummers/edit.html.twig', [
            'nummer' => $nummer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nummers_delete", methods={"DELETE"})
     * @param Request $request
     * @param Nummers $nummer
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Nummers $nummer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nummer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nummer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nummers_index');
    }
}
