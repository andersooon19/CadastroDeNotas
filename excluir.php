<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Nota</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Excluir Nota</h1>

        <?php
        include_once(__DIR__ . '/../src/Database.php');


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            try {
                $pdo = (new DatabaseNotas())->getConnection();
                $stmt = $pdo->prepare("DELETE FROM notas WHERE id = :id");
                $stmt->execute(['id' => $id]);
        
                // Redireciona para a página de lista após a exclusão
                header("Location: lista_notas.php?success=1");
                exit(); // Certifique-se de usar exit após header
            } catch (PDOException $e) {
                echo "<p>Erro ao excluir nota: " . $e->getMessage() . "</p>";
            }
        }
        
        ?>
        
        <a href="lista_notas.php" class="back-btn">Voltar para Lista</a>
    </div>
</body>
</html>