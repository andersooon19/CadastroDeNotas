<?php

class DatabaseNotas {
    private $host = 'localhost';
    private $dbname = 'notas_db';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function getConnection() {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);

                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
?>