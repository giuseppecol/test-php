<?php
class Database {
    private $host = "localhost";
    private $db_name = "api_rest";
    private $username = "root"; // Cambia según tu configuración.
    private $password = ""; // Cambia según tu configuración.
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error al conectar con la base de datos: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
