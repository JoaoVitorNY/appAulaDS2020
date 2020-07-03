<?php

include('../../banco/conexao.php');

if(!$conexao){
    $dados = array(
        'tipo' -> TYPE_MSG_INFO,
        'mensagem' -> 'Não foi possível conectar ao banco de dados...'
    );

}else{
    $requestData = $_REQUEST;
    $ativo = 
    //$requestData = array_map('utf8_decode', $requestData);
    $requestData['ativo'] = $requestData['ativo'] == "on" ? "S" : "N";
    $requestData['categoria'] = date('Y-d-m H:i:s', strtotime($requestData['dataagora']));

    if(empty($requestData['nome']) && empty($requestData['ativo'])){
        $dados = array(
            'tipo' => TYPE_MSG_INFO,
            'mensagem' => 'Existem campos obrigatórios vazios...'
        );
    }else{
        $sqlComando = "INSERT INTO CATEGORIAS(nome, ativo, datacriacao, datamodificacao) 
        VALUES('$requestData['nome']', '$requestData['ativo']', '$requestData['dataagora']', '$requestData['dataagora']')";

        $resultado = mysqli_query($conexao, $sqlComando);

        if(!$resultado){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'Categoria cadastrada com sucesso!'
            );
        }else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => 'Não foi possível cadastrar categoria.'               
            );
        }      
    }
    mysqli_close($conexao);
}
echo json_encode($dados);