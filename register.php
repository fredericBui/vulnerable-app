<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de données
    require_once 'db.php';  // Inclusion de la connexion à la base de données

    // Vérifier si l'email existe déjà
    $sql = "SELECT id FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);  // Lier l'email au paramètre
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Cet email est déjà utilisé.";
    } else {
        // Insérer l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (email, uncrypt_password) VALUES (?, ?)";
        $res = $conn->query($sql);
        header("Location: index.php");
    }

    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>S'inscrire</h2>
    <form method="POST" action="register.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">S'inscrire</button>
    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
</body>
</html>
