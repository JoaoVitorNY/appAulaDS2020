$(document).ready(function() {
    $('.btn-save').click(function(e) {
        e.preventDefault()

        let dados = $('#form-categoria').serialize()

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/categorias/modelo/create-categoria.php',
            success: function(dados) {
                Swal.fire({
                    title: 'AppAulaDS',
                    text: dados.mensagem,
                    type: dados.type,
                    confirmButtonText: 'OK'
                })

                $('#modal-categoria').modal('hide')
            }
        })
    })
})