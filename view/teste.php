<?php
session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant s'il existe une session avec son ID
if (!isset($_SESSION['commercant_id'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('../page/connexion.php');
    exit();
}

// Inclusion du fichier de connexion à la BDD
include '../conn/conn.php';

// Récupérez l'ID du commerçant à partir de la session
// Récupérez l'ID de l'utilisateur depuis la variable de session
$commercant_id = $_SESSION['commercant_id'];

// Vous pouvez maintenant utiliser $commercant_id pour récupérer les informations de l'utilisateur depuis la base de données
// Écrivez votre requête SQL pour récupérer les informations nécessaires
$query = "SELECT * FROM commerce_users ";
$stmt = $db->prepare($query);
// $stmt->bindValue(':commercant_id', $commercant_id , PDO::PARAM_INT);
$stmt->execute();
$usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Profil de l'utilisateur</h1>
<h1>Profil de l'utilisateur</h1>
<?php foreach($usersData as $userData): ?>
    <p>Nom : <?php echo $userData['nom']; ?></p>
    <p>Prénom : <?php echo $userData['boutique']; ?></p>
    <p>Email : <?php echo $userData['mail']; ?></p>
    <!-- Affichez d'autres informations selon vos besoins -->
<?php endforeach; ?>

</body>
</html>