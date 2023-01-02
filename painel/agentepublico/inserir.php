<?php 
$tabela = 'agentepublico';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$pispasep = $_POST['pispasep'];
$rg = $_POST['rg'];
$orgexp = $_POST['orgexp'];
$ufrg = $_POST['ufrg'];
$expedicaorg = $_POST['expedicaorg'];
$cnh = $_POST['cnh'];
$categoria = $_POST['categoria'];
$tituloeleitor = $_POST['tituloeleitor'];
$zonatitulo = $_POST['zonatitulo'];
$secaotitulo = $_POST['secaotitulo'];
$expedicaotitulo = $_POST['expedicaotitulo'];
$datanasc = $_POST['datanasc'];
$naturalidade = $_POST['naturalidade'];
$nacionalidade = $_POST['nacionalidade'];
$racacor = $_POST['racacor'];
$sexo = $_POST['sexo'];
$grauinstrucao = $_POST['grauinstrucao'];
$estadocivil = $_POST['estadocivil'];
$nomeconjugue = $_POST['nomeconjugue'];
$pai = $_POST['pai'];
$mae = $_POST['mae'];
$qtddep = $_POST['qtddep'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$fone = $_POST['fone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$federal = $_POST['federal'];
$efetivo = $_POST['efetivo'];
$comissionado = $_POST['comissionado'];
$seletivado = $_POST['seletivado'];
$tercerizado = $_POST['tercerizado'];
$estagiario = $_POST['estagiario'];
$setorlotado = $_POST['setorlotado'];
//$ativo = $_POST['ativo'];
$id = $_POST['id'];//43
//FOTO-44 LINHA 79

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'CPF já Cadastrado, escolha Outro!';
	exit();
}

//validar email
//$query = $pdo->query("SELECT * FROM $tabela where email = '$email'");
//$res = $query->fetchAll(PDO::FETCH_ASSOC);
//$total_reg = @count($res);
//if($total_reg > 0 and $res[0]['id'] != $id){
//	echo 'Email já Cadastrado, escolha Outro!';
//	exit();
//}


//$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
//        strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
//        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
//$url = preg_replace('/[ -]+/' , '-' , $nome_novo);

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-perfil.jpg';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-perfil.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}





if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, cpf = :cpf, pispasep = :pispasep, rg = :rg, orgexp = :orgexp, ufrg = :ufrg, expedicaorg = '$expedicaorg', cnh = :cnh, categoria = :categoria, tituloeleitor = :tituloeleitor, zonatitulo = :zonatitulo, secaotitulo = :secaotitulo, expedicaotitulo = '$expedicaotitulo', datanasc = '$datanasc', naturalidade = :naturalidade, nacionalidade = :nacionalidade, racacor = '$racacor', sexo = '$sexo', grauinstrucao = '$grauinstrucao', estadocivil= '$estadocivil', nomeconjugue = :nomeconjugue, pai = :pai, mae = :mae, qtddep =:qtddep, endereco=:endereco, cidade = '$cidade', bairro = '$bairro', cep = :cep, fone = :fone, celular = :celular, email = :email, banco = :banco, agencia=:agencia, conta = :conta, federal = '$federal', efetivo='$efetivo', comissionado='$comissionado', seletivado='$seletivado', tercerizado='$tercerizado', estagiario='$estagiario', setorlotado=:setorlotado, foto = '$foto', data_cad = curDate(), ativo = 'Sim'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, cpf = :cpf, pispasep = :pispasep, rg = :rg, orgexp = :orgexp, ufrg = :ufrg, expedicaorg = '$expedicaorg', cnh = :cnh, categoria = :categoria, tituloeleitor = :tituloeleitor, zonatitulo = :zonatitulo, secaotitulo = :secaotitulo, expedicaotitulo = '$expedicaotitulo', datanasc = '$datanasc', naturalidade = :naturalidade, nacionalidade = :nacionalidade, racacor = '$racacor', sexo = '$sexo', grauinstrucao = '$grauinstrucao', estadocivil= '$estadocivil', nomeconjugue = :nomeconjugue, pai = :pai, mae = :mae, qtddep =:qtddep, endereco=:endereco, cidade = '$cidade', bairro = '$bairro', cep = :cep, fone = :fone, celular = :celular, email = :email, banco = :banco, agencia=:agencia, conta = :conta, federal = '$federal', efetivo='$efetivo', comissionado='$comissionado', seletivado='$seletivado', tercerizado='$tercerizado', estagiario='$estagiario', setorlotado=:setorlotado, foto = '$foto' WHERE id = '$id'");



}

$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":pispasep", "$pispasep");
$query->bindValue(":rg", "$rg");
$query->bindValue(":orgexp", "$orgexp");
$query->bindValue(":ufrg", "$ufrg");
$query->bindValue(":cnh", "$cnh");
$query->bindValue(":categoria", "$categoria");
$query->bindValue(":tituloeleitor", "$tituloeleitor");
$query->bindValue(":zonatitulo", "$zonatitulo");
$query->bindValue(":secaotitulo", "$secaotitulo");
$query->bindValue(":naturalidade", "$naturalidade");
$query->bindValue(":nacionalidade", "$nacionalidade");
$query->bindValue(":nomeconjugue", "$nomeconjugue");
$query->bindValue(":pai", "$pai");
$query->bindValue(":mae", "$mae");
$query->bindValue(":qtddep", "$qtddep");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":cep", "$cep");
$query->bindValue(":fone", "$fone");
$query->bindValue(":celular", "$celular");
$query->bindValue(":email", "$email");
$query->bindValue(":banco", "$banco");
$query->bindValue(":agencia", "$agencia");
$query->bindValue(":conta", "$conta");
$query->bindValue(":setorlotado", "$setorlotado");

$query->execute();
$ult_id = $pdo->lastInsertId();



//atualizar no imovel o campo url
//$query = $pdo->query("UPDATE $tabela SET url = '$url' WHERE id = '$novo_id'");

echo 'Salvo com Sucesso'; 

?>