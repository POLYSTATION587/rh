<?php 
$tabela = 'cargos_comissao';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$vagas = $_POST['vagas'];
$subdivisao = $_POST['subdivisao'];
$idcodificacao = $_POST['idcodificacao'];

//validar nome
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Cargo Comissionado já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, vagas = :vagas, subdivisao = :subdivisao, ocupado = 0, vazio = 0, idcodificacao = :idcodificacao");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, vagas = :vagas, subdivisao = :subdivisao, idcodificacao = :idcodificacao WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":vagas", "$vagas");
$query->bindValue(":subdivisao", "$subdivisao");
$query->bindValue(":idcodificacao", "$idcodificacao");
$query->execute();

echo 'Salvo com Sucesso'; 

?>