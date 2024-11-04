<?php
session_start();
include("conexao.php");

// Entrada de dados vindos do HTML 
$nome = $_POST['nome'];
$especie = $_POST['especie'];
$raca = $_POST['raca'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];
$cpf_cliente = $_POST['cpf_cliente'];

// Verifica se algum dado não foi informado
if (
    empty($nome) || empty($especie) ||
    empty($raca) || empty($idade) ||
    empty($sexo) || empty($cpf_cliente)
) {
    echo "É necessário informar todos os campos.";
    exit;
}

if (isset($_FILES['arquivo_foto']) && $_FILES['arquivo_foto']['error'] === UPLOAD_ERR_OK) {
    $extensao = strtolower(substr($_FILES['arquivo_foto']['name'], -4)); // Obtém a extensão do arquivo
    $novo_nome = md5(time()) . $extensao; // Define o novo nome do arquivo
    $diretorio = "fotos/"; // Diretório onde as imagens serão salvas
    echo "to aqui";
    if (move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], $diretorio . $novo_nome)) {
        $resultSqlCliente = "
            INSERT INTO tb_pet (nome, especie, raca, idade, cpf_cliente, foto_caminho_pet)
            VALUES ('$nome', '$especie', '$raca', '$idade', '$cpf_cliente', '$novo_nome')";

        $resultadoCliente = mysqli_query($conexao, $resultSqlCliente);

        if (mysqli_insert_id($conexao)) {
            $_SESSION['msg'] = "<p>Pet cadastrado com sucesso.</p>";
        } else {
            $_SESSION['msg'] = "<p>Pet não cadastrado.</p>";
        }
    } else {
        $_SESSION['msg'] = "<p>Erro ao enviar a foto.</p>";
    }
} else {
    $_SESSION['msg'] = "<p>Nenhuma foto enviada.</p>";
}
?>
