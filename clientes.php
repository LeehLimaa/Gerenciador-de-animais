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
    <h2>CLIENTES:</h2>
  </div>

  <form method="POST" action="cliente.php">
    <p>
      <label>Nome:</label>
      <input type="text" name="nome" class="form-control" />
    </p>
    <p>
      <label>E-mail:</label>
      <input type="email" name="email" class="form-control" />
    </p>
    <p>
      <label>Telefone:</label>
      <input type="text" name="telefone" class="form-control" />
    </p>
    <p>
      <label>CPF:</label>
      <input type="text" name="cpf" class="form-control">
    </p>
    <p>
      <label>Data de nascimento:</label>
      <input type="date" name="data_nasc" class="form-control" />
    </p>
    <br>
    <p><label>Endereço</label></p>
    <p>
      <label>Rua:</label>
      <input type="text" name="rua" class="form-control" />
    </p>
    <p>
      <label>Bairro:</label>
      <input type="text" name="bairro" class="form-control" />
    </p>
    <p>
      <label>Nº:</label>
      <input type="text" name="num" size="5" class="form-control" />
    </p>
    <p>
      <label>Cidade:</label>
      <input type="text" name="cidade" class="form-control" />
    </p>
    <p>
      <label>Estado</label>
      <select class="form-control" name="estado">
        <option value="">Escolha uma das opções</option>
        <option value="Acre">AC</option>
        <option value="Alagoas">AL</option>
        <option value="Amapá">AP</option>
        <option value="Amazonas">AM</option>
        <option value="Bahia">BA</option>
        <option value="Ceará">CE</option>
        <option value="Distrito Federal">DF</option>
        <option value="Espírito Santo">ES</option>
        <option value="Goiás">GO</option>
        <option value="Maranhão">MA</option>
        <option value="Mato Grosso">MT</option>
        <option value="Mato Grosso do Sul">MS</option>
        <option value="Minas Gerais">MG</option>
        <option value="Pará">PA</option>
        <option value="Paraíba">PB</option>
        <option value="Paraná">PR</option>
        <option value="Pernambuco">PE</option>
        <option value="Piau ">PI</option>
        <option value="Rio de Janeiro">RJ</option>
        <option value="Rio Grande do Norte">RN</option>
        <option value="Rio Grande do Sul">RS</option>
        <option value="Rondônia">RO</option>
        <option value="Roraima">RR</option>
        <option value="Santa Catarina">SC</option>
        <option value="São Paulo">SP</option>
        <option value="Sergipe">SE</option>
        <option value="Tocantins">TO</option>
      </select>
    </p>

    <br>
    <input type="hidden" name="operacao" value="incluir">
    <button type="submit" class="btn btn-secondary btn-block">Salvar</button>
  </form><br>

  <form action="cliente.php" method="post">
    <input type="hidden" name="operacao" value="mostrar">
    <p class="text-center"><strong>Clique abaixo para consultar os clientes cadastrados</strong></p>
    <button type="submit" class="btn btn-secondary btn-block">Consultar</button>
  </form><br>

   <form action="clientes_editar.html" method="post">
    <input type="hidden">
    <p class="text-center"><strong>Clique abaixo para editar os clientes cadastrados</strong></p>
    <button type="submit" class="btn btn-secondary btn-block">Editar</button>
  </form><br>

  <form action="cliente.php" method="post">
    <input type="hidden" name="operacao" value="excluir" />
    <p class="text-center"><strong>Indique abaixo o codigo do cliente que deseja excluir</strong></p>
    <p>
      <input type="text" name="codigo" class="form-control" />
    </p>
    <button type="submit" class="btn btn-secondary btn-block">Deletar</button>
  </form><br>
</body>