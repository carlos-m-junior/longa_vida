<?php
include 'conexao.php';

// Consultar todos os associados com seus planos
$sql = "SELECT associado.Nome, associado.Plano, plano.Descricao, plano.Valor
        FROM associado
        JOIN plano ON associado.Plano = plano.Numero";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associados - Longa Vida</title>
</head>
<body>
    <h1>Associados</h1>
    <a href="criar.php">Criar Novo Associado</a>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Plano</th>
                <th>Descrição do Plano</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['Nome']) ?></td>
                <td><?= htmlspecialchars($row['Plano']) ?></td>
                <td><?= htmlspecialchars($row['Descricao']) ?></td>
                <td>R$ <?= number_format($row['Valor'], 2, ',', '.') ?></td>
                <td>
                    <a href="editar.php?nome=<?= urlencode($row['Nome']) ?>">Alterar</a> | 
                    <a href="deletar.php?nome=<?= urlencode($row['Nome']) ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="sair.php">Sair</a>
</body>
</html>

<?php
$conn->close();
?>
