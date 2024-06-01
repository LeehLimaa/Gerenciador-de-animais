<?php

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

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

// Obtém as informações do usuário do banco de dados

$stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Verifica se o usuário existe
if (!$user) {
    die('Usuário não encontrado');
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza as informações do perfil no banco de dados
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $stmt = $mysqli->prepare('UPDATE users SET full_name = ?, email = ? WHERE username = ?');
    $stmt->bind_param('sss', $full_name, $email, $_SESSION['username']);
    $stmt->execute();

    // Redireciona para a página de perfil após a atualização
    header("Location: profile.php");
    exit;
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
  </nav><br><br><br>
  <style>
    form {
      margin: 0 auto;
      width: 800px;
      padding: 1em;
      border: 1px solid #CCC;
      border-radius: 1em;
    }
    
  </style>
  <div class="text-center"><h2>PAINEL DE ADMINISTRAÇÃO:</h2></div><br>
  <form>
  <div class="text-center"><h2>Bem-vindo(a), <?php echo $_SESSION['username']; ?>!</h2></div>
  <div class="text-center"><p>Este é o painel de administração com os dados dos usuários cadastrados</p></div><br>

  <div class="text-center">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Nome de Usuário</th>
                <th class="text-center">Nome Completo</th>
                <th class="text-center">E-mail</th>
                <!-- Adicione mais colunas conforme necessário -->
            </tr>
        </thead>
        <tbody>
        <?php
        // Código para buscar os dados dos usuários no banco de dados
        $stmt = $mysqli->query('SELECT * FROM users');
        $users = $stmt->fetch_all(MYSQLI_ASSOC);
        ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                    <div id="user-form-<?=$user['id']?>" style="display: inline;">
                          <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                          <button type="button" class="btn btn-danger btn-xs" onclick="deleteUser(<?=$user['id']?>)">Excluir</button>
                    </div>
                    </td>

                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</form><br>
        
  <form action="logout.php" method="post">
    <input type="hidden">
    <button type="submit" class="btn btn-secondary btn-block">Sair da Conta</button>
  </form>
  <script>
    function deleteUser(userId) {
        if (confirm('Tem certeza de que deseja excluir o usuário?')) {
            // Cria um objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();
            
            // Define a função de callback para tratar a resposta
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Atualize a página após a exclusão do usuário
                    location.reload();
                }
            };
            
            // Abre uma solicitação POST para o arquivo delete_user.php
            xhr.open('POST', 'delete_user.php', true);
            
            // Define o cabeçalho da solicitação
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Envia a solicitação com o ID do usuário como dados
            xhr.send('user_id=' + encodeURIComponent(userId));
        }
    }
</script>

</body>
</html>



