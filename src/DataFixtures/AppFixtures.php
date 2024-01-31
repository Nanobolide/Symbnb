<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        for ($i=0; $i < 30 ; $i++) { 
            $ad = new Ad();
            
            
            $ad->setTitle("Titre de l'annnoce n*$i")
                ->setSlug("Titre-de-l-annnoce-n-$i")
                ->setCoverImage("http://placehold.it/100x300")
                ->setIntroduction("Bonjour a tous c'est une introduction")
                ->setContent("<p>Je suis un contenu riche  <br>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore, modi?
                    !</p>")
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1, 5));

            

                for ($j = 1; $j < mt_rand(1, 5); $j++) {
                    $image = new Image();
                    $image->setUrl("http://placehold.it/100x300")
                        ->setCaption("Légende de l'image $j")
                        ->setAd($ad);
    
                    $manager->persist($image);
                }
                $manager->persist($ad);



    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
