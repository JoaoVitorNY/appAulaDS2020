<?php

include('../../banco/conexao.php');

if(!$conexao){
    $dados = array(
        'tipo' => 'info',
        'mensagem' => 'Não foi possível conectar ao banco de dados...'
    );

}else{
    $requestData = $_REQUEST;
    //$requestData = array_map('utf8_decode', $requestData);

    if(empty($requestData['nome']) && empty($requestData['ativo'])){
        $dados = array(
            'tipo' => 'info',
            'mensagem' => 'Existem campos obrigatórios vazios...'
        );
    }else{
        $requestData['ativo'] = $requestData['ativo'] == "on" ? "S" : "N";
        $date = date_create_from_format('d/m/Y H:i:s', $requestData['dataagora']);
        $requestData['dataagora'] = date_format($date, 'Y-m-d H:i:s');

        $sqlComando = "INSERT INTO CATEGORIAS(nome, ativo, datacriacao, datamodificacao) 
        VALUES('$requestData[nome]', '$requestData[ativo]', '$requestData[dataagora]', '$requestData[dataagora]')";

        $resultado = mysqli_query($conexao, $sqlComando);

        if($resultado){
            $dados = array(
                'tipo' => 'success',
                'mensagem' => 'Categoria cadastrada com sucesso!'
            );
        }else{
            $dados = array(
                'tipo' => 'error',
                'mensagem' => 'Não foi possível cadastrar categoria.'               
            );
        }      
    }
    mysqli_close($conexao);
}
echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);