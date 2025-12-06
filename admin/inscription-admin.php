<?php
session_start();

// Traiter le formulaire
require_once __DIR__ . '/../controllers/controller_admin.php';
$result = process_admin_inscription();

// Si l'inscription est réussie, rediriger vers la page de connexion
if (isset($result['success']) && $result['success']) {
    $_SESSION['inscription_success'] = $result['message'];
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Administrateur - Tresor Africain</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0e9e9 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #918a44 0%, #c26638 100%);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #6b2f20;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            color: #000000;
            font-size: 14px;
            opacity: 0.7;
        }

        .header .icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #918a44 0%, #c26638 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #ffffff;
            font-size: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #6b2f20;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #f0e9e9;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #ffffff;
            color: #000000;
        }

        .form-group input:focus {
            outline: none;
            border-color: #918a44;
            box-shadow: 0 0 0 3px rgba(145, 138, 68, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #918a44;
            font-size: 16px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #918a44;
            font-size: 16px;
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #6b2f20;
        }

        .input-wrapper.password-wrapper {
            position: relative;
        }

        .input-wrapper.password-wrapper input {
            padding-right: 45px;
        }

        .input-wrapper.password-wrapper .password-toggle {
            right: 15px;
        }

        .error-message {
            background: #fee;
            border-left: 4px solid #c26638;
            color: #6b2f20;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .success-message {
            background: #efe;
            border-left: 4px solid #918a44;
            color: #6b2f20;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #918a44 0%, #c26638 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(145, 138, 68, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .password-requirements {
            background: #f0e9e9;
            padding: 12px;
            border-radius: 6px;
            margin-top: 8px;
            font-size: 12px;
            color: #6b2f20;
        }

        .password-requirements ul {
            list-style: none;
            padding-left: 0;
            margin: 5px 0 0 0;
        }

        .password-requirements li {
            margin: 5px 0;
            padding-left: 20px;
            position: relative;
        }

        .password-requirements li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #918a44;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            color: #000000;
            font-size: 14px;
            opacity: 0.7;
        }

        .footer-text a {
            color: #918a44;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .header .icon {
                width: 60px;
                height: 60px;
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1>Inscription Administrateur</h1>
            <p>Créez le compte administrateur principal</p>
        </div>

        <?php if (isset($result['message']) && !empty($result['message'])): ?>
            <?php if (isset($result['success']) && $result['success']): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($result['message']); ?>
                </div>
            <?php else: ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $result['message']; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="" id="inscriptionForm">
            <div class="form-group">
                <label for="nom"><i class="fas fa-user"></i> Nom *</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required
                    value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="prenom"><i class="fas fa-user"></i> Prénom *</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required
                    value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email *</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="votre@email.com" required
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Mot de passe *</label>
                <div class="input-wrapper password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="password-requirements">
                    <strong>Le mot de passe doit contenir :</strong>
                    <ul>
                        <li>Au moins 8 caractères</li>
                        <li>Au moins une majuscule</li>
                        <li>Au moins une minuscule</li>
                        <li>Au moins un chiffre</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirm"><i class="fas fa-lock"></i> Confirmer le mot de passe *</label>
                <div class="input-wrapper password-wrapper">
                    <input type="password" id="password_confirm" name="password_confirm"
                        placeholder="Confirmez votre mot de passe" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirm', this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Créer le compte administrateur
            </button>
        </form>

        <div class="footer-text">
            <p>Après l'inscription, vous serez redirigé vers la page de connexion</p>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>