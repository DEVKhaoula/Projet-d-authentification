<?php 
$dsn ='mysql:host=localhost;port=3306;dbname=gestionstagiaire_v1;charset=utf8';
$username = 'root';
$password ='';

try{
    $pdo = new PDO($dsn,$username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo'connected';  
}catch(PDOException $e){
    echo 'Erreur de connection :'.$e->getMessage();
    exit();
}
?>
