<?php
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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    // Verifica se o usuário já existe no banco de dados
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $error = '<p class="text-center">Nome de usuário já está em uso</p>';
    } else {
        // Verifica se o email já está em uso
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $error = '<p class="text-center">Email já está em uso</p>';
        } else {
            // Insere o novo usuário e suas informações do perfil no banco de dados
            $stmt = $conn->prepare('INSERT INTO users (username, password, full_name, email) VALUES (?, ?, ?, ?)');
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('ssss', $username, $hashed_password, $full_name, $email);
            $stmt->execute();

            // Redireciona para a página de login após o cadastro bem-sucedido
            header("Location: login.php");
            exit;
        }
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
<div class="text-center"><h2>CADASTRE-SE:</h2></div>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="register.php">
            <p>
                <label for="full_name">Nome Completo:</label>
                <input type="text" name="full_name" class="form-control" required>
            </p>
            <p>
                <label for="username">Nome de Usuário:</label>
                <input type="text" name="username" class="form-control" required>
            </p>
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
              <button type="submit" class="btn btn-secondary">Criar Conta</button>
              <a class="btn btn-secondary" href="login.php" role="button">Entrar</a>
            </p>            
        </form>
</body>
</html>



