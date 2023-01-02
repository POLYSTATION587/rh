<?php 
$tabela = 'salariocomissionado';
require_once("../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM cargos_comissao where idcodificacao = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este cargo não pode ser excluído, primeiro exclua os padrões relacionados a ele para depois excluir este cargo!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>