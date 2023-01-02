<?php 
require_once("../../conexao.php");
$id = $_GET['id'];

$query = $pdo->query("SELECT * from receber where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$descricao = $res[0]['descricao'];
$comprador = $res[0]['comprador'];
$locatario = $res[0]['locatario'];
$proprietario = $res[0]['proprietario'];
$valor = $res[0]['valor'];
$data_pgto = $res[0]['data_pgto'];

$nome_pessoa = 'Sem Registro';

$query2 = $pdo->query("SELECT * FROM compradores where id = '$comprador'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	
}

$query2 = $pdo->query("SELECT * FROM vendedores where id = '$proprietario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	
}

$query2 = $pdo->query("SELECT * FROM locatarios where id = '$locatario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	
}

$valorF = number_format($valor, 2, ',', '.');
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Recibo de Conta</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body {
  padding: 10px;
}

* {
  box-sizing: border-box;
}

.receipt-main {  
  width: 100%;
  padding: 15px;
  font-size: 12px;
  border: 1px solid #000;
}

.receipt-title {
  text-align: center;
  text-transform: uppercase;
  font-size: 20px;
  font-weight: 600;
  margin: 0;
}
  
.receipt-label {
  font-weight: 600;
}

.text-large {
  font-size: 16px;
}

.receipt-section {
  margin-top: 10px;
}

.receipt-footer {
  text-align: center;
  background: #ff0000;
}

.receipt-signature {
  height: 80px;
  margin: 50px 0;
  padding: 0 50px;
  background: #fff;
  
  .receipt-line {
    margin-bottom: 10px;
    border-bottom: 1px solid #000;
  }
  
  p {
    text-align: center;
    margin: 0;
  }

  .direita{
  	position:absolute;
  	right:30px;
  }


  .imagem {
			width: 150px;
			position:absolute;
			left:15px;
			top:20px;
			height:50px;
		}


	</style>


</head>
<body>	



<div class="receipt-main">

	<?php 
			if($logo_rel != ''){
				?>
				<img class="imagem" src="<?php echo $url_sistema ?>/sistema/imagens/<?php echo $logo_rel ?>" width="200px" height="60px">
				
			<?php } ?>

  
  <p class="receipt-title">Recibo de Pagamento</p>
  <br>
  
  <div class="receipt-section pull-left">
    <span class="receipt-label text-large">Número:</span>
    <span class="text-large"><?php echo date('Y/m') ?></span>

    <span class="text-large receipt-label direita">VALOR R$ <?php echo $valorF ?></span>
    
  </div>
  

  
  <div class="clearfix"></div>
  <br>
  
  <div class="receipt-section">
    <span><big>
      Recebi(emos) de <b><?php echo $nome_pessoa ?></b> a quantia de R$ <b><?php echo $valorF ?> </b> reais na data <b><?php echo $data_pgtoF ?></b> correspondente a(ao) <?php echo $descricao ?>. 
    
  </big></span>
        
  </div>
  
  <br><br>
	<div align="center">

  <?php if($assinatura == 'sem-assinatura.jpg'){
  	echo '<br><br>';
  }else{
  	?>
  	<img src="<?php echo $url_sistema ?>/sistema/imagens/modelo-assinatura.jpg" width="" height=""><br>
  <?php } ?>
    
  	
    ______________________________________________________________________<br>
    (<b>ASSINATURA DO RESPONSÁVEL</b>)

  </div>
  <br>

   <div align="center">
    <?php echo mb_strtoupper($nome_sistema) ?> CNPJ <?php echo $cnpj_imob ?><br>
    <small><?php echo $end_sistema ?> - <?php echo $tel_sistema ?></small>
  </div>

</div>




</body>
</html>