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
    body{
      background-color: #EBD0CC;
      color: #000;
      margin:2em;     
    }         
</style>

<body>
<?php
	$operacao = $_POST['operacao'];
	$conexao = mysqli_connect('localhost','root','','gerenciador_animais');
  	if($operacao=='incluir'){
  		if((!empty($_POST['nome'])) && (!empty($_POST['email'])) && (!empty($_POST['telefone'])) && (!empty($_POST['cpf'])) && (!empty($_POST['data_nasc'])) && (!empty($_POST['rua'])) && (!empty($_POST['bairro'])) && (!empty($_POST['num'])) && (!empty($_POST['cidade'])) && (!empty($_POST['estado'])) && (!empty($_POST['salario'])) && (!empty($_POST['funcao']))){
        $nome = $_POST['nome'];
    		$email = $_POST['email'];
        $telefone = $_POST['telefone']; 
        $cpf = $_POST['cpf']; 
        $data_nasc = $_POST['data_nasc']; 
        $rua = $_POST['rua']; 
        $bairro = $_POST['bairro']; 
    		$num = $_POST['num'];
    		$cidade = $_POST['cidade']; 
        $estado = $_POST['estado'];
        $salario = $_POST['salario']; 
        $funcao = $_POST['funcao'];
    		$sql = "INSERT INTO FUNCIONARIOS VALUES('','$nome','$email','$telefone','$cpf','$data_nasc','$rua','$bairro','$num','$cidade','$estado','$salario','$funcao');";
    		if(mysqli_query($conexao,$sql)){
  	  		echo '<p class="text-center">Cadastrado!</p>';
      		echo '<p class="text-center"><a href="funcionarios.php">Voltar</a></p>';
    		}
    		else{
      			echo '<p>Erro ao cadastrar no Banco de Dados.</p>';
      			echo '<p><a href="funcionarios.php">Voltar</a></p>';
    		}
  		}
  		else{
    		echo '<p class="text-center">Não efetuado.<br/>Favor preencher todos os campos.</p>';
    		echo '<p class="text-center"><a href="funcionarios.php">Voltar</a></p>';  
 		}
 	}
	elseif($operacao=='excluir'){
		$codigo = $_POST['codigo'];
		$sql = "DELETE FROM FUNCIONARIOS WHERE ID_funcionario=$codigo";
		mysqli_query($conexao, $sql);
		//mysqli_affected_row() retorna o número de linhas afetadas
		$linhas = mysqli_affected_rows($conexao);
		if($linhas==1){
			echo '<p class="text-center">Excluído.</p>';
    		echo '<p class="text-center"><a href="funcionarios.php"> Voltar</a></p>';
		}
		else{
			echo '<p class="text-center">Não encontrado.</p>';
    		echo '<p class="text-center"><a href="funcionarios.php"> Voltar</a></p>';
		}
	} 
	elseif ($operacao=='editar'){
		$codigo = $_POST['ID_funcionario'];
		$novonome = $_POST['nome'];
		$novoemail = $_POST['email'];
		$novotelefone = $_POST['telefone'];
		$novocpf = $_POST['cpf'];
		$novadata_nasc = $_POST['data_nasc'];
		$novarua = $_POST['rua'];
		$novobairro = $_POST['bairro'];
		$novonum = $_POST['num'];
		$novacidade = $_POST['cidade'];
		$novoestado = $_POST['estado'];
    $novosalario = $_POST['salario'];
		$novafuncao = $_POST['funcao'];


		$sql = "UPDATE FUNCIONARIOS SET nome = '$novonome', email = '$novoemail', telefone = '$novotelefone', cpf = '$novocpf', data_nasc = '$novadata_nasc', rua = '$novarua', bairro = '$novobairro', num = '$novonum', cidade = '$novacidade', estado = '$novoestado', salario = '$novosalario', funcao = '$novafuncao'  WHERE ID_funcionario = $codigo";

		if(mysqli_query($conexao, $sql)){
			echo '<p class="text-center">Edição realizada!</p>' . '<p class="text-center"><a href="funcionarios.php">Voltar</a></p>';
		}
		else{
			echo '<p class="text-center">Erro ao editar</p>' . '<p class="text-center"><a href="funcionarios.php">Voltar</a></p>';
		}
	} 
	else{
		$sql = "SELECT * FROM FUNCIONARIOS";
		$selecao = mysqli_query($conexao, $sql);
		//mysqli_num_rows() retorna á quantidade selecionada
		$quantidadeSelecionada = mysqli_num_rows($selecao);
		echo '<h1 class="text-center">Lista de Funcionários</h1>';
		echo '<table class="table table-striped">';  
    echo "<thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th><th>Data Nasc</th><th>Rua</th><th>Bairro</th><th>Nº</th><th>Cidade</th><th>Estado</th><th>Salário</th><th>Função</th></thead>";
    echo '<tbody>';
      
    for($i=0; $i<$quantidadeSelecionada; $i++){
			//mysqli_fetch_row() guarda a linha atual da seleção em um vetor
			$vetor = mysqli_fetch_row($selecao);
            $novaData = inverteData($vetor[6]);
			echo "\n<tr><td>".$vetor[0]."</td>";
            echo "<td>".$vetor[1]."</td>";       
            echo "<td>".$vetor[2]."</td>";     
            echo "<td>".$vetor[3]."</td>";       
            echo "<td>".$vetor[4]."</td>"; 
            echo "<td>".$vetor[5]."</td>"; 
            echo "<td>".$novaData."</td>"; 
            echo "<td>".$vetor[7]."</td>";     
            echo "<td>".$vetor[8]."</td>";       
            echo "<td>".$vetor[9]."</td>";  
            echo "<td>".$vetor[10]."</td>"; 
            echo "<td>".$vetor[11]."</td>";   
            echo "<td>".$vetor[12]."</td>";     
		}
    echo '</tbody></table>';
		echo '<p class="text-center"><a href="funcionarios.php">Voltar</a></p>';
	}
  function inverteData($data){
    /*explode separa a string em um vetor pelo caracter '-' 
    arrayreverse inverte o vetor
    implode une os elementos do vetor em uma string, no caso, a data no padrão BR*/
    $vetorData = explode('-',$data);
    $inverteData = array_reverse($vetorData);
    $dataCorreta = implode('-',$inverteData);
    return $dataCorreta;
  }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">

</script>
</body>
<html>






