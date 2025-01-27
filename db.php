<?php
require_once __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$host =  $_ENV['DB_HOST'];
$dbname =  $_ENV['DB_NAME'];
$username =  $_ENV['DB_USER'];
$password =  $_ENV['DB_PASS'];


$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
