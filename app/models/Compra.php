<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Compra
{
    public static function criar($participante_id, $evento_id, $valor_total)
    {
        $db = Database::getConnection();
        // O status já nasce como 'aprovada' pois estamos simulando a confirmação do pagamento
        $stmt = $db->prepare("
            INSERT INTO compras (participante_id, evento_id, valor_total, status) 
            VALUES (:part_id, :ev_id, :valor, 'aprovada')
        ");
        
        $stmt->execute([
            'part_id' => $participante_id,
            'ev_id' => $evento_id,
            'valor' => $valor_total
        ]);
        
        // Retorna o ID da compra recém-criada para amarrarmos ao ingresso
        return $db->lastInsertId();
    }
}