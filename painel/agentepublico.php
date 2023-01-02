<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'agentepublico';

//verificar se ele tem a permissão de estar nessa página
if(@$imoveis == 'ocultar'){
	echo "<script>window.location='../index.php'</script>";
	exit();
}

?>

<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Agente</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<small>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados Cadastrais</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Vínculo Estadual</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Fotos e Pessoas</a>
							</li>
						</ul>
					</small>
				</h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -40px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-text">
				<div class="modal-body" style="margin-top: -20px">

					

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

							<div class="row">

								<div class="col-md-6">
									<div class="form-group"> 
										<label>Nome</label> 
										<input type="text" class="form-control" name="nome" id="nome" required> 
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>CPF</label> 
										<input type="text" class="form-control" name="cpf" id="cpf" required> 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>PIS/PASEP</label> 
										<input type="text" class="form-control" name="pispasep" id="pispasep"> 
									</div>
								</div>
								

							</div>


							<div class="row">
								<div class="col-md-3">
									<div class="form-group"> 
										<label>Carteira Identidade</label> 
										<input type="text" class="form-control" name="rg" id="rg" placeholder="Nr RG"> 
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Órgao Exp.</label> 
										<input type="text" class="form-control" name="orgexp" id="orgexp" placeholder="SSP"> 
									</div>
								</div>

								<div class="col-md-1">
									<div class="form-group"> 
										<label>UF</label> 
										<input type="text" class="form-control" name="ufrg" id="ufrg" placeholder="RR"> 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Data Exp. RG</label> 
										<input type="date" class="form-control" name="expedicaorg" id="expedicaorg" value="<?php echo date('Y-m-d') ?>" > 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Data Nascimento</label> 
										<input type="date" class="form-control" name="datanasc" id="datanasc" value="<?php echo date('Y-m-d') ?>" > 
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-2">
									<div class="form-group"> 
										<label>Habilitação</label> 
										<input type="text" class="form-control" name="cnh" id="cnh" placeholder="Nr CNH"> 
									</div>
								</div>

								<div class="col-md-1">
									<div class="form-group"> 
										<label>Catg.</label> 
										<input type="text" class="form-control" name="categoria" id="categoria" placeholder="AB"> 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Título</label> 
										<input type="text" class="form-control" name="tituloeleitor" id="tituloeleitor" placeholder="Nr Título Eleitor"> 
									</div>
								</div>

								<div class="col-md-1">
									<div class="form-group"> 
										<label>Zona</label> 
										<input type="text" class="form-control" name="zonatitulo" id="zonatitulo" placeholder="01"> 
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Seção</label> 
										<input type="text" class="form-control" name="secaotitulo" id="secaotitulo" placeholder="005"> 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Data Exp. Título</label> 
										<input type="date" class="form-control" name="expedicaotitulo" id="expedicaotitulo" value="<?php echo date('Y-m-d') ?>" > 
									</div>
								</div>
								

							</div>


							<div class="row">

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Naturalidade</label> 
										<input type="text" class="form-control" name="naturalidade" id="naturalidade" placeholder="" > 
									</div>
								</div>	

								
								<div class="col-md-3">
									<div class="form-group"> 
										<label>Nacionalidade</label> 
										<input type="text" class="form-control" name="nacionalidade" id="nacionalidade" placeholder="" > 
									</div>
								</div>



								<div class="col-md-2">						
									<div class="form-group"> 
										<label>Raça</label> 
										<select class="form-control sel2" name="racacor" id="racacor" required style="width:100%;"> 
											<option value="Pardo">Pardo</option>
											<option value="Negro">Negro</option>
											<option value="Branco">Branco</option>
											<option value="Indígena">Indígena</option>
											<option value="Amarelo">Amarelo</option>
										</select>
									</div>						
								</div>

								<div class="col-md-2">						
									<div class="form-group"> 
										<label>Sexo</label> 
										<select class="form-control sel2" name="sexo" id="sexo" required style="width:100%;"> 
											<option value="M">Masculino</option>
											<option value="F">Feminino</option>										
										</select>
									</div>						
								</div>

								<div class="col-md-2">						
									<div class="form-group"> 
										<label>Estado Civil</label> 
										<select class="form-control sel2" name="estadocivil" id="estadocivil" required style="width:100%;"> 											
											<option value="Casado">Casado</option>
											<option value="Solteiro">Solteiro</option>
											<option value="União Estável">União Estável</option>
											<option value="Viúvo">Viúvo</option>
											<option value="Divorciado">Divorciado</option>
											<option value="Separado">Separado</option>
										</select>
									</div>						
								</div>


								


							</div>

							<div class="row">

								

								<div class="col-md-4">
									<div class="form-group"> 
										<label>Endereço</label> 
										<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua e Número" > 
									</div>
								</div>

								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Cidade*</label> 
										<select class="form-control sel2" name="cidade" id="cidade" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM cidades");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>


								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Bairro*</label> 
										<div id="listar-bairros"></div>
									</div>						
								</div>

<!--
								<div class="col-md-2">
									<div class="form-group"> 
										<label>BAIRR</label> 
										<input type="text" class="form-control" name="bairro" id="bairro" > 
									</div>
								</div> 
-->
								

							</div>	


							<div class="row">

								<div class="col-md-4">
									<div class="form-group"> 
										<label>Email</label> 
										<input type="email" class="form-control" name="email" id="email" placeholder="" > 
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group"> 
										<label>CEP</label> 
										<input type="text" class="form-control" name="cep" id="cep" placeholder="" > 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Telefone Fixo</label> 
										<input maxlength="15" type="text" class="form-control" name="fone" id="fone" placeholder="" > 
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Celular</label> 
										<input maxlength="15" type="text" class="form-control" name="celular" id="celular" placeholder="" > 
									</div>
								</div>

							</div>


							<hr>
							<div align="right">
								<button type="button" id="seguinte_aba2" name="seguinte_aba2" class="btn btn-primary">Seguinte</button>
							</div>

						</div>


						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


							<div class="row">

								<div class="col-md-2" id="fed">						
									<div class="form-group"> 
										<label>Federal</label> 
										<select class="form-control sel2" name="federal" id="federal" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="efe">						
									<div class="form-group"> 
										<label>Efetivo</label> 
										<select class="form-control sel2" name="efetivo" id="efetivo" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="com">						
									<div class="form-group"> 
										<label>Comissionado</label> 
										<select class="form-control sel2" name="comissionado" id="comissionado" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="sel">						
									<div class="form-group"> 
										<label>Seletivado</label> 
										<select class="form-control sel2" name="seletivado" id="seletivado" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="ter">						
									<div class="form-group"> 
										<label>Tercerizado</label> 
										<select class="form-control sel2" name="tercerizado" id="tercerizado" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

								<div class="col-md-2" id="est">						
									<div class="form-group"> 
										<label>Estagiario</label> 
										<select class="form-control sel2" name="estagiario" id="estagiario" required style="width:100%;">
											<option value="Não">Não</option>
											<option value="Sim">Sim</option>
										</select>
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group"> 
										<label>LOTAÇÃO ATUAL</label> 
										<input type="text" class="form-control" name="setorlotado" id="setorlotado" placeholder="Informe o setor lotado" > 
									</div>
								</div>

								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Grau de Instrução</label> 
										<select class="form-control sel2" name="grauinstrucao" id="grauinstrucao" required style="width:100%;">
											<option value="Médio">Médio</option>
											<option value="Fundamental">Fundamental</option>
											<option value="Básico">Básico</option>	
											<option value="Superior">Superior</option>
											<option value="Superior incompleto">Superior incompleto</option>
											<option value="Médio incompleto">Médio incompleto</option>
											<option value="Pós graduado">Pós graduado</option>
										</select>
									</div>						
								</div>
							</div>

							<div class="row">

								<div class="col-md-4">
									<div class="form-group"> 
										<label>DADOS BANCÁRIOS</label> 
										<input type="text" class="form-control" name="banco" id="banco" placeholder="Nome Banco" > 
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label></label>
										<input type="text" class="form-control" name="agencia" id="agencia" placeholder="Agência" > 
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label></label>
										<input type="text" class="form-control" name="conta" id="conta" placeholder="Nr conta" > 
									</div>
								</div>

							</div>

							<div class="row">
								<div class="col-md-6">
									<button type="button" id="voltar_aba1" name="voltar_aba1" class="btn btn-danger">Voltar</button>
								</div>

								<div class="col-md-6" align="right">
									<button type="button" id="seguinte_aba3" name="seguinte_aba3" class="btn btn-primary">Seguinte</button>
								</div>
							</div>

						</div>


						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

							<div class="row">

								<div class="col-md-9">						
									<div class="form-group"> 
										<label>Foto</label> 
										<input type="file" name="foto" onChange="carregarImg();" id="foto">
									</div>						
								</div>
								<div class="col-md-2">
									<div id="divImg">
										<img src="images/perfil/sem-perfil.jpg"  width="100px" id="target">									
									</div>
								</div>


							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group"> 
										<label>FILIAÇÃO</label> 
										<input type="text" class="form-control" name="pai" id="pai" placeholder="Nome completo do Pai" > 
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group"> 
										<label></label> 
										<input type="text" class="form-control" name="mae" id="mae" placeholder="Nome completo da Mãe" > 
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6" id="conjug">
									<div class="form-group"> 
										<label>Cônjugue</label> 
										<input type="text" class="form-control" name="nomeconjugue" id="nomeconjugue" placeholder="Informe nome completo" > 
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Nr Dependentes</label> 
										<input type="number" class="form-control" name="qtddep" id="qtddep" placeholder="Quantidade" > 
									</div>
								</div>

								
							</div>
<!--
							<div class="row">


								<?php 
								

											$query = $pdo->query("SELECT * FROM dependente order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											$total_reg = @count($res);
											if($total_reg > 0){

													?>	
												

								<table class="table table-striped">
									<thead>
										<tr>
									    	<th scope="col">ID</th>
											<th scope="col">DEPENDENTE</th>
									        <th scope="col">CPF</th>
									        <th scope="col">PARENTESCO</th>
									    </tr>
									</thead>
									<tbody>
										<?php 
											for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){}
												$id = $res[$i]['id'];
												$nome = $res[$i]['nome'];
												$cpf = $res[$i]['cpf'];
												$dtnasc = $res[$i]['dtnasc'];
												$sexo = $res[$i]['sexo'];
												$parentesco = $res[$i]['parentesco'];
												$idagente = $res[$i]['idagente'];
										?>
									    <tr>
									      <th scope="row"><?php echo "{$id}"?></th>
									      <td><?php echo "{$nome}"?></td>
									      <td><?php echo "{$cpf}"?></td>
									      <td><?php echo "{$parentesco}"?></td>
									    </tr>
									    
									  </tbody>
									  <?php } ?>
									</table>

										
									<?php }else{?>
										Não possui nenhum Dependentes cadastrado!
									<?php } ?>

							</div>
						-->
						<div class="row">
							<div class="col-md-6">
								<button type="button" id="voltar_aba2" name="voltar_aba2" class="btn btn-danger">Voltar</button>
							</div>

							<div class="col-md-6" align="right">
								<button type="submit" id="salvar" name="salvar" class="btn btn-primary">Salvar</button>
							</div>
						</div>

					</div>

				</div>





				<br>
				<input type="hidden" name="id" id="id"> <!-- hidden -->
				<small><div id="mensagem" align="center" class="mt-3"></div></small>


			</div>






		</form>

	</div>
</div>
</div>





<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="titulo_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-5">							
						<span><b>Agente: </b></span>
						<span id="nome_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>CPF: </b></span>
						<span id="cpf_mostrar"></span>							
					</div>

					<div class="col-md-4">							
						<span><b>PIS/PASEP: </b></span>
						<span id="pispasep_mostrar"></span>
					</div>
					
				</div>	


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-4">							
						<span><b>RG: </b></span>
						<span id="rg_mostrar"></span>					
					</div>

					<div class="col-md-3">							
						<span><b>Órgão emissor: </b></span>
						<span id="orgexp_mostrar"></span>
					</div>

					<div class="col-md-2">							
						<span><b>UF: </b></span>
						<span id="ufrg_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Emissão: </b></span>
						<span id="expedicaorg_mostrar"></span>
					</div>
					
				</div>			

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>CNH: </b></span>
						<span id="cnh_mostrar"></span>							
					</div>
					<div class="col-md-2">							
						<span><b>Categoria: </b></span>
						<span id="categoria_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Raça /Cor: </b></span>
						<span id="racacor_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Sexo: </b></span>
						<span id="sexo_mostrar"></span>							
					</div>

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">

					<div class="col-md-4">							
						<span><b>Título Eleitor: </b></span>
						<span id="tituloeleitor_mostrar"></span>							
					</div>

					<div class="col-md-2">							
						<span><b>Zona: </b></span>
						<span id="zonatitulo_mostrar"></span>							
					</div>
					<div class="col-md-2">							
						<span><b>Seção: </b></span>
						<span id="secaotitulo_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Emissão tit: </b></span>
						<span id="expedicaotitulo_mostrar"></span>							
					</div>

				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-4">							
						<span><b>Data Nasc: </b></span>
						<span id="datanasc_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Natural: </b></span>
						<span id="naturalidade_mostrar"></span>							
					</div>

					<div class="col-md-4">							
						<span><b>Nacionalidade: </b></span>
						<span id="nacionalidade_mostrar"></span>							
					</div>

				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-5">							
						<span><b>Grau Instrução: </b></span>
						<span id="grauinstrucao_mostrar"></span>
					</div>
					<div class="col-md-4">							
						<span><b>Estado Civil: </b></span>
						<span id="estadocivil_mostrar"></span>							
					</div>

					<div class="col-md-3">							
						<span><b>Qtd Dependente: </b></span>
						<span id="qtddep_mostrar"></span>
					</div>

				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-8">							
						<span><b>Cônjugue: </b></span>
						<span id="nomeconjugue_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>CEP: </b></span>
						<span id="cep_mostrar"></span>
					</div>
					
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">

					<div class="col-md-6">							
						<span><b>Pai: </b></span>
						<span id="pai_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Mãe: </b></span>
						<span id="mae_mostrar"></span>
					</div>

					
				</div>




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-5">							
						<span><b>Endereço: </b></span>
						<span id="endereco_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Bairro: </b></span>
						<span id="bairro_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Cidade: </b></span>
						<span id="cidade_mostrar"></span>							
					</div>
					
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Telefone Fixo: </b></span>
						<span id="fone_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Celular: </b></span>
						<span id="celular_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Email: </b></span>
						<span id="email_mostrar"></span>							
					</div>
					
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Banco: </b></span>
						<span id="banco_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Agência: </b></span>
						<span id="agencia_mostrar"></span>
					</div>
					
					<div class="col-md-4">							
						<span><b>Conta: </b></span>
						<span id="conta_mostrar"></span>
					</div>
				</div>


			</div>


		</div>
	</div>
</div>






<!-- Modal Arquivos -->
<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
				<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-arquivos" method="post">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-8">						
							<div class="form-group"> 
								<label>Arquivo</label> 
								<input type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
							</div>	
						</div>
						<div class="col-md-4" style="margin-top:-10px">	
							<div id="divImgArquivos">
								<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
							</div>					
						</div>




					</div>

					<div class="row" style="margin-top:-40px">
						<div class="col-md-8">
							<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
						</div>

						<div class="col-md-4">										 
							<button type="submit" class="btn btn-primary">Inserir</button>
						</div>
					</div>

					<hr>

					<small><div id="listar-arquivos"></div></small>

					<br>
					<small><div align="center" id="mensagem-arquivo"></div></small>

					<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


				</div>
			</form>
		</div>
	</div>

</div>




<!-- Modal Dependentes -->
<div class="modal fade" id="modalDependente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Dependentes do Agente: <span id="nome-dependente"> </span></h4>
				<button id="btn-fechar-dependentes" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-dependentes" method="post">
				<div class="modal-body">

					<div class="row" style="margin-top:10px">
						<div class="col-md-7">
							<label>Nome</label> 
							<input type="text" class="form-control" name="nome-dep"  id="nome-dep" placeholder="Nome do dependente completo * " required>
						</div>

						<div class="col-md-5">
							<label>CPF</label> 
							<input type="text" class="form-control" name="cpf-dep"  id="cpf-dep">
						</div>

					</div>

					<div class="row" style="margin-top:10px">

						<div class="col-md-4">
							<div class="form-group">
								<label>Data Nasc.</label>
								<input type="date" class="form-control" name="dtnas-dep" id="dtnas-dep" value="<?php echo date('Y-m-d') ?>" required> 
							</div>
						</div>

						<div class="col-md-3">						
							<div class="form-group"> 
								<label>Gênero</label> 
								<select class="form-control sel2" name="sexo-dep" id="sexo-dep" required style="width:100%;">
									<option value="M">Masculino</option>
									<option value="F">Feminino</option>
								</select>
							</div>						
						</div>

						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Parentesco</label> 
								<select class="form-control sel2" name="grauparentesco-dep" id="grauparentesco-dep" required style="width:100%;">
									<option value="Filho(a)">Filho(a)</option>
									<option value="Cônjugue">Cônjugue</option>
									<option value="Pai">Pai</option>
									<option value="Mãe">Mãe</option>
									<option value="Sobrinho(a)">Sobrinho(a)</option>
									<option value="Guarda tutelar">Guarda tutelar</option>
								</select>
							</div>						
						</div>

					</div>

					<div class="row" style="margin-top:10px">
						<div class="col-md-4">										 
							<button type="submit" class="btn btn-primary">Inserir</button>
						</div>
					</div>

					<hr>

					<small><div id="listar-dependentes"></div></small>

					<br>
					<small><div align="center" id="mensagem-dependente"></div></small>

					<input type="hidden" class="form-control" name="id-dependente"  id="id-dependente">


				</div>
			</form>
		</div>
	</div>

</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {

		$('#myTab a[href="#home"]').tab('show');

		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});

		$('.sel2').select2({
			dropdownParent: $('#modalDependente')
		});


		listarBairros();

		$('#cidade').change(function(){
			listarBairros();
		});


		$('#estadocivil').change(function(){// quando o combobox pretente_programa for modificada
			if($(this).val() == 'Solteiro' || $(this).val() == 'Viúvo' || $(this).val() == 'Divorciado'){ // se o valor for igual a Fisica
				//$('#doc').mask('000.000.000-00');
				//$('#doc').attr('placeholder','CPF');
				//document.getElementById('periodogestacional').style.display = 'none';
				document.getElementById('conjug').style.display = 'none';
				
			}else if($(this).val() == 'Casado' || $(this).val() == 'União Estável'){
				document.getElementById('conjug').style.display = 'block';
			}
		});

		$('#federal').change(function(){// quando o combobox pretente_programa for modificada
			if($(this).val() == 'Sim'){ // se o valor for igual a Fisica
				//$('#doc').mask('000.000.000-00');
				//$('#doc').attr('placeholder','CPF');
				//document.getElementById('periodogestacional').style.display = 'none';
				document.getElementById('efe').style.display = 'none';
				document.getElementById('sel').style.display = 'none';
				document.getElementById('ter').style.display = 'none';
				document.getElementById('est').style.display = 'none';
				document.getElementById('com').style.display = 'block';
			}else if($(this).val() == 'Não'){
				document.getElementById('efe').style.display = 'block';
				document.getElementById('sel').style.display = 'block';
				document.getElementById('ter').style.display = 'block';
				document.getElementById('est').style.display = 'block';
				document.getElementById('com').style.display = 'block';
			}
		});

		$('#efetivo').change(function(){// quando o combobox pretente_programa for modificada
			if($(this).val() == 'Sim'){ // se o valor for igual a Fisica
				document.getElementById('fed').style.display = 'none';
				document.getElementById('sel').style.display = 'none';
				document.getElementById('ter').style.display = 'none';
				document.getElementById('est').style.display = 'none';
				document.getElementById('com').style.display = 'block';
			}else if($(this).val() == 'Não'){
				document.getElementById('fed').style.display = 'block';
				document.getElementById('sel').style.display = 'block';
				document.getElementById('ter').style.display = 'block';
				document.getElementById('est').style.display = 'block';
				document.getElementById('com').style.display = 'block';
			}
		});

		$('#comissionado').change(function(){// quando o combobox pretente_programa for modificada
			if($(this).val() == 'Sim'){ // se o valor for igual a Fisica
				
				document.getElementById('sel').style.display = 'none';
				document.getElementById('ter').style.display = 'none';
				document.getElementById('est').style.display = 'none';
				
			}else if($(this).val() == 'Não'){
				
				document.getElementById('sel').style.display = 'block';
				document.getElementById('ter').style.display = 'block';
				document.getElementById('est').style.display = 'block';
				
			}
		});

	});
</script>


<script type="text/javascript">
	$("#seguinte_aba2").click(function () {
		
		if($("#nome").val() == "" || $("#nome").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Cadastre nome do Agente Público")
		}
		else if($("#cpf").val() == "" || $("#cpf").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo CPF!!")
		}
		else if($("#cidade").val() == "" || $("#cidade").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Cidade!!")
		}
		else if($("#bairro").val() == "" || $("#bairro").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Bairro!!")
		}

		else{
			$('#myTab a[href="#profile"]').tab('show');
			$('#mensagem').text("")
		}
		
	});



	$("#voltar_aba1").click(function () {
		$('#myTab a[href="#home"]').tab('show');
		$('#mensagem').addClass('')
	});



	$("#seguinte_aba3").click(function () {
		if($("#setorlotado").val() == ""){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Lotação Atual!!")
		}	
		
		else{
			$('#myTab a[href="#contact"]').tab('show');
			$('#mensagem').text("")
		}

	});


	$("#voltar_aba2").click(function () {
		$('#myTab a[href="#profile"]').tab('show');
		$('#mensagem').addClass('')
	});

</script>



<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>







<script type="text/javascript">
	function carregarImgPrincipal() {
		var target = document.getElementById('target-principal');
		var file = document.querySelector("#foto-principal").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>




<script type="text/javascript">
	function carregarImgPlanta() {
		var target = document.getElementById('target-planta');
		var file = document.querySelector("#foto-planta").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>



<script type="text/javascript">
	function carregarImgBanner() {
		var target = document.getElementById('target-banner');
		var file = document.querySelector("#foto-banner").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>





<script type="text/javascript">
	function carregarVideo() {		
		$('#target-video').attr('src', $('#video').val());
	}
</script>



<script type="text/javascript">
	function carregarImgArquivos() {
		var target = document.getElementById('target-arquivos');
		var file = document.querySelector("#arquivo_conta").files[0];

		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if(resultado[1] === 'pdf'){
			$('#target-arquivos').attr('src', "images/pdf.png");
			return;
		}

		if(resultado[1] === 'rar' || resultado[1] === 'zip'){
			$('#target-arquivos').attr('src', "images/rar.png");
			return;
		}

		if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
			$('#target-arquivos').attr('src', "images/word.png");
			return;
		}


		if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
			$('#target-arquivos').attr('src', "images/excel.png");
			return;
		}


		if(resultado[1] === 'xml'){
			$('#target-arquivos').attr('src', "images/xml.png");
			return;
		}




		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>




<script type="text/javascript">
	$("#form-arquivos").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/arquivos.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-arquivo').text('');
				$('#mensagem-arquivo').removeClass()
				if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

	});
</script>

<script type="text/javascript">
	$("#form-dependentes").submit(function () {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/dependentes.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#mensagem-dependente').text('');
				$('#mensagem-dependente').removeClass()
				if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-dep').val('');
						$('#cpf-dep').val('');
						$('#dtnas-dep').val('');
						$('#sexo-dep').val('');
						$('#grauparentesco-dep').val('');
						//$('#arquivo_conta').val('');
						//$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarDependentes();
					} else {
						$('#mensagem-dependente').addClass('text-danger')
						$('#mensagem-dependente').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

	});
</script>


<script type="text/javascript">
	function listarDependentes(){
		var id = $('#id-dependente').val();	
		$.ajax({
			url: pag + "/listar-dependentes.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar-dependentes").html(result);
			}
		});
	}

</script>



<script type="text/javascript">
	function listarArquivos(){
		var id = $('#id-arquivo').val();	
		$.ajax({
			url: pag + "/listar-arquivos.php",
			method: 'POST',
			data: {id},
			dataType: "text",

			success:function(result){
				$("#listar-arquivos").html(result);
			}
		});
	}

</script>


<script type="text/javascript">
	function listarBairros(){
		var cidade = $('#cidade').val();
		$.ajax({
			url: pag + "/listar-bairros.php",
			method: 'POST',
			data: {cidade},
			dataType: "text",

			success:function(result){
				$("#listar-bairros").html(result);
			},

		});
	}
</script>





<script>

	$("#form-text").submit(function () {
		event.preventDefault();
    //nicEditors.findEditor('area').saveContent();
    var formData = new FormData(this);

    $.ajax({
    	url: pag + "/inserir.php",
    	type: 'POST',
    	data: formData,

    	success: function (mensagem) {
    		$('#mensagem').text('');
    		$('#mensagem').removeClass()
    		if (mensagem.trim() == "Salvo com Sucesso") {                    
    			$('#btn-fechar').click();
    			listar();
    		} else {
    			$('#mensagem').addClass('text-danger')
    			$('#mensagem').text(mensagem)
    		}

    	},

    	cache: false,
    	contentType: false,
    	processData: false,

    });

});

</script>


<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<!-- <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script> -->