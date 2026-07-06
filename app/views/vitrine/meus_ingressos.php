<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Ingressos - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --text: #1F2937; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); color: var(--text); }
        .navbar { background: #fff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .navbar a { text-decoration: none; color: var(--primary); font-weight: bold; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .ticket { background: #fff; border-radius: 8px; display: flex; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 1.5rem; overflow: hidden; border-left: 8px solid var(--primary); }
        .ticket-info { padding: 1.5rem; flex: 1; }
        .ticket-code { background: #F9FAFB; padding: 1.5rem; display: flex; flex-direction: column; justify-content: center; align-items: center; border-left: 2px dashed #E5E7EB; min-width: 200px; }
        .code-hash { background: #E5E7EB; padding: 0.5rem 1rem; border-radius: 4px; font-family: monospace; font-size: 1.2rem; font-weight: bold; margin-top: 0.5rem; letter-spacing: 2px; }
        .status-badge { background: #D1FAE5; color: #065F46; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: bold; display: inline-block; margin-bottom: 0.5rem; }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>🎉 EvenSys Ticket</h2>
        <div>
            <a href="<?= BASE_URL ?>/vitrine" style="margin-right: 1rem;">Ver Eventos</a>
            <a href="<?= BASE_URL ?>/logout">Sair</a>
        </div>
    </nav>

    <div class="container">
        <h2>🎟️ Meus Ingressos</h2>
        
        <?php if(empty($ingressos)): ?>
            <p>Você ainda não comprou nenhum ingresso.</p>
        <?php else: ?>
            <?php foreach($ingressos as $ing): ?>
                <div class="ticket">
                    <div class="ticket-info">
                        <span class="status-badge">✅ Válido</span>
                        <h3 style="margin: 0.5rem 0;"><?= htmlspecialchars($ing->evento_nome) ?></h3>
                        <p style="color: #6B7280; font-size: 0.9rem; margin: 0.2rem 0;">📅 <?= date('d/m/Y \à\s H:i', strtotime($ing->data_hora)) ?></p>
                        <p style="color: #6B7280; font-size: 0.9rem; margin: 0.2rem 0;">🏷️ <?= htmlspecialchars($ing->lote_nome) ?> - R$ <?= number_format($ing->valor_pago, 2, ',', '.') ?></p>
                    </div>
                    <div class="ticket-code">
                        <span style="font-size: 0.8rem; color: #6B7280; text-transform: uppercase;">Código de Entrada</span>
                        <div class="code-hash"><?= htmlspecialchars($ing->codigo_unico) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>