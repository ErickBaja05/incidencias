<?php

require_once __DIR__ . '/DatabaseConfig.php';

class DatabaseConnection
{
    public static function open(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
            DatabaseConfig::HOST,
            DatabaseConfig::PORT,
            DatabaseConfig::DATABASE
        );

        $connection = new PDO($dsn, DatabaseConfig::USER, DatabaseConfig::PASSWORD);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}
