<?php

namespace Framework;

use PDO;
use PDOException;
use PDOStatement;
use Exception;

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
        // Creating the connection string
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8";

        // Creating the options
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            // Connecting to the database
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $exception) {
            throw new Exception("Database connection failed: {$exception->getMessage()}");
        }
    }

    /**
     * Query the database
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     * @throws Exception
     */
    public function query(string $query, array $params = []): PDOStatement
    {
        try {
            $stmt = $this->conn->prepare($query);
            foreach ($params as $param => $value) {
                $stmt->bindValue(":{$param}", $value);
            }
            $stmt->execute();

            return $stmt;
        } catch (PDOException $exception) {
            throw new Exception("Query failed to execute: {$exception->getMessage()}");
        }
    }
}
