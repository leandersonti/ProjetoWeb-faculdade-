<?php
require 'conn.php';

session_start();
if(!isset($_SESSION['titulo']))
{
	header("Location: index.php");
	exit();
}

$serie = $_GET['serie'];
$protocolo = $_GET['prot'];
$local = $_GET['local'];
$titulo = $_SESSION['titulo'];
// echo "$serie - $protocolo";

$sql = "UPDATE equipamento_emprestado SET lot_status=1, titulo_receptor='$titulo', dt_devolucao=now() WHERE protocolo='$protocolo' and num_serie='$serie'";
mysqli_query($conn,$sql);
if($local=='capital')
	header("Location: lista_lotacao_cap.php?ok=1");
else
	header("Location: lista_lotacao_int.php?ok=1");

$sql = "UPDATE equipamento SET status=0 WHERE num_serie=".$serie;
mysqli_query($conn,$sql);

?>