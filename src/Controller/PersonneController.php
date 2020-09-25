<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PersonneController
 * @package App\Controller
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/", name="personne")
     */
    public function index()
    {
        //Je dois récupérer mon Repository qui s'occupe des personnes
        $repository = $this->getDoctrine()->getRepository(Personne::class);

        //Je veux récupérer toutes les personnes de la base de données
        $personnes = $repository->findAll();

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/add/{name?sellaouti}/{firstname?aymen}/{age?38}", name="personne.add")
     */
    public function addPersonne($name, $firstname, $age) {
        //je récupére l'objet doctrine
        $doctrine = $this->getDoctrine();
        //Je récupére le manager de Doctrine
        $manager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setName($name);
        $personne->setFirstname($firstname);
        $personne->setAge($age);
        $manager->persist($personne);
        $manager->flush();
        $this->addFlash('success', "${firstname} ${name} ajouté avec succçès");
        // va vers la fonction qui liste les personnes
        return $this->redirectToRoute('personne');
    }

    /**
     * @Route("/{id}", name="personne.detail")
     */
    public function detailPersonne($id)
    {
        $personne = $this->findPersonneById($id);
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }

    /**
     * @Route("/update/{id}/{name?sellaouti}/{firstname?aymen}/{age?38}", name="personne.update")
     */
    public function updatePersonne($name, $firstname, $age, $id) {
        // Je récupére la personne à modifier
        $personne = $this->findPersonneById($id);
        // S'il existe
            // Je mets à jour les champs
        if ($personne) {
            $manager = $this->getDoctrine()->getManager();
            $personne->setAge($age);
            $personne->setName($name);
            $personne->setFirstname($firstname);
            $manager->persist($personne);
            $manager->flush();
            $this->addFlash('success', "Personne d'id ${id} a été modifié avec succçès");
        } else {
            // sinon
            // Message d'erreur
            $this->addFlash('error', "Personne d'id ${id} n'existe pas");
        }
        return $this->redirectToRoute('personne');
    }

    /**
     * @Route("/delete/{id}", name="personne.delete")
     */
    public function deletePersonne($id) {
        // Je récupére la personne à supprimer
        $personne = $this->findPersonneById($id);
        // S'il existe
        // Je supprime
        if ($personne) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash('success', "Personne d'id ${id} a été supprimé avec succçès");
        } else {
            // sinon
            // Message d'erreur
            $this->addFlash('error', "Personne d'id ${id} n'existe pas");
        }
        return $this->redirectToRoute('personne');
    }


    function findPersonneById($id) {
        //Je dois récupérer mon Repository qui s'occupe des personnes
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        //Je veux récupérer toutes les personnes de la base de données
        $personne = $repository->find($id);
        return ($personne);
    }
}
