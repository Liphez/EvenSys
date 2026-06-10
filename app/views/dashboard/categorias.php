<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        
        /* Estilos do Formulário e Tabela */
        form { display: flex; gap: 1rem; align-items: flex-end; }
        .form-group { display: flex; flex-direction: column; flex: 1; }
        .form-group input { padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 0.5rem 1rem; background-color: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer; }
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
        <a href="#">📅 Eventos</a>
        <a href="<?= BASE_URL ?>/logout" style="margin-top: auto; border-top: 1px solid #374151;">🚪 Sair</a>
    </nav>

    <main class="main-content">
        <div class="card">
            <h2>Nova Categoria</h2>
            <form action="<?= BASE_URL ?>/categorias/salvar" method="POST">
                <div class="form-group">
                    <label for="nome">Nome da Categoria (Ex: Show, Palestra)</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <div class="card">
            <h2>Categorias Cadastradas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $cat): ?>
                        <tr>
                            <td>#<?= $cat->id ?></td>
                            <td><?= htmlspecialchars($cat->nome) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>