<?php
class panier{
	
	private $DB;
	
	public function __construct($DB){
		if(!isset($_SESSION)){
			session_start();
		}
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
			// $_SESSION['panieratteint'] = false;
		}
		$this->DB = $DB;
	}
	
	public function add($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			$_SESSION['panier'][$product_id]++;
		} else {
			$_SESSION['panier'][$product_id] = 1;
		}
	}
	
	public function remove($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			if($_SESSION['panier'][$product_id] > 1){
				$_SESSION['panier'][$product_id]--;
			} else {
				unset($_SESSION['panier'][$product_id]);
			}
		}
	}
	
	public function total(){
		$total = 0;
		$ids = array_keys($_SESSION['panier']);
		if(empty($ids)){
			$produits = array();
		} else {
			$produits = $this->DB->query('SELECT id, prix_vente FROM products WHERE id in ('.implode(",", $ids).')');
		}
		foreach($produits as $produit){
			$total += $produit->prix_vente * $_SESSION['panier'][$produit->id];
		}
		return $total;
	}
	
	public function count(){
		return array_sum($_SESSION['panier']);
	}
	
	public function empty(){
		$produits = $this->DB->query('SELECT id FROM products');
		foreach($produits as $produit){
			if (isset($_SESSION['panier'][$produit->id])) {
				unset($_SESSION['panier'][$produit->id]);
			}
		}
		if (isset($_SESSION['panier'])) {
			if (count($_SESSION['panier']) == 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
}


























