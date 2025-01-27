<?php
session_start();

// Connexion à la base de données
require_once 'db.php';

// Ajouter un client
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_client'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];

    // Insérer un nouveau client dans la base de données
    $sql = "INSERT INTO clients (nom, prenom, telephone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nom, $prenom, $telephone);
    $stmt->execute();
    $stmt->close();
}

// Supprimer un client
if (isset($_GET['delete_id'])) {
    $client_id = $_GET['delete_id'];

    // Supprimer le client de la base de données
    $sql = "DELETE FROM clients WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $stmt->close();
}

// Récupérer la liste des clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des clients</title>
</head>
<body>
    <h2>Liste des clients</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><a href="clients.php?delete_id=<?php echo $row['id']; ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Ajouter un nouveau client</h3>
    <form method="POST" action="clients.php">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="telephone" placeholder="Téléphone" required>
        <button type="submit" name="add_client">Ajouter</button>
    </form>
</body>
</html>
