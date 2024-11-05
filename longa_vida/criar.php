<?php
include 'conexao.php';

// Consultar todos os planos disponíveis
$sql_planos = "SELECT * FROM plano";
$result_planos = $conn->query($sql_planos);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $plano = $_POST['plano'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $sql_insert = "INSERT INTO associado (Nome, Plano, Endereco, Cidade, Estado, CEP) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssssss", $nome, $plano, $endereco, $cidade, $estado, $cep);
    $stmt->execute();

    // Redirecionar para a página principal após a criação
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Associado</title>
</head>
<body>
    <h1>Criar Novo Associado</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="plano">Plano:</label>
        <select id="plano" name="plano" required>
            <?php while ($plano = $result_planos->fetch_assoc()): ?>
                <option value="<?= $plano['Numero'] ?>"><?= $plano['Descricao'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" required><br><br>

        <button type="submit">Criar Associado</button>
    </form>
    <br>
    <a href="index.php">Voltar para a lista de associados</a>
</body>
</html>

<?php
$conn->close();
?>
