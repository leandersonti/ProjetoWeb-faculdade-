<?php
require_once('../conn.php');

session_start();

$titulo = $_SESSION['titulo'];


//$_POST = json_decode(file_get_contents("php://input"), true);

$acao = mysqli_real_escape_string($conn, $_POST['acao']);



switch ($acao) {

		//Cadastrar Equipamento
	case 'cadastrar':
		sleep(1);

		if (isset($_POST['tipo'])) {
			// Cadastro do equipamento
			if ($_POST['tipo'] == "Outro") {
				$tipo = $_POST['tipoAlternativo'];
			} else {
				$tipo = $_POST['tipo'];
			}

			if ($_POST['marca'] == "Outro") {
				$marca = $_POST['outraMarca'];
			} else {
				$marca = $_POST['marca'];
			}

			$serie = $_POST['num_serie'];
			$serie = str_replace(" ", "", $serie);

			$status = $_POST['status'];
			$status_original = $status;
			if ($status == 4) $status = 1;

			if ($serie != "") {
				$sql = "INSERT INTO equipamento (num_serie,tipo,descricao,status,condicao_entrada,marca,modelo) VALUES ('" . $serie . "','$tipo','" . $_POST['descricao'] . "'," . $status . ",'" . $_POST['condicao_entrada'] . "','" . $marca . "','" . $_POST['modelo'] . "')";
				$consulta = mysqli_query($conn, $sql);
				if (!$consulta)
					echo 2;
			} else {
				echo 2;
			}

			// Definir equipamento como alocado caso o mesmo já esteja alocado no ato de seu cadastro
			$qtdd = '0' . $_POST['qtdd'];
			$desc = $_POST['descricao'];
			$dpto = $_POST['local_equipamento'];
			$responsavel = $_POST['responsavel'];

			$fed = -1;
			if ($status_original == 1) $fed = 0;
			else if ($status_original == 4) $fed = 1;

			if ($fed > -1) {
				do {
					$num_protocolo = date("y") . "" . $qtdd;
					$num_protocolo .= rand(0, 9);
					$num_protocolo .= rand(0, 9);
					$num_protocolo .= rand(0, 9);
					$num_protocolo .= rand(0, 9);
					$num_protocolo .= rand(0, 9);

					$protocolo = intval($num_protocolo);
					$query = "SELECT protocolo FROM emprestimo WHERE protocolo='$protocolo'";
					$rs = mysqli_query($conn, $query);
				} while (mysqli_fetch_object($rs));

				$query = "INSERT INTO emprestimo (protocolo, federacao, descricao, dt_lotacao, titulo_locador, unipto, responsavel) VALUES ('$protocolo',$fed,'$desc',now(),'$titulo','$dpto','$responsavel')";
				$insert = mysqli_query($conn, $query);
				if (!$insert) echo 2;

				$query = "INSERT INTO equipamento_emprestado (num_serie,protocolo,lot_status) VALUES ('$serie','$protocolo',0)";
				$insert = mysqli_query($conn, $query);
				if ($insert) echo 1;
				else echo 2;
			} else if ($consulta) {
				echo 1;
			}
		}
		break;

		//consulta equipamentos para listagem
	case 'consulta':

		$idedit = $_POST['idedit'];
		$sql = "SELECT * FROM equipamento WHERE num_serie ='" . $idedit . "'";
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($query);
		$st = mysqli_fetch_assoc($query);
		echo json_encode($st);
		//echo $rows;


		break;


	case 'cadastrarUsuario':

		$senha = sha1(md5($_POST['senha']));
		$dados = [$_POST['nome'], $_POST['titulo'], $senha, $_POST['nivel']];

		if (strlen($dados[1]) != 14) {
			echo 3;
		} else {
			if ($dados[3] != "") {
				$query = "INSERT INTO usuario(nome,titulo,senha,nivel) VALUES('" . $dados[0] . "','" . $dados[1] . "','" . $dados[2] . "'," . $dados[3] . ")";

				if (mysqli_query($conn, $query))
					echo 1;
				else
					echo 2;
			}
		}


		break;


	case 'consultaUsuario':

		$idedit = $_POST['ideditUsu'];
		$sql = "SELECT * FROM usuario WHERE titulo ='" . $idedit . "'";
		$query = mysqli_query($conn, $sql);
		/*if($query){
		echo "foi";
	}else{
		echo "nao foi";
	}*/
		$st = mysqli_fetch_assoc($query);
		echo json_encode($st);


		break;


		/* */
		//Editar equipamentos da listagem
	case 'editar':
		sleep(1);

		if ($_POST['marca'] == "Outro") {
			$marca = $_POST['outraMarca'];
		} else {
			$marca = $_POST['marca'];
		}

		$editID = $_POST['idserie'];
		$marca = mysqli_real_escape_string($conn, $marca);
		$tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
		$status = mysqli_real_escape_string($conn, $_POST['status']);
		$modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
		$serie = mysqli_real_escape_string($conn, $_POST['num_serie']);
		$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

		$query = "SELECT status FROM equipamento WHERE num_serie='" . $editID . "'";
		$result = mysqli_query($conn, $query);
		$statusAtual = mysqli_fetch_object($result)->status;
		if ($statusAtual == 1) {
			echo 3;
		} else {
			$sql = "UPDATE equipamento SET num_serie = '" . $serie . "',tipo = '" . $tipo . "', status=" . $status . ",marca = '" . $marca . "',modelo = '" . $modelo . "',descricao = '" . $descricao . "' WHERE num_serie ='" . $editID . "'";
			// echo $sql;
			$query = mysqli_query($conn, $sql);
			if ($query) {
				echo 1;
			} else {
				echo 2;
			}
		}

		break;
		// Fim do case Edit

	case 'editarUsuario':
		sleep(1);
		$editIDusu = $_POST['IdEditUsuario'];
		$nome = mysqli_real_escape_string($conn, $_POST['nome']);
		$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
		$nivel = mysqli_real_escape_string($conn, $_POST['nivel']);

		$sql = "UPDATE usuario SET nome = '" . $nome . "',titulo = '" . $titulo . "'
	,nivel = '" . $nivel . "'";
		if ($_POST['senha'] != "") {
			$senha = mysqli_real_escape_string($conn, sha1(md5($_POST['senha'])));
			$sql .= ", senha='" . $senha . "'";
		}

		$sql .= " WHERE titulo ='" . $editIDusu . "'";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			echo 1;
		} else {
			echo 2;
		}

		break;

	case 'deletar':
		sleep(1);
		$idexcluir = $_POST['idexcluir'];
		$flag = true;

		$query = "SELECT status FROM equipamento WHERE num_serie='" . $idexcluir . "'";
		$result = mysqli_query($conn, $query);
		if (mysqli_fetch_object($result)->status == 1) {
			$flag = false;
			echo 2;
		}

		if ($flag) {
			$sql = "DELETE FROM equipamento WHERE num_serie ='" . $idexcluir . "'";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo 1;
			} else {
				echo 2;
			}
		}


		break;

	case 'deletarUsuario':
		sleep(1);
		$idexcluirUsu = $_POST['idexcluir'];
		$sql = "DELETE FROM usuario WHERE titulo ='" . $idexcluirUsu . "'";
		$query = mysqli_query($conn, $sql);
		if ($query) {
			echo 1;
		} else {
			echo 2;
		}


		break;

	case 'Listar':
		$consulta = "SELECT * FROM EQUIPAMENTO";
		$query = mysqli_query($conn, $consulta);
		while ($linha = mysqli_fetch_assoc($query)) {
			$st[] = $linha;
		}
		echo json_encode($st);
		break;

	default:
}//fim switch
