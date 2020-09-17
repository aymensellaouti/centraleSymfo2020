<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig');
    }

    /**
     * @return Response
     * @Route("/apprentissage/{matiere}/{enseignant}")
     */
    public function testApprentissage($matiere, $enseignant) {
        return $this->render('test/second.html.twig', [
            'maMatiere' => $matiere,
            'enseignant' => $enseignant,
        ]);
    }
}
