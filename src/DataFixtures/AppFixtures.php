<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Match;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        m1 = ajouterMatch("fred","foot","Allemagne", "France", LocalDateTime.now().plusMinutes(5));
        ajouterMatch("fred","rugby","France", "Australie", LocalDateTime.now().minusDays(7));
        m2 = ajouterMatch("fred","foot","France", "Australie", LocalDateTime.parse("2018-06-16 12:00",formatter));
        ajouterMatch("fred","foot","France", "Pérou", LocalDateTime.parse("2018-06-21 10:00",formatter));
        ajouterMatch("fred","foot","Danemark", "France", LocalDateTime.parse("2018-06-26 16:00",formatter));
        $match = new Match();
        $match->setSport("foot")
              ->setEquipe1("Allemagne")
              ->setEquipe2("France")
              ->setQuand(new \DateTime());
        $manager->persist($match);

        $match = new Match();
        $match->setSport("rugby")
              ->setEquipe1("France")
              ->setEquipe2("Australie")
              ->setQuand(new \DateTime());
        $manager->persist($match);

        $match = new Match();
        $match->setSport("foot")
              ->setEquipe1("France")
              ->setEquipe2("Pérou")
              ->setQuand(new \DateTime());
        $manager->persist($match);

        $match->setSport("foot")
              ->setEquipe1("Denmark")
              ->setEquipe2("Brésil")
              ->setQuand(new \DateTime());
        $manager->persist($match);

        $match->setSport("BasketBall")
              ->setEquipe1("Algerie")
              ->setEquipe2("Japan")
              ->setQuand(new \DateTime());
        $manager->persist($match);

        $match->setSport("HandBall")
              ->setEquipe1("Mexique")
              ->setEquipe2("Amérique")
              ->setQuand(new \DateTime());
        $manager->persist($match);
        
        $user = new User();
        $user->setLogin("nano")
             ->setPassword("nano123")
             ->setIsAdmin(true);
        $manager->persist($user);

        $user = new User();
        $user->setLogin("nano")
             ->setPassword("nano123")
             ->setIsAdmin(true);
        $manager->persist($user);

        $manager->flush();
    }
}
