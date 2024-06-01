<?php
session_start();

// Verifica se o usuário já está logado
if (isset($_SESSION['username'])) {
    header("Location: profile.php"); // Redireciona para a página de dashboard ou home
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conecta ao banco de dados (substitua os valores pelos seus próprios)
    $host = 'localhost';
    $dbname = 'gerenciador_animais';
    $username = 'root';
    $password = '';

    
    // Conexão com o banco de dados MySQLi
    $conn = new mysqli($host, $username, $password, $dbname);

    // Verifica se ocorreu algum erro na conexão
    if ($conn->connect_error) {
        die('Erro ao conectar com o banco de dados: ' . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta o banco de dados para verificar o usuário
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        // Verifica se é um administrador
        if ($user['is_admin']) {
            // Inicia a sessão e redireciona para a página do administrador
            $_SESSION['username'] = $user['username'];
            header("Location: adm.php");
            exit;
        } else {
            // Inicia a sessão e redireciona para a página do usuário comum
            $_SESSION['username'] = $user['username'];
            header("Location: profile.php");
            exit;
        }
    } else {
        $error = '<p class="text-center">Usuário ou senha inválidos</p>';
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Gerenciador de Animais</title>
  <meta charset="utf-8" />
  <meta name="description" content="Sistema web para gerenciar seus animais">
  <meta name="keywords" content="Gerenciamento, Animais">
  <meta name="author" content="Leticia de Lima Batista">
  <link rel="icon" type="image/png" href="icone.png" />
  <link href="estilo.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="script.js"></script>
  <style>
        .input-group-addon {
            padding: 5px 12px;
            cursor: pointer;
        }
  </style>
</head>

<body>

  <!-- Menu -->
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"></button>
        <img class="navbar-brand" href="#" src="icone.png" />
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li class="link"><a href="index.html" target="_self" title="Voltar para a página inicial" class="glyphicon glyphicon-home"></a></li>
          <li class="link"><a href="contatos.php" target="_self" title="Entre em contato conosco!" class="glyphicon glyphicon-earphone"></a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" title="Login"></span></a>
            <ul class="dropdown-menu">
              <li class="link"><a href="login.php" target="_self" title="Entrar">Entrar</a></li>
              <li class="link"><a href="register.php" target="_self" title="Criar Conta">Criar Conta</a></li>
              <li class="link"><a href="profile.php" target="_self" title="Perfil">Perfil</a></li>
            </ul>
          </li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-option-vertical" title="Menu"></span></a>
            <ul class="dropdown-menu">
              <li class="link"><a href="atendimentos.php" target="_self" title="Atendimentos">Atendimentos</a></li>
              <li class="link"><a href="clientes.php" target="_self" title="Cliente">Clientes</a></li>
              <li class="link"><a href="funcionarios.php" target="_self" title="Funcionarios">Funcionários</a></li>
              <li class="link"><a href="animais.php" target="_self" title="Animais">Animais</a></li>
              <li class="link"><a href="especies.php" target="_self" title="Especies">Espécies</a></li>
              <li class="link"><a href="racas.php" target="_self" title="Raça">Raças</a></li>
              <li class="link"><a href="consultas.php" target="_self" title="Consultas">Consultas</a></li>
              <li class="link"><a href="vacinas.php" target="_self" title="Vacinas">Vacinas</a></li>
              <li class="link"><a href="medicamentos.php" target="_self" title="Medicamentos">Medicamentos</a></li>
              <li class="link"><a href="exames.php" target="_self" title="Exames">Exames</a></li>
              <li class="link"><a href="banhos_tosas.php" target="_self" title="Banho e Tosa">Banho e Tosa</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br>
  <!-- Fim do menu -->
<div class="text-center"><h2>LOGIN:</h2></div>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

        <form method="POST" action="login.php">
            <p>
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" required>
            </p>
            <div class="form-group">
              <label for="password">Senha:</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password">
                <span class="input-group-addon" onclick="togglePasswordVisibility()">
                  <span id="password-toggle" class="glyphicon glyphicon-eye-open"></span>
                </span>
              </div>
            </div>
            <p class="form-group">
              <button type="submit" class="btn btn-secondary">Entrar</button>
              <a class="btn btn-secondary" href="register.php" role="button">Criar conta</a>
            </p>			
        </form>
</body>
</html>
