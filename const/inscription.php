<?php
    session_start();

    $nom = $prenom = $usernam = $email = $password = $numero =  "";
    $nomError = $prenomError = $usernamError = $emailError = $passwordError = $numeroError =  "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = verifyInput($_POST['nom']);
        $prenom = verifyInput($_POST['prenom']);
        $usernam = verifyInput($_POST['usernam']);
        $email = verifyInput($_POST['email']);
        $Password = verifyInput($_POST['password']);
        $numero = verifyInput($_POST['numero']);
        
                if(empty($nom))
                {
                    $nomError = "Votre nom s'il vous plait";
                }
                 if(empty($prenom))
                {
                    $prenomError = "Votre prenom s'il vous plait";
                }
                 if(empty($usernam))
                {
                    $usernamError = "Votre nom utilisateur s'il vous plait";
                 }
                 if(empty($pssword))
                {
                    $passwordError = "Votre mot de passe s'il vous plait";
                }
                 if(isPhone($numero))
                {
                    $numeroError = "le numero doit contenir que des espaces et des chiffres";
                }
                 
        }
        
        function isPhone($var)
        {
            return preg_match("/[0-9 ]*$/", $var);
        }

        function isEmail($var)
        {
           return filter_var($var, FILTER_VALIDATE_EMAIL);
        }
            
            
        function verifyInput($var)
        {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
            
            
            return $var;
        }

        try
            {
            $bdd = new PDO('mysql:host=localhost;dbname=nan', 'root', '');
            }
            atch(Exception $e)
            {
            die('Erreur : '.$e->getMessage());
            }
            $req = $bdd->prepare('INSERT INTO inscription (nom, prenom, usernam, email,
            password, numero)
            VALUES(?, ?, ?, ?, ?, ?)');
            $req->execute(array($_POST['nom'], $_POST['prenom'], $_POST['usernam'], $_POST['email'], $_POST['password'], $_POST['numero']));
            
            header('Location: accueil.php');
  ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>INSCRIPTION</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="inscription.css">
</head>
<body class="test">
	<div id="for">
	    <form method="post" action="inscription.php" enctype="multipart/form-data">
	    	<legend><h2>inscription</h2></legend>
	    	<input type="text" name="nom" placeholder="Nom"><br>
            <p style="color:red;"><?php echo $nomError; ?></p>
	    	<input type="text" name="prenom" placeholder="Prenom"><br>
            <p style="color:red;"><?php echo $prenomError; ?></p>
	    	<input type="text" name="usernam" placeholder="Usernam" ><br>
            <p style="color:red;"><?php echo $usernamError; ?></p>
	    	<input type="email" name="email" placeholder="Email"><br>
            <p style="color:red;"><?php echo $emailError; ?></p>
	    	<input type="password" name="password" placeholder="Password"><br>
            <p style="color:red;"><?php echo $passwordError; ?></p>
	    	<input type="tel" name="numero" placeholder="Numéro"><br>
            <p style="color:red;"><?php echo $numeroError; ?></p>
	    	<input type="submit" value="VALIDER">
	    </form>
    </div>
</body>
</html>