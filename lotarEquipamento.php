<?php

session_start();
if(!isset($_SESSION['titulo']))
{
	header("Location: index.php");
	exit();
}

$titulo = $_SESSION['titulo'];
$prazo = "null";
if ($_POST['prazo']!="")
	$prazo = "'".$_POST['prazo']."'";
print_r($prazo);
?>

<?php require 'conn.php'; ?>
<?php

if (isset($_POST['sub_form']))
{
	$lista = $_POST['lista'];
	$nums_serie = explode(";", $lista);
	$tam = count($nums_serie);
	$flag = true;

	// O laço verifica se todos os equipamentos selecionados estão mesmo disponiveis
	for ($i=0; $i < $tam-1; $i++)
	{
		$query = "SELECT * FROM equipamento WHERE num_serie='".$nums_serie[$i]."'";
		$result = mysqli_query($conn,$query);
		$fetch = mysqli_fetch_object($result);
		if($fetch->status!=0)
			$flag = false;
	}

	$protocolo=0;

	// O bloco de codigo abaixo gera um protocolo de lotação
	if($flag)
	{
		$q = $tam-1;
		if($q<10)
			$qtdd = "0".$q;
		else
			$qtdd = $q;
		do
		{
			$num_protocolo = date("y")."".$qtdd;
			$num_protocolo .= rand(0,9);
			$num_protocolo .= rand(0,9);
			$num_protocolo .= rand(0,9);
			$num_protocolo .= rand(0,9);
			$num_protocolo .= rand(0,9);

			$protocolo = intval($num_protocolo);

			// A consulta certifica de que o protocolo nunca foi usado antes
			$sql="SELECT protocolo FROM emprestimo WHERE protocolo = '".$protocolo."'";

			$consulta = mysqli_query($conn,$sql);
		}while(mysqli_fetch_object($consulta));

		$responsavel = $_POST['responsavel'];
		$dpto = $_POST['dpto'];
		$unidade = $_POST['unidade'];
		$desc = $_POST['descricao'];
	}

	if(isset($_POST['destino']) && $_POST['destino']=="interior")
	{
		if($flag)
		{
			if($unidade!="")
			{
				if($_POST['tipoEmprestimo']=="definitivo")
				{
					for ($i=0; $i < $tam-1; $i++)
					{
						$query = "INSERT INTO definitivo_interior (def_num_serie,unidade,responsavel,data,descricao) VALUES ('".$nums_serie[$i]."','".$unidade."','".$responsavel."',now(),'".$desc."')";

						mysqli_query($conn,$query);

						$query = "UPDATE equipamento SET status=4 WHERE num_serie='".$nums_serie[$i]."'";
						mysqli_query($conn,$query);
					}

					echo "<script>alert('O número de protocolo da lotação é: ".$protocolo.". Anote-o!')</script>";

				}else if($_POST['tipoEmprestimo']=='emprestimo'){
					$query = "INSERT INTO emprestimo (protocolo,responsavel,unipto,descricao, dt_lotacao, dt_prazo, titulo_locador, federacao) VALUES ('".$protocolo."','".$responsavel."','".$unidade."','".$desc."',now(),".$prazo.",'".$titulo."',1)";
					mysqli_query($conn,$query);

					for ($i=0; $i < $tam-1; $i++)
					{
						$query = "INSERT INTO equipamento_emprestado (num_serie, protocolo, lot_status) VALUES ('".$nums_serie[$i]."','".$protocolo."',0)";
						mysqli_query($conn,$query);

						$query = "UPDATE equipamento SET status=1 WHERE num_serie='".$nums_serie[$i]."'";
						mysqli_query($conn,$query);
					}

					echo "<script>alert('O equipamento foi direcionado à unidade de destino solicitada')</script>";
				}
			}else{
				echo "<script>alert('Informe a unidade de destino no campo UNIDADE')</script>";
			}
			// header('Location: lista_equipamento.php');
		}
	}else if((isset($_POST['destino']) && $_POST['destino']=="capital")|| !isset($_POST['destino']))
	{
		if($flag)
		{
			if($dpto!=""){
				$query = "INSERT INTO emprestimo (protocolo,responsavel,unipto,descricao, dt_lotacao, dt_prazo, titulo_locador, federacao) VALUES ('".$protocolo."','".$responsavel."','".$dpto."','".$desc."',now(),".$prazo.",'".$titulo."',0)";
				mysqli_query($conn,$query);

				for ($i=0; $i < $tam-1; $i++)
				{
					$query = "INSERT INTO equipamento_emprestado (num_serie, protocolo, lot_status) VALUES ('".$nums_serie[$i]."','".$protocolo."',0)";
					mysqli_query($conn,$query);

					$query = "UPDATE equipamento SET status=1 WHERE num_serie='".$nums_serie[$i]."'";
					mysqli_query($conn,$query);
				}

				echo "<script>alert('O número de protocolo da lotação é: ".$protocolo.". Anote-o!')</script>";
			}else{
				echo "<script>alert('Preencha todos os campos')</script>";
			}
		}else{
			echo "<script>alert('Todos os equipamentos selecionados devem está disponiveis')</script>";
		}
	}
	if($protocolo==0)
		header('Location: lista_equipamento.php?');
	else
		header('Location: lista_equipamento.php?protocolo='.$protocolo);
}
?>