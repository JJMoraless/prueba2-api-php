<?php 
namespace Config;
use Config\DbConfig;

class Db {
    use DbConfig;
    protected $conn;
    public function getConnection(string $dbKey = "mysql")
    {
        $dbConfig = self::$settings[$dbKey];
        $this->conn = null;
        $dns = "{$dbConfig['driver']}:host={$dbConfig['host']};dbname={$dbConfig['database']}";
        try {
            $this->conn = new \PDO($dns, $dbConfig['username'], $dbConfig['password'], $dbConfig['flags']);
            echo "okkkk";
        } catch (\PDOException $exception) {
            $error = [[
                'error' => $exception->getMessage(),
                'message' => 'Error al momento de establecer la conexion'
            ]];
            echo "eroorrrrr";
            return $error;

        }
        return $this->conn;
    }
}


