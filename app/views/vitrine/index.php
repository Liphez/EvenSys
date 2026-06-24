<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Disponíveis - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --text: #1F2937; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); color: var(--text); }
        .navbar { background: #fff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .navbar a { text-decoration: none; color: var(--primary); font-weight: bold; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: 0.3s; }
        .card:hover { transform: translateY(-5px); }
        .card-content { padding: 1.5rem; }
        .tag { background: #E0E7FF; color: var(--primary); padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
        .btn { display: inline-block; width: 100%; text-align: center; background: var(--primary); color: #fff; padding: 0.75rem; text-decoration: none; border-radius: 4px; margin-top: 1rem; font-weight: 500; }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>🎉 EvenSys Ticket</h2>
        <div>
            <?php if(isset($_SESSION['usuario_id'])): ?>
                <a href="<?= BASE_URL ?>/dashboard">Meu Painel</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/login">Entrar</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <h2>Próximos Eventos</h2>
        <div class="grid">
            <?php if(empty($eventos)): ?>
                <p>Nenhum evento disponível no momento.</p>
            <?php else: ?>
                <?php foreach($eventos as $ev): ?>
                    <div class="card">
                        <div class="card-content">
                            <span class="tag"><?= htmlspecialchars($ev->categoria_nome ?? 'Geral') ?></span>
                            <h3 style="margin: 0.5rem 0;"><?= htmlspecialchars($ev->titulo) ?></h3>
                            <p style="color: #6B7280; font-size: 0.9rem;">📍 <?= htmlspecialchars($ev->local) ?></p>
                            <p style="color: #6B7280; font-size: 0.9rem;">📅 <?= date('d/m/Y \à\s H:i', strtotime($ev->data_hora)) ?></p>
                            <a href="<?= BASE_URL ?>/evento/detalhes?id=<?= $ev->id ?>" class="btn">Ver Detalhes</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>