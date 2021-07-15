<?php

namespace App\Controller\Admin;

use App\Entity\Admin\question;
use App\Form\Admin\questionType;
use App\Repository\Admin\questionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * Controller Admin
     * @Route("/opadmin/question/", name="op_admin_question_index", methods={"GET"})
     */
    public function index(questionRepository $questionRepository): Response
    {
        return $this->render('admin/question/index.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    /**
     * Controller Public
     * @Route("/webapp/questions", name="op_webapp_question_index", methods={"GET"})
     */
    public function index_public(questionRepository $questionRepository): Response
    {
        return $this->render('admin/question/index_public.html.twig', [
            'questions' => $questionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/opadmin/question/new", name="admin_question_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $question = new question();
        $form = $this->createForm(questionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setLevel('0');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('admin_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/question/new.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/opadmin/question/{id}", name="admin_question_show", methods={"GET"})
     */
    public function show(question $question): Response
    {
        return $this->render('admin/question/show.html.twig', [
            'question' => $question,
        ]);
    }

    /**
     * @Route("/opadmin/question/{id}/edit", name="admin_question_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, question $question): Response
    {
        $form = $this->createForm(questionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_question_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/question/edit.html.twig', [
            'question' => $question,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/opadmin/question/{id}", name="admin_question_delete", methods={"POST"})
     */
    public function delete(Request $request, question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_question_index', [], Response::HTTP_SEE_OTHER);
    }
}
