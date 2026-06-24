<?php

namespace App\Controllers;

class DashboardController
{
    public function __construct()
    {
        // Trava de segurança: Se não estiver logado, expulsa para o login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public function index()
    {
        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}