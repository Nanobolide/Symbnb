<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    #[Route('/ads', name: 'ad_index')]
    public function index(AdRepository $repo): Response
    {
        
        //Dependance
        // public function index( EntityManagerInterface $entityManager ): Response 
        // $repo = $entityManager->getRepository(Ad::class);

        $ads = $repo->findAll();



        return $this->render('ad/index.html.twig', [
            'ads'=> $ads,
        ]);
 
            }

        
            // Permet d'afficher une seule Annonce
        /**
         * @return Response
         */
        #[Route('/ads/{slug}' , name: 'ads_show')]
        public function show($slug , AdRepository $repo)
        {
            //Je récupère l'annonce qui correspond au slug !
            $ad = $repo->findOneBySlug($slug);


            return $this->render('ad/show.html.twig', [
                    'ad' => $ad
            ]);
        }
}

