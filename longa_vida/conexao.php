<?php
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuários
$password = ""; 
$dbname = "longa_vida"; // Substitua pelo seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
