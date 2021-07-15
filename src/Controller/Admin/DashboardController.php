<?php

namespace App\Controller\Admin;

use App\Entity\Webapp\Usager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/opadmin/dashboard", name="op_admin_dashboard_index")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig');
    }

    /**
     * @Route("/webapp/dashboard/addusager", name="op_admin_dashboard_addusager", methods={"GET","POST"})
     */
    public function addusager()
    {
        $date = new \DateTime();
        $date->format('Y-m-d');
        //dd($date);
        $lastentry = $this->getDoctrine()->getRepository(Usager::class)->findOneBy(array(),array('id'=>'DESC'));
        //dd($lastentry);
        if (!$lastentry){
            $usager = new Usager();
            $usager->setDate($date);
            $usager->setCountUsager(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usager);
            $entityManager->flush();
            return $this->json([
                'code'          => 200,
                'message'       => 'Une nouvelle date ajoutée et un usager est ajoutée'
            ], 200);
        } else {
            $lastdate = $lastentry->getDate();
            $countUsager = $lastentry->getCountUsager();
            //dd($countUsager);
            if($lastdate = $date){
                $lastentry->setCountUsager($countUsager +1);
                $this->getDoctrine()->getManager()->flush();
                return $this->json([
                    'code'          => 200,
                    'message'       => 'Un usager est entré dans la poste'
                ], 200);
            } else {
                $usager = new Usager();
                $usager->setDate($date);
                $usager->setCountUsager(1);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usager);
                $entityManager->flush();
                return $this->json([
                    'code'          => 200,
                    'message'       => 'Une nouvelle date ajoutée et un usager est ajoutée'
                ], 200);
            }
        }
    }

    /**
     * @Route("/webapp/dashboard/remusager", name="op_admin_dashboard_remusager", methods={"GET","POST"})
     */
    public function remusager()
    {
        $lastentry = $this->getDoctrine()->getRepository(Usager::class)->findOneBy(array(),array('id'=>'DESC'));
        $countUsager = $lastentry->getCountUsager();
        $lastentry->setCountUsager($countUsager - 1);
        $this->getDoctrine()->getManager()->flush();
        return $this->json([
            'code'          => 200,
            'message'       => "correction d'usager"
        ], 200);
    }
}
