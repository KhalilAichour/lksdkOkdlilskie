<?php 
require '../classes/_header.php';
?>
<!doctype html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Khalil AICHOUR">

		<meta name="theme-color" content="#f5f5f5">
		<title>Panier</title>
		<link rel="icon" type="image/gif/png" href="../assets/brand/favicon.png">
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

		<!-- Bootstrap core CSS -->
		<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../assets/css/sign.css" rel="stylesheet">
	</head>

	<body class="text-center">

	<main class="form-cart">
		<img class="mb-1" src="../assets/brand/EatingSpot-logo_70.svg" alt="">
		<h1 class="logo">Eating spot</h1>
		<div class="container mt-3">
			<div class="row justify-content-center">
				<div class="col-sm-10 col-md-8 col-lg-6 col-lg-4">
					
					<?php
						$ids = array_keys($_SESSION['panier']);
						if(empty($ids)){
							$panierVide = TRUE;
							$produits = array();
						} else {
							$panierVide = FALSE;
							$produits = $DB->query('SELECT * FROM products WHERE id in ('.implode(",", $ids).')');
						}
					?>
					
					<?php if(!$panierVide){ ?>
						<div class="text-center">
							<p><a class="text-monospace text-muted" href="javascript:history.back()">Continuez vos achats</a></p>
						</div>
						<h4 class="d-flex justify-content-between mb-3 mt-4">
							<span class="text-secondary">Votre panier:</span>
							<span class="badge rounded-pill bg-secondary"><?= $panier->count(); ?></span>
						</h4>
					<?php } else { ?>
						<h4 class="d-flex justify-content-center mb-3 mt-4">
							<span class="text-secondary">Votre panier est vide</span>
						</h4>
						<p><a class="text-monospace text-muted" href="javascript:history.back()">Retourner sur le menu</a></p>
					<?php } ?>
					
					<ul class="list-group mb-3">
						<?php foreach($produits as $key=>$produit) { ?>
							<li class="list-group-item d-flex justify-content-between text-start">
								<div>
									<h6 class="my-0"><?= $produit->name; ?></h6>
									<small class="text-muted">[Pu : <?= $produit->prix_vente; ?> / Qty : <?= $_SESSION['panier'][$produit->id]; ?>]</small>
								</div>
								<div>
									<h6 class="text-muted"><span><?= $produit->prix_vente * $_SESSION['panier'][$produit->id]; ?></span> da</h6>
								</div>
							</li>
						
						<?php } ?>
						
						<?php if(!$panierVide){ ?>
							<li class="list-group-item d-flex justify-content-between bg-light text-start">
								<div class="text-success">
									<h6 class="my-0">Code promotion</h6>
									<small class="text-uppercase"><span>code promo</span></small>
								</div>
								<span class="text-success"><span>- </span>0</span>
							</li>

							<li class="list-group-item d-flex justify-content-between text-start">
								<strong><span>Total</span></strong>
								<strong><span><?= $panier->total(); ?></span> da</strong>
							</li>
						<?php } ?>
					</ul>
					
					
					<?php if(!$panierVide){ ?>
						
							<div class="input-group mb-3 mt-4">
								<input type="text" class="form-control" placeholder="Entrer code promo">
								<div class="input-group-append">
									<button class="btn btn-outline-success" type="button" id="button-addon2" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" disabled>Appliquer</button>
								</div>
							</div>

							<div class="d-flex justify-content-between mt-4 mb-5">
								<a href="../classes/removecart.php" type="button" class="btn btn-outline-danger btn-block removeCart">Vider le panier</a>
								<a href="../checkout/index.php" type="button" id="checkoutButton" name="checkoutButton" value="Commander" class="btn btn-block submit-color">Commander</a>
							</div>
						
					<?php } ?>
					
					<div class="mb-3"></div>

				</div>
			</div>
		</div>
		<p class="mt-3 mb-2 text-muted">&copy; 2021-2022</p>
	</main>

	<!--
		<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
		<script src="../assets/js/offcanvas.js"></script>
	-->
	<script src="../assets/js/myScript.js"></script>
	</body>

</html>

