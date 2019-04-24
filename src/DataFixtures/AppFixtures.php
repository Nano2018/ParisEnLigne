<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Matche;
use App\Entity\Pari;
use App\Entity\User;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $match1 = new Matche();
        $match1->setSport("foot")
              ->setEquipe1("Allemagne")
              ->setEquipe2("France")
              ->setQuand(new \DateTime());
        $manager->persist($match1);

        $match2 = new Matche();
        $match2->setSport("rugby")
              ->setEquipe1("France")
              ->setEquipe2("Australie")
              ->setQuand(new \DateTime());
        $manager->persist($match2);

        $match3 = new Matche();
        $match3->setSport("foot")
              ->setEquipe1("France")
              ->setEquipe2("Pérou")
              ->setQuand(new \DateTime());
        $manager->persist($match3);

        $match4 = new Matche();
        $match4->setSport("foot")
              ->setEquipe1("Denmark")
              ->setEquipe2("Brésil")
              ->setQuand(new \DateTime());
        $manager->persist($match4);
        
        $match5 = new Matche();
        $match5->setSport("BasketBall")
              ->setEquipe1("Algerie")
              ->setEquipe2("Japan")
              ->setQuand(new \DateTime());
        $manager->persist($match5);

        $match6 = new Matche();
        $match6->setSport("HandBall")
              ->setEquipe1("Mexique")
              ->setEquipe2("Amérique")
              ->setQuand(new \DateTime());
        $manager->persist($match6);
        
        $admin = new User();
        $admin->setLogin("nano")
             ->setPassword("nano123")
             ->setIsAdmin(true);
        $manager->persist($admin);

        $user1 = new User();
        $user1->setLogin("kiki")
             ->setPassword("kiki123")
             ->setIsAdmin(false);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setLogin("saso")
             ->setPassword("saso123")
             ->setIsAdmin(false);
        $manager->persist($user2);
  
        $pari1 = new Pari();
        $pari1->setParieur($user1)
              ->setMatche($match1)
              ->setVainqueur("null")
              ->setMontant(35.0)
              ->setGain(0.0);
        $manager->persist($pari1);

        $pari2 = new Pari();
        $pari2->setParieur($user2)
              ->setMatche($match3)
              ->setVainqueur("France")
              ->setMontant(110.0)
              ->setGain(0.0);
        $manager->persist($pari2);
    
        $manager->flush();
    }
}
