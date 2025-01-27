<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: clients.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo($email);
    echo($password);
    // Connexion à la base de données
    require_once 'db.php';  // Inclusion de la connexion à la base de données

    // Préparer la requête pour vérifier les informations de l'utilisateur
    $req = "select * from utilisateurs";
    $res = $conn->query($req);

    var_dump($res);
    
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Se connecter</h2>
    <form method="POST" action="login.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>

    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
</body>
</html>
