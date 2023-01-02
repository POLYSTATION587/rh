<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();

echo <<<HTML
<small>
HTML;


$query = $pdo->query("SELECT * FROM agentepublico ORDER BY id ASC");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th class="esconder">id</td>
	<th>Nome Agente</th>
	<th class="esc">CPF</th> 
	<th class="esc">Telefone</th>
	<th class="esc">Lotação</th> 		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
			$nome = $res[$i]['nome'];
			$cpf = $res[$i]['cpf'];
			$pispasep = $res[$i]['pispasep'];
			$rg = $res[$i]['rg'];
			$orgexp = $res[$i]['orgexp'];
			$ufrg = $res[$i]['ufrg'];
			$expedicaorg = $res[$i]['expedicaorg'];
			$cnh = $res[$i]['cnh'];
			$categoria = $res[$i]['categoria'];
			$tituloeleitor = $res[$i]['tituloeleitor'];
			$zonatitulo = $res[$i]['zonatitulo'];
			$secaotitulo = $res[$i]['secaotitulo'];
			$expedicaotitulo = $res[$i]['expedicaotitulo'];
			$datanasc = $res[$i]['datanasc'];
			$naturalidade = $res[$i]['naturalidade'];
			$nacionalidade = $res[$i]['nacionalidade'];
			$racacor = $res[$i]['racacor'];
			$sexo = $res[$i]['sexo'];
			$grauinstrucao = $res[$i]['grauinstrucao'];
			$estadocivil = $res[$i]['estadocivil'];
			$nomeconjugue = $res[$i]['nomeconjugue'];
			$pai = $res[$i]['pai'];
			$mae = $res[$i]['mae'];
			$qtddep = $res[$i]['qtddep'];
			$endereco = $res[$i]['endereco'];
			$cidade = $res[$i]['cidade'];
			$bairro = $res[$i]['bairro'];
			$cep = $res[$i]['cep'];
			$fone = $res[$i]['fone'];
			$celular = $res[$i]['celular'];
			$email = $res[$i]['email'];
			$banco = $res[$i]['banco'];
			$agencia = $res[$i]['agencia'];
			$conta = $res[$i]['conta'];
			$federal = $res[$i]['federal'];
			$efetivo = $res[$i]['efetivo'];
			$comissionado = $res[$i]['comissionado'];
			$seletivado = $res[$i]['seletivado'];
			$tercerizado = $res[$i]['tercerizado'];
			$estagiario = $res[$i]['estagiario'];
			$setorlotado = $res[$i]['setorlotado'];
			$foto = $res[$i]['foto'];

			$expedicaorgF = implode('/', array_reverse(explode('-', $expedicaorg)));
			$expedicaotituloF = implode('/', array_reverse(explode('-', $expedicaotitulo)));
			$datanascF = implode('/', array_reverse(explode('-', $datanasc)));
			$nomeF = mb_strimwidth($nome, 0, 40, "...");

		
		$query2 = $pdo->query("SELECT * FROM cidades where id = '$cidade'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cidade = $res2[0]['nome'];
		}else{
			$nome_cidade = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_bairro = $res2[0]['nome'];
		}else{
			$nome_bairro = 'Sem Registro';
		}



		echo <<<HTML
		<tr> 
		<td class="esconder">{$id}</td>
		<td>
		<img src="images/perfil/{$foto}" width="27px" class="mr-2">
		{$nomeF}
		</td> 
		<td class="esc">{$cpf}</td>
		<td class="esc">{$celular}</td>
		<td class="esc">{$setorlotado}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$cpf}', '{$pispasep}', '{$rg}', '{$orgexp}', '{$ufrg}', '{$expedicaorg}', '{$cnh}', '{$categoria}', '{$tituloeleitor}', '{$zonatitulo}', '{$secaotitulo}', '{$expedicaotitulo}', '{$datanasc}', '{$naturalidade}', '{$nacionalidade}', '{$racacor}', '{$sexo}', '{$grauinstrucao}', '{$estadocivil}', '{$nomeconjugue}', '{$pai}', '{$mae}', '{$qtddep}', '{$endereco}', '{$cidade}', '{$bairro}', '{$cep}', '{$fone}', '{$celular}', '{$email}', '{$banco}', '{$agencia}', '{$conta}', '{$federal}', '{$efetivo}', '{$comissionado}', '{$seletivado}', '{$tercerizado}', '{$estagiario}', '{$setorlotado}', '{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$id}', '{$nome}', '{$cpf}', '{$pispasep}', '{$rg}', '{$orgexp}', '{$ufrg}', '{$expedicaorgF}', '{$cnh}', '{$categoria}', '{$tituloeleitor}', '{$zonatitulo}', '{$secaotitulo}', '{$expedicaotituloF}', '{$datanascF}', '{$naturalidade}', '{$nacionalidade}', '{$racacor}', '{$sexo}', '{$grauinstrucao}', '{$estadocivil}', '{$nomeconjugue}', '{$pai}', '{$mae}', '{$qtddep}', '{$endereco}', '{$nome_cidade}', '{$nome_bairro}', '{$cep}', '{$fone}', '{$celular}', '{$email}', '{$banco}', '{$agencia}', '{$conta}', '{$federal}', '{$efetivo}', '{$comissionado}', '{$seletivado}', '{$tercerizado}', '{$estagiario}', '{$setorlotado}', '{$foto}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>



		<a href="#" onclick="depend('{$id}', '{$nome}')" title="Inserir Dependentes"><i class="fa fa-users" style="color:#22146e"></i></a>

		<a href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>





		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		</td>  
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
	HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );



	function editar(id, nome, cpf, pispasep, rg, orgexp, ufrg, expedicaorg, cnh, categoria, tituloeleitor, zonatitulo, secaotitulo, expedicaotitulo, datanasc, naturalidade, nacionalidade, racacor, sexo, grauinstrucao, estadocivil, nomeconjugue, pai, mae, qtddep, endereco, cidade, bairro, cep, fone, celular, email, banco, agencia, conta, federal, efetivo, comissionado, seletivado, tercerizado, estagiario, setorlotado, foto){


		$('#id').val(id);
		$('#nome').val(nome); //.change();
		$('#cpf').val(cpf); //.change();
		$('#pispasep').val(pispasep); //.change();
		$('#rg').val(rg);
		$('#orgexp').val(orgexp);
		$('#ufrg').val(ufrg); //.change();
		$('#expedicaorg').val(expedicaorg); //.change();
		$('#cnh').val(cnh).change();
		$('#categoria').val(categoria);
		$('#tituloeleitor').val(tituloeleitor);
		$('#zonatitulo').val(zonatitulo);
		$('#secaotitulo').val(secaotitulo);
		$('#expedicaotitulo').val(expedicaotitulo);
		$('#datanasc').val(datanasc);
		$('#naturalidade').val(naturalidade);
		$('#nacionalidade').val(nacionalidade);
		$('#racacor').val(racacor).change();
		$('#sexo').val(sexo).change();
		$('#grauinstrucao').val(grauinstrucao).change();
		$('#estadocivil').val(estadocivil).change();
		$('#nomeconjugue').val(nomeconjugue);
		$('#pai').val(pai);
		$('#mae').val(mae);
		$('#qtddep').val(qtddep);
		$('#endereco').val(endereco);
		$('#cidade').val(cidade).change();
		$('#bairro').val(bairro).change();
		//setTimeout(function() { $( #bairro ).val(bairro).change(); }, 1000)
		$('#cep').val(cep);
		$('#fone').val(fone);
		$('#celular').val(celular);
		$('#email').val(email);
		$('#banco').val(banco);
		$('#agencia').val(agencia);
		$('#conta').val(conta);
		$('#federal').val(federal).change();
		$('#efetivo').val(efetivo).change();
		$('#comissionado').val(comissionado).change();
		$('#seletivado').val(seletivado).change();
		$('#tercerizado').val(tercerizado).change();
		$('#estagiario').val(estagiario).change();
		$('#setorlotado').val(setorlotado);
		$('#foto').val('');
		$('#target').attr('src','images/perfil/' + foto);
		//setTimeout(function() { $( #bairro ).val(bairro).change(); }, 2000);
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(id, nome, cpf, pispasep, rg, orgexp, ufrg, expedicaorgF, cnh, categoria, tituloeleitor, zonatitulo, secaotitulo, expedicaotituloF, datanascF, naturalidade, nacionalidade, racacor, sexo, grauinstrucao, estadocivil, nomeconjugue, pai, mae, qtddep, endereco, nome_cidade, nome_bairro, cep, fone, celular, email, banco, agencia, conta, federal, efetivo, comissionado, seletivado, tercerizado, estagiario, setorlotado, foto){	

		//$('#id_mostrar').text(id);
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#pispasep_mostrar').text(pispasep);
		$('#rg_mostrar').text(rg);
		$('#orgexp_mostrar').text(orgexp);
		$('#ufrg_mostrar').text(ufrg);
		$('#expedicaorg_mostrar').html(expedicaorgF);
		$('#cnh_mostrar').text(cnh);
		$('#categoria_mostrar').text(categoria);		
		$('#tituloeleitor_mostrar').text(tituloeleitor);			
		$('#zonatitulo_mostrar').text(zonatitulo);		
		$('#secaotitulo_mostrar').text(secaotitulo);
		$('#expedicaotitulo_mostrar').text(expedicaotituloF);		
		$('#datanasc_mostrar').text(datanascF);
		$('#naturalidade_mostrar').text(naturalidade);
		$('#nacionalidade_mostrar').text(nacionalidade);		
		$('#racacor_mostrar').text(racacor);			
		$('#sexo_mostrar').text(sexo);		
		$('#grauinstrucao_mostrar').text(grauinstrucao);
		$('#estadocivil_mostrar').text(estadocivil);
		$('#nomeconjugue_mostrar').text(nomeconjugue);
		$('#pai_mostrar').text(pai);
		$('#mae_mostrar').text(mae);
		$('#qtddep_mostrar').text(qtddep);
		$('#endereco_mostrar').text(endereco);
		$('#cidade_mostrar').text(nome_cidade);
		$('#bairro_mostrar').text(nome_bairro);
		$('#cep_mostrar').text(cep);
		$('#fone_mostrar').text(fone);
		$('#celular_mostrar').text(celular);
		$('#email_mostrar').text(email);
		$('#banco_mostrar').text(banco);
		$('#agencia_mostrar').text(agencia);
		$('#conta_mostrar').text(conta);
	
		
		$('#tituloModal').text('Ficha Resumida');

		$('#modalMostrar').modal('show');
	}

	function limparCampos(){

		$('#id').val('');
		$('#nome').val(''); //.change();
		$('#cpf').val(''); //.change();
		$('#pispasep').val(''); //.change();
		$('#rg').val('');
		$('#orgexp').val('');
		$('#ufrg').val(''); //.change();
		$('#expedicaorg').val(''); //.change();
		$('#cnh').val('');
		$('#categoria').val('');
		$('#tituloeleitor').val('');
		$('#zonatitulo').val('');
		$('#secaotitulo').val('');
		$('#expedicaotitulo').val('');
		$('#datanasc').val('');
		$('#naturalidade').val('');
		$('#nacionalidade').val('');
		$('#racacor').val('');
		$('#sexo').val('');
		$('#grauinstrucao').val('');
		$('#estadocivil').val('');
		$('#nomeconjugue').val('');
		$('#pai').val('');
		$('#mae').val('');
		$('#qtddep').val('');
		$('#endereco').val('');
		$('#cep').val('');
		$('#fone').val('');
		$('#celular').val('');
		$('#email').val('');
		$('#banco').val('');
		$('#agencia').val('');
		$('#conta').val('');
		$('#federal').val('');
		$('#efetivo').val('');
		$('#comissionado').val('');
		$('#seletivado').val('');
		$('#tercerizado').val('');
		$('#estagiario').val('');
		$('#setorlotado').val('');
		$('#foto').val('');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');


		$('#myTab a[href="#home"]').tab('show');
		
	}




function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}

function depend(id, nome){
    $('#id-dependente').val(id);    
    $('#nome-dependente').text(nome);
    $('#modalDependente').modal('show');
    $('#mensagem-dependente').text(''); 
    listarDependentes();   
}

</script>