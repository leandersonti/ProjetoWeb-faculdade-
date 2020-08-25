<?php require '../conn.php'; ?>

<?php

if($_GET['tipo']==1)
	$tabela = "tabela_equipamento.php";
else
	$tabela = "tabela_emprestimo.php";

$pagina = "<!DOCTYPE html>
<html>
<head>
	<title>Relatório</title>
	<style>
		*{font-family: sans-serif;}
		table{width: 600px;margin: 0 auto;}
		table{border: 1px solid black;}
		td{padding: 5px;}

		.centro{text-align: center;}
		.row-cond{background-color: lightblue;}
		.row-sub{background-color: lightblue;}
		.row-eqp{background-color: skyblue;font-weight: bold;}
		.row-eqp,.row-cond,.row-sub{font-size: 18px;text-align: center;}
	</style>
</head>
<body>";

if($tabela=="tabela_equipamento.php")
{
	$query = "SELECT *,COUNT(*) as total FROM equipamento GROUP BY tipo";
	$result = mysqli_query($conn,$query);
	while($rs = mysqli_fetch_object($result))
	{
		// arquivo vergonha.php possui as consultas referente aos dados das tabelas
		include 'vergonha.php';

		include $tabela;
	}
}else{
	include 'vergonha.php';
	
	include $tabela;
}

$pagina .= "
	</body>
</html>";

use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

//instanciando
$dompdf = new Dompdf();

//lendo o arquivo
$html = file_get_contents('teste.php');

//inserindo o html que queremos converter
$dompdf->load_html($pagina);

//definindo o papel e a orientação
$dompdf->setPaper('A4','portrait');

// Renderizando o HTML como PDF
$dompdf->render();

// Enviando o PDF para o browser
$dompdf->stream(
	"teste.pdf",
	array("Attachment" => false)
);

?>