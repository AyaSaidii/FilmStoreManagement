<?php

namespace App\Controller;

use App\Entity\Commentaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="app_commentaire")
     */
    public function index(ManagerRegistry $manager): Response
    {
        $Commentaires = $manager->getRepository(Commentaire::class)->findAll();
        return $this->render('commentaire/index.html.twig', [
            'Commentaires' => $Commentaires,
        ]);
    }

     /**
     * @Route("/commentaire/delete/{id?0}", name="delete_commentaire")
     */
    public function delete(Commentaire $Commentaires=null,ManagerRegistry $manager,Request $request)
    {   
        if($Commentaires){
            $rep = $manager->getManager();
            $rep->remove($Commentaires);
            $rep->flush();
            return $this->redirectToRoute('app_commentaire');
        }
    }
}
