<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Carrega dependências
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Controllers\AuthController;

// --- ROTEAMENTO PROFISSIONAL ---

// 2. Define a base do projeto para ser usada nos links e redirecionamentos
define('BASE_URL', '/EvenSys/public');

// 3. Pega a URL exata e isola apenas a rota solicitada
$rota_completa = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$rota = str_replace(BASE_URL, '', $rota_completa);

// 4. Se a rota ficar vazia, força a ida para a raiz '/'
if ($rota === '' || $rota === '/index.php') {
    $rota = '/';
}

// 5. Direciona para o Controller
switch ($rota) {
    case '/':
    case '/login':
        $controller = new AuthController();
        $controller->index();
        break;

    case '/login/processar':
        $controller = new AuthController();
        $controller->processarLogin();
        break;

    case '/cadastro':
        $controller = new AuthController();
        $controller->cadastro();
        break;

    case '/cadastro/processar':
        $controller = new AuthController();
        $controller->processarCadastro();
        break;

    case '/recuperar-senha':
        $controller = new AuthController();
        $controller->recuperarSenha();
        break;

    case '/recuperar-senha/processar':
        $controller = new AuthController();
        $controller->processarRecuperacao();
        break;

    case '/dashboard':
        $controller = new App\Controllers\DashboardController();
        $controller->index();
        break;

    case '/categorias':
        $controller = new App\Controllers\CategoriaController();
        $controller->index();
        break;

    case '/categorias/salvar':
        $controller = new App\Controllers\CategoriaController();
        $controller->salvar();
        break;
        echo "<h1>Bem-vindo, " . $_SESSION['usuario_nome'] . " (" . $_SESSION['usuario_perfil'] . ")!</h1>";
        echo "<a href='" . BASE_URL . "/logout'>Sair</a>";
        break;

    case '/eventos':
        $controller = new App\Controllers\EventoController();
        $controller->index();
        break;

    case '/eventos/salvar':
        $controller = new App\Controllers\EventoController();
        $controller->salvar();
        break;

    case '/logout':
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        break;

    default:
        http_response_code(404);
        echo "<h1>Erro 404 - Página não encontrada na rota: $rota</h1>";
        break;
}
