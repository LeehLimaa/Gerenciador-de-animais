<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Verifica se o formulário de exclusão foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Parâmetros de conexão com o banco de dados (substitua pelos seus próprios)
    $host = 'localhost';
    $dbname = 'gerenciador_animais';
    $username = 'root';
    $password = '';


    // Criação da conexão MySQLi
    $mysqli = new mysqli($host, $username, $password, $dbname);
    if ($mysqli->connect_error) {
        die('Erro ao conectar com o banco de dados: ' . $mysqli->connect_error);
    }

    // Obtém o ID do usuário a ser excluído
    $user_id = $_POST['user_id'];

    // Exclui o usuário do banco de dados
    $stmt = $mysqli->prepare('DELETE FROM users WHERE id = ?');
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    // Redireciona para a página de perfil após a exclusão
    header("Location: profile.php");
    exit;
} else {
    // Se o formulário não foi enviado, redireciona para a página de perfil
    header("Location: profile.php");
    exit;
}
?>
