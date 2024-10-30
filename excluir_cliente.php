<?php
include("conexao.php");

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    $sqlExcluir = "delete from tb_cliente where cpf = '$cpf' ";
    if (mysqli_query($conexao, $sqlExcluir)){
        echo "Excluido com Sucesso";
    }else{
        echo "Não excluido";
    }

}

?>