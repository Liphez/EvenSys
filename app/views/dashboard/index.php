<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem; }
        .stat-card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-left: 5px solid var(--primary); }
        .stat-card h3 { margin: 0; color: #6B7280; font-size: 1rem; }
        .stat-card .value { font-size: 2rem; font-weight: bold; color: #1F2937; margin-top: 0.5rem; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <h2>EvenSys</h2>
        <a href="<?= BASE_URL ?>/dashboard" style="background: #374151;">🏠 Início</a>
        <?php if ($_SESSION['usuario_perfil'] !== 'participante'): ?>
            <a href="<?= BASE_URL ?>/categorias">🏷️ Categorias</a>
            <a href="<?= BASE_URL ?>/eventos">📅 Eventos</a>
            <a href="<?= BASE_URL ?>/checkin">✅ Check-in</a>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>/logout" style="margin-top: auto; border-top: 1px solid #374151;">🚪 Sair</a>
    </nav>

    <main class="main-content">
        <h1>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>! 👋</h1>
        <p>Bem-vindo ao seu painel de controle.</p>

        <?php if ($_SESSION['usuario_perfil'] !== 'participante'): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total de Eventos</h3>
                    <div class="value"><?= $estatisticas['eventos'] ?></div>
                </div>
                <div class="stat-card" style="border-left-color: #10B981;">
                    <h3>Ingressos Vendidos</h3>
                    <div class="value"><?= $estatisticas['ingressos'] ?></div>
                </div>
                <div class="stat-card" style="border-left-color: #F59E0B;">
                    <h3>Faturamento Total</h3>
                    <div class="value">R$ <?= number_format($estatisticas['faturamento'], 2, ',', '.') ?></div>
                </div>
            </div>
        <?php else: ?>
            <div class="stat-card" style="margin-top: 2rem;">
                <h3>Área do Participante</h3>
                <p>Você pode explorar novos eventos na vitrine ou acessar seus ingressos comprados.</p>
                <a href="<?= BASE_URL ?>/vitrine" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: var(--primary); color: white; text-decoration: none; border-radius: 4px;">Ir para Vitrine</a>
                <a href="<?= BASE_URL ?>/meus-ingressos" style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #374151; color: white; text-decoration: none; border-radius: 4px; margin-left: 0.5rem;">Meus Ingressos</a>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>