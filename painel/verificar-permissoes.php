<?php 
$home = 'ocultar';
$cargos = 'ocultar';
$tipos = 'ocultar';
$cidades = 'ocultar';
$bairros = 'ocultar';
$contas_banco = 'ocultar';
$frequencias = 'ocultar';
$acessos = 'ocultar';
$imoveis = 'ocultar';
$imoveis_venda = 'ocultar';
$imoveis_locacao = 'ocultar';
$imoveis_vendidos = 'ocultar';
$imoveis_alugados = 'ocultar';
$imoveis_inativos = 'ocultar';
$funcionarios = 'ocultar';
$vendedores = 'ocultar';
$compradores = 'ocultar';
$locatarios = 'ocultar';
$usuarios = 'ocultar';
$agenda = 'ocultar';
$tarefas = 'ocultar';
$pagar = 'ocultar';
$receber = 'ocultar';
$movimentacoes = 'ocultar';
$comissoes = 'ocultar';
$vendas = 'ocultar';
$alugueis = 'ocultar';
$rel_movimentacoes = 'ocultar';
$rel_comissoes = 'ocultar';
$rel_vendas = 'ocultar';
$rel_alugueis = 'ocultar';
$rel_contas_pagar = 'ocultar';
$rel_contas_receber = 'ocultar';
$recibos_pagamento = 'ocultar';
$proposta_compra = 'ocultar';
$proposta_locacao = 'ocultar';
$laudos = 'ocultar';
$vendas_juridico = 'ocultar';
$alugueis_juridico = 'ocultar';
$configuracoes = 'ocultar';

$menu_cadastros = 'ocultar';
$menu_imoveis = 'ocultar';
$menu_pessoas = 'ocultar';
$menu_financeiro = 'ocultar';
$menu_rel_financeiros = 'ocultar';
$menu_contratos = 'ocultar';

$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];



		if($chave == 'home'){
			$home = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'tipos'){
			$tipos = '';
		}

		if($chave == 'cidades'){
			$cidades = '';
		}

		if($chave == 'bairros'){
			$bairros = '';
		}

		if($chave == 'contas_banco'){
			$contas_banco = '';
		}

		if($chave == 'frequencias'){
			$frequencias = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}

		if($chave == 'imoveis'){
			$imoveis = '';
		}

		if($chave == 'imoveis_venda'){
			$imoveis_venda = '';
		}

		if($chave == 'imoveis_locacao'){
			$imoveis_locacao = '';
		}

		if($chave == 'imoveis_vendidos'){
			$imoveis_vendidos = '';
		}

		if($chave == 'imoveis_alugados'){
			$imoveis_alugados = '';
		}

		if($chave == 'imoveis_inativos'){
			$imoveis_inativos = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'vendedores'){
			$vendedores = '';
		}

		if($chave == 'compradores'){
			$compradores = '';
		}

		if($chave == 'locatarios'){
			$locatarios = '';
		}

		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'agenda'){
			$agenda = '';
		}

		if($chave == 'tarefas'){
			$tarefas = '';
		}

		if($chave == 'pagar'){
			$pagar = '';
		}

		if($chave == 'receber'){
			$receber = '';
		}

		if($chave == 'movimentacoes'){
			$movimentacoes = '';
		}


		if($chave == 'comissoes'){
			$comissoes = '';
		}


		if($chave == 'vendas'){
			$vendas = '';
		}

		if($chave == 'alugueis'){
			$alugueis = '';
		}

		if($chave == 'rel_movimentacoes'){
			$rel_movimentacoes = '';
		}

		if($chave == 'rel_comissoes'){
			$rel_comissoes = '';
		}

		if($chave == 'rel_vendas'){
			$rel_vendas = '';
		}

		if($chave == 'rel_alugueis'){
			$rel_alugueis = '';
		}

		if($chave == 'rel_contas_pagar'){
			$rel_contas_pagar = '';
		}

		if($chave == 'rel_contas_receber'){
			$rel_contas_receber = '';
		}

		if($chave == 'recibos_pagamento'){
			$recibos_pagamento = '';
		}

		if($chave == 'proposta_compra'){
			$proposta_compra = '';
		}

		if($chave == 'proposta_locacao'){
			$proposta_locacao = '';
		}

		if($chave == 'laudos'){
			$laudos = '';
		}

		if($chave == 'vendas_juridico'){
			$vendas_juridico = '';
		}

		if($chave == 'alugueis_juridico'){
			$alugueis_juridico = '';
		}

		if($chave == 'configuracoes'){
			$configuracoes = '';
		}



	}
}


if($cargos != 'ocultar' || $tipos != 'ocultar' || $cidades != 'ocultar' || $bairros != 'ocultar' || $contas_banco != 'ocultar' || $frequencias != 'ocultar' || $acessos != 'ocultar'){
	$menu_cadastros = '';
}


if($imoveis != 'ocultar' || $imoveis_venda != 'ocultar' || $imoveis_locacao != 'ocultar' || $imoveis_vendidos != 'ocultar' || $imoveis_alugados != 'ocultar' || $imoveis_inativos != 'ocultar'){
	$menu_imoveis = '';
}





if($funcionarios != 'ocultar' || $vendedores != 'ocultar' || $compradores != 'ocultar' || $locatarios != 'ocultar' || $usuarios != 'ocultar'){
	$menu_pessoas = '';
}


if($pagar != 'ocultar' || $receber != 'ocultar' || $movimentacoes != 'ocultar' || $comissoes != 'ocultar' || $vendas != 'ocultar' || $alugueis != 'ocultar'){
	$menu_financeiro = '';
}


if($rel_movimentacoes != 'ocultar' || $rel_comissoes != 'ocultar' || $rel_vendas != 'ocultar' || $rel_alugueis != 'ocultar' || $rel_contas_pagar != 'ocultar' || $rel_contas_receber != 'ocultar' || $recibos_pagamento != 'ocultar'){
	$menu_rel_financeiros = '';
}


if($proposta_compra != 'ocultar' || $proposta_locacao != 'ocultar' || $laudos != 'ocultar' || $vendas_juridico != 'ocultar' || $alugueis_juridico != 'ocultar'){
	$menu_contratos = '';
}

if($home != 'ocultar'){
	$pagina_inicial = 'home';
}else if($agenda != 'ocultar'){
	$pagina_inicial = 'agenda';
}else{

	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){	
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pagina_inicial = $res2[0]['chave'];		

	}

}

 ?>