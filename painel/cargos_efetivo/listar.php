<?php 
require_once("../../conexao.php");

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM cargos_efetivo ORDER BY id ASC"); //desc
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 
				<th class="esc">ID</th> 
				<th>Nome</th>
				<th>Nível</th>
				<th class="esc">Escolaridade</th>						
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$nivel = $res[$i]['nivel'];
$escolaridade = $res[$i]['escolaridade'];
$curso = $res[$i]['curso'];
$atribuicoes = $res[$i]['atribuicoes'];

//retirar quebra de texto do atribuicoes
$atribuicoes = str_replace(array("\n", "\r"), ' + ', $atribuicoes);

/*
$query2 = $pdo->query("SELECT * FROM salariocomissionado where id = '$idcodificacao'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$cod_padrao = $res2[0]['nome'];
	$valor_padrao = '  R$ ' . number_format($res2[0]['valor'], 2, ',', '.');
}else{
	$cod_padrao = 'Sem Padrão';
	$valor_padrao = 'Sem valor';
}
*/

echo <<<HTML
			<tr> 
				<td class="esc">{$id}</td> 
				<td title="$atribuicoes">{$nome}</td>
				<td>{$nivel}</td>
				<td class="esc">{$escolaridade}</td>				
				<td>
					<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$nivel}', '{$escolaridade}', '{$curso}', '{$atribuicoes}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>
					
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



	function editar(id, nome, nivel, escolaridade, curso, atribuicoes){

		for (let letra of atribuicoes){  				
			if (letra === '+'){
				atribuicoes = atribuicoes.replace(' +  + ', '\n')
			}			
		}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#nivel').val(nivel).change();
		$('#escolaridade').val(escolaridade);
		$('#curso').val(curso);
		$('#atribuicoes').val(atribuicoes);

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#nivel').val('');
		$('#escolaridade').val('');
		$('#curso').val('');
		$('#atribuicoes').val('');
	}

</script>



