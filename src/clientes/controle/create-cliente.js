$(document).ready(function() {
    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#form-cliente').serialize()

        $('input[type=checkbox]').each(function() {
            if (!this.checked) {
                dados += '&' + this.name + '=off'
            }
        })

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/clientes/modelo/create-cliente.php',
            success: function(dados) {
                Swal.fire({
                    title: 'AppAulaDS',
                    text: dados.mensagem,
                    type: dados.type,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        location.reload()
                    }
                })

                $('#modal-cliente').modal('hide')
            }
        })
    })
})