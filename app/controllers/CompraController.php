<?php

namespace App\Controllers;

use App\Models\Compra;
use App\Models\Ingresso;
use App\Models\Lote;

class CompraController
{
    public function comprar()
    {
        // 1. Trava de Segurança: Só usuários logados podem comprar
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['erro_login'] = "Faça login para comprar ingressos.";
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $evento_id = filter_input(INPUT_POST, 'evento_id', FILTER_VALIDATE_INT);
        $lote_id = filter_input(INPUT_POST, 'lote_id', FILTER_VALIDATE_INT);
        $participante_id = $_SESSION['usuario_id'];

        if (!$evento_id || !$lote_id) {
            header('Location: ' . BASE_URL . '/vitrine');
            exit;
        }

        // 2. Validação da Regra de Negócio (RN02 - Não vender esgotados)
        $lote = Lote::buscarPorId($lote_id);
        if (!$lote || $lote->quantidade <= 0) {
            header('Location: ' . BASE_URL . '/evento/detalhes?id=' . $evento_id);
            exit;
        }

        // 3. Processa a Compra (RF06)
        $compra_id = Compra::criar($participante_id, $evento_id, $lote->preco);
        
        // 4. Gera Código Único Absoluto usando Hash e Tempo (RN04)
        $string_secreta = uniqid($participante_id . $lote_id . time(), true);
        $codigo_unico = strtoupper(substr(hash('sha256', $string_secreta), 0, 10));

        // 5. Gera o Ingresso e abate o estoque (RF07)
        if ($compra_id) {
            Ingresso::criar($compra_id, $lote_id, $codigo_unico, $lote->preco);
            Lote::decrementarQuantidade($lote_id);
        }

        // 6. Envia para a carteira
        header('Location: ' . BASE_URL . '/meus-ingressos');
        exit;
    }

    public function meusIngressos()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $ingressos = Ingresso::listarPorParticipante($_SESSION['usuario_id']);
        require_once __DIR__ . '/../views/vitrine/meus_ingressos.php';
    }
}