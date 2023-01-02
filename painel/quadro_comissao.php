<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'quadro_comissao';

//verificar se ele tem a permissão de estar nessa página
if(@$cargos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>
<!--
 <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Cargo Comissão</button>
-->
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
					<div class="col-md-9">						
						<div class="form-group"> 
							<label>Descrição do Cargo</label> 
							<input type="text" class="form-control" name="nome" id="nome" required> 
						</div>						
					</div>
					<div class="col-md-3">						
						<div class="form-group"> 
							<label>Nr Vagas</label> 
							<input type="text" class="form-control" name="vagas" id="vagas"> 
						</div>						
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">						
						<div class="form-group"> 
							<label>Subdivisões que pertence o cargo <small class="form-text text-muted"> (Max 500 Caracteres)</small></label> 
							<textarea maxlength="500" type="text" class="form-control" name="subdivisao" id="subdivisao"> </textarea>
		<!--					<input type="text" class="form-control" name="subdivisao" id="subdivisao"> -->
						</div>						
					</div>

				</div>
				<div class="row">
					<div class="col-md-9">			
							<div class="form-group"> 
								<label>Padrão</label> 
								<select class="form-control sel2" name="idcodificacao" id="idcodificacao" required style="width:100%;"> 
									<?php 
									$query = $pdo->query("SELECT * FROM salariocomissionado order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}
											$valorF = '  R$ ' . number_format($res[$i]['valor'], 2, ',', '.');
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> - <?php echo $valorF ?></option>

									<?php } ?>

								</select>
							</div>				
						</div>
						
						<div class="col-md-3" style="margin-top:20px">						 
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