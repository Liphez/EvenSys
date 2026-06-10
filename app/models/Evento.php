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
}