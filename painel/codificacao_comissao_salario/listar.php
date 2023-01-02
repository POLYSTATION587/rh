<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM salariocomissionado ORDER BY id ASC");//desc
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 
				<th>ID</th> 
				<th>Nome</th> 
				<th>Valor(R$)</th> 
				<th>Sigla</th> 
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$valor = $res[$i]['valor'];
	$idsigla = $res[$i]['idsigla'];

	$valorF = number_format($valor, 2, ',', '.');


	$query2 = $pdo->query("SELECT * FROM codificacaocomissao where id = '$idsigla'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){
		$nome_sigla = $res2[0]['sigla'];
		$nome_descricao = $res2[0]['nome'];
	}else{
		$nome_sigla = 'Sem Sigla';
		$nome_descricao = 'Sem descrição';
	}

echo <<<HTML
			<tr> 
				<td>{$id}</td> 
				<td>{$nome}</td>
				<td>{$valorF}</td>
				<td>{$nome_sigla} - {$nome_descricao}</td>
				<td>
					<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$valor}', '{$idsigla}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
					
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



	function editar(id, nome, valor, idsigla){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#valor').val(valor);
		$('#idsigla').val(idsigla);
		
		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#valor').val('');
		$('#idsigla').val('');		
	}

</script>



