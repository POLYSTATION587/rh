<?php 
$tabela = 'imagens_imoveis';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-imagens'];

for ($i = 0; $i < count(@$_FILES['imgimovel']['name']); $i++){

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imgimovel']['name'][$i];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/detalhes-imoveis/' .$nome_img;

$imagem_temp = @$_FILES['imgimovel']['tmp_name'][$i]; 

if(@$_FILES['imgimovel']['name'][$i] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['imgimovel']['name'][$i] != ""){			

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}else{
	echo 'Insira uma Imagem!';
	exit();
}

$query = $pdo->query("INSERT INTO $tabela SET id_imovel = '$id', foto = '$foto'");

}

echo 'Inserido com Sucesso';

?>