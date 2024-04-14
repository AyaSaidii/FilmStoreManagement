<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UserFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="app_utilisateur")
     */
    public function index(ManagerRegistry $manager): Response
    {   
        $Users = $manager->getRepository(Utilisateur::class)->findAll();
        return $this->render('utilisateur/index.html.twig', [
            'Users' => $Users,
        ]);
    }

     /**
     * @Route("/utilisateur/delete/{id?0}", name="delete_utilisateur")
     */
    public function delete(Utilisateur $Users=null,ManagerRegistry $manager,Request $request)
    {   
        if($Users){
            $rep = $manager->getManager();
            $rep->remove($Users);
            $rep->flush();
            return $this->redirectToRoute('app_utilisateur');
        }
    }
    /**
     * @Route("/User/add", name="add_User")
     */
    public function add(ManagerRegistry $manager,Request $request): Response
    {   
        $Users = new Utilisateur();
        $form = $this->createForm(UserFormType::class,$Users);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $rep =$manager->getManager();
            $rep->persist($Users);
            $rep->flush();
            $this->addFlash('success','Utilisateur ajouter avec succes');
            return $this->redirectToRoute('app_utilisateur');
        }else{
            return $this->render('utilisateur/form.html.twig',['form' =>$form->createView()]);
        }

    }
}
