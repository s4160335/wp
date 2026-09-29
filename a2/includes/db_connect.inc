<?php

// Check whether the website is running locally or on Coreteaching
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    // Local XAMPP database settings
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'bookverse';
} else {
    // Coreteaching / Jacob 5 database settings
    $dbHost = 'talsprddb02.int.its.rmit.edu.au';
    $dbUser = 'S4160335';
    $dbPass = 'Moha@3334';
    $dbName = 'S4160335_159009';
}

// Connect to the database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Stop if the connection fails
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');