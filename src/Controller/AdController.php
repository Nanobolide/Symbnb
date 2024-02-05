<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

        /**
         * @return Response
         */
        #[Route('/ads/create' , name: 'ads_create')]
        public function create(Request $request , EntityManagerInterface $manager){
            $ad = new Ad();
            $form = $this->createForm(AdType::class, $ad);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                

                 $manager->persist($ad);
                 $manager->flush();

                 return $this->redirectToRoute('ads_show', [
                    'slug' => $ad->getSlug()
                 ]);
            }
            // var_dump($ad);
            return $this->render('ad/create.html.twig', [
                'form' => $form->createView()
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

