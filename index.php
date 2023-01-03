<?php
require_once("conexao.php");
$senha_crip = md5('123');

//CRIAR UM USUÁRIO ADMINISTRADOR CASO NÃO EXISTA NENHUM
$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg == 0) {
	$pdo->query("INSERT INTO usuarios SET nome = 'Gene Charles', cpf='446.384.422-34', email='aprendendo@gmail.com', senha_crip='$senha_crip', senha='123', nivel='Administrador', foto = 'sem-perfil.jpg', id_func = '0', ativo = 'Sim' ");
}


//inserir os cargos que geram níveis de usuários
$query = $pdo->query("SELECT * FROM cargos");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg == 0) {
	$pdo->query("INSERT INTO cargos SET nome = 'Tesoureiro'");
	$pdo->query("INSERT INTO cargos SET nome = 'Recepcionista'");
	$pdo->query("INSERT INTO cargos SET nome = 'Gestor'");
}

//inserir as codificações dos cargos-comissiocao que geram níveis dos cargos-comissao
$query = $pdo->query("SELECT * FROM codificacaocomissao");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg == 0) {
	$pdo->query("INSERT INTO codificacaocomissao SET nome = 'Cargo de Natureza Especial Superior I', sigla = 'CNETS'");
	$pdo->query("INSERT INTO codificacaocomissao SET nome = 'Cargo de Natureza Especial Superior II - III - IV', sigla = 'CNES'");
	$pdo->query("INSERT INTO codificacaocomissao SET nome = 'Cargo de Direção Superior I - II', sigla = 'CDS'");
	$pdo->query("INSERT INTO codificacaocomissao SET nome = 'Cargo de Direção Intermediária I - II - III', sigla = 'CDI'");
	$pdo->query("INSERT INTO codificacaocomissao SET nome = 'Função de Assistência Intermediária I - II', sigla = 'FAI'");
}

?>
<!DOCTYPE html>
<html>

<head>

	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/login.css" media="screen" />

	<title>
		<?php echo $nome_sistema ?>
	</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
	<link rel="icon" href="imagens/favicon.ico" type="image/x-icon">

	



</head>

<body>

	<main class="d-flex  vh-100 py-3 py-md-0">

		<div class="container h-100">
			<div class="d-flex justify-content-center h-100">
				<div class="user_card">

					<div class="d-flex justify-content-center">
						<div class="brand_logo_container">
							<img src="imagens/logo2.png" class="brand_logo" alt="Logo">
						</div>
					</div>

					<div class="d-flex justify-content-center form_container">

						<form id="form" action="autenticar.php" method="post">

							<div class="input-group mb-3">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-user-circle"></i></span>
								</div>
								<input type="text" id="cpfcnpj" name="usuario" class="form-control input_user"
									placeholder="CPF" required>
							</div>


							<div class="input-group mb-3">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
								<input type="password" id="senha" name="senha" class="form-control input_user"
									placeholder="Senha" required>
							</div>

							<div class="d-flex justify-content-center mt-3 login_container">
								<button type="submit" name="login" id="login" class="btn login_btn">Login</button>
							</div>

						</form>

					</div>

					<div class="mt-4">
						<div class="d-flex justify-content-center links">
							<a class="small text-muted" href="#" data-bs-toggle="modal"
								data-bs-target="#modalRecuperar">Recuperar Senha?</a>
						</div>
					</div>

				</div>
			</div>
		</div>


	</main>


	
	<script src="https://unpkg.com/imask"></script>
	<script type="text/javascript" src="js/login.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>

</html>



<!-- Modal -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="form-recuperar" method="POST">
				<div class="modal-body">
					<input type="email" id="email" name="email" class="form-control form-control-lg" required
						placeholder="Digite seu email de Cadastro" />
					<br>
					<small>
						<div align="center" id="mensagem"></div>
					</small>
				</div>
				<div class="modal-footer">

					<button type="submit" class="btn btn-secondary">Recuperar</button>
				</div>
			</form>
		</div>

	</div>
</div>




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">
	$("#form-recuperar").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "recuperar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem').removeClass()
				$('#mensagem').addClass('text-info')
				$('#mensagem').text("Enviando!!")

				if (mensagem.trim() === 'Senha Enviada para o Email!') {

					$('#mensagem').addClass('text-success')

					$('#email').val('');

					$('#mensagem').text(mensagem)
					//$('#btn-fechar').click();
					//location.reload();


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