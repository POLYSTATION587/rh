<?php 
require_once("../../conexao.php");
$id_imovel = $_GET['id'];

$query = $pdo->query("SELECT * from contrato_venda where imovel = '$id_imovel' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$texto = $res[0]['texto'];		
}


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>




<!DOCTYPE html>
<html>
<head>
	<title>Contrato de Venda</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 30px;

		}

		
.titulo{
	font-size:22px;
}

.texto-contrato{
	font-size:12px;
	text-align: center;
}

	</style>


</head>
<body>	


<p class="titulo">CONTRATO DE COMPRA E VENDA DE IMÓVEL</p>
<div style="border-bottom: solid 1px #0340a3"></div>
<br>
<p class="texto-contrato">

<?php echo $texto ?>

<?php echo $cidade_imob ?> <?php echo ucwords($data_hoje) ?>.
<br><br><br> 

Vendedor: _______________________________________________.<br>   
<b>NOME DO PROPRIETÁRIO</b>
<br> <br> 
    
Comprador  ______________________________________________.  <br>   
<b>NOME DO COMPRADOR</b>
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

Testemunhas:______________________________________________.<br> 
<br> <br> 

       

 </p>
       



</body>
</html>