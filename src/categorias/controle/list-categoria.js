$(document).ready(function() {

    var url = "src/categorias/modelo/list-categoria.php"
    $('#table-categoria').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "language": {
            "url": "../../../libs/DataTables/dataTables.brazil.json"
        },
        "columns": [{
                "data": 'idcategoria',
                "className": 'text-center'
            },
            {
                "data": 'nome',
                "className": 'text-center'
            },
            {
                "data": 'ativo',
                "className": 'text-center'
            },
            {
                "data": 'datacriacao',
                "className": 'text-center'
            },
            {
                "data": 'datamodificacao',
                "className": 'text-center'
            },
            {
                // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
                // podermos executar as funções do CRUD.
                "data": 'idcategoria',
                "orderable": false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
                "searchable": false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
                "className": 'text-center',
                // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
                "render": function(data, type, row, meta) {
                    return `
                        <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
                        <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
                `
                }
            }
        ]
    })
})