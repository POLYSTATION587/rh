<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM cargos_comissao ORDER BY id ASC"); //desc
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 
				<th class="esc">ID</th> 
				<th>Descrição<small> / Subdivisão</small></th>
				<th class="esc">Salário</th>
				<th class="esc">Padrão</th>
				<th>Vagas</th>
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$vagas = $res[$i]['vagas'];
$ocupado = $res[$i]['ocupado'];
$vazio = $res[$i]['vazio'];
$subdivisao = $res[$i]['subdivisao'];
$idcodificacao = $res[$i]['idcodificacao'];

//retirar quebra de texto do subdivisao
$subdivisao = str_replace(array("\n", "\r"), ' + ', $subdivisao);
//$subdivisaoF = str_replace(array(' + '), "\n", "\r", $subdivisao);


$query2 = $pdo->query("SELECT * FROM salariocomissionado where id = '$idcodificacao'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$cod_padrao = $res2[0]['nome'];
	$valor_padrao = '  R$ ' . number_format($res2[0]['valor'], 2, ',', '.');
}else{
	$cod_padrao = 'Sem Padrão';
	$valor_padrao = 'Sem valor';
}


echo <<<HTML
			<tr> 
				<td class="esc">{$id}</td> 
				<td title="$subdivisao">{$nome}</td>
				<td class="esc">{$valor_padrao}</td>
				<td class="esc">{$cod_padrao}</td>
				<td>{$vagas}</td>
				<td>
					<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$vagas}', '{$subdivisao}', '{$idcodificacao}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
					
					<!--
					<li class="dropdown head-dpdn2" style="display: inline-block;">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

						<ul class="dropdown-menu" style="margin-left:-230px;">
							<li>
								<div class="notification_desc2">
									<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
								</div>
							</li>										
						</ul>

									
					</li>-->
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



	function editar(id, nome, vagas, subdivisao, idcodificacao){

		for (let letra of subdivisao){  				
			if (letra === '+'){
				subdivisao = subdivisao.replace(' +  + ', '\n')
			}			
		}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#vagas').val(vagas);
		$('#subdivisao').val(subdivisao);
		$('#idcodificacao').val(idcodificacao);

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#vagas').val('');
		$('#subdivisao').val('');
		$('#idcodificacao').val('');
	}
	

</script>



