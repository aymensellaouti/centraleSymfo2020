<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Lf3igController extends AbstractController
{
    /**
     * @Route("/lf3ig", name="lf3ig")
     */
    public function index()
    {
        return $this->redirectToRoute('session');
    }
}
