<?php 
date_default_timezone_set('America/Sao_Paulo');

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/colomae/";// <-- nome bd
}

$usuario = 'geneso40_usuario';
$senha = 'colomae@2022';
$servidor = 'localhost';
//br1092.hostgator.com.br
$banco = 'geneso40_colomae';

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao conectar com o banco de dados! <br>';
	echo $e;
}


//VARIAVEIS GLOBAIS DO SISTEMA
$nome_sistema = 'Colo Mãe';
$email_adm = 'coordenacaocolodemaerr@gmail.com';



//inserir registros na tabela config
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email_adm = '$email_adm', logs = 'Sim', logo = 'logo.png', favicon = 'favicon.ico', logo_rel = 'logo.jpg', dias_limpar_logs = 40, relatorio_pdf = 'pdf' ");
}


//VARIAVEIS DE CONFIGURAÇÕES DA TABELA CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$logs = $res[0]['logs'];
$nome_sistema = $res[0]['nome'];
$email_adm = $res[0]['email_adm'];
$tel_sistema = $res[0]['telefone'];
$end_sistema = $res[0]['endereco'];
$logo = $res[0]['logo'];
$favicon = $res[0]['favicon'];
$logo_rel = $res[0]['logo_rel'];
$dias_limpar_logs = $res[0]['dias_limpar_logs'];
$relatorio_pdf = $res[0]['relatorio_pdf'];
 ?>