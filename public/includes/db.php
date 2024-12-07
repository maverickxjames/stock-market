<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'stockmarket';

$conn = new mysqli($host, $user, $pass, $db);
session_start();

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}
?>