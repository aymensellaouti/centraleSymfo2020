<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function index(Request $request)
    {
        /*
         * Je vérifie si le tableau existe ou pas
         *    Si n'existe pas
         *      J'initialiste le tableau
         *      Je le mets dans la session
         *    Finsi
         *    Afficher la liste des todos
         * */

        // Je récupére la session
        $session = $request->getSession();

        if(!$session->has('mesTodos')) {
            $todos = array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            );
            $this->addFlash('info', "La liste de todos vient d'etre initialisée");
            $session->set('mesTodos', $todos);
        }
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/todo/add/{name}/{content}", name="todo.add")
     */
    public function addTodo($name, $content, Request $request) {
        /*
         * Si on a une session
         *    On vérfie que la clé du todo n'existe pas
         *      Si elle existe
         *          message erreur flashbag
         *      Sinon
         *          Récupére le tableau de la session
         *          On ajoute le todo
         *          Flashbag succes
         *          On le remet dans la session
         *     finsi
         * sinon
         *      message erreur et
         * finsi
         * redirection vers page d'accueil
         * */
        //Je récupére la session
        $session = $request->getSession();

        if($session->has('mesTodos')) {
            //Si on a les todos
            $todos = $session->get('mesTodos');
            if(isset($todos[$name])) {
                //Si le todo existe déjà on affiche un message d'erreur
                $this->addFlash('error', "Le todo ${name} existe déjà");
            } else {
                //LE todo n'existe pas
                $todos[$name] = $content;
                $this->addFlash('success', "Le todo ${name} a été ajouté avec succès");
                $session->set('mesTodos', $todos);
            }
        } else {
            //Si on n'a pas les todos
            $this->addFlash('error', "La session n'a pas encore été initialisée");
        }
        return $this->redirectToRoute('todo');
    }
}
