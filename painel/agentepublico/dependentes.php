<?php 
$tabela = 'dependente';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$idagente = $_POST['id-dependente']; // id do servidor
$nome = $_POST['nome-dep'];
$cpf = $_POST['cpf-dep'];
$datanasc = $_POST['dtnas-dep'];
$sexo = $_POST['sexo-dep'];
$parentesco = $_POST['grauparentesco-dep'];


$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, cpf = :cpf, datanasc = :datanasc, sexo = '$sexo', parentesco = '$parentesco', idagente = '$idagente'");
	
$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":datanasc", "$datanasc");
$query->execute();

echo 'Inserido com Sucesso';

?>