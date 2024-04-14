<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * @Route("/home", name="home")
     */
    public function findBy6(ManagerRegistry $manager): Response
    {   $FilmsAll = $manager->getRepository(Film::class)-> findAll();
        $Films6 = $manager->getRepository(Film::class)-> findBy(array('id' => array(1, 2, 3, 4, 5, 6)));
        $Films10 = $manager->getRepository(Film::class)-> findBy(array('id' => array(8, 9, 10, 11, 12, 13,14,15,16,17)));
        $Filmslast = $manager->getRepository(Film::class)-> findBy(array('id' => array(12, 13, 17, 15, 16,9)));
        $Film = $manager->getRepository(Film::class)-> find(7);
        return $this->render('home/index.html.twig', [
            'FilmsAll' => $FilmsAll,
            'Films6' => $Films6,
            'Films10' => $Films10,
            'Filmslast' => $Filmslast,
            'Film' => $Film,
        ]);

    }
    /**
     * @Route("/reg", name="register")
     */
    public function register(ManagerRegistry $manager): Response
    {  
        return $this->render('home/signin.html.twig');
    }

    /**
     * @Route("/trailer/{id?0}", name="trailer")
     */
    public function trailer(Film $film =null,ManagerRegistry $manager): Response
    {  
        return $this->render('home/trailer.html.twig', [
            'FilmOne' => $film,
        ]);
    }


   
    /**
     * @Route("/signup", name="signup")
     */
    public function signup(): Response
    {
        return $this->render('home/signup.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
