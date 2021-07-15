<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Besoin;
use App\Form\Admin\BesoinType;
use App\Repository\Admin\BesoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("")
 */
class BesoinController extends AbstractController
{
    /**
     * @Route("/opadmin/besoin/", name="op_admin_besoin_index", methods={"GET"})
     */
    public function index(BesoinRepository $besoinRepository): Response
    {
        return $this->render('admin/besoin/index.html.twig', [
            'besoins' => $besoinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/webapp/besoins/", name="op_webapp_besoin_index_public", methods={"GET"})
     */
    public function index_public(BesoinRepository $besoinRepository): Response
    {
        return $this->render('admin/besoin/index_public.html.twig', [
            'besoins' => $besoinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/opadmin/besoin/new", name="op_admin_besoin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $besoin = new Besoin();
        $form = $this->createForm(BesoinType::class, $besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($besoin);
            $entityManager->flush();

            return $this->redirectToRoute('op_admin_besoin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/besoin/new.html.twig', [
            'besoin' => $besoin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("op/admin/besoin/{id}", name="op_admin_besoin_show", methods={"GET"})
     */
    public function show(Besoin $besoin): Response
    {
        return $this->render('admin/besoin/show.html.twig', [
            'besoin' => $besoin,
        ]);
    }

    /**
     * @Route("/admin/besoin/{id}/edit", name="op_admin_besoin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Besoin $besoin): Response
    {
        $form = $this->createForm(BesoinType::class, $besoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('op_admin_besoin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/besoin/edit.html.twig', [
            'besoin' => $besoin,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/besoin/{id}", name="admin_besoin_delete", methods={"POST"})
     */
    public function delete(Request $request, Besoin $besoin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$besoin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($besoin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_besoin_index', [], Response::HTTP_SEE_OTHER);
    }
}
