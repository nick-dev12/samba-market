<?php
/**
 * Page de connexion utilisateur
 * Programmation procédurale uniquement
 */

session_start();

// Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header('Location: /index.php');
    exit;
}

// Traiter le formulaire de connexion
require_once __DIR__ . '/../controllers/controller_users.php';
$result = process_user_login();

// Si la connexion est réussie, créer la session et rediriger
if (isset($result['success']) && $result['success'] && $result['user']) {
    $_SESSION['user_id'] = $result['user']['id'];
    $_SESSION['user_nom'] = $result['user']['nom'];
    $_SESSION['user_prenom'] = $result['user']['prenom'];
    $_SESSION['user_email'] = $result['user']['email'];
    $_SESSION['user_telephone'] = $result['user']['telephone'];
    $_SESSION['user_statut'] = $result['user']['statut'];
    
    header('Location: /index.php');
    exit;
}

// Afficher le message de succès d'inscription si présent
$inscription_success = '';
if (isset($_SESSION['inscription_success'])) {
    $inscription_success = $_SESSION['inscription_success'];
    unset($_SESSION['inscription_success']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Samba Market</title>
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
            max-width: 450px;
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

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin: 0;
            margin-top: 3px;
            cursor: pointer;
            accent-color: #918a44;
        }

        .checkbox-group label {
            font-weight: normal;
            cursor: pointer;
            font-size: 14px;
            line-height: 1.5;
            color: #000000;
        }

        .checkbox-group label a {
            color: #918a44;
            text-decoration: underline;
        }

        .checkbox-group label a:hover {
            color: #6b2f20;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <h1>Connexion</h1>
            <p>Accédez à votre compte</p>
        </div>

        <?php if (!empty($inscription_success)): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($inscription_success); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($result['message']) && !empty($result['message']) && !$result['success']): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $result['message']; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" id="loginForm">
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
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="accepte_conditions" name="accepte_conditions" value="1" required>
                <label for="accepte_conditions">
                    J'accepte les <a href="/conditions-utilisation.php" target="_blank">conditions d'utilisation</a> *
                </label>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>

        <div class="footer-text">
            <p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>
        </div>
    </div>
</body>
</html>

