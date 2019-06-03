<?php

$config = require __DIR__ . '/../config.php';

$servername = $config['host'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

$conn = new PDO("mysql:host=$servername", $username, $password);

try {
    $sql = "CREATE DATABASE $database";
    $conn->exec($sql);
    echo "Database created successfully" . PHP_EOL;
    $conn->query("use $database");

    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        name VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        city VARCHAR(256),
        address VARCHAR(256),
        email VARCHAR(256),
        password VARCHAR(256),
        user_photo VARCHAR(256),
        reg_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table \"users\" created successfully" . PHP_EOL;

    $sql = "INSERT INTO users (full_name, email, password)
    VALUES ('John Doe', 'admin@example.com', '" . password_hash('admin', PASSWORD_BCRYPT) . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "User \"admin\" was inserted into database" . PHP_EOL;

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
