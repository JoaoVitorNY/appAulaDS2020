$(document).ready(function() {

    $('#table-cliente').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: {
            url: "src/clientes/modelo/list-cliente.php",
            type: "POST"
        },
        language: {
            url: "libs/DataTables/dataTables.brazil.json"
        },
        columns: [{
                "data": 'idcliente',
                "className": 'text-center'
            },
            {
                "data": 'nome',
                "className": 'text-center'
            },
            {
                "data": 'email',
                "className": 'text-center'
            },
            {
                "data": 'telefone',
                "className": 'text-center'
            },
            {
                "data": 'datamodificacao',
                "className": 'text-center'
            },
            {
                "data": 'ativo',
                "className": 'text-center'
            },
            {
                // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
                // podermos executar as funções do CRUD.
                data: 'idcliente',
                orderable: false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
                searchable: false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
                className: 'text-center',
                // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
                render: function(data, type, row, meta) {
                    return `
                    <button id="${data}" class="btn btn-info btn-sm btn-view"><i class="mdi mdi-eye"></i></button>
                    <button id="${data}" class="btn btn-primary btn-sm btn-edit"><i class="mdi mdi-pencil"></i></button>
                    <button id="${data}" class="btn btn-danger btn-sm btn-delete"><i class="mdi mdi-trash-can"></i></button>
                `;
                }
            }
        ]
    })
})