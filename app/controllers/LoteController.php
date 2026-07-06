<?php

namespace App\Controllers;

use App\Models\Lote;

class LoteController
{
    public function __construct()
    {
        // Trava de segurança: Apenas organizadores acessam
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] === 'participante') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }

    public function index()
    {
        $evento_id = filter_input(INPUT_GET, 'evento_id', FILTER_VALIDATE_INT);
        
        if (!$evento_id) {
            header('Location: ' . BASE_URL . '/eventos');
            exit;
        }

        $lotes = Lote::listarPorEvento($evento_id);
        require_once __DIR__ . '/../views/dashboard/lotes.php';
    }

    public function salvar()
    {
        $evento_id = filter_input(INPUT_POST, 'evento_id', FILTER_VALIDATE_INT);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
        
        // Formata o preço trocando vírgula por ponto para o MySQL
        $preco_raw = str_replace(',', '.', $_POST['preco'] ?? '0');
        $preco = (float) $preco_raw;

        if ($evento_id && !empty($nome) && $quantidade > 0 && $preco >= 0) {
            Lote::criar($evento_id, $nome, $quantidade, $preco);
        }

        header('Location: ' . BASE_URL . '/lotes?evento_id=' . $evento_id);
        exit;
    }
}