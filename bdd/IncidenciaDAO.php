<?php

require_once __DIR__ . '/DatabaseConnection.php';
require_once __DIR__ . '/Incidencia.php';

class IncidenciaDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    /**
     * Inserta una nueva incidencia (registrar.php)
     * Retorna el ID autoincremental generado por MariaDB.
     */
    public function create(Incidencia $incidencia): int
    {
        $sql = "INSERT INTO incidencias (nombre, descripcion, prioridad, usuario_username)
                VALUES (:nombre, :descripcion, :prioridad, :usuario_username)";

        // 1. Sentencia preparada (Previene inyección SQL)
        $stmt = $this->db->prepare($sql);

        // 2. Enlace de parámetros y ejecución
        $stmt->execute([
            ':nombre' => $incidencia->getNombre(),
            ':descripcion' => $incidencia->getDescripcion(),
            ':prioridad' => $incidencia->getPrioridad(),
            ':usuario_username' => $incidencia->getUsuarioUsername()
        ]);

        // 3. Obtener el ID autoincremental que MariaDB asignó
        return (int) $this->db->lastInsertId();
    }

    /**
     * Lista todas las incidencias creadas por el usuario en sesión (listar.php)
     * @return Incidencia[]
     */
    public function findByUsuario(string $username): array
    {
        $sql = "SELECT id, nombre, descripcion, prioridad, usuario_username, fecha_registro
                FROM incidencias
                WHERE usuario_username = :username
                ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);

        $incidencias = [];
        while ($row = $stmt->fetch()) {
            $incidencias[] = new Incidencia(
                $row['nombre'],
                $row['descripcion'],
                $row['prioridad'],
                $row['usuario_username'],
                (int) $row['id'],
                $row['fecha_registro']
            );
        }

        return $incidencias;
    }

    /**
     * Obtiene los detalles de una incidencia por su ID (detalle.php)
     */
    public function findById(int $id): ?Incidencia
    {
        $sql = "SELECT id, nombre, descripcion, prioridad, usuario_username, fecha_registro
                FROM incidencias
                WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return new Incidencia(
            $row['nombre'],
            $row['descripcion'],
            $row['prioridad'],
            $row['usuario_username'],
            (int) $row['id'],
            $row['fecha_registro']
        );
    }
}
