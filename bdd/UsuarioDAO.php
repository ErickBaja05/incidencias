<?php

require_once __DIR__ . '/DatabaseConnection.php';
require_once __DIR__ . '/Usuario.php';

class UsuarioDAO
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    /**
     * Busca un usuario por su nombre de usuario.
     * Retorna el objeto Usuario si existe, o null si no se encuentra.
     */
    public function findByUsername(string $username): ?Usuario
    {
        $sql = "SELECT username, passwd FROM usuarios WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        return new Usuario($row['username'], $row['passwd']);
    }

    /**
     * Valida si las credenciales son correctas.
     * Si usas password_hash en el registro, aquí se usa password_verify.
     */
    public function autenticar(string $username, string $plainPassword): ?Usuario
    {
        $usuario = $this->findByUsername($username);
        if ($usuario === null) {
            return null;
        }

        // Si las contraseñas en la BDD están con password_hash:
        if (password_verify($plainPassword, $usuario->getPasswd())) {
            return $usuario;
        }

        // Alternativa temporal si para pruebas guardaron texto plano:
        // if ($usuario->getPasswd() === $plainPassword) { return $usuario; }

        return null;
    }

    /**
     * Inserta un nuevo usuario con la contraseña hasheada.
     * Retorna true en caso de éxito, false si falla (por ejemplo, usuario duplicado).
     */
    public function insertar(string $username, string $plainPassword): bool
    {
        $hash = password_hash($plainPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (username, passwd) VALUES (:username, :passwd)";
        $stmt = $this->db->prepare($sql);

        try {
            return $stmt->execute([
                ':username' => $username,
                ':passwd' => $hash
            ]);
        } catch (PDOException $e) {
            // Manejo de error si el username ya existe o hay falla de conexión
            return false;
        }
    }
}
