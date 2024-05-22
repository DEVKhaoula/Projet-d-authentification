<?php 
include("config/connect.php");
$sql = 'SELECT * FROM stagiaire';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Bonjour</h3><br>
    <button><a href="InsererStagiaire.php">Inserer</a></button>
    <?php if (empty($users)): ?>
      <p >Aucun stagiaire</p>
    <?php endif;  ?>
    <table >
  <thead>
    <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Date de naissance</th>
    <th>Photo de profile</th>
    <th>Filiere</th>
    <th>Modifier</th>
    <th>Supprimer</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user): ?>
    <tr>
      <td><?= $user['nom']; ?></td>
      <td><?= $user['prenom']; ?></td>
      <td><?= $user['dateNaissance']; ?></td>
      <td><img style="width: 40px;" src="images/<?= $user['photoProfil'];?>"></td>
      <td><?= $user['idFiliere'] ?></td>
      <td><a href="ModifierStagiaire.php?id=<?= $user['idStagiaire'] ?>"><i class="bi bi-pencil"></i></i></a></td>
      <td><a href=""><i class="bi bi-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    
</body>
</html>
