<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;

class MonsiteController extends AbstractController
{
    /**
     * @Route("/monsite", name="monsite")
     */
    public function index(): Response
    {
        return $this->render('monsite/index.html.twig', [
            'controller_name' => 'MonsiteController',
        ]);
    }

     // création function +route pour que la page accuiel s'affiche en premier quand j'appel locahost 8000

    /**
     * @Route("/", name="accueil")
     */
    public function accueil(){

        $produit1 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(1); // si tu veux le produit avec id 1

        $produit2 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(2); // si tu veux le produit avec id 2

        $produit3 = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find(3); // si tu veux le produit avec id 3

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
        //$categorie = $request->query->get("category");

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
