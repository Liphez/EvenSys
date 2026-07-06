<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Checkin
{
    public static function registrar($ingresso_id, $organizador_id)
    {
        $db = Database::getConnection();
        
        // RN03: Trava de segurança para impedir duplo check-in
        $stmtVerifica = $db->prepare("SELECT id FROM checkin WHERE ingresso_id = :ing_id");
        $stmtVerifica->execute(['ing_id' => $ingresso_id]);
        
        if ($stmtVerifica->fetch()) {
            return false; // Check-in já foi feito
        }

        $stmt = $db->prepare("INSERT INTO checkin (ingresso_id, organizador_id) VALUES (:ing_id, :org_id)");
        return $stmt->execute(['ing_id' => $ingresso_id, 'org_id' => $organizador_id]);
    }
}