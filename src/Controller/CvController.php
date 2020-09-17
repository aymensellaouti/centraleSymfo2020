<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /**
     * @Route("/cv/{name}/{firstname}/{age}/{section}", name="cv")
     */
    public function index($name, $firstname, $age, $section)
    {
        return $this->render('cv/index.html.twig', array(
            'name' => $name,
            'firstname' => $firstname,
            'age' => $age,
            'section' => $section,
        ));
    }
}
