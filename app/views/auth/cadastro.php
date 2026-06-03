<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Eventos Online</title>
    <style>
        :root { --primary-color: #4F46E5; --bg-color: #F3F4F6; --text-color: #1F2937; }
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--bg-color); display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-container h2 { margin-top: 0; color: var(--text-color); text-align: center; }
        .form-group { margin-bottom: 1.5rem; display: flex; flex-direction: column; }
        .form-group label { margin-bottom: 0.5rem; color: var(--text-color); font-weight: 500; }
        .form-group input { padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 4px; font-size: 1rem; }
        .btn-submit { width: 100%; padding: 0.75rem; background-color: var(--primary-color); color: white; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer; transition: background 0.3s; margin-bottom: 1rem; }
        .btn-submit:hover { background-color: #4338CA; }
        .alert { background-color: #FEE2E2; color: #B91C1C; padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; text-align: center; font-size: 0.9rem; }
        .link-footer { text-align: center; display: block; color: var(--primary-color); text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Criar Conta</h2>

        <?php if (isset($_SESSION['erro_cadastro'])): ?>
            <div class="alert">
                <?= $_SESSION['erro_cadastro']; ?>
            </div>
            <?php unset($_SESSION['erro_cadastro']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/cadastro/processar" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn-submit">Cadastrar</button>
            <a href="<?= BASE_URL ?>/login" class="link-footer">Já tenho uma conta</a>
        </form>
    </div>
</body>
</html>