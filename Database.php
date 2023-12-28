<?php

class Database
{
    public PDO $conn;

    /**
     * Database class constructor
     *
     * @param array $config
     * @throws Exception
     */
    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
            foreach ($options as $key => $value) {
                $this->conn->setAttribute($key, $value);
            }
        } catch (PDOException $exception) {
            throw new Exception("Database connection failed: {$exception->getMessage()}");
        }
    }
}
