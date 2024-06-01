<?php
session_start();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header("Location: index.html");
exit;
?>
