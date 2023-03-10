<?php 
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* define o prazo do cache em 120 minutos */
session_cache_expire(120);
$cache_expire = session_cache_expire();
/* inicia a sessão */

@session_start();
require_once("conexao.php");

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_crip = md5($senha);

$query = $pdo->prepare("SELECT * FROM usuarios WHERE (cpf = :usuario or email = :usuario) and senha_crip = :senha ");
$query->bindValue(":usuario", "$usuario");
$query->bindValue(":senha", "$senha_crip");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = @count($res);
if($total_reg > 0){

	
	$id_usuario = $res[0]['id'];
	$nivel_usuario = $res[0]['nivel'];

	if($res[0]['ativo'] != 'Sim'){
		echo "<script>window.alert('Usuário Inativo, contate o Administrador');</script>";
		echo "<script>window.location='index.php'</script>";
		exit();
	}

	if($nivel_usuario != "Administrador"){
			$query2 = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			$total_reg2 = @count($res2);
			if($total_reg2 == 0){
					echo "<script>window.alert('Nenhuma permissão definida para este usuário, contate o Administrador');</script>";
				echo "<script>window.location='index.php'</script>";
			}	
		}


	$_SESSION['id_usuario'] = $res[0]['id'];
	$_SESSION['nome_usuario'] = $res[0]['nome'];
	$_SESSION['nivel_usuario'] = $res[0]['nivel'];



		

	
	echo "<script>window.location='painel'</script>";
}else{
	echo "<script>window.alert('Dados Incorretos');</script>";
	echo "<script>window.location='index.php'</script>";
}

 ?>