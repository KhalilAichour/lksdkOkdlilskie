<?php

require './_header.php';

$json = array('error' => true);

if ($panier->empty()) {
	$json['error'] = false;
	$json['message'] = 'The cart has been emptied.';
} else {
	$json['message'] = "The cart could not be emptied.";
}

echo json_encode($json);

