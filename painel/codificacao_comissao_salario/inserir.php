<?php 
$tabela = 'salariocomissionado';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$idsigla = $_POST['idsigla'];

//echo "string: ".$nome;
//exit();

//validar nome
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Padrão já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, valor = :valor, idsigla = :idsigla");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, valor = :valor, idsigla = :idsigla WHERE id = '$id'");	
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor", "$valor");
$query->bindValue(":idsigla", "$idsigla");
$query->execute();

echo 'Salvo com Sucesso'; 

?>