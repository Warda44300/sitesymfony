<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProduitRepository;
use App\Entity\Produit;
use App\Entity\Commande;
use \DateTime;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier/monpanier", name="monpanier")
     */
    public function panier(SessionInterface $session, ProduitRepository $produitrepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $produit = $produitrepository->find($id);

            $panierWithData[] = [
                'produit' => $produit,
                'quantity' => $quantity,
            ];

            $totalItem = $produit->getPrice() * $quantity;
            $total += $totalItem;
        }

        // foreach ($panierWithData as $item) {
        //     $totalItem = $item['produit']->getPrice() * $item['quantity'];
        //     $total += $totalItem;
        // }

        return $this->render('panier/monpanier.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="monpanier_add")
     */
    public function add($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier{$id})) {
            $panier[$id]++;
        } else{
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('monpanier');
    }

     /**
     * @Route("/panier/remove/{id}", name="monpanier_remove")
     */
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier' , $panier);

        return $this->redirectToRoute("monpanier_index");
    }

    /**
    * @Route("/panier/commande", name="commande")
    */
    public function commmande(SessionInterface $session){
        $panier = $session->get('panier', []);
        $em = $this->getDoctrine()->getManager();

        $commande= new Commande();

        $commande->setEncours('blabla');
        $commande->setValider('azerthj');
        $commande->setCreatedAt(new DateTime());
        $commande->setUser($this->getUser());

        foreach ($panier as $produit) {
            $commande->addProdut($this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($produit));
        }
 
        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute("panier_commande");
    }

    /**
    * @Route("/validation", name="panier_commande")
    */
    public function validation(SessionInterface $session, ProduitRepository $produitrepository)
    {
       $panier = $session->get('panier', []);

        $panierWithData = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $produit = $produitrepository->find($id);

            $panierWithData[] = [
                'produit' => $produit,
                'quantity' => $quantity,
            ];

            $totalItem = $produit->getPrice() * $quantity;
            $total += $totalItem;
        }

        $session->set('panier', []);
        return $this->render("panier/validation.html.twig", [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }
}


// Symfony fournit un service de session qui est injecté dans vos services et contrôleurs si vous tapez un argument 