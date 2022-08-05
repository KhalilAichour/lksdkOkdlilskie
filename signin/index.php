<?php
	
	require '../classes/_header.php';
	
	if ($user->userConnected()){
		header("location:../");
	} else {
		$erreur="";
	
		$formSigninPhone=isset($_POST['formSigninPhone']) ? $_POST['formSigninPhone'] : NULL;
		$formSigninPassword=isset($_POST['formSigninPassword']) ? hash("sha256", $_POST["formSigninPassword"]) : NULL;
		$formSigninSubmit=isset($_POST['formSigninSubmit']) ? $_POST['formSigninSubmit'] : NULL;
		
		if(isset($formSigninSubmit)){
			$query_user = $DB->query('SELECT id, phonenumber, function, name, email FROM users WHERE phonenumber=:phonenumber and password=:password', array('phonenumber' => $formSigninPhone, 'password' => $formSigninPassword));
			
			if (count($query_user) == 1) {
				$user->setId      ($query_user[0]->id);
				$user->setPhone   ($query_user[0]->phonenumber);
				$user->setName    ($query_user[0]->name);
				$user->setEmail   ($query_user[0]->email);
				$user->setFunction($query_user[0]->function);
				
				if (isset($_SESSION['panieratteint']) and $_SESSION['panieratteint']){
					header("location:../cart");
				} else {
					header("location:../");
				}
			} else {
				$erreur = "Erreur de connexion";
			}
		}
	}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Khalil AICHOUR">

  <meta name="theme-color" content="#f5f5f5">
  <title>Se connecter</title>
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

  <main class="form-signin">
    <form name="signinForm" method="post" action="">
      <img class="mb-1" src="../assets/brand/EatingSpot-logo_70.svg" alt="">
      <h1 class="logo">Eating spot</h1>

      <h2 class="h3 my-3 fw-normal">Connectez-vous</h2>

      <?php if($erreur !== ""){ ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $erreur ?>
      </div>
      <?php } ?>

      <div class="form-floating">
        <input type="text" class="form-control" id="formSigninPhone" name="formSigninPhone"
          placeholder="05 ou 06 ou 07 xx xx xx xx">
        <label for="formSigninPhone">05 ou 06 ou 07 xx xx xx xx</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="formSigninPassword" name="formSigninPassword"
          placeholder="Mot de passe">
        <label for="formSigninPassword">Mot de passe</label>
      </div>

      <button class="w-100 btn btn-lg submit-color mt-4" id="formSigninSubmit" name="formSigninSubmit" value="se_connecter" type="submit">Se connecter</button>

      <div class="w-100 d-flex justify-content-between mt-4">
        <a class="rattrapage" href="../signup">Créer un compte</a>
        <a class="rattrapage" href="../">Accueil</a>
      </div>

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
    </form>
  </main>


<!--<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="./assets/js/offcanvas.js"></script>-->
<script src="./assets/js/myScript.js"></script>
</body>

</html>