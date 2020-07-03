$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar Categoria')

        const datacriacao = new Date().toLocaleString()

        $('.modal-body').load('src/categorias/visao/form-categoria.html', function() {
            $('#datacriacao').val(datacriacao)
        })

        $('.btn-save').show()
        $('#modal-categoria').modal('show')
    })
})