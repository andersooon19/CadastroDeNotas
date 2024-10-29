<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Notas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Notas</h1>

        <?php
        include_once(__DIR__ . '/../src/Database.php');


        try {
            $pdo = (new DatabaseNotas())->getConnection();

            // Consulta todas as notas
            $stmt = $pdo->query("SELECT * FROM notas");
            $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($notas) > 0) {
                echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Nota</th>
                        <th>Ações</th>
                    </tr>";

                // Exibe as notas em uma tabela
                foreach ($notas as $nota) {
                    echo "<tr>
                        <td>" . htmlspecialchars($nota['id']) . "</td>
                        <td>" . htmlspecialchars($nota['nome']) . "</td>
                        <td>" . htmlspecialchars($nota['nota']) . "</td>
                        <td>
                            <form action='excluir.php' method='POST'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($nota['id']) . "'>
                                <input type='submit' value='Excluir'>
                            </form>
                        </td>
                    </tr>";
                }

                echo "</table>";
            } else {
                echo "<p class='message'>Nenhuma nota cadastrada.</p>";
            }
        } catch (PDOException $e) {
            echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
        }
        ?>

        <a href="index.php" class="link-button back">Voltar para Cadastro</a>

    </div>
</body>
</html>