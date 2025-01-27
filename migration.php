<?php
require_once __DIR__ . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$host =  $_ENV['DB_HOST'];
$dbname =  $_ENV['DB_NAME'];
$username =  $_ENV['DB_USER'];
$password =  $_ENV['DB_PASS'];

// Connect to MySQL server
$conn = new mysqli($host, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' created or already exists.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
    exit();
}

// Select the database
$conn->select_db($dbname);

// Create the `utilisateurs` table
$sql = "CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    uncrypt_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Table 'utilisateurs' created successfully.\n";
} else {
    echo "Error creating table 'utilisateurs': " . $conn->error . "\n";
    exit();
}

// Create the `clients` table
$sql = "CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
    echo "Table 'clients' created successfully.\n";
} else {
    echo "Error creating table 'clients': " . $conn->error . "\n";
    exit();
}

// Close the connection
$conn->close();

echo "Migration completed successfully.\n";
?>
