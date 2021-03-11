<?php

// namespace App\Service\Panier;

// use App\Repository\ProduitRepository;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;

// class PanierService{

// 	protected $session;
// 	protected $produitrepository;

// 	public function __construct(SessionInterface $session , ProduitRepository $produitrepository)
// 	{
// 		$this->session = $session;
// 		$this->produitRepository = $produitrepository;
// 	}

// 	public function add(int $id) {
// 		$panier =$this->session->get('panier', []);

//     	if(!empty($panier{$id})) {
//     		$panier[$id]++;
//     	} else{
//     		$panier[$id] = 1;
//     	}

//     	$this->$session->set('panier', $panier);
// 	}

// 	public function remove(int $id) {
// 		 $panier = $this->$session->get('panier', []);

//         if(!empty($panier[$id])){
//             unset($panier[$id]);
//         }

//         $this->$session->set('panier' , $panier);

// 	}

// 	public function getFullPanier() : array 
// 	{
// 		$panier = $this->$session->get('panier', []);

//         $panierWithData = [];

//         foreach ($panier as $id => $quantity) {
//         	$panierWithData[] = [
//         		'produit' => $this->$produitrepository->find($id),
//         		'quantity' => $quantity,
//         	];
//         }

//         return $panierWithData;
// 	}

// 	public function getTotal() : float {
// 		 $total = 0;


//         foreach ($this->getFullPanier() as $item) {
//             $total += $item['produit']->getPrice() * $item['quantity'];
//         }
//         return $total;
// 	}
	
// }