<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Ingresso
{
    public static function criar($compra_id, $lote_id, $codigo_unico, $valor_pago)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO ingressos (compra_id, lote_id, codigo_unico, valor_pago, status) 
            VALUES (:comp_id, :lote_id, :codigo, :valor, 'valido')
        ");
        
        return $stmt->execute([
            'comp_id' => $compra_id,
            'lote_id' => $lote_id,
            'codigo' => $codigo_unico,
            'valor' => $valor_pago
        ]);
    }

    public static function listarPorParticipante($participante_id)
    {
        $db = Database::getConnection();
        // Um JOIN robusto para montar a carteira de ingressos do usuário
        $stmt = $db->prepare("
            SELECT i.codigo_unico, i.valor_pago, i.status, e.titulo as evento_nome, e.data_hora, l.nome as lote_nome
            FROM ingressos i
            JOIN compras c ON i.compra_id = c.id
            JOIN eventos e ON c.evento_id = e.id
            JOIN lotes l ON i.lote_id = l.id
            WHERE c.participante_id = :part_id
            ORDER BY c.data_compra DESC
        ");
        $stmt->execute(['part_id' => $participante_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}