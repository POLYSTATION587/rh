<?php 
$tabela = 'cargos_federal';
require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$nivel = $_POST['nivel'];
$escolaridade = $_POST['escolaridade'];
$curso = $_POST['curso'];
$atribuicoes = $_POST['atribuicoes'];

//validar nome
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Cargo Federal já Cadastrado, escolha Outro!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, nivel = :nivel, escolaridade = :escolaridade, curso = :curso, atribuicoes = :atribuicoes");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, nivel = :nivel, escolaridade = :escolaridade, curso = :curso, atribuicoes = :atribuicoes WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":nivel", "$nivel");
$query->bindValue(":escolaridade", "$escolaridade");
$query->bindValue(":curso", "$curso");
$query->bindValue(":atribuicoes", "$atribuicoes");
$query->execute();

echo 'Salvo com Sucesso'; 

?>