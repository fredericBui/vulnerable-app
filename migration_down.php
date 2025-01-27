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
$sql = "DROP DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' destroy.\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
    exit();
}

// Close the connection
$conn->close();

echo "Migration completed successfully.\n";
?>
