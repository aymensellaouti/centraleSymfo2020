<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class TodoController
 * @package App\Controller
 * @Route("todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/all", name="todo")
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
     * @Route(
     *     "/add/{name}/{content}",
     *      name="todo.add",
     *      requirements={"name":"[0-1]?\d{1,2}"},
     *      defaults={"content":"Dormir", "name":"dimanche"}
     * )
     */
    public function addTodo($name, $content, Request $request) {
        /*
         * Si on a une session
         *    On vérfie que la clé du todo n'existe pas
         *      Si elle existe
         *          message erreur flashbag
         *      Sinon // existe pas
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
            // je vérifie si il y a dans mesTodos une variable de clé $name
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
    /**
     * @Route("/update/{name}/{content}", name="todo.update")
     */
    public function updateTodo($name, $content, Request $request) {
        /*
         * Si on a une session
         *    On vérfie que la clé du todo n'existe pas
         *      Si elle n'existe pas
         *          message erreur flashbag
         *      Sinon // existe
         *          Récupére le tableau de la session
         *          On met à jour le todo
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
            // je vérifie si il y a dans mesTodos une variable de clé $name
            if(!isset($todos[$name])) {
                //Si le todo n'existe pas on affiche un message d'erreur
                $this->addFlash('error', "Le todo ${name} n'existe pas");
            } else {
                //LE todo existe
                $todos[$name] = $content;
                $this->addFlash('success', "Le todo ${name} a été mis à jour avec succès");
                $session->set('mesTodos', $todos);
            }
        } else {
            //Si on n'a pas les todos
            $this->addFlash('error', "La session n'a pas encore été initialisée");
        }
        return $this->redirectToRoute('todo');
    }

    /**
     * @Route("/delete/{name}", name="todo.delete")
     */
    public function deleteTodo($name, Request $request) {
        /*
         * Si on a une session
         *    On vérfie que la clé du todo n'existe pas
         *      Si elle n'existe pas
         *          message erreur flashbag
         *      Sinon // existe
         *          Récupére le tableau de la session
         *          On supprime le todo
         *          Flashbag succes
         *          On le remet dans la session
         *     finsi
         * sinon
         *      message erreur
         * finsi
         * redirection vers page d'accueil
         * */
        //Je récupére la session
        $session = $request->getSession();

        if($session->has('mesTodos')) {
            //Si on a les todos
            $todos = $session->get('mesTodos');
            // je vérifie si il y a dans mesTodos une variable de clé $name
            if(!isset($todos[$name])) {
                //Si le todo n'existe pas on affiche un message d'erreur
                $this->addFlash('error', "Le todo ${name} n'existe pas");
            } else {
                //LE todo existe
                unset($todos[$name]);
                $this->addFlash('success', "Le todo ${name} a été supprimé avec succès");
                $session->set('mesTodos', $todos);
            }
        } else {
            //Si on n'a pas les todos
            $this->addFlash('error', "La session n'a pas encore été initialisée");
        }
        return $this->redirectToRoute('todo');
    }
}
