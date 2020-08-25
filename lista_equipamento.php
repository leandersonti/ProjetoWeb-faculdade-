<?php
require 'conn.php';
include_once('head.php');
include_once('topoLogo.php');
include_once('menu.php');

$limite = 10; #!!!!ATENÇÃO!!!! Esta variável define a quantidade de elementos exibidos por página na tabela //Cley
?>


<script defer src="scripts/lista_equipamento.js" type="text/javascript"></script>

<!-- <style>
	.expand-user {
		display: flex;
		padding: 10px;
		padding-bottom: 0px;
		align-items: flex-start;
		justify-content: flex-start;
	}
</style> -->

<body>
	<div id="app">
		<!-- Inputs do tipo hidden para controlar a paginação feita no JavaScript //Cley -->
		<input type="hidden" id="inputEscondido" value="1">
		<?php
		$sql = "SELECT COUNT(*) AS qtdd FROM equipamento WHERE status!=4";
		if (isset($_POST['submit'])) {
			if ($_POST['tipo'] != "")
				$sql .= " and tipo='" . $_POST['tipo'] . "'";
			if ($_POST['status'] != "")
				$sql .= " and status=" . $_POST['status'];
		}
		$consulta = mysqli_query($conn, $sql);
		$rs = mysqli_fetch_object($consulta);
		$maximo = ceil($rs->qtdd / $limite);
		?>
		<input type="hidden" id="fecharPagina" value="0">
		<input type="hidden" id="totalPaginas" value="<?php echo $maximo ?>">

		<div style="width:94%; margin:100px auto" class="panel panel-defalt">

			<!-- Formulário de FILTRO //Cley -->
			<div class="esconderUsu"></div>


			<!-- Formulario de EMPRÉSTIMO -->
			<form id="formulario_escondido" method="post" action="lotarEquipamento.php">
				<fieldset id="field">
					<legend>Emprestar Equipamento</legend>
					<div class="content-emp">
						<div class="col-emp-1 col-6">
							<input type="hidden" name="lista" value="" id="lotados">

							<div class="form-group">
								<label>Designação do empréstimo:</label>
								<br>
								<div class="radios">
									<div class="radio">
										<label for="destinoInterior">Interior</label>
										<input onfocus="exibirUnidade('i')" type="radio" name="destino" value="interior" id="destinoInterior">
									</div>

									<div class="radio">
										<label for="destinoCapital">Capital</label>
										<input onfocus="exibirUnidade('c')" type="radio" name="destino" value="capital" id="destinoCapital">
									</div>
								</div>
							</div>
							<div id="groupEmprestimo" class="form-group">
								<label>Tipo de transação:</label>
								<div class="radios2">
									<div class="radio">
										<label for="tipoDefinitivo">Definitivo</label>
										<input type="radio" name="tipoEmprestimo" value="definitivo" id="tipoDefinitivo">
									</div>

									<div class="radio">
										<label for="tipoEmprestado">Empréstimo</label>
										<input checked type="radio" name="tipoEmprestimo" value="emprestimo" id="tipoEmprestado">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div>
									<input type="checkbox" id="prazoDevolucao" onclick="exibePrazo(true)">
									<label for="prazoDevolucao">Prazo de devolução</label>
								</div>
								<div id="contPrazo" class="contPutPrazo">
									<input id="putPrazo" class="form-control" type="date" name="prazo">
								</div>
							</div>

							<div class="form-group">
								<input type="text" onblur="setMaiusculo(this)" name="responsavel" placeholder="Responsável" class="form-control" required>
							</div>

							<div class="form-group">
								<input type="text" name="dpto" placeholder="Departamento" id="putDpto" required class="form-control">

								<input type="text" id="putUnidade" name="unidade" placeholder="Unidade" class="form-control">
							</div>

							<div class="form-group">
								<textarea class="form-control" name="descricao" rows="3" placeholder="Descrição a respeito do empréstimo de equipamentos"></textarea>
							</div>
						</div>

						<div class="col-6 div-lista">
							<div class="form-group">
								<div id="lista" class="form-control"></div>
							</div>
						</div>
					</div>
					<input type="submit" name="sub_form" value="Enviar" class="btn btn-primary">
				</fieldset>
			</form>
			<!-- Fim do formulário de cadastro //Cley -->

			<!-- ******* TABELA DE LISTAGEM DE EQUIPAMENTO ******* -->
			<div id="tabelinha" class="table tabelaAlfa">



				<!-- tirar todo style e jogar no principal part1-->
				<div class="linhaB" style="margin-top:20px">

					<vs-table stripe pagination :description-items="descriptionItems" :max-items="descriptionItems[15]" search :data="Equipamentos" description>
						<template slot="header">
							<h3>
								Lista de Equipamentos
							</h3>
						</template>
						<template slot="thead">

							<vs-th sort-key="patrimonio">
								Série/Patrimônio
							</vs-th>
							<vs-th sort-key="equipamento">
								Equipamento
							</vs-th>
							<vs-th sort-key="marca">
								Marca
							</vs-th>
							<vs-th sort-key="modelo">
								Modelo
							</vs-th>
							<vs-th sort-key="status">
								Status
							</vs-th>
							<vs-th sort-key="acoes" style="text-align:center">
								<div style="margin:0px auto"> Ações</div>
							</vs-th>
						</template>

						<template slot-scope="{data}">
							<vs-tr :data="tr" :key="tr.num_serie" v-for="(tr, index) in data">

								<vs-td :id="index" :data="data[index].num_serie">
									{{data[index].num_serie}}
								</vs-td>

								<vs-td :id="'e'+index" :data="data[index].tipo">
									{{data[index].tipo}}
								</vs-td>

								<vs-td :id="'marca'+index" :data="data[index].marca">
									{{data[index].marca}}
								</vs-td>

								<vs-td :id="'modelo'+index" :data="data[index].modelo">
									{{data[index].modelo}}
								</vs-td>
								<vs-td :id="'stt'+index" :data="data[index].status">
									{{statusComp(data[index].status)}}
								</vs-td>
								<vs-td :data="data[index].num_serie" style="width: 50px">
									<div class="btn-group">

										<div :id="'lotar'+index" class="coluna icone link">

											<img src="imagens/icons/seta_que_vai.svg" class="icon" :onclick="'addList('+index+')'" v-if="data[index].status == 0">

										</div>

										<div :id="data[index].num_serie" class="editarM" data-toggle="modal" data-target="#ExemploModalCentralizado">
											<!--data-toggle="modal" data-target="#ExemploModalCentralizado"-->
											<img src="imagens/icons/edit.svg" class="icon">
										</div>

										<div :id="data[index].num_serie" class="excluirM" data-toggle="modal" data-target="#modalexcluir">
											<img src="imagens/icons/delete.svg" class="icon">
										</div>
										<div>
											<a :href="'gerarHistorico.php?serie='+data[index].num_serie">
												<img src="imagens/icons/archive.svg" class="icon">
											</a>
										</div>
									</div>


								</vs-td>

								<!-- expansivel -->
								<!-- <template class="expand-user" slot="expand" style="float:left">
									<span style="color:red;float:left">{{data[index].descricao}}</span>

								</template> -->
								<!-- fim do expansivel -->

							</vs-tr>

						</template>
					</vs-table>
				</div>

				<!-- <pre>{{ selected }}</pre> -->


			</div>

			<!-- ----------------------------------------->

			<!-- Modal editar equipamento-->

			<div class="modal fade editarN" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="TituloModalCentralizado">Editar</h5>
							<button type="button" onclick="removeMarca()" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form name="editar" class="was-validated">
							<div class="modal-body">

								<div class="alert-warning esconder" role="alert">

								</div>
								<div class="form-row">

									<div class="form-group col-md-6">
										<label for="inputCity">Número de Patrimônio/Série</label>
										<input type="text" name="num_serie" class="form-control" id="campoSerie" required>
										<div class="invalid-feedback">
											Informe o Número de Patrimônio!
										</div>
									</div>

									<div class="form-group col-md-6">
										<label for="inputEstado">Tipo</label>
										<select id="inputEstado" name="tipo" class="form-control" required>
											<option value="">Equipamento</option>
											<option value="Mouse">Mouse</option>
											<option value="Monitor">Monitor</option>
											<option value="Teclado">Teclado</option>
											<option value="Gabinete">Gabinete</option>
											<option value="Notebook">Notebook</option>
											<option value="Injetor">Injetor</option>
											<option value="Impressora">Impressora</option>
											<option value="Print Server">Print Server</option>
											<option value="Projetor">Projetor</option>
											<option value="Webcam">Webcam</option>
											<option value="Telefone">Telefone</option>
											<option value="Mini HD">Mini HD</option>
											<option value="Minicomputador">Minicomputador</option>
											<option value="Bateria para Nobreak">Bateria para Nobreak</option>
										</select>
										<div class="invalid-feedback">
											selecione o Tipo do Equipamento!
										</div>
									</div>

								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputCity">Modelo</label>
										<input type="text" name="modelo" class="form-control" id="inputCity" placeholder="Modelo do Equipamento" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputEstado">Marca</label>
										<select id="selecao" name="marca" class="form-control" required>
											<option value="">Escolher...</option>
											<option value="Dell">Dell</option>
											<option value="HP">HP</option>
											<option value="AOC">AOC</option>
											<option value="AVAYA">AVAYA</option>
											<option value="Samsung">Samsung</option>
											<option value="Logitech">Logitech</option>
											<option value="Epson">Epson</option>
											<option value="Lenovo">Lenovo</option>
											<option value="Outro">Outro</option>
										</select>
										<div class="invalid-feedback">
											selecione a Marca do Equipamento!
										</div>
									</div>
								</div>

								<!-- Campo oculto de 'outra marca'-->

								<div class="form-group" id="oculto" style="display:none">
									<!-- Só pra deixar claro que esse style na div é 100% culpa do LEANDERSON //Cley -->
									<label for="exampleFormControlTextarea1">Outros</label>
									<input type="text" name="outraMarca" class="form-control" placeholder="Marca">
								</div>

								<!-- Fim do campo oculto -->

								<div class="form-group">
									<label>Status</label>
									<select name="status" class="form-control" required>
										<option value="">Escolher...</option>
										<option value="0">Disponivel</option>
										<option value="1" disabled>Alocado</option>
										<option value="2">Defeituoso</option>
										<option value="3">Em manutenção</option>
										<option value="4" disabled>Cedido ao interior</option>
									</select>
									<div class="invalid-feedback">
										selecione a um Status
									</div>
								</div>

								<div class="form-group">
									<label for="exampleFormControlTextarea1">Descrição</label>
									<textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" placeholder="Detalhes a respeito do equipamento"></textarea>
								</div>
								<input type="hidden" title="teste" id="<?php echo $fetch->num_serie; ?>" />

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="removeMarca()">Fechar</button>
								<button type="submit" id="<?php echo $fetch->num_serie; ?>" data-dismiss="" class="btn btn-primary enveditar">Salvar mudanças</button>
							</div>
						</form>

					</div>
				</div>
			</div>

			<!--Inicio Modal excluir -->


			<div class="modal fade" tabindex="-1" role="dialog" id="modalexcluir" aria-labelledby="mySmallModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="TituloModalCentralizado">Excluir</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="alert alert-primary esconderex" role="alert">
								Confirmar Exclusão?
							</div>

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" value="1">Sim</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>

						</div>

					</div>
				</div>
			</div>
			<!--fim  Modal excluir -->



		</div>



	</div>
	<!--fim div do painel-->
	</div>
	<script src="js/vue.js"></script>
	<script src="js/vuesax.umd.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="js/axios.min.js"></script>
	<script src="js/mainVue.js"></script>
</body>

<?php
if (isset($_GET['edit'])) {
	echo "<script async>alert('Informações do equipamento editadas!')</script>";
}
if (isset($_GET['excluido'])) {
	echo "<script>alert('Equipamento excluido!')</script>";
}

if (isset($_GET['protocolo'])) {
	echo "<script>alert('O número de protocolo é " . $_GET['protocolo'] . ". Anote-o!')</script>";
}
?>

<script>
	$(function() {
		$('select[name="marca"]').change(function() {
			var valor = $(this).val();
			if (valor == "Outro") {
				$("#oculto").show(300);
			} else {
				$("#oculto").hide(300);
			}
		});
	});

	function removeMarca() {
		selecao = document.getElementById('selecao');
		marca = selecao.lastChild.innerText;
		if (marca != 'Outro')
			document.getElementById('selecao').removeChild(selecao.lastChild);
	}

	function abrir(tag) {
		let pag = document.getElementsByClassName("pgatual")[0].id.replace("btn", "");
		let pagina = document.getElementById("pg" + pag);

		altura = parseInt(pagina.style.height) + 66;
		pagina.style.height = altura + "px";

		tag.style.transform = 'rotate(90deg)';
		tag.onclick = function() {
			fechar(tag);
		};
	}

	function fechar(tag) {
		let pag = document.getElementsByClassName("pgatual")[0].id.replace("btn", "");
		let pagina = document.getElementById("pg" + pag);

		altura = parseInt(pagina.style.height) - 66;
		pagina.style.height = altura + "px";

		tag.style.transform = 'rotate(0deg)';
		tag.onclick = function() {
			abrir(tag);
		};
	}
</script>