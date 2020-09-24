<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index()
    {
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
        ]);
    }

    /**
     * @Route("/personne/add", name="personne.add")
     */
    public function addPersonne() {
        //je récupére l'objet doctrine
        $doctrine = $this->getDoctrine();
        //Je récupére le manager de Doctrine
        $manager = $doctrine->getManager();
        $personne = new Personne();
        $personne->setName('sellaouti');
        $personne->setFirstname('aymen');
        $personne->setAge(38);
        $manager->persist($personne);
        $manager->flush();
        return new Response('<html><body><h1>Test ajout personne</h1></body></html>');
    }
}
