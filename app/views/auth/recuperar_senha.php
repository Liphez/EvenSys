<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - EvenSys</title>
    <style>
        :root { --primary-color: #4F46E5; --bg-color: #F3F4F6; --text-color: #1F2937; }
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--bg-color); display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-container h2 { margin-top: 0; color: var(--text-color); text-align: center; }
        .login-container p { text-align: center; color: #6B7280; font-size: 0.9rem; margin-bottom: 1.5rem; }
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
        <h2>Recuperar Senha</h2>
        <p>Informe seu e-mail cadastrado e defina uma nova senha de acesso.</p>

        <?php if (isset($_SESSION['erro_recuperacao'])): ?>
            <div class="alert">
                <?= $_SESSION['erro_recuperacao']; ?>
            </div>
            <?php unset($_SESSION['erro_recuperacao']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/recuperar-senha/processar" method="POST">
            <div class="form-group">
                <label for="email">E-mail Cadastrado</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="nova_senha">Nova Senha</label>
                <input type="password" id="nova_senha" name="nova_senha" required>
            </div>
            <button type="submit" class="btn-submit">Redefinir Senha</button>
            <a href="<?= BASE_URL ?>/login" class="link-footer">Voltar para o Login</a>
        </form>
    </div>
</body>
</html>