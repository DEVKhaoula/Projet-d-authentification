<?php
require_once 'gestionstagiaire.php';
try{
    $sql = "CREATE TABLE if not exists compteadministrateur(
    loginAdmin varchar(10) primary key ,
    motdepasse varchar(10),
    nom varchar(20),
    prenom varchar(20) 
    );
    CREATE TABLE if not exists filiere(
    idFiliere varchar(5) primary key ,
    intitule varchar(20),
    nombreGroupe int(11)
    );
    CREATE TABLE if not exists stagiaire(
    nom varchar(20) primary key ,
    idstagiaire int(11),
    prenom varchar(20),
    dateNaissance date,
    photoProl text,
    idFiliere varchar(5),
    FOREIGN KEY (idFiliere) REFERENCES filiere(idFiliere)
    );
    ";

    $pdo->exec($sql);
    echo"les tables ont été créées avec succés.";
}catch(PDOException $e) {
   echo "Erreur :".$e->getMessage();
}
?>
