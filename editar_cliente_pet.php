<?php
include("conexao.php");

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Buscar os dados do cliente pelo CPF
    $sqlBusca = "SELECT * FROM tb_cliente WHERE cpf = '$cpf'";
    $resultadoBusca = mysqli_query($conexao, $sqlBusca);
    $cliente = mysqli_fetch_assoc($resultadoBusca);

    // Verifica se o cliente existe
    if (!$cliente) {
        echo "Cliente não encontrado!";
        exit;
    }

    // Preenche as variáveis com os dados do cliente para exibir no formulário
    $nome = $cliente['nome'];
    $email = $cliente['email'];
    $celular = $cliente['celular'];
    $datadenascimento = $cliente['datadenascimento'];
    $cidade = $cliente['cidade'];
    $endereco = $cliente['endereco'];
    $nrcasa = $cliente['nrcasa'];
    $senha = $cliente['senha'];
    $confirmarsenha = $cliente['confirmarsenha'];
}

// Atualiza o cliente se o formulário for enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $datadenascimento = $_POST['datadenascimento'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco'];
    $nrcasa = $_POST['numeroCasa'];
    $senha = $_POST['senha'];
    $confirmarsenha = $_POST['confirmarsenha'];

    $sqlUpdate = "UPDATE tb_cliente SET 
        nome = '$nome', 
        email = '$email', 
        celular = '$celular', 
        datadenascimento = '$datadenascimento', 
        cidade = '$cidade', 
        endereco = '$endereco', 
        nrcasa = '$nrcasa', 
        senha = '$senha', 
        confirmarsenha = '$confirmarsenha'
        WHERE cpf = '$cpf'";

    if (mysqli_query($conexao, $sqlUpdate)) {
       header("Location: consulta-cliente-pet.php");
    } else {
        echo "Erro ao atualizar!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <form action="" method="post">
        <div>
            <label for="cpf"> CPF:
                <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" readonly>
            </label>
        </div>
        <div>
            <label for="nome"> Nome:
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>">
            </label>
        </div>
        <div>
            <label> Email: 
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            </label>
        </div>
        <div>
            <label> Celular: 
                <input type="text" id="celular" name="celular" value="<?php echo $celular; ?>">
            </label>
        </div>
        <div>
            <label for="datadenascimento">Data de Nascimento:
                <input type="date" id="datadenascimento" name="datadenascimento" value="<?php echo $datadenascimento; ?>">
            </label>
        </div>
        <div>
            <label for="cidade"> Cidade:
                <input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>">
            </label>
        </div>
        <div>
            <label for="endereco"> Endereço
                <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>">
            </label>
        </div>
        <div>
            <label for="numeroCasa"> Número Casa:
                <input type="text" name="numeroCasa" id="numeroCasa" value="<?php echo $nrcasa; ?>">
            </label>
        </div>
        <div>
            <label for="senha"> Senha:
                <input type="password" id="senha" name="senha" value="<?php echo $senha; ?>">
            </label>
        </div>
        <div>
            <label for="confirmarsenha"> Confirmar Senha:
                <input type="password" id="confirmarsenha" name="confirmarsenha" value="<?php echo $confirmarsenha; ?>">
            </label>
        </div>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
