<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        require_once __DIR__ . '/vendor/autoload.php';
        Dotenv\Dotenv::createImmutable(__DIR__)->load();
        echo $_ENV['DB_HOST'] 
    ?>
    <nav>
        <ul>
            <li><a href="clients.php">Gestion des clients</a></li>
            <li><a href="index.php">Tableau de bord</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Bienvenue sur la gestion des clients</h1>
        <p>Dans cette application, vous pouvez gérer vos clients, vous connecter, et vous inscrire.</p>
        <p><a href="register.php">S'inscrire</a></p>
    </div>

</body>
</html>
