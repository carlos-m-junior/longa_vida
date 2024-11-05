<?php
include 'conexao.php';

// Verificar se o parâmetro 'nome' foi passado na URL
if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];

    // Consultar os dados do associado
    $sql = "SELECT * FROM associado WHERE Nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();
    $associado = $result->fetch_assoc();

    // Consultar todos os planos disponíveis
    $sql_planos = "SELECT * FROM plano";
    $result_planos = $conn->query($sql_planos);
}

// Se o formulário foi enviado, processar a atualização
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $plano = $_POST['plano'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    // Atualizar os dados do associado
    $sql_update = "UPDATE associado SET Nome = ?, Plano = ?, Endereco = ?, Cidade = ?, Estado = ?, CEP = ? WHERE Nome = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssss", $nome, $plano, $endereco, $cidade, $estado, $cep, $_GET['nome']);
    $stmt_update->execute();

    // Redirecionar para a página principal após salvar
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Associado</title>
</head>
<body>
    <h1>Alterar Associado</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($associado['Nome']) ?>" required><br><br>

        <label for="plano">Plano:</label>
        <select id="plano" name="plano" required>
            <?php while ($plano = $result_planos->fetch_assoc()): ?>
                <option value="<?= $plano['Numero'] ?>" <?= $plano['Numero'] == $associado['Plano'] ? 'selected' : '' ?>>
                    <?= $plano['Descricao'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($associado['Endereco']) ?>" required><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($associado['Cidade']) ?>" required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($associado['Estado']) ?>" required><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($associado['CEP']) ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="index.php">Voltar para a lista de associados</a>
</body>
</html>

<?php
$conn->close();
?>
