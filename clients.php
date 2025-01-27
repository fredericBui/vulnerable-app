<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'db.php';

// Ajout de client
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("INSERT INTO clients (nom, prenom, telephone) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $prenom, $telephone]);
}

// Récupération des clients
$stmt = $pdo->query("SELECT * FROM clients");
$clients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des clients</title>
</head>
<body>
    <h1>Gestion des clients</h1>
    <h2>Ajouter un client</h2>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="telephone" placeholder="Numéro de téléphone" required>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Liste des clients</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
        </tr>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= $client['nom'] ?></td>
            <td><?= $client['prenom'] ?></td>
            <td><?= $client['telephone'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="logout.php">Déconnexion</a></p>
</body>
</html>
