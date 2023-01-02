<?php 
$tabela = 'vendas';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-vender'];
$comprador = $_POST['comprador'];
$data_pgto = $_POST['data_pgto'];
$valor = $_POST['valor'];
$comissao_corretor = $_POST['comissao_corretor'];
$comissao_imob = $_POST['comissao_imob'];
$obs = $_POST['obs'];

if($comprador == ''){
	echo 'Selecione um comprador!!';
	exit();
}

$valor = str_replace(',', '.', $valor);
$comissao_corretor = str_replace(',', '.', $comissao_corretor);
$comissao_imob = str_replace(',', '.', $comissao_imob);

$valorF = number_format($valor, 2, ',', '.');
$comissao_corretorF = number_format($comissao_corretor, 2, ',', '.');
$comissao_imobF = number_format($comissao_imob, 2, ',', '.');
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));

$query = $pdo->query("SELECT * FROM imoveis where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$corretor = $res[0]['corretor'];
$vendedor = $res[0]['dono'];
$endereco = $res[0]['endereco'];
$cidade = $res[0]['cidade'];
$bairro = $res[0]['bairro'];

$query = $pdo->query("SELECT * from cidades where id = '$cidade' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cidade = $res[0]['nome'];

$query = $pdo->query("SELECT * from bairros where id = '$bairro' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_bairro = $res[0]['nome'];


//PEGAR DADOS DO CONTRATO
$query2 = $pdo->query("SELECT * FROM vendedores where id = '$vendedor'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_vendedor = $res2[0]['nome'];
	$cpf_vendedor = $res2[0]['doc'];
	$estado_civil_vendedor = ', '.$res2[0]['estado_civil'];
	$nacionalidade_vendedor = $res2[0]['nacionalidade'];
	$endereco_vendedor = $res2[0]['endereco'];
	$tipo_pessoa_vendedor = $res2[0]['pessoa'];
	$banco_vendedor = $res2[0]['banco'];
	$tipo_conta_vendedor = $res2[0]['tipo'];
	$agencia_vendedor = $res2[0]['agencia'];
	$conta_vendedor = $res2[0]['conta'];
	$profissao_pessoa_vendedor = $res2[0]['profissao'];
			//$pix_vendedor = $res2[0]['pix'];
	if($tipo_pessoa_vendedor != 'Física'){
		$estado_civil_vendedor = '';
		$tipo_doc_vendedor = 'CNPJ';
	}else{
		$tipo_doc_vendedor = 'CPF';
	}
}


$query2 = $pdo->query("SELECT * FROM compradores where id = '$comprador'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_comprador = $res2[0]['nome'];
	$cpf_comprador = $res2[0]['doc'];
	$estado_civil_comprador = ', '.$res2[0]['estado_civil'];
	$nacionalidade_comprador = $res2[0]['nacionalidade'];
	$endereco_comprador = $res2[0]['endereco'];
	$tipo_pessoa_comprador = $res2[0]['pessoa'];
	$profissao_pessoa_comprador = $res2[0]['profissao'];
	if($tipo_pessoa_comprador != 'Física'){
		$estado_civil_comprador = '';
		$tipo_doc_comprador = 'CNPJ';
	}else{
		$tipo_doc_comprador = 'CPF';
	}
}



//INSERIR NAS VENDAS
$query = $pdo->prepare("INSERT INTO $tabela SET corretor = '$corretor', comprador = '$comprador', vendedor = '$vendedor', valor_total = :valor_total, comissao_corretor = :comissao_corretor, comissao_imob = :comissao_imob, data = curDate(), data_pgto = '$data_pgto', pago = 'Não', obs = :obs, usuario = '$id_usuario', imovel = '$id'");

$query->bindValue(":valor_total", "$valor");
$query->bindValue(":comissao_imob", "$comissao_imob");
$query->bindValue(":comissao_corretor", "$comissao_corretor");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();


//ATUALIZAR STATUS DO IMÓVEL PARA VENDIDO
$query = $pdo->query("UPDATE imoveis SET status = 'Vendido' where id = '$id'");

//GERAR A CONTA A RECEBER COM A SOMA DAS COMISSÕES
$valor_conta = $comissao_corretor + $comissao_imob;
$query = $pdo->query("INSERT INTO receber SET descricao = 'Venda de Imóvel', proprietario = '$vendedor',  valor = '$valor_conta', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Venda', id_ref = '$ult_id'");

//GERAR A CONTA A PAGAR COM A COMISSÃO DO CORRETOR CASO EXISTA
if($comissao_corretor > 0){	
	$query = $pdo->query("INSERT INTO pagar SET descricao = 'Comissão Venda', corretor = '$corretor', valor = '$comissao_corretor', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref = '$ult_id'");

}


require_once("../../texto_contrato_venda.php");



//LANÇAR OS DADOS DO IMÓVEL NA TABELA DE CONTRATOS VENDA
$query = $pdo->query("INSERT INTO contrato_venda SET imovel = '$id', texto = '$texto_contrato', usuario = '$id_usuario', data = curDate()");



echo 'Inserido com Sucesso';
?>