<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Form\AlbumsType;
use App\Repository\AlbumsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/albums")
 */
class AlbumsController extends AbstractController
{
    /**
     * @Route("/", name="albums_index", methods={"GET"})
     */
    public function index(AlbumsRepository $albumsRepository): Response
    {
        return $this->render('albums/index.html.twig', [
            'albums' => $albumsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="albums_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $album = new Albums();
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('albums_index');
        }

        return $this->render('albums/new.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="albums_show", methods={"GET"})
     */
    public function show(Albums $album): Response
    {
        return $this->render('albums/show.html.twig', [
            'album' => $album,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="albums_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Albums $album): Response
    {
        $form = $this->createForm(AlbumsType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('albums_index');
        }

        return $this->render('albums/edit.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="albums_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Albums $album): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('albums_index');
    }
}
