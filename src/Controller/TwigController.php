<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route(
     *     "/twig/{nb?5<\d+>}",
     *      name="twig"
     * )
     */
    public function index($nb)
    {
        $tab = [];
        for ($i = 0; $i < $nb; $i++) {
            $tab[$i] = random_int(1, 1000);
        }
        return $this->render('twig/index.html.twig', [
            'monTableauDentier' => $tab
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/colortab", name="twig.colorTab")
     */
    public function tabColor()
    {
        $users = [
            ['name' => 'sellaouti', 'firstname' => 'aymen', 'age' => 38],
            ['name' => 'ben slimen', 'firstname' => 'ahmed', 'age' => 38],
            ['name' => 'ben salah', 'firstname' => 'mohamed', 'age' => 38]
        ];
        return $this->render('twig/colorTab.html.twig', [
           'colorTab' => $users
        ]);
    }
}
