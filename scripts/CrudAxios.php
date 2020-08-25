<?php
require_once('../conn.php');

session_start();

$titulo = $_SESSION['titulo'];


$_POST = json_decode(file_get_contents("php://input"), true);

$acao = mysqli_real_escape_string($conn, $_POST['acao']);

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';



switch ($acao) {
    case 'Listar':
        $consulta = "SELECT * FROM EQUIPAMENTO";
        $query = mysqli_query($conn, $consulta);
        while ($linha = mysqli_fetch_assoc($query)) {
            $st[] = $linha;
        }
        echo json_encode($st);
        break;

    case 'Editar':
        $consulta = "UPDATE EQUIPAMENTO SET MARCA = '$marca',MODELO = '$modelo',TIPO = '$tipo' WHERE ID = '$id'";
        $query = mysqli_query($conn, $consulta);
        if ($query) {
            echo 1;
        } else {
            echo 2;
        }
        break;

    default:
}
