<?php
session_start();
include("conexao.php");
//entrada de dados vindos do HTML 
$nome = $_POST['nome'];
$especie = $_POST['especie'];
$raca = $_POST['raca'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo']; 
$cpf_cliente = $_POST['cpf_cliente'];

//verifica se algum dado nao foi informado
if (
    empty($nome) || empty($especie) ||
    empty($raca) || empty($idade) ||
    empty($sexo) || empty($cpf_cliente)  ){
        echo " É necessário informar todos os campos";
        exit;
    }
   
    $resultSqlCliente =
     " insert into tb_pet( nome, especie,
    raca, idade, cpf_cliente )
    values ( '$nome', '$especie', '$raca', 
    '$idade', '$cpf_cliente' )";

    
    $resultadoCliente = mysqli_query($conexao, $resultSqlCliente);

    if (mysqli_insert_id($conexao)){
        $_SESSION['msg'] = "<p> Pet Cadastrado com Sucesso</p>";
    }
    else{
        $_SESSION['msg'] = "<p> Pet não Cadastrado</p>";
     
    }
?>
