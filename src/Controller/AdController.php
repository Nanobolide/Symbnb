<?php

namespace App\Controller;

use App\Entity\Ad;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    #[Route('/ads', name: 'ad_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        
        $repo = $entityManager->getRepository(Ad::class);
        $ads = $repo->findAll();



        return $this->render('ad/index.html.twig', [
            'ads'=> $ads,
        ]);
        
    }
}
