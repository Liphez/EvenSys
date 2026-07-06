<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Eventos - EvenSys</title>
    <style>
        :root { --primary: #4F46E5; --bg: #F3F4F6; --sidebar: #1F2937; --text-light: #F9FAFB; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg); display: flex; height: 100vh; }
        .sidebar { width: 250px; background-color: var(--sidebar); color: var(--text-light); display: flex; flex-direction: column; }
        .sidebar h2 { text-align: center; border-bottom: 1px solid #374151; padding-bottom: 1rem; margin-top: 2rem; }
        .sidebar a { color: var(--text-light); text-decoration: none; padding: 1rem 1.5rem; transition: 0.3s; }
        .sidebar a:hover { background-color: #374151; }
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .card { background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1.5rem; }
        
        /* Layout em Grid para o formulário de Eventos */
        form { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: span 2; }
        .form-group label { font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
        .form-group input, .form-group select, .form-group textarea { padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 4px; font-family: inherit; }
        button { grid-column: span 2; padding: 0.75rem; background-color: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; margin-top: 0.5rem; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { text-align: left; padding: 0.75rem; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .badge-status { background: #D1FAE5; color: #065F46; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
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
        <div class="card">
            <h2>Criar Novo Evento</h2>
            <form action="<?= BASE_URL ?>/eventos/salvar" method="POST">
                
                <div class="form-group full-width">
                    <label for="titulo">Título do Evento</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    <select id="categoria_id" name="categoria_id" required>
                        <option value="">Selecione uma categoria...</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat->id ?>"><?= htmlspecialchars($cat->nome) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_hora">Data e Horário</label>
                    <input type="datetime-local" id="data_hora" name="data_hora" required>
                </div>

                <div class="form-group">
                    <label for="local">Local (Endereço ou Link)</label>
                    <input type="text" id="local" name="local" required>
                </div>

                <div class="form-group">
                    <label for="capacidade_maxima">Capacidade Máxima</label>
                    <input type="number" id="capacidade_maxima" name="capacidade_maxima" min="1" required>
                </div>

                <div class="form-group full-width">
                    <label for="descricao">Descrição do Evento</label>
                    <textarea id="descricao" name="descricao" rows="3"></textarea>
                </div>

                <button type="submit">Salvar Evento</button>
            </form>
        </div>

        <div class="card">
            <h2>Meus Eventos Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($eventos)): ?>
                        <tr><td colspan="4" style="text-align: center;">Nenhum evento cadastrado.</td></tr>
                    <?php else: ?>
                        <?php foreach ($eventos as $ev): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($ev->titulo) ?></strong></td>
                                <td><?= date('d/m/Y H:i', strtotime($ev->data_hora)) ?></td>
                                <td>
                                    <?php if($ev->status === 'ativo'): ?>
                                        <span class="badge-status" style="background: #D1FAE5; color: #065F46;">ATIVO</span>
                                    <?php else: ?>
                                        <span class="badge-status" style="background: #FEE2E2; color: #991B1B;">CANCELADO</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($ev->status === 'ativo'): ?>
                                        <a href="<?= BASE_URL ?>/lotes?evento_id=<?= $ev->id ?>" style="background: var(--primary); color: white; padding: 0.3rem 0.6rem; text-decoration: none; border-radius: 4px; font-size: 0.8rem; margin-right: 0.5rem;">🏷️ Lotes</a>
                                        
                                        <form action="<?= BASE_URL ?>/eventos/cancelar" method="POST" style="display:inline; grid-template-columns: none; gap: 0;">
                                            <input type="hidden" name="id" value="<?= $ev->id ?>">
                                            <button type="submit" style="background: #DC2626; color: white; padding: 0.3rem 0.6rem; border: none; border-radius: 4px; font-size: 0.8rem; cursor: pointer; margin-top: 0;" onclick="return confirm('Atenção: Cancelar o evento encerra todas as vendas. Deseja continuar?');">🚫 Cancelar</button>
                                        </form>
                                    <?php else: ?>
                                        <span style="font-size: 0.8rem; color: #6B7280;">Nenhuma ação disponível</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>