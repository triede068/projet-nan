<?php



    $erreur = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $base = new PDO('mysql:host=localhost;dbname=nan', 'root', '');
        $req = $base->prepare("SELECT * FROM inscription WHERE usernam = ? AND password = ?");
        $req->execute(array($_POST['usernam'], $_POST['password']));
        $result = $req->fetch();
        $count = $req->rowCount();
        if ($count >= 1){
            session_start();
            $_SESSION['nom'] = $result['nom'];
            header("location: accueil.php");
        }
        else {
            $erreur = "Email ou mot de passe inexistant";
        }
    }
 
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body style="background-color: #ddd;">
  <div id="login">
  	<form method="post" action="login.php">
  		<span class="glyphicon glyphicon-user"></span><br>
        <?php $erreur = "Email ou mot de passe inexistant"; ?>
  		<input type="text" name="usernam" placeholder="Usernam"><br>
  		<br>
  		<input type="password" name="password" placeholder="Password"><br>
  		<br>
  		<input type="submit" value="LOGIN">
  		<button class="b1"> Forgot your passwor ? </button>
  	</form>
  </div>
 
</body>
</html>
