<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

//Ma class MonsiteController hérite de AbstractController parce que Symfony est fourni avec une classe de contrôleur de base optionnelle.
//@Route = annotation les route me permet de dire à symfony 'quand mon site appellera "/"" voici la fonction que tu dois afficher' 
//Dans mes fonction je traite la demande et de renvoyer une réponse
// Dans mes render, mes tableaux contiennent une liste des variables que twig va devoir utiliser

class MonsiteController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueil(){

        $produit1 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(1); // pour récupérer le produit avec id 1

        $produit2 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(2); // pour récupérer le produit avec id 2

        $produit3 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(3); // pour récupérer le produit avec id 3

        return $this->render('monsite/accueil.html.twig',[
            "produit1" => $produit1,
            "produit2" => $produit2,
            "produit3" => $produit3,
         ]); 
    }


	 /**
     * @Route("monsite/boutique", name="boutique")
     */
    public function boutique():Response
    {
        $produits = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->findAll();
        
        return $this->render('monsite/boutique.html.twig', [
            "produits" => $produits,
        ]);
    } 

    // création function +route pour redirection vers page une page produits
     /**
     * @Route("/monsite/shop/{id}", name="monsite_shop")
     */
    public function shop(int $id){

        $produit = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find($id);
        
        return $this->render('monsite/shop.html.twig',  [
            "produit" => $produit,
        ]);
    }


    /**
     * @Route("/monsite/contact", name="contact")
     */
    public function contact(){
        return $this->render('monsite/contact.html.twig');
    } 

    /**
     * @Route("/monsite/propos", name="propos")
     */
    public function propos(){
        return $this->render('monsite/propos.html.twig');
    } 

    /**
    * @Route("/monsite/mention", name="mention")
    */
    public function mention(){
        return $this->render('monsite/mention.html.twig');
    }
}

// getDoctrine = permet de dire à mon controller que je veux discuté avec doctrine et que je veux le repository tel (EXEMPLE/ repository qui gére un produit )
// int $id paramétre qui me permet de à symfony que mes route/quelque chose ce quelque chose est un identifaint et pour le récupérer l'identifiant je le passe dans ma function shop et dans la fonction je dit trouver moi l'identifiant du produit qu'on m'a envoyer à l'adresse en haut(url) et je passe un tableau à twig avec une varible qui va devoir afficher un produit et il contiendra les données du produit