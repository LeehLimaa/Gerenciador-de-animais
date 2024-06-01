<?php
$servername = 'localhost';
$username = 'root';
$password = '';

$dbname = 'gerenciador_animais';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Falha na conexão! (" . $conn-> connect_error . ") " . $conn->connect_error);
}


?>