<?php

namespace App\Controllers;

use App\Models\Categoria;

class CategoriaController
{
    public function __construct()
    {
        // Apenas Organizadores e Admins podem acessar
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] === 'participante') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }

    public function index()
    {
        $categorias = Categoria::listarTodas();
        require_once __DIR__ . '/../views/dashboard/categorias.php';
    }

    public function salvar()
    {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($nome)) {
            Categoria::criar($nome);
        }

        header('Location: ' . BASE_URL . '/categorias');
        exit;
    }
}