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
     * @Route("/panier", name="monpanier_index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitrepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
        	$panierWithData[] = [
        		'produit' => $produitrepository->find($id),
        		'quantity' => $quantity,
        	];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['produit']->getPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="monpanier_add")
     */
    public function add($id, SessionInterface $session)
    {
       	$panier =$session->get('panier', []);

    	if(!empty($panier{$id})) {
    		$panier[$id]++;
    	} else{
    		$panier[$id] = 1;
    	}

    	$session->set('panier', $panier);

    	return $this->redirectToRoute('monpanier_index');
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

        $commande->setEnCours('azerthj');
        $commande->setCreatedAt(new DateTime());

         foreach ($panier as $produit) {
            $commande->addProdut($this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($produit));
        }

        $session->set('panier', []);

        $em->persist($commande);
        $em->flush();

        return $this->redirectToRoute("monpanier_index");
    }
}
