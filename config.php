<?php
// Conexão com o MySQL
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'empresa';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
?>