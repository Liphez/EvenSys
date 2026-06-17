<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($evento->titulo) ?> - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --text: #1F2937; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); color: var(--text); }
        .navbar { background: #fff; padding: 1rem 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar a { text-decoration: none; color: var(--primary); font-weight: bold; }
        .container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-top: 1.5rem; display: flex; flex-direction: column; }
        .form-group select { padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 4px; font-size: 1rem; }
        .btn { width: 100%; text-align: center; background: var(--primary); color: #fff; padding: 1rem; border: none; border-radius: 4px; margin-top: 1.5rem; font-size: 1.1rem; font-weight: bold; cursor: pointer; }
        .btn:disabled { background: #9CA3AF; cursor: not-allowed; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="<?= BASE_URL ?>/vitrine">⬅ Voltar para Eventos</a>
    </nav>

    <div class="container">
        <div class="card">
            <span style="background: #E0E7FF; color: #4F46E5; padding: 0.3rem 0.6rem; border-radius: 4px; font-size: 0.9rem; font-weight: bold;">
                <?= htmlspecialchars($evento->categoria_nome ?? 'Geral') ?>
            </span>
            <h1 style="margin-top: 1rem;"><?= htmlspecialchars($evento->titulo) ?></h1>
            <p style="color: #4B5563; line-height: 1.6;"><?= nl2br(htmlspecialchars($evento->descricao)) ?></p>
            
            <hr style="border: 0; border-top: 1px solid #E5E7EB; margin: 2rem 0;">
            
            <h3>Informações</h3>
            <p><strong>📍 Local:</strong> <?= htmlspecialchars($evento->local) ?></p>
            <p><strong>📅 Data:</strong> <?= date('d/m/Y \à\s H:i', strtotime($evento->data_hora)) ?></p>
            <p><strong>🏢 Organizador:</strong> <?= htmlspecialchars($evento->organizador_nome) ?></p>

            <form action="<?= BASE_URL ?>/comprar" method="POST">
                <input type="hidden" name="evento_id" value="<?= $evento->id ?>">
                
                <div class="form-group">
                    <label for="lote_id" style="font-weight: bold; margin-bottom: 0.5rem;">Escolha seu Ingresso:</label>
                    <select id="lote_id" name="lote_id" required>
                        <option value="">Selecione um lote...</option>
                        <?php foreach($lotes as $lote): ?>
                            <option value="<?= $lote->id ?>">
                                <?= htmlspecialchars($lote->nome) ?> - R$ <?= number_format($lote->preco, 2, ',', '.') ?> (<?= $lote->quantidade ?> disponíveis)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if(empty($lotes)): ?>
                    <button type="button" class="btn" disabled>Ingressos Esgotados ou Indisponíveis</button>
                <?php else: ?>
                    <button type="submit" class="btn">Comprar Ingresso</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

</body>
</html>