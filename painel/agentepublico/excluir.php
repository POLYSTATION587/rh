<?php 
$tabela = 'agentepublico';
require_once("../../conexao.php");

$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM arquivos where id_reg = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este funcionário não pode ser excluído, primeiro exclua os Arquivos anexos relacionados a ele para depois excluir este funcionário!';
	exit();
}

$query = $pdo->query("SELECT * FROM dependente where idagente = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Este funcionário não pode ser excluído, primeiro exclua os dependentes relacionados a ele para depois excluir este funcionário!';
	exit();
}


$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];
if($foto != "sem-perfil.jpg"){
	@unlink('../images/perfil/'.$foto);
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>