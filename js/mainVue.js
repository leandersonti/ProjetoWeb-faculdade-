url = '../ControleEquipamentos2/scripts/CrudAxios.php';

const vm = new Vue({
    el: "#app",
    data: {
        Equipamentos: [],
        NumeroSerie: '',
        Equipamento: '',
        Marca: '',
        Modelo: '',
        Status: '',
        selected: [],
        descriptionItems: [5, 10, 15],
        //expand: ''

    },
    methods: {
        Listar() {
            axios.post(url, { acao: "Listar" }).then(resposta => {
                this.Equipamentos = resposta.data;
            }).catch(erro => {
                alert(erro + "nao ta indo a listagem");
            })
        },
        // Listar() {
        //     fetch(url, {
        //         method: "POST",
        //         body: { acao: "Listar" },
        //     }).then(r => r.json()).then(r => {
        //         alert("ta indo" + r.json());
        //         this.Equipamentos = r;
        //         console.log(r)
        //     }).catch(erro => {
        //         alert("deu pau" + erro)
        //     })
        // },

        statusComp(status) {
            if (status == 0) {
                return "Disponível"
            } else if (status == 1) {
                return "Alocado"
            } else if (status == 2) {
                return "Defeituoso"
            } else if (status == 3) {
                return "Em Manutenção"
            } else {
                return "Cedido ao Interior"
            }
        },
        // async btnEditar(id, tipo, marca, modelo) {
        //     await Swal.fire({
        //         title: 'Editar',
        //         html:
        //             '<div class="modal fade editarN" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">' +
        //             '<div class="modal-dialog modal-dialog-centered" role="document">' +
        //             '<div class="modal-content">' +
        //             '<div class="modal-header">' +
        //             '<h5 class="modal-title" id="TituloModalCentralizado">Editar</h5>' +
        //             '<button type="button" onclick="removeMarca()" class="close" data-dismiss="modal" aria-label="Fechar">' +
        //             '<span aria-hidden="true">&times;</span>' +
        //             '</button>' +
        //             '</div >' +
        //             '<form name="editar" class="was-validated">' +
        //             '<div class="modal-body">' +

        //             '<div class="form-row">' +

        //             ' <div class="form-group col-md-6">' +
        //             '<label for="inputCity">Número de Patrimônio/Série</label>' +
        //             '<input type="text" name="num_serie" class="form-control" id="campoSerie" required>' +
        //             '<div class="invalid-feedback">' +
        //             'Informe o Número de Patrimônio!' +
        //             '</div>' +
        //             '</div>' +

        //             '<div class="form-group col-md-6">' +
        //             '<label for="inputEstado">Tipo</label>' +
        //             '<select id="inputEstado" name="tipo" class="form-control" required>' +
        //             '<option value="">Equipamento</option>' +
        //             '<option value="Mouse">Mouse</option>' +
        //             '<option value="Monitor">Monitor</option>' +
        //             '<option value="Teclado">Teclado</option>' +
        //             '<option value="Gabinete">Gabinete</option>' +
        //             '<option value="Notebook">Notebook</option>' +
        //             '<option value="Injetor">Injetor</option>' +
        //             '<option value="Impressora">Impressora</option>' +
        //             '<option value="Print Server">Print Server</option>' +
        //             '<option value="Projetor">Projetor</option>' +
        //             '<option value="Webcam">Webcam</option>' +
        //             '<option value="Telefone">Telefone</option>' +
        //             '<option value="Mini HD">Mini HD</option>' +
        //             '<option value="Minicomputador">Minicomputador</option>' +
        //             '<option value="Bateria para Nobreak">Bateria para Nobreak</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">' +
        //             'selecione o Tipo do Equipamento!' +
        //             '</div>' +
        //             '</div>' +

        //             '</div>' +

        //             '<div class="form-row">' +
        //             '<div class="form-group col-md-6">' +
        //             '<label for="inputCity">Modelo</label>' +
        //             '<input type="text" name="modelo" class="form-control" id="inputCity" placeholder="Modelo do Equipamento" required>' +
        //             '</div>' +
        //             '<div class="form-group col-md-6">' +
        //             '<label for="inputEstado">Marca</label>' +
        //             '<select id="selecao" name="marca" class="form-control" required>' +
        //             '<option value="">Escolher...</option>' +
        //             '<option value="Dell">Dell</option>' +
        //             '<option value="HP">HP</option>' +
        //             '<option value="AOC">AOC</option>' +
        //             '<option value="AVAYA">AVAYA</option>' +
        //             '<option value="Samsung">Samsung</option>' +
        //             '<option value="Logitech">Logitech</option>' +
        //             '<option value="Epson">Epson</option>' +
        //             '<option value="Lenovo">Lenovo</option>' +
        //             '<option value="Outro">Outro</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">' +
        //             'selecione a Marca do Equipamento!' +
        //             '</div>' +
        //             '</div>' +
        //             '</div>' +

        //             '< !--Campo oculto de outra marca-->' +

        //             '<div class="form-group" id="oculto" style="display:none">' +
        //             '<!-- Só pra deixar claro que esse style na div é 100% culpa do LEANDERSON //Cley -->' +
        //             '<label for="exampleFormControlTextarea1">Outros</label>' +
        //             '<input type="text" name="outraMarca" class="form-control" placeholder="Marca">' +
        //             '</div>' +

        //             '<!-- Fim do campo oculto -->' +

        //             '<div class="form-group">' +
        //             '<label>Status</label>' +
        //             '<select name="status" class="form-control" required>' +
        //             '<option value="">Escolher...</option>' +
        //             '<option value="0">Disponivel</option>' +
        //             '<option value="1" disabled>Alocado</option>' +
        //             '<option value="2">Defeituoso</option>' +
        //             '<option value="3">Em manutenção</option>' +
        //             '<option value="4" disabled>Cedido ao interior</option>' +
        //             '</select>' +
        //             '<div class="invalid-feedback">' +
        //             'selecione a um Status' +
        //             '</div>' +
        //             '</div>' +

        //             '<div class="form-group">' +
        //             '<label for="exampleFormControlTextarea1">Descrição</label>' +
        //             '<textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3" placeholder="Detalhes a respeito do equipamento"></textarea>' +
        //             '</div>' +
        //             '<input type="hidden" title="teste" id="<?php echo $fetch->num_serie; ?>" />' +

        //             '</div>' +

        //             '</form >' +

        //             '</div >' +
        //             '</div >' +
        //             '</div >',
        //         focusConfirm: false,
        //         showCancelButton: true,
        //         confirmButtonText: 'Editar'
        //     }).then((result) => {
        //         if (result.value) {
        //             marca = document.getElementById('marca').value,
        //                 modelo = document.getElementById('modelo').value,
        //                 estoque = document.getElementById('estoque').value
        //             this.Editar(id, marca, modelo, estoque)
        //             Swal.fire({
        //                 type: 'success',
        //                 title: 'Atualizado com Sucesso',
        //             })
        //         }
        //     })

        // },
        Editar(id, tipo, marca, modelo) {
            axios.post(url, { acao: "Editar", id: id, tipo: tipo, marca: marca, modelo: modelo }).then(resposta => {
                if (resposta.data == 1) {

                    this.Listar();
                } else {
                    alert("nao ta indo" + resposta.data)
                }
            }).catch(erro => {
                alert(erro + "nao ta indo");
            })
        }

    },

    created() {
        this.Listar();
    }
})