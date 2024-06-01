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

  <style>
    body {
      background-color: #EBD0CC;
      color: #000;
      margin: 2em;
    }
  </style>

  <body>
    <?php
	$operacao = $_POST['operacao'];
	$conexao = mysqli_connect('localhost','root','','gerenciador_animais');
  	if($operacao=='incluir'){
  		if((!empty($_POST['nome'])) && (!empty($_POST['foto'])) && (!empty($_POST['data_nasc'])) && (!empty($_POST['altura'])) && (!empty($_POST['peso'])) && (!empty($_POST['especie'])) && (!empty($_POST['raca'])) && (!empty($_POST['cor'])) && (!empty($_POST['porte'])) && (!empty($_POST['genero'])) && (!empty($_POST['habitat']))){
    		$nome = $_POST['nome'];
    		$foto = $_POST['foto'];
        $data_nasc = $_POST['data_nasc']; 
        $altura = $_POST['altura']; 
        $peso = $_POST['peso']; 
        $especie = $_POST['especie']; 
        $raca = $_POST['raca']; 
    		$cor = $_POST['cor'];
    		$porte = $_POST['porte']; 
        $genero = $_POST['genero']; 
        $habitat = $_POST['habitat'];
    		$sql = "INSERT INTO ANIMAIS VALUES('','$nome','$foto','$data_nasc','$altura','$peso','$especie','$raca','$cor','$porte','$genero','$habitat');";
    		if(mysqli_query($conexao,$sql)){
  	  		echo '<p class="text-center">Cadastrado!</p>';
      		echo '<p class="text-center"><a href="animais.php">Voltar</a></p>';
    		}
    		else{
      			echo '<p>Erro ao cadastrar no Banco de Dados.</p>';
      			echo '<p><a href="animais.php">Voltar</a></p>';
    		}
  		}
  		else{
    		echo '<p class="text-center">Cadastro não efetuado.<br/>Favor preencher todos os campos.</p>';
    		echo '<p class="text-center"><a href="animais.php">Voltar</a></p>';  
 		}
 	}
	elseif($operacao=='excluir'){
		$codigo = $_POST['codigo'];
		$sql = "DELETE FROM ANIMAIS WHERE ID_animal=$codigo";
		mysqli_query($conexao, $sql);
		//mysqli_affected_row() retorna o número de linhas afetadas
		$linhas = mysqli_affected_rows($conexao);
		if($linhas==1){
			echo '<p class="text-center">Excluído.</p>';
    	echo '<p class="text-center"><a href="animais.php"> Voltar</a></p>';
		}
		else{
			echo '<p class="text-center">Não encontrado.</p>';
    	echo '<p class="text-center"><a href="animais.php"> Voltar</a></p>';
		}
  }
  elseif ($operacao=='editar'){
		$codigo = $_POST['ID_animal'];
		$novonome = $_POST['nome'];
    $novafoto = $_POST['foto'];
    $novadata_nasc = $_POST['data_nasc'];
    $novaaltura = $_POST['altura']; 
    $novopeso = $_POST['peso']; 
    $novaespecie = $_POST['especie']; 
    $novaraca = $_POST['raca']; 
  	$novacor = $_POST['cor'];
  	$novoporte = $_POST['porte']; 
    $novogenero = $_POST['genero']; 
    $novohabitat = $_POST['habitat'];

		$sql = "UPDATE ANIMAIS SET nome = '$novonome', foto = '$novafoto', data_nasc = '$novadata_nasc', altura = '$novaaltura', peso = '$novopeso', especie = '$novaespecie', raca = '$novaraca', cor = '$novacor', porte = '$novoporte', genero = '$novogenero', habitat = '$novohabitat'  WHERE ID_animal = $codigo";
		
		if(mysqli_query($conexao, $sql)){
			echo '<p class="text-center">Edição realizada!</p>' . '<p class="text-center"><a href="animais.php">Voltar</a></p>';
		}
		else{
			echo '<p class="text-center">Erro ao editar</p>' . '<p class="text-center"><a href="animais.php">Voltar</a></p>';
		}
	} 
	else{
		$sql = "SELECT * FROM ANIMAIS";
		$selecao = mysqli_query($conexao, $sql);
		$quantidadeSelecionada = mysqli_num_rows($selecao);
		echo '<h1 class="text-center">Lista de Animais</h1>';
		echo '<table class="table table-striped">';  
        echo 
        "<thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Foto</th>
              <th>Data Nasc</th>
              <th>Altura</th>
              <th>Peso</th>
              <th>Espécie</th>
              <th>Raça</th>
              <th>Cor</th>
              <th>Porte</th>
              <th>Gênero</th>
              <th>Habitat</th>
            </tr>
          </thead>";
        echo '<tbody>';
      
    for($i=0; $i<$quantidadeSelecionada; $i++){
			$vetor = mysqli_fetch_row($selecao);
      $novaData = inverteData($vetor[3]);
			echo "\n<tr><td>".$vetor[0]."</td>";
      echo "<td>".$vetor[1]."</td>";       
      echo "<td>".$vetor[2]."</td>";     
      echo "<td>".$novaData."</td>";       
      echo "<td>".$vetor[4]."</td>"; 
      echo "<td>".$vetor[5]."</td>"; 
      echo "<td>".$vetor[6]."</td>";       
      echo "<td>".$vetor[7]."</td>";     
      echo "<td>".$vetor[8]."</td>";       
      echo "<td>".$vetor[9]."</td>";  
      echo "<td>".$vetor[10]."</td>";       
      echo "<td>".$vetor[11]."</td>";    
      echo "</tr>";     
		}
    echo '</tbody></table>';
		echo '<p class="text-center"><a href="animais.php">Voltar</a></p>';
	}
  function inverteData($data){
    $vetorData = explode('-',$data);
    $inverteData = array_reverse($vetorData);
    $dataCorreta = implode('-',$inverteData);
    return $dataCorreta;
  }
?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
      </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
      integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
      </script>
  </body>
  <html>