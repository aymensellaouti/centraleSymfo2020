<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(Request $request)
    {
        $session = $request->getSession();
        if($session->has('username')) {
            $nbVisite = $session->get('nbVisite');
            $nbVisite++;
            if ($nbVisite == 5) {
               $this->addFlash('fidele',"C'est votre 5eme visite merci pour votre fidélité");
            }
            $session->set('nbVisite', $nbVisite);
            $message = 'Merci de nous faire encore confiance';
        } else {
            $session->set('username', 'aymen');
            $session->set('nbVisite', 1);
            $message = "C'est votre première visite, nous vous souhaitons la bienvenu";
        }
        return $this->render('session/index.html.twig', [
            'message' => $message,
        ]);
    }
}
