<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Usuario
{
    public static function buscarPorEmail(string $email)
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, nome, email, senha_hash, perfil FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function criar(string $nome, string $email, string $senha_hash, string $perfil = 'organizador')
    {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha_hash, perfil) VALUES (:nome, :email, :senha, :perfil)");
        
        return $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha_hash,
            'perfil' => $perfil
        ]);
    }
}