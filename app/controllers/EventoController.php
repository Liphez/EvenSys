<?php

namespace App\Controllers;

use App\Models\Evento;
use App\Models\Categoria;

class EventoController
{
    public function __construct()
    {
        // RN05 - Somente organizadores autenticados podem gerenciar eventos
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] === 'participante') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }

    public function index()
    {
        // Carrega as categorias para o formulário
        $categorias = Categoria::listarTodas();
        // Lista apenas os eventos do organizador logado
        $eventos = Evento::listarPorOrganizador($_SESSION['usuario_id']);
        
        require_once __DIR__ . '/../views/dashboard/eventos.php';
    }

    public function salvar()
    {
        // Sanitização de entradas (RNF01)
        $dados = [
            'organizador_id' => $_SESSION['usuario_id'],
            'categoria_id' => filter_input(INPUT_POST, 'categoria_id', FILTER_VALIDATE_INT),
            'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS),
            'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS),
            'local' => filter_input(INPUT_POST, 'local', FILTER_SANITIZE_SPECIAL_CHARS),
            'data_hora' => $_POST['data_hora'] ?? '',
            'capacidade_maxima' => filter_input(INPUT_POST, 'capacidade_maxima', FILTER_VALIDATE_INT)
        ];

        // Validação simples
        if (!empty($dados['titulo']) && !empty($dados['data_hora']) && !empty($dados['categoria_id'])) {
            Evento::criar($dados);
        }

        header('Location: ' . BASE_URL . '/eventos');
        exit;
    }
}