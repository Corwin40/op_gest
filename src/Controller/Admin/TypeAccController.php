<?php

namespace App\Controller\Admin;

use App\Entity\Admin\TypeAcc;
use App\Form\Admin\TypeAccType;
use App\Repository\Admin\TypeAccRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/opadmin/typeacc")
 */
class TypeAccController extends AbstractController
{
    /**
     * @Route("/", name="op_admin_typeacc_index", methods={"GET"})
     */
    public function index(TypeAccRepository $typeAccRepository): Response
    {
        return $this->render('admin/type_acc/index.html.twig', [
            'type_accs' => $typeAccRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="op_admin_typeacc_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeAcc = new TypeAcc();
        $form = $this->createForm(TypeAccType::class, $typeAcc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeAcc);
            $entityManager->flush();

            return $this->redirectToRoute('op_admin_typeacc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/type_acc/new.html.twig', [
            'type_acc' => $typeAcc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="op_admin_typeacc_show", methods={"GET"})
     */
    public function show(TypeAcc $typeAcc): Response
    {
        return $this->render('admin/type_acc/show.html.twig', [
            'type_acc' => $typeAcc,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="op_admin_typeacc_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeAcc $typeAcc): Response
    {
        $form = $this->createForm(TypeAccType::class, $typeAcc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('op_admin_typeacc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/type_acc/edit.html.twig', [
            'type_acc' => $typeAcc,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="op_admin_typeacc_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeAcc $typeAcc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeAcc->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeAcc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_type_acc_index', [], Response::HTTP_SEE_OTHER);
    }
}
