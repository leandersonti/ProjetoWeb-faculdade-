<?php
require 'conn.php';
include_once('head.php');
include_once('topoLogo.php');
// include_once('menu.php');
session_start();

?>

<script type="text/javascript" src="js/scriptLogin.js" async></script>

<body id="body">
	<div id="app">
		<div style="width:max-content; padding:40px;margin:100px auto" class="panel panel-defalt">
			<form method="post" name="loginUsuario">
				<label class="title">
					<img src="imagens/Tre.png" id="brasao">
					Área restrita
				</label>
				<div class="esconderUsu"></div>
				<div class="form-group form-row">
					<input type="text" name="titulo" class="form-control" placeholder="Título de Eleitor" onkeydown="fMasc(this,mNUM)" minlength="14" maxlength="14" required>
				</div>
				<div class="form-group form-row">
					<input type="password" name="senha" class="form-control" placeholder="Senha" required>
				</div>
				<div class="form-row">
					<input type="submit" name="login" value="Login" class="btn btn-primary form-control">
				</div>
			</form>
		</div>
		<!-- <vs-row vs-justify="center" style="margin-top:100px">
			<vs-col type="flex" vs-justify="center" vs-align="center" vs-w="4">
				<vs-card actionable class="cardx" style="height: 300px">
					<div slot="header">
						<div slot="media">
							<img src="imagens/Tre.png" id="brasao"> <span>Área Restrita</span>
						</div>
					</div>

					<div style="display:flex;justify-content:center">
						<form method="post" name="loginUsuario">

							<div class="esconderUsu"></div>
							<div class="form-group form-row" style="width:300px;margin-top:10px">
								<input type="text" name="titulo" class="form-control" placeholder="Título de Eleitor" onkeydown="fMasc(this,mNUM)" minlength="14" maxlength="14" required>
							</div>
							<div class="form-group form-row">
								<input type="password" name="senha" class="form-control" placeholder="Senha" required>
							</div>
							<div class="form-row">

							</div>
						</form>
					</div>
					<div slot="footer">
						<vs-row vs-justify="center">
							<vs-button color="primary" type="gradient">Entrar</vs-button>
							<vs-button color="warning" type="gradient" style="margin-left:10px">Limpar</vs-button>
						</vs-row>
					</div>
				</vs-card>
			</vs-col>
		</vs-row>


	</div>

	<script src="js/vue.js"></script>
	<script src="js/vuesax.umd.min.js"></script>
	<script assync>
		const vm = new Vue({
			el: "#app",
		})
	</script> -->

		<script type="text/javascript">
			function fMasc(objeto, mascara) {
				obj = objeto;
				masc = mascara;
				setTimeout("fMascEx()", 1);
			}

			function fMascEx() {
				obj.value = masc(obj.value);
			}

			function mNUM(num) {
				num = num.replace(/\D/g, "");
				num = num.replace(/(\d{4})(\d)/, "$1 $2");
				num = num.replace(/(\d{4})(\d)/, "$1 $2");
				// num=num.replace(/(\d{4})(\d)/,"$1 $2");
				return num;
			}
		</script>

</body>

</html>