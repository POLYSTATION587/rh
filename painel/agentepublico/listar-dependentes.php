<?php 
require_once("../../conexao.php");
$pagina = 'dependente';
$id = $_POST['id'];

echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM $pagina where idagente = '$id' order by nome desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela_dependentes">
		<thead> 
			<tr> 				
				<th>Nome</th>
				<th>CPF</th>
				<th class="esc">Data Nasc</th>				
				<th class="esc">Gênero</th>				
				<th>Parentesco</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$nome = $res[$i]['nome'];
$cpf = $res[$i]['cpf'];
$datanasc = $res[$i]['datanasc'];
$sexo = $res[$i]['sexo'];
$parentesco = $res[$i]['parentesco'];


$datanascF = implode('/', array_reverse(explode('-', $datanasc)));

echo <<<HTML
			<tr>					
				<td class="">{$nome}</td>
				<td class="">{$cpf}</td>
				<td class="esc">{$datanascF}</td>
				<td class="esc">{$sexo}</td>
				<td class="">{$parentesco}</td>
				<td class="">
					<li class="dropdown head-dpdn2" style="display: inline-block;">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-trash-o text-danger"></i></a>
						<ul class="dropdown-menu">
							<li>
								<div class="notification_desc2">
									<p>Confirmar Exclusão? <a href="#" onclick="excluirDependente('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
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
	</table>
</small>
HTML;
}else{
	echo 'Não possui nenhum arquivo cadastrado!';
}

?>


<script type="text/javascript">


	


	function excluirDependente(id, nome){
    
    $.ajax({
        url: "dependentes/excluir-dependente.php",
        method: 'POST',
        data: {id, nome},
        dataType: "text",

        success: function (mensagem) {
            $('#mensagem-dependente').text('');
            $('#mensagem-dependente').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {                
                listarDependentes();                
            } else {

                $('#mensagem-dependente').addClass('text-danger')
                $('#mensagem-dependente').text(mensagem)
            }


        },      

    });
}


</script>


