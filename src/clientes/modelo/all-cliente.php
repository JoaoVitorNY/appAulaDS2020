<?php

include('../../banco/conexao.php');

if(!$conexao){
    $dados = array(
        "tipo" => "info",
        "mensagem" => "Não possível conecar ao banco de dados",
        "dados" => array()
    );
}else{

    $sql = "SELECT idcliente, nome, email, telefone FROM clientes WHERE ativo = 'S'";
    $resultado = mysqli_query($conexao, $sql);

    $dadosCliente = array();
    if($resultado && mysqli_num_rows($resultado) > 0){

        while($row = mysqli_fetch_assoc($resultado)){
            $dadosCliente[] = array_map('utf8_encode', $row);
        }

        $dados = array(
            "tipo" => "success",
            "mensagem" => "...",
            "dados" => $dadosCliente
        );
    }else{
        $dados = array(
            "tipo" => "error",
            "mensagem" => "Não possível localizar o cliente.",
            "dados" => array()
        );
    }

mysqli_close($conexao);

}    

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);