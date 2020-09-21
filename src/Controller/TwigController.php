<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route("/twig", name="twig")
     */
    public function index()
    {
        $name="aymen";
        $tab = [10,20,3];
        return $this->render('twig/index.html.twig', [
            'nom' => $name,
            'age' => '38',
            'monTableau' => $tab
        ]);
    }
}
