<?php
$servername = "localhost";
$username = "root";
$password = "190304";
$dbname = "batcadastro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
