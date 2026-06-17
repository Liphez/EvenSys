<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Lote
{
    public static function listarPorEvento($evento_id)
    {
        $db = Database::getConnection();
        // Regra de Negócio: Só lista lotes que ainda tem quantidade disponível (> 0)
        $stmt = $db->prepare("
            SELECT * FROM lotes 
            WHERE evento_id = :evento_id AND quantidade > 0 
            ORDER BY preco ASC
        ");
        $stmt->execute(['evento_id' => $evento_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}