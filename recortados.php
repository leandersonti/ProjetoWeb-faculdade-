<!-- parte 1 -->
<div class="linha cor<?php echo $cor; ?>">
    <div id="<?php echo $i; ?>" class="coluna serie link">
        <?php $mostra = $fetch->descricao;
        if ($mostra != null) echo "<div style='float:left;margin-top:5px' ><img id='imgrotate' style='width:12px;' src='imagens/icons/next.svg' data-toggle='collapse' data-target='#collapse$i' onclick='abrir(this)' /></div>"
        ?><div><?php echo $fetch->num_serie; ?></div>
    </div>

    <div id="e<?php echo $i; ?>" class="coluna maior link">
        <?php echo $fetch->tipo; ?>
    </div>
    <div id="marca<?php echo $i; ?>" class="coluna menor link">
        <?php echo $fetch->marca; ?>
    </div>
    <div id="modelo<?php echo $i; ?>" class="coluna link">
        <?php echo $fetch->modelo; ?>
    </div>
    <div id="stt<?php echo $i ?>" class="coluna">
        <?php echo $status; ?>
    </div>
    <div id="lotar<?php echo $i; ?>" class="coluna icone link" onclick="addList(<?php echo $i; ?>)">
        <?php
        if ($s == 0) {
        ?>
            <img src="imagens/icons/seta_que_vai.svg" class="icon">
        <?php
        }
        ?>
    </div>
    <!--editar equipamento-->
    <div id="<?php echo $fetch->num_serie; ?>" class="coluna icone link editarM <?php echo $tipo_user; ?>" data-toggle="modal" data-target="#ExemploModalCentralizado">
        <img src="imagens/icons/edit.svg" class="icon">
    </div>
    <!--excluir equipamento-->
    <div id="<?php echo $fetch->num_serie; ?>" class="coluna icone link excluirM <?php echo $tipo_user; ?>" data-toggle="modal" data-target="#modalexcluir">
        <img src="imagens/icons/delete.svg" class="icon">
    </div>
    <!-- histórico do equipamento -->
    <div class="coluna icone link">
        <a href="gerarHistorico.php?serie=<?php echo $fetch->num_serie; ?>">
            <img src="imagens/icons/archive.svg" class="icon">
        </a>
    </div>
</div>
<!-- Container da descrição do equipamento-->
<div class="collapse" id="<?php echo 'collapse' . $i ?>">
    <div class="card card-body">
        <span style="margin-left: 30px"><?php echo $fetch->descricao; ?></span>
    </div>
</div>



<?php
					$i++;
					if ($i % $limite == 0) {
						echo "</div>";
						$pg++;
					}
				}
                ?>
                

                <div class="paginacao">
				<div onclick="back()" class="btn btn-primary">Anterior</div>
				<div class="botoes">
					<?php
					for ($i = 1; $i <= $pganterior; $i++) {
						echo "<div onclick='paginacao(" . $i . ")' id='btn" . $i . "' class='btn btn-primary'>" . $i . "</div>";
					}
					?>
				</div>
				<div onclick="next()" class="btn btn-primary">Próximo</div>
			</div>