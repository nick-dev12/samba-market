<?php
/**
 * Page d'inscription utilisateur
 * Programmation procédurale uniquement
 */

session_start();

// Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header('Location: mon-compte.php');
    exit;
}

// Traiter le formulaire
require_once __DIR__ . '/../controllers/controller_users.php';
$result = process_user_inscription();

// Si l'inscription est réussie, rediriger vers la page de connexion
if (isset($result['success']) && $result['success']) {
    $_SESSION['inscription_success'] = $result['message'];
    header('Location: connexion.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Samba Market</title>
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

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Créer un compte</h1>
            <p>Rejoignez Samba Market</p>
        </div>

        <?php if (isset($result['message']) && !empty($result['message']) && !$result['success']): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $result['message']; ?>
            </div>
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
                <label for="telephone"><i class="fas fa-phone"></i> Téléphone *</label>
                <div class="input-wrapper">
                    <input type="tel" id="telephone" name="telephone" placeholder="+241 01 23 45 67" required
                           value="<?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : ''; ?>">
                    <i class="fas fa-phone"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Mot de passe *</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirm"><i class="fas fa-lock"></i> Confirmer le mot de passe *</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmez votre mot de passe" required>
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> S'inscrire
            </button>
        </form>

        <div class="footer-text">
            <p>Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>
        </div>
    </div>
</body>
</html>

