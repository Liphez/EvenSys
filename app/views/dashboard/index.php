<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        
        /* Menu Lateral (Sidebar) */
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        
        /* Conteúdo Principal */
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="sidebar">
        <h2>EvenSys</h2>
        <a href="<?= BASE_URL ?>/dashboard">🏠 Início</a>
        <?php if ($_SESSION['usuario_perfil'] !== 'participante'): ?>
            <a href="<?= BASE_URL ?>/categorias">🏷️ Categorias</a>
            <a href="#">📅 Eventos</a>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>/logout" style="margin-top: auto; border-top: 1px solid #374151;">🚪 Sair</a>
    </nav>

    <main class="main-content">
        <div class="card">
            <h1>Bem-vindo, <?= $_SESSION['usuario_nome'] ?>!</h1>
            <p>Seu perfil de acesso é: <strong><?= ucfirst($_SESSION['usuario_perfil']) ?></strong>.</p>
            <p>Utilize o menu lateral para navegar pelas opções do sistema.</p>
        </div>
    </main>

</body>
</html>