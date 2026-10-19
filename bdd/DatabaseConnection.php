<?php

require_once __DIR__ . '/DatabaseConfig.php';

class DatabaseConnection
{
    // 1. Variable estática privada para almacenar la única instancia
    private static ?PDO $instance = null;

    // 2. Constructor privado para evitar que hagan new DatabaseConnection()
    private function __construct()
    {
    }

    // 3. Método para clonar privado (evita clonaciones)
    private function __clone()
    {
    }

    // 4. Método de acceso global
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
                DatabaseConfig::HOST,
                DatabaseConfig::PORT,
                DatabaseConfig::DATABASE
            );

            self::$instance = new PDO($dsn, DatabaseConfig::USER, DatabaseConfig::PASSWORD);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Configurar que por defecto devuelva arrays asociativos
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$instance;
    }
}
