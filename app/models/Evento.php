<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Evento
{
    public static function listarPorOrganizador($organizador_id)
    {
        $db = Database::getConnection();
        //  LEFT JOIN para pegar o nome da categoria que o evento pertence
        $stmt = $db->prepare("
            SELECT e.*, c.nome as categoria_nome 
            FROM eventos e 
            LEFT JOIN categorias c ON e.categoria_id = c.id 
            WHERE e.organizador_id = :org_id 
            ORDER BY e.data_hora DESC
        ");
        $stmt->execute(['org_id' => $organizador_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function criar(array $dados)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO eventos 
            (organizador_id, categoria_id, titulo, descricao, local, data_hora, capacidade_maxima, status) 
            VALUES 
            (:org_id, :cat_id, :titulo, :descricao, :local, :data_hora, :capacidade, 'ativo')
        ");
        
        return $stmt->execute([
            'org_id' => $dados['organizador_id'],
            'cat_id' => $dados['categoria_id'],
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'local' => $dados['local'],
            'data_hora' => $dados['data_hora'],
            'capacidade' => $dados['capacidade_maxima']
        ]);
    }
    public static function listarAtivos()
    {
        $db = Database::getConnection();
        // Busca eventos ativos e traz o nome da categoria junto
        $stmt = $db->query("
            SELECT e.*, c.nome as categoria_nome 
            FROM eventos e 
            LEFT JOIN categorias c ON e.categoria_id = c.id 
            WHERE e.status = 'ativo' 
            ORDER BY e.data_hora ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function buscarPorId($id)
    {
        $db = Database::getConnection();
        // Busca um evento específico com o nome do organizador e categoria
        $stmt = $db->prepare("
            SELECT e.*, c.nome as categoria_nome, u.nome as organizador_nome 
            FROM eventos e 
            LEFT JOIN categorias c ON e.categoria_id = c.id 
            LEFT JOIN usuarios u ON e.organizador_id = u.id 
            WHERE e.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public static function cancelar($id, $organizador_id)
    {
        $db = Database::getConnection();
        // A trava do organizador_id garante que ninguém cancele o evento de outra pessoa
        $stmt = $db->prepare("UPDATE eventos SET status = 'cancelado' WHERE id = :id AND organizador_id = :org_id");
        return $stmt->execute([
            'id' => $id, 
            'org_id' => $organizador_id
        ]);
    }
}