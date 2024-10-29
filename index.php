<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Notas</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Notas</h1>
        <form method="post" action="">
            <label for="nome">Nome do Aluno:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="nota">Nota:</label>
            <input type="number" id="nota" name="nota" step="0.1" required><br>

            <input type="submit" value="Cadastrar">
        </form>

        <?php
        include_once(__DIR__ . '/../src/Database.php');


        try {
            $pdo = (new DatabaseNotas())->getConnection();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nome = $_POST['nome'];
                $nota = $_POST['nota'];

                $stmt = $pdo->prepare("INSERT INTO notas (nome, nota) VALUES (:nome, :nota)");

                $stmt->execute(['nome' => $nome, 'nota' => $nota]);

                echo "<p>Nota cadastrada com sucesso!</p>";
            } 
        } catch (PDOException $e) {
                echo "<p>Erro: " . $e->getMessage() . "<p>";
            }

        ?>

        <a href="lista_notas.php" class="link-button list">Listar Notas</a>
    </div>
</body>
</html>