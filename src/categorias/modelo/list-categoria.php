<?php

include('../../banco/conexao.php');

if(!$conexao){  
    $requestData = $_REQUEST;
    $colunas = $requestData['columns'];

    $sql = "SELECT idcategoria, nome, date_format(datamodificacao,'%d/%m/%Y %H:%i:%s') as datamodificacao, ativo FROM CATEGORIAS WHERE 1=1 ";

    $resultado = mysqli_query($conexao, $sql);
    $linhas = mysqli_num_rows($resultado);

    $filtro = $requestData['search']['value'];
    if(!empty($filtro)){
        $sql .= " AND (idcategoria LIKE '$filtro%' ";
        $sql .= " OR nome LIKE '$filtro%') ";
    }

    $resultado = mysqli_query($conexao, $sql);
    $totalFiltrados = mysqli_num_rows($resultado);

    $colunaOrdem = $requestData['order'][0]['column'];
    $ordem = $colunas['$colunaOrdem']['data'];
    $direcao = $requestData['order'][0]['dir'];

    $inicio = $requestData['start'];
    $tamanho = $requestData['length'];

    $sql .= " ORDER BY $ordem $direcao LIMIT $inicio $tamanho";
    $resultado = mysqli_query($conexao, $sql);
    
    $dados = array();
    while($row = mysqli_fetch_assoc($resultado)){
        $dados[] = array_map('utf8_encode', $row);
    }

    $json_data = array(
        "draw" => inval($requestData['draw']),
        "recordsTotal" => inval($linhas),
        "recordsFiltrados" => inval($totalFiltrados),
        "data" => $dados
    )

    mysqli_close($conexao);

}else{
    $json_data = array(
        "draw" => 0,
        "recordsTotal" => 0,
        "recordsFiltrados" => 0,
        "data" => array()
    );
}
echo json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);