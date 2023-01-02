<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'contas_banco';

//verificar se ele tem a permissão de estar nessa página
if(@$contas_banco == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

 ?>
<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Conta</button>

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
					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Nome</label> 
							<input type="text" class="form-control" name="nome" id="nome" required> 
						</div>						
					</div>

					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Banco</label> 
							<input type="text" class="form-control" name="banco" id="banco" required> 
						</div>						
					</div>					

				</div>

				<div class="row">
					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Conta</label> 
							<input type="text" class="form-control" name="conta" id="conta" required> 
						</div>						
					</div>

					<div class="col-md-6">						
						<div class="form-group"> 
							<label>Agência</label> 
							<input type="text" class="form-control" name="agencia" id="agencia" required> 
						</div>						
					</div>					

				</div>
				
				<br>
				<input type="hidden" name="id" id="id"> 
				<small><div id="mensagem" align="center" class="mt-3"></div></small>					

			</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>

			
			
			</form>

		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

