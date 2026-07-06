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

    public static function buscarPorId($id)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM lotes WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function decrementarQuantidade($id)
    {
        $db = Database::getConnection();
        // A trava "quantidade > 0" no SQL garante que nunca venderemos ingresso negativo (RN02)
        $stmt = $db->prepare("UPDATE lotes SET quantidade = quantidade - 1 WHERE id = :id AND quantidade > 0");
        return $stmt->execute(['id' => $id]);
    }
    public static function criar($evento_id, $nome, $quantidade, $preco)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO lotes (evento_id, nome, quantidade, preco) 
            VALUES (:ev_id, :nome, :qtd, :preco)
        ");
        
        return $stmt->execute([
            'ev_id' => $evento_id,
            'nome' => $nome,
            'qtd' => $quantidade,
            'preco' => $preco
        ]);
    }
}