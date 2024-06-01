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
    <h2>ATENDIMENTOS:</h2>
  </div>

  <main class="form-container">
    <div class="formulario">
    <?php
      include('conexao.php');

        $sql_cod = "SELECT * FROM clientes ORDER BY nome ASC";
        $sql_query_cliente = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM animais ORDER BY nome ASC";
        $sql_query_animal = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM banho_tosa ORDER BY procedimento, preco ASC";
        $sql_query_banho_tosa = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM consulta ORDER BY tipo, preco ASC";
        $sql_query_consulta = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM exames ORDER BY exame, preco ASC";
        $sql_query_exames = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM medicamentos ORDER BY medicamento, preco ASC";
        $sql_query_medicamentos = $conn->query($sql_cod) or die($conn->error);

        $sql_cod = "SELECT * FROM vacinas ORDER BY vacina, preco ASC";
        $sql_query_vacinas = $conn->query($sql_cod) or die($conn->error);
  
    ?>
    <form action="atendimento.php" method="post">
      <p>
        <label>Data:</label>
        <input type="date" name="data" class="form-control" />
      </p>
      <p>
        <label>Nome do Cliente:</label>
          <select class="form-control" name="cliente">
            <option value="">Selecione uma das opções</option>
              <?php while($cliente = $sql_query_cliente->fetch_assoc()) {?>
                <option value ="<?php echo $cliente['ID_cliente']; ?>"><?php echo $cliente['nome']?></option>
                  <?php } ?>
          </select>
      </p>
      <p>
        <label>Nome do Animal:</label>
          <select class="form-control" name="animal">
            <option value="">Selecione uma das opções</option>
              <?php while($animal = $sql_query_animal->fetch_assoc()) {?>
                <option value ="<?php echo $animal['ID_animal']; ?>"><?php echo $animal['nome']?></option>
                  <?php } ?>
          </select>
      </p>
      <br><p class="text-center"><strong>PROCEDIMENTOS REALIZADOS:</strong></p>
      <p>
        <label>Banho e/ou Tosa:</label>
          <select class="form-control" name="banho_tosa" id="banho_tosa">
            <option value="">Selecione uma das opções</option>
              <?php while($banho_tosa = $sql_query_banho_tosa->fetch_assoc()) {?>
                <option value ="<?php echo $banho_tosa['ID_banho_tosa']; ?>">
                <?php echo $banho_tosa['procedimento']?><p> - R$ </p><?php echo $banho_tosa['preco']?>
              </option>
                  <?php } ?>
          </select>
      </p>
      <p>
        <label for="quantidade_banho_tosa">Quantidade de Banhos e/ou Tosas:</label>
        <input type="number" id="qtde_banho_tosa" name="qtde_banho_tosa" min="0" value="0" class="form-control">
      </p><br>
      <p>
        <label>Consulta:</label>
          <select class="form-control" name="consulta">
            <option value="">Selecione uma das opções</option>
              <?php while($consulta = $sql_query_consulta->fetch_assoc()) {?>
                <option value ="<?php echo $consulta['ID_consulta']; ?>">
                <?php echo $consulta['tipo']?><p> - R$ </p><?php echo $consulta['preco']?>
              </option>
                  <?php } ?>
          </select>
      </p>
      <p>
        <label for="quantidade_consulta">Quantidade de Consultas:</label>
        <input type="number" id="qtde_consulta" name="qtde_consulta" min="0" value="0" class="form-control">
      </p><br>
      <p>
        <label>Exame:</label>
          <select class="form-control" name="exames">
            <option value="">Selecione uma das opções</option>
              <?php while($exames = $sql_query_exames->fetch_assoc()) {?>
                <option value ="<?php echo $exames['ID_exame']; ?>">
                <?php echo $exames['exame']?><p> - R$ </p><?php echo $exames['preco']?>
              </option>
                  <?php } ?>
          </select>
      </p>
      <p>
        <label for="quantidade_exames">Quantidade de Exames:</label>
        <input type="number" id="qtde_exames" name="qtde_exames" min="0" value="0" class="form-control">
      </p><br>
      <p>
        <label>Medicamento:</label>
          <select class="form-control" name="medicamentos">
            <option value="">Selecione uma das opções</option>
              <?php while($medicamentos = $sql_query_medicamentos->fetch_assoc()) {?>
                <option value ="<?php echo $medicamentos['ID_medicamentos']; ?>">
                <?php echo $medicamentos['medicamento']?><p> - R$ </p><?php echo $medicamentos['preco']?>
              </option>
                  <?php } ?>
          </select>
      </p>
      <p>
        <label for="quantidade_medicamentos">Quantidade de Medicamentos:</label>
        <input type="number" id="qtde_medicamentos" name="qtde_medicamentos" min="0" value="0" class="form-control">
      </p><br>
      <p>
        <label>Vacina:</label>
          <select class="form-control" name="vacinas">
            <option value="">Selecione uma das opções</option>
              <?php while($vacinas = $sql_query_vacinas->fetch_assoc()) {?>
                <option value ="<?php echo $vacinas['ID_vacina']; ?>">
                <?php echo $vacinas['vacina']?><p> - R$ </p><?php echo $vacinas['preco']?>
              </option>
              <?php } ?>
          </select>
      </p>
      <p>
        <label for="quantidade_vacinas">Quantidade de Vacinas:</label>
        <input type="number" id="qtde_vacinas" name="qtde_vacinas" min="0" value="0" class="form-control">
      </p>

      <input type="hidden" name="operacao" value="incluir">
      <button type="submit" class="btn btn-secondary btn-block">Salvar</button>
    </form><br>

    <!-- Botao de consultar -->
    <form action="atendimento.php" method="post">
      <input type="hidden" name="operacao" value="mostrar">
      <p class="text-center"><strong>Clique abaixo para consultar os atendimentos cadastrados</strong></p>
      <button type="submit" class="btn btn-secondary btn-block">Consultar</button>
    </form><br>

    <!-- Botao de editar -->
    <form action="atendimentos_editar.php" method="post">
      <input type="hidden">
      <p class="text-center"><strong>Clique abaixo para editar os atendiemntos cadastrados</strong></p>
      <button type="submit" class="btn btn-secondary btn-block">Editar</button>
    </form><br>

    <!-- Botao de excluir -->
    <form action="atendimento.php" method="post">
      <input type="hidden" name="operacao" value="excluir"/>
      <p class="text-center"><strong>Indique abaixo o codigo do atendimento que deseja excluir</strong></p>
        <p>
          <input type="text" name="codigo" class="form-control"/>
        </p>
        <button type="submit" class="btn btn-secondary btn-block">Deletar</button>	
    </form><br>

  </body>
</html>