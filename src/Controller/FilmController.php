<?php

namespace App\Controller;
use App\Form\FilmType;
use App\Entity\Film;
use App\Form\FilmFormType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
    * @Route("/film/{id}", name="film_detail")
    */
public function showFilm(FilmRepository $filmRepository, $id): Response
{
    $FilmsAll = $filmRepository->find($id);

    return $this->render('home/film_detail.html.twig', [
        'film' => $FilmsAll,
    ]);
}

    /**
     * @Route("/films", name="all_film")
     */
    public function index(ManagerRegistry $manager): Response
    {
        $FilmsAll = $manager->getRepository(Film::class)-> findAll();
        return $this->render('home/films.html.twig', ['FilmsAll' => $FilmsAll,]);
    }

}

    



