<?php 
$tabela = 'alugueis';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-vender'];
$comprador = $_POST['comprador'];
$data_pgto = $_POST['data_pgto'];
$data_inicio = $_POST['data_inicio'];
$data_final = $_POST['data_final'];
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


//GERAR AS CONTA A RECEBER DE CADA MÊS DE ALUGUÉL
$data_ini  = $data_inicio;
$data_end  = $data_final; 
$dif = strtotime($data_end) - strtotime($data_ini); 
$qtd_parcelas = floor($dif / (60 * 60 * 24 * 30));

$data_pgto_separada = explode("-", $data_pgto);
$dia_pgto = $data_pgto_separada[2];


	//retirar quebra de texto do obs		
		$dataF = implode('/', array_reverse(explode('-', date("Y-m-d"))));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

		$valorF = number_format($valor, 2, ',', '.');
		$comissao_corretorF = number_format($comissao_corretor, 2, ',', '.');
		$comissao_imobF = number_format($comissao_imob, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];
		}else{
			$nome_corretor = 'Sem Registro';
		}
		

		$query2 = $pdo->query("SELECT * FROM locatarios where id = '$comprador'");
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


		$query2 = $pdo->query("SELECT * FROM vendedores where id = '$vendedor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_vendedor = $res2[0]['nome'];
			$cpf_vendedor = $res2[0]['doc'];
			$estado_civil_vendedor = ', '.$res2[0]['estado_civil'];
			$nacionalidade_vendedor = $res2[0]['nacionalidade'];
			$endereco_vendedor = $res2[0]['endereco'];
			$tipo_pessoa_vendedor = $res2[0]['pessoa'];
			$profissao_pessoa_vendedor = $res2[0]['profissao'];
			if($tipo_pessoa_vendedor != 'Física'){
				$estado_civil_vendedor = '';
				$tipo_doc_vendedor = 'CNPJ';
			}else{
				$tipo_doc_vendedor = 'CPF';
			}
		}



//INSERIR NAS VENDAS
$query = $pdo->prepare("INSERT INTO $tabela SET corretor = '$corretor', inquilino = '$comprador', proprietario = '$vendedor', valor_total = :valor_total, comissao_corretor = :comissao_corretor, comissao_imob = :comissao_imob, data = curDate(), data_pgto = '$data_pgto', obs = :obs, usuario = '$id_usuario', imovel = '$id', data_inicio = '$data_inicio' , data_final = '$data_final' ");

$query->bindValue(":valor_total", "$valor");
$query->bindValue(":comissao_imob", "$comissao_imob");
$query->bindValue(":comissao_corretor", "$comissao_corretor");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();


//ATUALIZAR STATUS DO IMÓVEL PARA VENDIDO
$query = $pdo->query("UPDATE imoveis SET status = 'Alugado' where id = '$id'");

//GERAR AS CONTA A RECEBER DE CADA MÊS DE ALUGUÉL
$data_ini  = $data_inicio;
$data_end  = $data_final; 
$dif = strtotime($data_end) - strtotime($data_ini); 
$qtd_parcelas = floor($dif / (60 * 60 * 24 * 30)); 

for($i=1; $i <= $qtd_parcelas; $i++){
	$descricao_nova = 'Aluguel Parcela - ('.$i.')';
	if($i == 1){
		$novo_vencimento = $data_pgto;
	}	

	$query = $pdo->query("INSERT INTO receber SET descricao = '$descricao_nova', locatario = '$comprador',  valor = '$valor', data_venc = '$novo_vencimento', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Aluguél', id_ref = '$ult_id'");


	$novo_vencimento = date('Y/m/d', strtotime("+1 month",strtotime($novo_vencimento)));
}



//GERAR A CONTA A PAGAR COM A COMISSÃO DO CORRETOR CASO EXISTA
if($comissao_corretor > 0){	
	$query = $pdo->query("INSERT INTO pagar SET descricao = 'Comissão Aluguél', corretor = '$corretor', valor = '$comissao_corretor', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref = '$ult_id'");

}



require_once("../../texto_contrato_locacao.php");

//LANÇAR OS DADOS DO IMÓVEL NA TABELA DE CONTRATOS VENDA
$query = $pdo->query("INSERT INTO contrato_aluguel SET imovel = '$id', texto = '$texto_contrato', usuario = '$id_usuario', data = curDate()");



echo 'Inserido com Sucesso';
?>