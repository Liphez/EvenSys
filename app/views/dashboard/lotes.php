<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Lotes - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        form { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; align-items: end; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-group input { padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 4px; }
        button { padding: 0.75rem; background-color: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { text-align: left; padding: 0.75rem; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>

    <nav class="sidebar">
        <h2>EvenSys</h2>
        <a href="<?= BASE_URL ?>/dashboard">🏠 Início</a>
        <a href="<?= BASE_URL ?>/categorias">🏷️ Categorias</a>
        <a href="<?= BASE_URL ?>/eventos">📅 Eventos</a>
        <a href="<?= BASE_URL ?>/logout" style="margin-top: auto; border-top: 1px solid #374151;">🚪 Sair</a>
    </nav>

    <main class="main-content">
        <a href="<?= BASE_URL ?>/eventos" style="color: var(--primary); text-decoration: none; font-weight: bold;">⬅ Voltar para Eventos</a>
        
        <div class="card" style="margin-top: 1rem;">
            <h2>Adicionar Novo Lote de Ingressos</h2>
            <form action="<?= BASE_URL ?>/lotes/salvar" method="POST">
                <input type="hidden" name="evento_id" value="<?= htmlspecialchars($_GET['evento_id'] ?? '') ?>">
                
                <div class="form-group">
                    <label for="nome">Nome (Ex: Lote 1, VIP)</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade de Ingressos</label>
                    <input type="number" id="quantidade" name="quantidade" min="1" required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço Unitário (R$)</label>
                    <input type="text" id="preco" name="preco" placeholder="Ex: 50,00" required>
                </div>
                <button type="submit" style="grid-column: span 3;">Salvar Lote</button>
            </form>
        </div>

        <div class="card">
            <h2>Lotes Ativos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome do Lote</th>
                        <th>Preço</th>
                        <th>Disponíveis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($lotes)): ?>
                        <tr><td colspan="3" style="text-align: center;">Nenhum lote configurado. O evento aparecerá como "Esgotado".</td></tr>
                    <?php else: ?>
                        <?php foreach ($lotes as $lote): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($lote->nome) ?></strong></td>
                                <td>R$ <?= number_format($lote->preco, 2, ',', '.') ?></td>
                                <td><?= $lote->quantidade ?> ingressos</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>