<?php

	require '../classes/_header.php';
	
	if ($user->userConnected()) {
		$ids = array_keys($_SESSION['panier']);
		
		if(empty($ids)){
			header("location:../");
		} else {
			$json = array();
			$montant = 0;
			$produits = $DB->query('SELECT * FROM products WHERE id in ('.implode(",", $ids).')');
			foreach ($produits as $produit){
				$json += array($produit->id => $_SESSION['panier'][$produit->id]);
				$montant += $produit->prix_vente * $_SESSION['panier'][$produit->id];
			}
			$DB->insertOrUpdate("INSERT INTO orders (client_name, client_phone_number, status, items_json, montant, transport_mode, payed) VALUES ('".$user->getName()."', '".$user->getPhone()."', 'new', '".json_encode($json)."', '".$montant."', 'take away', '0')");
			$panier->empty();
			$_SESSION['panieratteint'] = false;
			header("location:../");
		}
	} else {
		$_SESSION['panieratteint'] = true;
		header("location:../signin");
	}
	