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
  </nav>
  <br><br><br>
  <!-- Fim do menu -->
    <?php
session_start();

// Verifica se o usuário não está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
  <div class="text-center">
    <h2>EXAMES:</h2>
  </div>
  <main class="form-container">
    <div class="formulario">
      <?php
        include('conexao.php');

        $sql_cod = "SELECT * FROM funcionarios ORDER BY nome, funcao ASC";
        $sql_query_funcionario= $conn->query($sql_cod) or die($conn->error);
      ?>
  <form method="POST" action="exame.php">
    <p>
      <label>Exame:</label>
      <input type="text" name="exame" class="form-control" />
    </p>
    <p>
      <label>Preço:</label>
      <input type="text" name="preco" class="form-control" placeholder="R$" />
    </p>
    <p>
      <label>Observações:</label>
      <input type="text" name="observacoes" class="form-control" />
    </p>
    <p>
      <label>Funcionário:</label>
      <select class="form-control" name="funcionario"> 
        <option value="">Selecione uma das opções</option>
        <?php while($funcionario = $sql_query_funcionario->fetch_assoc()) : ?>
          <option value ="<?= $funcionario['ID_funcionario']; ?>">
          <?= $funcionario['nome']?> <p>-</p> <?=$funcionario['funcao']?>
        </option>
            <?php endwhile; ?>
      </select><br>

        <!-- botao de salvar -->
          <input type="hidden" name="operacao" value="incluir">
          <button type="submit" class="btn btn-secondary btn-block">Salvar</button>
        </form><br>

        <!-- botao de consultar -->
        <form action="exame.php" method="post">
          <input type="hidden" name="operacao" value="mostrar">
          <p class="text-center"><strong>Clique abaixo para consultar os exames cadastrados</strong></p>
          <button type="submit" class="btn btn-secondary btn-block">Consultar</button>
        </form><br>

        <!-- botao de editar -->
        <form action="exames_editar.php" method="post">
          <input type="hidden">
          <p class="text-center"><strong>Clique abaixo para editar os exames cadastrados</strong></p>
          <button type="submit" class="btn btn-secondary btn-block">Editar</button>
        </form><br>

        <!-- botao de excluir -->
        <form action="exame.php" method="post">
          <input type="hidden" name="operacao" value="excluir" />
          <p class="text-center"><strong>Indique abaixo o codigo do exame que deseja excluir</strong></p>
          <p>
            <input type="text" name="codigo" class="form-control" />
          </p>
          <button type="submit" class="btn btn-secondary btn-block">Deletar</button>
        </form><br>
        
      </div>
    </main>
  </form>
</body>