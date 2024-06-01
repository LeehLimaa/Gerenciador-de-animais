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

<style>    
    body{
      background-color: #EBD0CC;
      color: #000;
      margin:2em;     
    }         
</style>

<?php
$operacao = $_POST['operacao'];
$conexao = mysqli_connect('localhost', 'root', '', 'gerenciador_animais');

if ($operacao == 'incluir') {
    if ((!empty($_POST['data'])) && (!empty($_POST['cliente'])) && (!empty($_POST['animal']))) {
        $data = $_POST['data'];
        $cliente = $_POST['cliente'];
        $animal = $_POST['animal'];
        $banho_tosa = isset($_POST['banho_tosa']) ? $_POST['banho_tosa'] : '';
        $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : '';
        $exames = isset($_POST['exames']) ? $_POST['exames'] : '';
        $medicamentos = isset($_POST['medicamentos']) ? $_POST['medicamentos'] : '';
        $vacinas = isset($_POST['vacinas']) ? $_POST['vacinas'] : '';

        $qtde_banho_tosa = isset($_POST['qtde_banho_tosa']) ? $_POST['qtde_banho_tosa'] : 0;
        $qtde_consulta = isset($_POST['qtde_consulta']) ? $_POST['qtde_consulta'] : 0;
        $qtde_exames = isset($_POST['qtde_exames']) ? $_POST['qtde_exames'] : 0;
        $qtde_medicamentos = isset($_POST['qtde_medicamentos']) ? $_POST['qtde_medicamentos'] : 0;
        $qtde_vacinas = isset($_POST['qtde_vacinas']) ? $_POST['qtde_vacinas'] : 0;


        $total = 0;

        if (!empty($banho_tosa)) {
            $banho_tosa_sql = "SELECT preco FROM banho_tosa WHERE ID_banho_tosa = $banho_tosa";
            $banho_tosa_result = $conexao->query($banho_tosa_sql);
            $banho_tosa_row = $banho_tosa_result->fetch_assoc();
            $qtde_banho_tosa = $_POST['qtde_banho_tosa'];
            $total += $banho_tosa_row['preco'] * $qtde_banho_tosa;
            echo "<strong>Banho e/ou Tosa</strong><br>";
            echo "Preço (unid.): <strong>R$ " . ($banho_tosa_row['preco']) . ".00</strong><br>"; 
            echo "Quantidade: <strong>" . $qtde_banho_tosa . "</strong><br>";
            echo "Preço Total do Banhos e/ou Tosas: <strong>R$ " . ($banho_tosa_row['preco'] * $qtde_banho_tosa) . ".00</strong><br><br>";
        }

        if (!empty($consulta)) {
            $consulta_sql = "SELECT preco FROM consulta WHERE ID_consulta = $consulta";
            $consulta_result = $conexao->query($consulta_sql);
            $consulta_row = $consulta_result->fetch_assoc();
            $qtde_consulta = $_POST['qtde_consulta'];
            $total += $consulta_row['preco'] * $qtde_consulta;
            echo "<strong>Consulta</strong><br>";
            echo "Preço (unid.): <strong>R$ " . ($consulta_row['preco']) . ".00</strong><br>"; 
            echo "Quantidade: <strong>" . $qtde_consulta . "</strong><br>";
            echo "Preço Total das Consultas: <strong>R$ " . ($consulta_row['preco'] * $qtde_consulta) . ".00</strong><br><br>";        
          }

        if (!empty($exames)) {
            $exames_sql = "SELECT preco FROM exames WHERE ID_exame = $exames";
            $exames_result = $conexao->query($exames_sql);
            $exames_row = $exames_result->fetch_assoc();
            $qtde_exames = $_POST['qtde_exames'];
            $total += $exames_row['preco'] * $qtde_exames;
            echo "<strong>Exames</strong><br>";
            echo "Preço (unid.): <strong>R$ " . ($exames_row['preco']) . ".00</strong><br>"; 
            echo "Quantidade: <strong>" . $qtde_exames . "</strong><br>";
            echo "Preço Total dos Exames: <strong>R$ " . ($exames_row['preco'] * $qtde_exames) . ".00</strong><br><br>";        }

        if (!empty($medicamentos)) {
            $medicamentos_sql = "SELECT preco FROM medicamentos WHERE ID_medicamentos = $medicamentos";
            $medicamentos_result = $conexao->query($medicamentos_sql);
            $medicamentos_row = $medicamentos_result->fetch_assoc();
            $qtde_medicamentos = $_POST['qtde_medicamentos'];
            $total += $medicamentos_row['preco'] * $qtde_medicamentos;
            echo "<strong>Medicamentos</strong><br>";
            echo "Preço (unid.): <strong>R$ " . ($medicamentos_row['preco']) . ".00</strong><br>"; 
            echo "Quantidade: <strong>" . $qtde_medicamentos . "</strong><br>";
            echo "Preço Total dos Medicamentos: <strong>R$ " . ($medicamentos_row['preco'] * $qtde_medicamentos) . ".00</strong><br><br>";        }

            if (!empty($vacinas)) {
              $vacinas_sql = "SELECT preco FROM vacinas WHERE ID_vacina = $vacinas";
              $vacinas_result = $conexao->query($vacinas_sql);
              $vacinas_row = $vacinas_result->fetch_assoc();
              $qtde_vacinas = $_POST['qtde_vacinas'];
              $total += $vacinas_row['preco'] * $qtde_vacinas;
              echo "<strong>Vacinas</strong><br>";
              echo "Preço (unid.): <strong>R$ " . ($vacinas_row['preco']) . ".00</strong><br>"; 
              echo "Quantidade: <strong>" . $qtde_vacinas . "</strong><br>";
              echo "Preço Total dos Vacinas: <strong>R$ " . ($vacinas_row['preco'] * $qtde_vacinas) . ".00</strong><br><br>";        }
  

        $sql = "INSERT INTO ATENDIMENTOS (data, cliente, animal, banho_tosa, consulta, exames, medicamentos, vacinas, qtde_banho_tosa, qtde_consulta, qtde_exames, qtde_medicamentos, qtde_vacinas) 
        VALUES ('$data', '$cliente','$animal', '$banho_tosa', '$consulta', '$exames', '$medicamentos', '$vacinas',$qtde_banho_tosa, $qtde_consulta, $qtde_exames, $qtde_medicamentos, $qtde_vacinas);";

        if (mysqli_query($conexao, $sql)) {
            echo "<br>Atendimento registrado com sucesso! <br>Preço total: <strong>R$ $total</strong>";
            echo '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
        } else {
            echo '<p>Erro ao cadastrar no Banco de Dados.</p>';
            echo '<p><a href="atendimentos.php">Voltar</a></p>';
        }
    } else {
        echo '<p class="text-center">Cadastro não efetuado.<br/>Favor preencher todos os campos obrigatórios (data e cliente).</p>';
        echo '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
    }


} elseif ($operacao == 'excluir') {
    $codigo = $_POST['codigo'];
    $sql = "DELETE FROM ATENDIMENTOS WHERE ID_atendimento = $codigo";
    mysqli_query($conexao, $sql);
    // mysqli_affected_row() retorna o número de linhas afetadas
    $linhas = mysqli_affected_rows($conexao);
    if ($linhas == 1) {
        echo '<p class="text-center">Excluído.</p>';
        echo '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
    } else {
        echo '<p class="text-center">Não encontrado.</p>';
        echo '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
    }
} elseif ($operacao == 'editar') {
    $codigo = $_POST['ID_atendimento'];
    $novodata = $_POST['data'];
    $novocliente = $_POST['cliente'];
    $novoanimal = $_POST['animal'];
    $novobanho_tosa = isset($_POST['banho_tosa']) ? $_POST['banho_tosa'] : '';
    $novoconsulta = isset($_POST['consulta']) ? $_POST['consulta'] : '';
    $novoexames = isset($_POST['exames']) ? $_POST['exames'] : '';
    $novomedicamentos = isset($_POST['medicamentos']) ? $_POST['medicamentos'] : '';
    $novovacinas = isset($_POST['vacinas']) ? $_POST['vacinas'] : '';

    $novoqtde_banho_tosa = isset($_POST['qtde_banho_tosa']) ? $_POST['qtde_banho_tosa'] : 0;
    $novoqtde_consulta = isset($_POST['qtde_consulta']) ? $_POST['qtde_consulta'] : 0;
    $novoqtde_exames = isset($_POST['qtde_exames']) ? $_POST['qtde_exames'] : 0;
    $novoqtde_medicamentos = isset($_POST['qtde_medicamentos']) ? $_POST['qtde_medicamentos'] : 0;
    $novoqtde_vacinas = isset($_POST['qtde_vacinas']) ? $_POST['qtde_vacinas'] : 0;


    $novototal = 0;

    if (!empty($novobanho_tosa)) {
        $novobanho_tosa_sql = "SELECT preco FROM banho_tosa WHERE ID_banho_tosa = $novobanho_tosa";
        $novobanho_tosa_result = $conexao->query($novobanho_tosa_sql);
        $novobanho_tosa_row = $novobanho_tosa_result->fetch_assoc();
        $novoqtde_banho_tosa = $_POST['qtde_banho_tosa'];
        $novototal += $novobanho_tosa_row['preco'] * $novoqtde_banho_tosa;
        echo "Preço de Banho e/ou Tosa: <strong>R$ " . ($novobanho_tosa_row['preco'] * $novoqtde_banho_tosa) . "</strong><br>Quantidade: <strong>" . $novoqtde_banho_tosa . "</strong><br><br>";
    }

    if (!empty($consulta)) {
        $novoconsulta_sql = "SELECT preco FROM consulta WHERE ID_consulta = $novoconsulta";
        $novoconsulta_result = $conexao->query($novoconsulta_sql);
        $novoconsulta_row = $novoconsulta_result->fetch_assoc();
        $novoqtde_consulta = $_POST['qtde_consulta'];
        $novototal += $novoconsulta_row['preco'] * $novoqtde_consulta;
        echo "Preço de Consulta: <strong>R$ " . ($novoconsulta_row['preco'] * $novoqtde_consulta) . "</strong><br>Quantidade: <strong>" . $novoqtde_consulta . "</strong><br><br>";
    }

    if (!empty($exames)) {
        $novoexames_sql = "SELECT preco FROM exames WHERE ID_exame = $novoexames";
        $novoexames_result = $conexao->query($novoexames_sql);
        $novoexames_row = $novoexames_result->fetch_assoc();
        $novoqtde_exames = $_POST['qtde_exames'];
        $novototal += $novoexames_row['preco'] * $qtde_exames;
        echo "Preço de Exame: <strong>R$ " . ($novoexames_row['preco'] * $novoqtde_exames) . "</strong><br>Quantidade: <strong>" . $novoqtde_exames . "</strong><br><br>";
    }

    if (!empty($medicamentos)) {
        $novomedicamentos_sql = "SELECT preco FROM medicamentos WHERE ID_medicamentos = $novomedicamentos";
        $novomedicamentos_result = $conexao->query($novomedicamentos_sql);
        $novomedicamentos_row = $novomedicamentos_result->fetch_assoc();
        $novoqtde_medicamentos = $_POST['qtde_medicamentos'];
        $novototal += $novomedicamentos_row['preco'] * $novoqtde_medicamentos;
        echo "Preço de Medicamento: <strong>R$ " . ($novomedicamentos_row['preco'] * $novoqtde_medicamentos) . "</strong><br>Quantidade: <strong>" . $novoqtde_medicamentos . "</strong><br><br>";
    }

    if (!empty($medicamentos)) {
      $novovacinas_sql = "SELECT preco FROM vacinas WHERE ID_vacinas = $novovacinas";
      $novovacinas_result = $conexao->query($novovacinas_sql);
      $novovacinas_row = $novovacinas_result->fetch_assoc();
      $novoqtde_vacinas = $_POST['qtde_vacinas'];
      $novototal += $novovacinas_row['preco'] * $novoqtde_vacinas;
      echo "Preço de Medicamento: <strong>R$ " . ($novovacinas_row['preco'] * $novoqtde_vacinas) . "</strong><br>Quantidade: <strong>" . $novoqtde_vacinas . "</strong><br><br>";
  }

    $sql = "INSERT INTO ATENDIMENTOS (data, cliente, animal, banho_tosa, consulta, exames, medicamentos, vacinas, qtde_banho_tosa, qtde_consulta, qtde_exames, qtde_medicamentos, qtde_vacinas) 
    VALUES ('$novodata', '$novocliente', '$novoanimal', '$novobanho_tosa', '$novoconsulta', '$novoexames', '$novomedicamentos', '$novovacinas',$novoqtde_banho_tosa, $novoqtde_consulta, $novoqtde_exames, $novoqtde_medicamentos, $novoqtde_vacinas);";

    if (mysqli_query($conexao, $sql)) {
        echo '<p class="text-center">Edição realizada!</p>' . '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
    } else {
        echo '<p class="text-center">Erro ao editar</p>' . '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
    }
} else {
    $sql = "SELECT * FROM ATENDIMENTOS";
    $selecao = mysqli_query($conexao, $sql);
    $quantidadeSelecionada = mysqli_num_rows($selecao);

    echo '<h1 class="text-center">Lista de Atendimentos</h1>';
    echo '<table class="table table-striped">';
    echo "<thead>
            <tr>
              <th>ID</th>
              <th>Data</th>
              <th>Cliente</th>
              <th>Animal</th>
              <th>Banhos e/ou Tosas</th>
              <th>Consultas</th>
              <th>Exames</th>
              <th>Medicamentos</th>
              <th>Vacinas</th>
            </tr>
          </thead>";
    echo '<tbody>';

    for ($i = 0; $i < $quantidadeSelecionada; $i++) {
        $vetor = mysqli_fetch_row($selecao);
        $novaData = inverteData($vetor[1]);
        echo "\n<tr><td>" . $vetor[0] . "</td>";
        echo "<td>" . $novaData . "</td>";
        echo "<td>" . $vetor[2] . "</td>";
        echo "<td>" . $vetor[3] . "</td>";
        echo "<td>" . $vetor[4] . " (Qtde: " . $vetor[9] . ")</td>";
        echo "<td>" . $vetor[5] . " (Qtde: " . $vetor[10] . ")</td>";
        echo "<td>" . $vetor[6] . " (Qtde: " . $vetor[11] . ")</td>";
        echo "<td>" . $vetor[7] . " (Qtde: " . $vetor[12] . ")</td>";
        echo "<td>" . $vetor[8] . " (Qtde: " . $vetor[13] . ")</td>";

    }
    echo '</tbody></table>';
    echo '<p class="text-center"><a href="atendimentos.php">Voltar</a></p>';
}

function inverteData($data)
{
    $vetorData = explode('-', $data);
    $inverteData = array_reverse($vetorData);
    $dataCorreta = implode('-', $inverteData);
    return $dataCorreta;
}
?>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">   
  </script>






