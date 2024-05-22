<?php
include 'gestionstagiaire.php';
$nom = $prenom  = $date = $pic = $filiere = "";
$erreur = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) && empty($_POST['prenom']) && empty($_POST['date']) && empty($_FILE['pic']['name']) && empty($_POST['filiere']))  {
        $erreur = 'les champ obligatoire';
    } else{
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $filiere = filter_input(INPUT_POST, 'filiere', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $file_name = $_FILES['pic']['name'];
        $file_tmp = $_FILES['pic']['tmp_name'];
        $target_dir = "images/$file_name";
        move_uploaded_file($file_tmp, $target_dir);
    }
   
    
    if (empty($erreur) ) {
          $sql = $pdo->prepare("INSERT INTO stagiaire (nom, prenom, dateNaissance, photoProfil, idFiliere) 
          VALUES (:nom, :prenom, :dateNaissance, :photoProfil, :idFiliere);");
          $sql->execute(['nom'=>$nom, 'prenom'=>$prenom, 'dateNaissance'=>$date, 'photoProfil'=>$file_name, 'idFiliere'=>$filiere]);
          header('Location: espacePrivee.php');
        }   
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter</title>
</head>

<body id="body" >
  <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <a href="Espaceprivee.php">Retour</a><br>
    <h3>Ajouter un stagiare</h3><br>
    <div>
        <?php $erreur ? $erreur :""?>
    </div>
    <label for="nom">NOM:</label><br>
    <input type="text" id="nom" name="nom" value="<?php $nom; ?>"><br>
    <label for="prenom">PRENOM:</label><br>
    <input type="text" id="prenom" name="prenom" value="<?php $prenom; ?>"><br>
    <label for="date">DATE DE NAISSANCE:</label><br>
    <input type="date" id="date" name="date" value="<?php $date; ?>"><br>
    <label for="PdP">PHOTO DE PROFIL:</label><br>
    <input type="file" id="PdP" name="pic" value="<?php $pic; ?>"><br>
    <select name="filiere" id="filiere">
    <option disabled>choisissez une filiere</option>
    <option value="DD">Developpement digital</option>
    <option value="INFO">Infographie</option>
    <option value="AI">Automatisation industrielle</option>
    <option value="F">Finance</option>

</select>
    <button type="submit">Login</button>
  </form>

  
</body>
</html>
