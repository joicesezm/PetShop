<?php
session_start();
include("conexao.php");
//entrada de dados vindos do HTML 
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$celular = $_POST['celular'];
$datadenascimento = $_POST['datadenascimento'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$endereco = $_POST['endereco'];
$numeroCasa = $_POST['numeroCasa'];
$senha = $_POST['senha'];
$confirmarsenha = $_POST['confirmarsenha'];

//verifica se algum dado nao foi informado
if (
    empty($cpf) || empty($nome) || empty($celular) ||
    empty($datadenascimento) || empty($email) ||
    empty($cidade) || empty($endereco) || empty($numeroCasa) ||
    empty($senha) || empty($confirmarsenha) ){
        echo " É necessário informar todos os campos";
        exit;
    }
   if ($senha != $confirmarsenha){
      echo " Senhas são diferentes";
      exit;
   }

    $resultSqlCliente =
     " insert into tb_cliente( cpf, nome, celular,
    datadenascimento, email, cidade, endereco, nrcasa, 
    senha, confirmarsenha)
    values ('$cpf', '$nome', '$celular', '$datadenascimento', 
    '$email', '$cidade', '$endereco', '$numeroCasa', 
    '$senha', '$confirmarsenha')";

    
    $resultadoCliente = mysqli_query($conexao, $resultSqlCliente);

    if (mysqli_insert_id($conexao)){
      //  echo "<script> alert(' ". strip_tags($_SESSION['msg']). "'); </script>";
       // unset($_SESSION['msg']);
        header("Location: consulta-cliente-pet.php") ;
    }
    else{
        $_SESSION['msg'] = "<p> Cliente não Cadastrado</p>";
     
    }
?>
