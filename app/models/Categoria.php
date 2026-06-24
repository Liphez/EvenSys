<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Categoria
{
    public static function listarTodas()
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM categorias ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function criar(string $nome)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        return $stmt->execute(['nome' => $nome]);
    }
}