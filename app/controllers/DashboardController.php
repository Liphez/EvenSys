<?php

namespace App\Controllers;

use App\Core\Database;
use PDO;

class DashboardController
{
    public function __construct()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function index()
    {
        $estatisticas = ['eventos' => 0, 'ingressos' => 0, 'faturamento' => 0];

        // Se for organizador, puxa os dados reais do banco (RF10)
        if ($_SESSION['usuario_perfil'] !== 'participante') {
            $db = Database::getConnection();
            $stmt = $db->prepare("
                SELECT 
                    COUNT(DISTINCT e.id) as eventos,
                    COUNT(i.id) as ingressos,
                    COALESCE(SUM(i.valor_pago), 0) as faturamento
                FROM eventos e
                LEFT JOIN compras c ON c.evento_id = e.id AND c.status = 'aprovada'
                LEFT JOIN ingressos i ON i.compra_id = c.id
                WHERE e.organizador_id = :org_id
            ");
            $stmt->execute(['org_id' => $_SESSION['usuario_id']]);
            $estatisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}