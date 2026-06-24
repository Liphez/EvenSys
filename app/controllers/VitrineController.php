<?php

namespace App\Controllers;

use App\Models\Evento;
use App\Models\Lote;

class VitrineController
{
    public function index()
    {
        // Busca todos os eventos ativos no banco
        $eventos = Evento::listarAtivos();
        require_once __DIR__ . '/../views/vitrine/index.php';
    }

    public function detalhes()
    {
        // Valida se foi passado um ID na URL (Ex: ?id=1)
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            header('Location: ' . BASE_URL . '/vitrine');
            exit;
        }

        $evento = Evento::buscarPorId($id);
        
        if (!$evento) {
            header('Location: ' . BASE_URL . '/vitrine');
            exit;
        }

        // Busca os lotes disponíveis para este evento
        $lotes = Lote::listarPorEvento($id);
        
        require_once __DIR__ . '/../views/vitrine/detalhes.php';
    }
}