<?php
  session_start();

  $formSignupName=isset($_POST['formSignupName']) ? $_POST['formSignupName'] : NULL;
  $formSignupPhone=isset($_POST['formSignupPhone']) ? $_POST['formSignupPhone'] : NULL;
  $formSignupEmail=isset($_POST['formSignupEmail']) ? $_POST['formSignupEmail'] : NULL;
  $formSignupPassword=isset($_POST['formSignupPassword']) ? $_POST['formSignupPassword'] : NULL;
  $formSignupRePassword=isset($_POST['formSignupRePassword']) ? $_POST['formSignupRePassword'] : NULL;
  $formSignupSubmit=isset($_POST['formSignupSubmit']) ? $_POST['formSignupSubmit'] : NULL;
  $erreur="";

  if(isset($formSignupSubmit)){
    if(empty($formSignupName) || empty($formSignupPhone) || empty($formSignupEmail) || empty($formSignupPassword) || empty($formSignupRePassword)){
      $erreur="Veuillez remplir correctement tous les champs.";
    } elseif ($formSignupPassword!=$formSignupRePassword) {
        $erreur="Mots de passe non identiques.";
    } else {
        include("./connexion.php");
        $sel=$pdo->prepare("select id from clients where mobile=? limit 1");
        $sel->execute(array($formSignupPhone));
        $tab=$sel->fetchAll();
        if(count($tab)>0){
          $erreur="Le numéro de téléphone existe déjà.";
          $pdo = null;
        }
        else{
          $ins=$pdo->prepare("insert into clients(nom,mobile,email,pass) values(?,?,?,?)");
          if($ins->execute(array($formSignupName,$formSignupPhone,$formSignupEmail,hash("sha256", $formSignupPassword)))){
            $pdo = null;
            header("location:../");
          }
          $pdo = null;
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
  <title>Créer un compte</title>
  <link rel="icon" type="image/gif/png" href="../assets/brand/favicon.png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../assets/css/sign.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin">
    <form name="signupForm" method="post" action="">
      <img class="mb-1" src="../assets/brand/EatingSpot-logo_70.svg" alt="">
      <h1 class="logo">Eating spot</h1>

      <h2 class="h3 mt-3 mb-3 fw-normal">Créer un compte</h2>

      <?php if($erreur !== ""){ ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $erreur ?>
      </div>
      <?php } ?>

      <div class="form-floating">
        <input type="text" class="form-control" id="formSignupName" name="formSignupName" placeholder="Votre Prénom">
        <label for="formSignupName">Votre prénom</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" id="formSignupPhone" name="formSignupPhone"
          placeholder="05 ou 06 ou 07 xx xx xx xx">
        <label for="formSignupPhone">05 ou 06 ou 07 xx xx xx xx</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="formSignupEmail" name="formSignupEmail"
          placeholder="adresse@email.com">
        <label for="formSignupEmail">adresse@email.com</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="formSignupRePassword" name="formSignupRePassword"
          placeholder="Mot de passe">
        <label for="formSignupRePassword">Mot de passe</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="formSignupPassword" name="formSignupPassword"
          placeholder="Mot de passe encore">
        <label for="formSignupPassword">Mot de passe encore</label>
      </div>

      <button class="w-100 btn btn-lg submit-color mt-4" id="formSignupSubmit" name="formSignupSubmit" type="submit"
        value="S'authentifier">Créer un compte</button>

      <div class="w-100 d-flex justify-content-between mt-4 rattrapage">
        <a class="rattrapage" href="./signin.php">Se connecter</a>
        <a class="rattrapage" href="./">Accueil</a>
      </div>

      <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
    </form>
  </main>



</body>

</html>