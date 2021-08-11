<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Accompagnement;
use App\Form\Admin\AccompagnementType;
use App\Repository\Admin\AccompagnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccompagnementController extends AbstractController
{
    /**
     * Controller Admin
     * @Route("/opadmin/accompagnement/", name="op_admin_accompagnement_index", methods={"GET"})
     */
    public function index(AccompagnementRepository $accompagnementRepository): Response
    {
        return $this->render('admin\accompagnement/index.html.twig', [
            'accompagnements' => $accompagnementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/webapp/accompagnement/new", name="op_admin_accompagnement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $accompagnement = new Accompagnement();
        $form = $this->createForm(AccompagnementType::class, $accompagnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accompagnement);
            $entityManager->flush();

            return $this->redirectToRoute('op_admin_accompagnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/accompagnement/new.html.twig', [
            'accompagnement' => $accompagnement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/opadmin/accompagnement/{id}", name="op_admin_accompagnement_show", methods={"GET"})
     */
    public function show(Accompagnement $accompagnement): Response
    {
        return $this->render('admin/accompagnement/show.html.twig', [
            'accompagnement' => $accompagnement,
        ]);
    }

    /**
     * @Route("/opadmin/{id}/edit", name="op_admin_accompagnement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Accompagnement $accompagnement): Response
    {
        $form = $this->createForm(AccompagnementType::class, $accompagnement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('op_admin_accompagnement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/accompagnement/edit.html.twig', [
            'accompagnement' => $accompagnement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/opadmin/accompagnement/{id}", name="op_admin_accompagnement_delete", methods={"POST"})
     */
    public function delete(Request $request, Accompagnement $accompagnement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accompagnement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($accompagnement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('op_admin_accompagnement_index', [], Response::HTTP_SEE_OTHER);
    }
}
