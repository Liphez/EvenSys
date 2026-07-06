<?php

namespace App\Controllers;

use App\Models\Ingresso;
use App\Models\Checkin;

class CheckinController
{
    public function __construct()
    {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_perfil'] === 'participante') {
            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }

    public function index()
    {
        require_once __DIR__ . '/../views/dashboard/checkin.php';
    }

    public function processar()
    {
        $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (!$codigo) {
            $_SESSION['msg_checkin'] = "<div class='alert error'>Código inválido.</div>";
            header('Location: ' . BASE_URL . '/checkin');
            exit;
        }

        $ingresso = Ingresso::buscarPorCodigo($codigo);

        // Valida se o ingresso existe e se pertence a um evento deste organizador
        if (!$ingresso || $ingresso->organizador_id !== $_SESSION['usuario_id']) {
            $_SESSION['msg_checkin'] = "<div class='alert error'>Ingresso não encontrado ou não pertence a você.</div>";
        } else {
            // Tenta registrar a entrada
            if (Checkin::registrar($ingresso->id, $_SESSION['usuario_id'])) {
                $_SESSION['msg_checkin'] = "<div class='alert success'>✅ Entrada Liberada! Evento: " . htmlspecialchars($ingresso->evento_nome) . "</div>";
            } else {
                $_SESSION['msg_checkin'] = "<div class='alert error'>❌ ALERTA: Este ingresso já foi utilizado!</div>";
            }
        }

        header('Location: ' . BASE_URL . '/checkin');
        exit;
    }
}