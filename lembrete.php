<?php
require_once 'conn.php';
include_once('head.php');
include_once('topoLogo.php');
include_once('menu.php');

$dt_atual = date("Y-m-d");
?>
<link rel="stylesheet" type="text/css" href="css/lembretes.css">
<body>
	<div class="container">
		<div class="capital">

			<h3 class="titulo">Empréstimos vencidos ou prestes a vencer</h3>
			
			<div class="legenda">
				<div class="item-legenda">
					<div class="linha-legenda verde"></div>
					<span>1 a 7 dias restantes</span>
				</div>
				<div class="item-legenda">
					<div class="linha-legenda laranja"></div>
					<span>Vencimento hoje</span>
				</div>
				<div class="item-legenda">
					<div class="linha-legenda vermelho"></div>
					<span>Vencido</span>
				</div>
			</div>

			<?php
			$query = "SELECT * FROM equipamento_emprestado eq,emprestimo emp WHERE eq.protocolo=emp.protocolo and lot_status=0 and dt_prazo ORDER BY dt_prazo";
			$result = mysqli_query($conn,$query);
			while($fetch = mysqli_fetch_object($result))
			{
				$dt = explode("-", $dt_atual);
				$dia = intval($dt[2]);
				$mes = intval($dt[1]);

				$dt_venc = explode("-", $fetch->dt_prazo);
				$dia_venc = intval($dt_venc[2]);
				$mes_venc = intval($dt_venc[1]);


				$dpto = $fetch->unipto;
				$protocolo = $fetch->protocolo;
				$responsavel = $fetch->responsavel;

				if($fetch->federacao==0) $local = "no departamento";
				else $local = "na unidade";

				if($mes==$mes_venc)
				{
					$falta = $dia_venc - $dia;
					if ($falta == 0)
					{
						$mensagem = "O empréstimo de protocolo ".$protocolo." feito para ".$responsavel." ".$local." ".$dpto." expira hoje e os equipamentos do empréstimo devem ser devolvidos";
						$cor = "laranja";
					}
					else if($falta == 1)
					{
						$mensagem = "O empréstimo de protocolo ".$protocolo." feito para ".$responsavel." ".$local." ".$dpto." expira em 1 dia e os equipamentos do empréstimo devem ser devolvidos";
						$cor = "verde";
					}
					else if($falta < 0)
					{
						$mensagem = "O empréstimo de protocolo ".$protocolo." feito para ".$responsavel." ".$local." ".$dpto." expirou a ".($falta * -1)." dias. Lembre o responsável do setor para devolvê-los";
						$cor = "vermelho";

						if($falta == -1) $mensagem = "O empréstimo de protocolo ".$protocolo." feito para ".$responsavel." ".$local." ".$dpto." expirou a ".($falta * -1)." dia. Lembre o responsável do setor para devolvê-los";
					}
					else if ($falta <= 7)
					{
						$mensagem = "O empréstimo de protocolo ".$protocolo." feito para ".$responsavel." ".$local." ".$dpto." expira em $falta dias e os equipamentos do empréstimo devem ser devolvidos";
						$cor = "verde";
					}

				}
				?>

				<div class="mensagem <?php echo $cor ?>">
					<span><?php echo $mensagem; ?></span>
				</div>

				<?php
			}
			?>
		</div>

	</div>
</body>

</html>
<!-- host: inventario-db
user: inventario
senha: tream2019 -->