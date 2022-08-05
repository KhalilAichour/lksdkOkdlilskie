<?php

require './_header.php';

$json = array('error' => true);

if(isset($_GET['id'])){
	$product = $DB->query('SELECT id FROM products WHERE id=:id', array('id' => $_GET['id']));
	if(empty($product)){
		$json['message'] = "This product does not exists.";
	}
	$panier->add($product[0]->id);
	$json['error'] = false;
	$json['count'] = $panier->count();
	$json['message'] = 'The product has been successfully added to your cart.';
} else {
	$json['message'] = "You have not selected a product to add to the cart.";
}

echo json_encode($json);

