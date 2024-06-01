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
  <div class="text-center">
    <h2>EDITAR ANIMAIS:</h2>
  </div>
  <?php
        include('conexao.php');

          $sql_cod = "SELECT * FROM racas ORDER BY raca ASC";
          $sql_cod2 = "SELECT * FROM especies ORDER BY especie ASC";

          $sql_query_raca = $conn->query($sql_cod) or die($conn->error);
          $sql_query_especie = $conn->query($sql_cod2) or die($conn->error);
      ?>
  <form action="animal.php" method="post">
    <input type="hidden" name="operacao" value="editar" />

    <p>
      <label>Código:</label>
      <input type="text" name="ID_animal" class="form-control" />
    </p>
    <p>
      <label>Nome:</label>
      <input type="text" name="nome" class="form-control" />
    </p>
    <p>
      <label>Foto:</label>
      <input type="file" class="form-control-file" name="foto">
    </p>
    <p>
      <label>Data de nascimento:</label>
      <input type="date" name="data_nasc" class="form-control" />
    </p>
    <p>
      <label>Altura:</label>
      <input type="text" name="altura" class="form-control">
    </p>
    <p>
      <label>Peso:</label>
      <input type="text" name="peso" class="form-control" />
    </p>
    <p>
      <label>Especie:</label>
      <select class="form-control" name="especie">
        <option value="">Selecione uma opção</option>
        <?php while($expecie = $sql_query_especie->fetch_assoc()) {?>
        <option value="<?php echo $expecie['ID_especie']; ?>">
          <?php echo $expecie['especie']?>
        </option>
        <?php } ?>
      </select>
    </p>
    <p>
      <label>Raça:</label>
      <select class="form-control" name="raca">
        <option value="">Selecione uma das opções</option>
        <?php while($raca = $sql_query_raca->fetch_assoc()) {?>
        <option value="<?php echo $raca['ID_raca']; ?>">
          <?php echo $raca['raca']?>
        </option>
        <?php } ?>
      </select>
    </p>
    <p>
      <label>Cor:</label>
      <input type="text" name="cor" class="form-control" />
    </p>
    <p>
      <label>Porte:</label>
      <select class="form-control" name="porte">
        <option value="">Selecione uma das opções</option>
        <option value="Pequeno">Pequeno</option>
        <option value="Médio">Médio</option>
        <option value="Grande">Grande</option>
      </select>
    </p>
    <p>
      <label>Gênero:</label>
      <select class="form-control" name="genero">
        <option value="">Selecione uma das opções</option>
        <option value="Macho">Macho</option>
        <option value="Fêmea">Fêmea</option>
      </select>
    </p>
    <p>
      <label>Habitat:</label>
      <select class="form-control" name="habitat">
        <option value="">Selecione uma das opções</option>
        <option value="Terrestre">Terrestre</option>
        <option value="Marinho">Marinho</option>
        <option value="Aéreo">Aéreo</option>
      </select>
    </p>
    <button type="submit" class="btn btn-secondary btn-block">Editar</button>
    <button type="reset" class="btn btn-secondary btn-block">Resetar formulario</button>
  </form>