<?php
$mssg = '';

if($_SERVER["REQUEST_METHOD"]== "POST"){
    if(empty($_POST['login'])|| $_POST['password']){
        $mssg = "Les données d'authentification sont obligatoire";
    }else{
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
    }
    if(empty($mssg)){}
}

if(empty($mssg)){
    try {
      $sql = $pdo->prepare("SELECT * FROM compteadministrateur WHERE loginAdmin = ?");
      $sql->execute([$login]);
      $user = $sql->fetch();
      if ($user && $user["password"] == $password) {
        session_start();
        $_SESSION['nom'] = $user['nom'];
        header('location: espaceprivee.php');
      } else {
        echo '<div class="alert alert-danger">Invalid login or password.</div>';
      }
    } catch (PDOException $e) {
      echo 'error :' . $e->getMessage();
    }
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'authentification</title>
</head>
<body>
<style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: white;
            padding: 20px 30px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            border-radius: 20px; 
        }

        h2 {
            margin-top: 0;
            color:black;
            background-color: gray; 
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); 
        }

        label {
            display: block;
            margin-bottom: 8px;
            color:black;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px); 
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid orange; 
            font-size: 16px;
        }

        input[type="submit"] {
            background: linear-gradient(to right, orange, orange);
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out; 
        }

        input[type="submit"]:hover {
            transform: scale(1.05); 
            box-shadow: 0px 0px 20px rgba(255, 105, 180, 0.5);
        }

        span{
            color:red;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Authentification</h2>
    <form action="authentifier.php" method="post">
        <div>
            <label for="Login">Login</label>
            <input type="text" name="login">
            <span><?php  echo isset($mssg) ? $mssg: ''?></span>
        </div>

        <div>
            <label for="password">Mot de Passe:</label>
            <input type="password"  name="password">
            <span><?php  echo isset($mssg) ? $mssg: ''?></span>
        </div>

        <div>
            <input type="submit" value="S'authentifier">
        </div>
    </form>
</div>
    
</body>
</html>
