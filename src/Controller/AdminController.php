<?php

namespace App\Controller;
use App\Form\FilmType;
use App\Entity\Film;
use App\Entity\User;
use App\Form\FilmFormType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class AdminController extends AbstractController
{
    /**
     * @Route("admin/film", name="app_film")
     */
    public function index(ManagerRegistry $manager): Response
    {
        $Films = $manager->getRepository(Film::class)->findAll();
        return $this->render('admin/index.html.twig', ['Films' => $Films]);
    }
    /**
     * @Route("admin/users", name="users")
     */
    public function getAllUsers(ManagerRegistry $manager): Response
    {
        $Users = $manager->getRepository(User::class)->findAll();
        return $this->render('admin/user.html.twig', ['Users' => $Users]);
    }

     /**
     * @Route("admin/ajouter_film", name="add_Film")
     */
    public function addFilm(ManagerRegistry $manager,Request $request): Response
    {   
        $Films = new Film();
        $film = $this->createForm(FilmFormType::class,$Films);
        $film->handleRequest($request);
        if($film->isSubmitted()){
            $rep =$manager->getManager();
            $rep->persist($Films);
            $rep->flush();
            $this->addFlash('success','Film ajouter avec succes');
            return $this->redirectToRoute('app_film');
        }else{
            return $this->render('admin/AjouterFilm.html.twig',['form' =>$film->createView()]);
        }

    }
     /**
     * @Route("admin/liste_film", name="apdate_film")
     */
    public function apdate(ManagerRegistry $manager): Response
    {
        $Films = $manager->getRepository(Film::class)->findAll();
        return $this->render('admin/MaisAjourFilm.html.twig', ['Films' => $Films,]);
    }
    
    
     /**
     * @Route("/film/delete/{id?0}", name="delete_film")
     */
    public function delete(Film $Films=null,ManagerRegistry $manager,Request $request)
    {   
        if($Films){
            $rep = $manager->getManager();
            $rep->remove($Films);
            $rep->flush();
            return $this->redirectToRoute('app_film');
        }
    }
     /**
     * @Route("admin/liste_user", name="liste_user")
     */
    public function drop(ManagerRegistry $manager): Response
    {
        $Users = $manager->getRepository(User::class)->findAll();
        return $this->render('admin/Delete.html.twig', ['Users' => $Users,]);
    }
    /**
     * @Route("/user/delete/{id?0}", name="delete")
     */
    public function deleteUser(User $Users=null,ManagerRegistry $manager,Request $request)
    {   
        if($Users){
            $rep = $manager->getManager();
            $rep->remove($Users);
            $rep->flush();
            return $this->redirectToRoute('users');
        }
    }
    
       /**
     * @Route("/film/update/{id}", name="update_film")
     */
    public function update(FilmRepository $filmRepository, $id, Request $request): Response
    {
        $film = $filmRepository->find($id);
        $form = $this->createForm(FilmFormType::class, $film);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $filmRepository->add($film,true);//on utilise save pour enregestrer l'objet qui est deja trouver avec findbyid
        return $this->redirectToRoute('app_film');
        }
        
        return $this->render('admin/EditFilm.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

    



