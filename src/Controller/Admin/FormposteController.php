<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Formposte;
use App\Form\Admin\FormposteType;
use App\Repository\Admin\FormposteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FormposteController extends AbstractController
{
    /**
     * @Route("/admin/formposte", name="admin_formposte_index", methods={"GET"})
     */
    public function index(FormposteRepository $formposteRepository): Response
    {
        return $this->render('admin/formposte/index.html.twig', [
            'formpostes' => $formposteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/formposte/newbesoin", name="op_webapp_formposte_newbesoin", methods={"GET","POST"})
     */
    public function newbesoin(Request $request): Response
    {
        $formpostebesoin = new Formposte();
        $form = $this->createForm(FormposteType::class, $formpostebesoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formpostebesoin);
            $entityManager->flush();

            return $this->redirectToRoute('admin_formposte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formposte/new.html.twig', [
            'formposte' => $formpostebesoin,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/formposte/new", name="op_webapp_formposte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formposte = new Formposte();
        $form = $this->createForm(FormposteType::class, $formposte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formposte);
            $entityManager->flush();

            return $this->redirectToRoute('admin_formposte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formposte/new.html.twig', [
            'formposte' => $formposte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/formposte/{id}", name="admin_formposte_show", methods={"GET"})
     */
    public function show(Formposte $formposte): Response
    {
        return $this->render('admin/formposte/show.html.twig', [
            'formposte' => $formposte,
        ]);
    }

    /**
     * @Route("/admin/formposte/{id}/edit", name="admin_formposte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formposte $formposte): Response
    {
        $form = $this->createForm(FormposteType::class, $formposte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_formposte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/formposte/edit.html.twig', [
            'formposte' => $formposte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/admin/formposte/{id}", name="admin_formposte_delete", methods={"POST"})
     */
    public function delete(Request $request, Formposte $formposte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $formposte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formposte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_formposte_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/webapp/formposte/addbesoin", name="op_webapp_formposte_addbesoin", methods={"GET","POST"})
     */
    public function addbesoin(Request $request):Response
    {
        $data = json_decode($request->getContent(), true);

        $formposte = new Formposte();
        $formposte->setFirstName($data['firstName']);
        $formposte->setlastName($data['lastName']);
        $formposte->setPhone($data['phone']);
        $formposte->setEmail($data['email']);
        $formposte->setAge($data['age']);
        $formposte->setGenre($data['genre']);
        $formposte->setIsRgpd($data['isRgpd']);
        $formposte->setInternet($data['internet']);
        $formposte->setComputer($data['computer']);
        $formposte->setMediadevice($data['mediadevice']);
        $formposte->setOtherdevice($data['otherdevice']);
        $formposte->setPrintdevice($data['printdevice']);
        $formposte->setBesoins($data['besoins']);
        //dd($formposte);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($formposte);
        $entityManager->flush();

        return $this->json([
            'code'=> 200,
            'message' => "Ajout r??alis??"
        ], 200);

    }
}
