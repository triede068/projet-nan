<?php
    session_start();

    $nom = $prenom = $objet = $email = $message = $numero =  "";
    $nomError = $prenomError = $objetError = $emailError = $messageError = $numeroError =  "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = verifyInput($_POST['nom']);
        $prenom = verifyInput($_POST['prenom']);
        $objet = verifyInput($_POST['objet']);
        $email = verifyInput($_POST['email']);
        $message = verifyInput($_POST['massage']);
        $numero = verifyInput($_POST['numero']);
        
                if(empty($nom))
                {
                    $nomError = "Votre nom s'il vous plait";
                }
                 if(empty($prenom))
                {
                    $prenomError = "Votre prenom s'il vous plait";
                }
                 if(empty($objet))
                {
                    $objetError = "L'objet de votre message s'il vous plait";
                 }
                 if(empty($message))
                {
                    $messageError = "Votre message s'il vous plait";
                }
                 if(isPhone($numero))
                {
                    $numeroError = "le numero doit contenir que des espaces et des chiffres";
                }
                 if(isEmail(email))
                 {
                     $emailError = "Votre email s'il vous plait";
                 }
        }
        
        function isPhone($var)
        {
            return preg_match("^/[0-9 ]*$/", $var);
        }

        function isEmail($var)
        {
           return filter_var($var, FILTER8VALIDATE8EMAIL);
        }
            
            
        function verifyInput($var)
        {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
            
            
            return $var;
        }
        
            // Connexion à la base de données
            try
            {
            $bdd = new PDO('mysql:host=localhost;dbname=nan', 'root', '');
            }c
            atch(Exception $e)
            {
            die('Erreur : '.$e->getMessage());
            }

            $req = $bdd->prepare('INSERT INTO contact (nom, prenom, objet, email,
            message, numero)
            VALUES(?, ?, ?, ?, ?, ?)');
            $req->execute(array($_POST['nom'], $_POST['prenom'], $_POST['objet'], $_POST['email'], $_POST['message'], $_POST['numero']));
            header('Location: accueil.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" type="text/css" href="inscription.css">
</head>
<body>
   <div>
   	 <form method="post" action="inscription.php">
	    	<legend><h2>Contactez-nous</h2></legend>
	    	<input type="text" name="nom" placeholder="Nom"><br>
            <p style="color:red;"><?php echo $nomError; ?></p>
	    	<input type="text" name="prennom" placeholder="Prénom"><br>
            <p style="color:red;"><?php echo $prenomError; ?></p>
	    	<input type="email" name="email" placeholder="Email"><br>
            <p style="color:red;"><?php echo $emailError; ?></p>
	    	<input type="tel" name="numero" placeholder="Numéro de téléphone"><br>
            <p style="color:red;"><?php echo $numeroError; ?></p>
	    	<input type="text" name="objet" placeholder="Objet"><br>
            <p style="color:red;"><?php echo $obetError; ?></p>
	    	<textarea name="message" cols="80" rows="5" placeholder="Notre message"></textarea><br>
            <p style="color:red;"><?php echo $messageError; ?></p>
	    	<input type="submit" value="VALIDER">
	    </form>
   </div>
</body>
</html>