<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 500px; text-align: center; }
        .form-group input { padding: 1rem; width: 80%; border: 2px solid #D1D5DB; border-radius: 4px; font-size: 1.5rem; text-align: center; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem; }
        button { padding: 1rem 2rem; background-color: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1.2rem; font-weight: bold; width: 88%; }
        .alert { padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; font-weight: bold; }
        .alert.success { background: #D1FAE5; color: #065F46; border: 1px solid #10B981; }
        .alert.error { background: #FEE2E2; color: #991B1B; border: 1px solid #EF4444; }
    </style>
</head>
<body>
    <nav class="sidebar">
        <h2>EvenSys</h2>
        <a href="<?= BASE_URL ?>/dashboard">🏠 Início</a>
        <a href="<?= BASE_URL ?>/categorias">🏷️ Categorias</a>
        <a href="<?= BASE_URL ?>/eventos">📅 Eventos</a>
        <a href="<?= BASE_URL ?>/checkin" style="background: #374151;">✅ Check-in</a>
        <a href="<?= BASE_URL ?>/logout" style="margin-top: auto; border-top: 1px solid #374151;">🚪 Sair</a>
    </nav>

    <main class="main-content">
        <div class="card">
            <h2>Validação de Ingressos</h2>
            <p style="color: #6B7280; margin-bottom: 2rem;">Digite o código único do ingresso para liberar a entrada.</p>
            
            <?php if (isset($_SESSION['msg_checkin'])): ?>
                <?= $_SESSION['msg_checkin']; ?>
                <?php unset($_SESSION['msg_checkin']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/checkin/processar" method="POST">
                <div class="form-group">
                    <input type="text" name="codigo" placeholder="EX: A1B2C3D4E5" required autocomplete="off" autofocus>
                </div>
                <button type="submit">Validar Entrada</button>
            </form>
        </div>
    </main>
</body>
</html>