<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'codificacao_comissao_salario';

//verificar se ele tem a permissão de estar nessa página
if(@$cargos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>

 <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Padrão</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
			<div class="modal-body">

				<div class="row">
					<div class="col-md-4">						
						<div class="form-group"> 
							<label>Padrão</label> 
							<input type="text" class="form-control" name="nome" id="nome" required> 
						</div>						
					</div>
					<div class="col-md-3">						
						<div class="form-group"> 
							<label>Valor</label> 
							<input type="text" class="form-control" name="valor" id="valor"> 
						</div>						
					</div>

					<div class="col-md-5">			
							<div class="form-group"> 
								<label>Sigla</label> 
								<select class="form-control sel2" name="idsigla" id="idsigla" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM codificacaocomissao order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>">
											<?php echo $res[$i]['sigla'] ?>-<?php echo $res[$i]['nome'] ?>
										</option>

									<?php } ?>

								</select>
							</div>				
						</div>

				</div>
				
				<div class="row">
					
						
						<div class="col-md-4" style="margin-top:20px">						 
							<button type="submit" class="btn btn-primary">Salvar</button>
						</div>
						
					</div>
				

				
				<br>
				<input type="hidden" name="id" id="id"> 
				<small><div id="mensagem" align="center" class="mt-3"></div></small>					

			</div>

			
			
			</form>

		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>