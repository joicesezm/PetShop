<?php
include("conexao.php");

$msg = false;

// Verifica se a conexão com o banco de dados está estabelecida
if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

if (isset($_FILES['arquivo_foto'])) {
    $extensao = strtolower(substr($_FILES['arquivo_foto']['name'], -4)); // obtém a extensão do arquivo
    $novo_nome = md5(time()) . $extensao; // define o novo nome do arquivo
    $diretorio = "fotos/"; // diretório onde as imagens serão salvas

    if (move_uploaded_file($_FILES['arquivo_foto']['tmp_name'], $diretorio . $novo_nome)) {
        $sql_foto = "INSERT INTO tb_foto_pet (caminho_foto, data_foto) VALUES ('$novo_nome', NOW())";

        if (mysqli_query($conexao, $sql_foto)) {
            $msg = "Foto salva com sucesso!";
        } else {
            $msg = "Falha ao salvar a foto no banco de dados: " . mysqli_error($conexao);
        }
    } else {
        $msg = "Falha ao mover o arquivo de upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Foto</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Upload de foto do seu Pet</h1>
        <?php if ($msg) echo "<p>$msg</p>"; ?>
        
        <div>
            <label for="arquivo_foto">Foto do Pet:</label>
            <input type="file" name="arquivo_foto" id="arquivo_foto" required>
        </div>
        <button type="submit" name="salvar">Salvar</button>
    </form>
</body>

</html>
