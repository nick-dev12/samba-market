<?php
/**
 * Page de profil utilisateur - Modification des informations
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer les informations de l'utilisateur
require_once __DIR__ . '/../models/model_users.php';
$user = get_user_by_id($_SESSION['user_id']);

if (!$user) {
    session_destroy();
    header('Location: connexion.php');
    exit;
}

// Traitement des formulaires
$success_message = '';
$error_message = '';

// Récupérer le message de succès de la session (après redirection)
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Traitement du formulaire d'informations personnelles
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_profil'])) {
    // Récupération et nettoyage des données
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';

    $errors = [];

    // Validation du nom
    if (empty($nom)) {
        $errors[] = 'Le nom est obligatoire.';
    } elseif (strlen($nom) < 2) {
        $errors[] = 'Le nom doit contenir au moins 2 caractères.';
    }

    // Validation du prénom
    if (empty($prenom)) {
        $errors[] = 'Le prénom est obligatoire.';
    } elseif (strlen($prenom) < 2) {
        $errors[] = 'Le prénom doit contenir au moins 2 caractères.';
    }

    // Validation de l'email
    if (empty($email)) {
        $errors[] = 'L\'email est obligatoire.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'email n\'est pas valide.';
    } else {
        // Vérifier si l'email existe déjà pour un autre utilisateur
        $existing_user = get_user_by_email($email);
        if ($existing_user && $existing_user['id'] != $_SESSION['user_id']) {
            $errors[] = 'Cet email est déjà utilisé par un autre compte.';
        }
    }

    // Validation du téléphone
    if (empty($telephone)) {
        $errors[] = 'Le téléphone est obligatoire.';
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $telephone)) {
        $errors[] = 'Le format du téléphone n\'est pas valide.';
    }

    // Si aucune erreur, procéder à la mise à jour
    if (empty($errors)) {
        // Préparer les données à mettre à jour
        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone
        ];

        // Mettre à jour les informations de base
        if (update_user($_SESSION['user_id'], $data)) {
            // Mettre à jour l'email dans la session
            $_SESSION['user_email'] = $email;

            // Redirection pour éviter la double soumission (pattern Post-Redirect-Get)
            $_SESSION['success_message'] = 'Vos informations personnelles ont été mises à jour avec succès !';
            header('Location: profil.php');
            exit;
        } else {
            $error_message = 'Une erreur est survenue lors de la mise à jour. Veuillez réessayer.';
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}

// Traitement du formulaire de changement de mot de passe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier_mot_de_passe'])) {
    // Récupération et nettoyage des données (protection XSS)
    $current_password = isset($_POST['current_password']) ? $_POST['current_password'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    $errors = [];

    // Validation du mot de passe actuel
    if (empty($current_password)) {
        $errors[] = 'Le mot de passe actuel est obligatoire.';
    } else {
        // Vérifier que le mot de passe actuel est correct
        if (!password_verify($current_password, $user['password'])) {
            $errors[] = 'Le mot de passe actuel est incorrect.';
        }
    }

    // Validation du nouveau mot de passe
    if (empty($password)) {
        $errors[] = 'Le nouveau mot de passe est obligatoire.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Le nouveau mot de passe doit contenir au moins 6 caractères.';
    } elseif ($password === $current_password) {
        $errors[] = 'Le nouveau mot de passe doit être différent de l\'ancien.';
    } elseif ($password !== $password_confirm) {
        $errors[] = 'Les nouveaux mots de passe ne correspondent pas.';
    }

    // Si aucune erreur, procéder à la mise à jour
    if (empty($errors)) {
        require_once __DIR__ . '/../conn/conn.php';
        global $db;

        // Protection contre les injections SQL : utilisation de PDO avec prepared statements
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");

        if (
            $stmt->execute([
                'id' => $_SESSION['user_id'],
                'password' => $password_hash
            ])
        ) {
            // Redirection pour éviter la double soumission (pattern Post-Redirect-Get)
            $_SESSION['success_message'] = 'Votre mot de passe a été modifié avec succès !';
            header('Location: profil.php');
            exit;
        } else {
            $error_message = 'Une erreur est survenue lors de la modification du mot de passe. Veuillez réessayer.';
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/user-dashboard.css">
    <style>
        .profil-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .profil-header {
            background: linear-gradient(135deg, #918a44 0%, #6b2f20 100%);
            color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
        }

        .profil-header .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 48px;
        }

        .profil-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .profil-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .profil-form {
            background: #ffffff;
            border: 1px solid #f0e9e9;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #6b2f20;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group label .required {
            color: #dc3545;
            margin-left: 3px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #f0e9e9;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #918a44;
            box-shadow: 0 0 0 3px rgba(145, 138, 68, 0.1);
        }

        .form-group .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .btn-submit {
            background-color: #918a44;
            color: #ffffff;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background-color: #6b2f20;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-cancel {
            background-color: #f0e9e9;
            color: #6b2f20;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-cancel:hover {
            background-color: #e0d9d9;
        }

        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .info-section h3 {
            color: #6b2f20;
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item label {
            color: #666;
            font-weight: 500;
            font-size: 14px;
        }

        .info-item .value {
            color: #000000;
            font-weight: 600;
            font-size: 14px;
        }

        .form-section {
            background: #ffffff;
            border: 1px solid #f0e9e9;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-section h3 {
            color: #6b2f20;
            font-size: 18px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0e9e9;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .security-section {
            background: #fff9f0;
            border: 1px solid #f0e9e9;
        }

        .security-section h3 {
            color: #c26638;
        }
    </style>
</head>

<body>
    <?php include 'includes/user_nav.php'; ?>

    <div class="content-header">
        <h1><i class="fas fa-user"></i> Mon Profil</h1>
    </div>

    <section class="content-section">
        <div class="profil-container">
            <!-- En-tête du profil -->
            <div class="profil-header">
                <div class="avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h2><?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></h2>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>

            <!-- Messages -->
            <?php if ($success_message): ?>
                <div class="message success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo $success_message; ?></span>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>

            <!-- Informations du compte -->
            <div class="info-section">
                <h3><i class="fas fa-info-circle"></i> Informations du compte</h3>
                <div class="info-item">
                    <label>Date d'inscription:</label>
                    <span class="value"><?php echo date('d/m/Y', strtotime($user['date_creation'])); ?></span>
                </div>
                <div class="info-item">
                    <label>Statut:</label>
                    <span class="value"
                        style="color: <?php echo $user['statut'] == 'actif' ? '#0f5132' : '#842029'; ?>">
                        <?php echo ucfirst($user['statut']); ?>
                    </span>
                </div>
            </div>

            <!-- Section Informations personnelles -->
            <form method="POST" action="" class="profil-form">
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Informations personnelles</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom <span class="required">*</span></label>
                            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom <span class="required">*</span></label>
                            <input type="text" id="prenom" name="prenom"
                                value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone <span class="required">*</span></label>
                        <input type="tel" id="telephone" name="telephone"
                            value="<?php echo htmlspecialchars($user['telephone']); ?>" required>
                        <div class="help-text">Format: +225 XX XX XX XX XX ou 0X XX XX XX XX</div>
                    </div>

                    <div style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
                        <button type="submit" name="modifier_profil" class="btn-submit">
                            <i class="fas fa-save"></i> Enregistrer les modifications
                        </button>
                        <a href="mon-compte.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>

            <!-- Section Sécurité -->
            <form method="POST" action="" class="profil-form">
                <div class="form-section security-section">
                    <h3><i class="fas fa-lock"></i> Sécurité</h3>

                    <div class="form-group">
                        <label for="current_password">Mot de passe actuel <span class="required">*</span></label>
                        <input type="password" id="current_password" name="current_password"
                            placeholder="Entrez votre mot de passe actuel" required autocomplete="current-password">
                        <div class="help-text">Vous devez confirmer votre mot de passe actuel pour le modifier</div>
                    </div>

                    <div class="form-group">
                        <label for="password">Nouveau mot de passe <span class="required">*</span></label>
                        <input type="password" id="password" name="password"
                            placeholder="Entrez votre nouveau mot de passe" required autocomplete="new-password">
                        <div class="help-text">Minimum 6 caractères</div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirmer le nouveau mot de passe <span
                                class="required">*</span></label>
                        <input type="password" id="password_confirm" name="password_confirm"
                            placeholder="Confirmez votre nouveau mot de passe" required autocomplete="new-password">
                    </div>

                    <div style="margin-top: 25px; display: flex; align-items: center; gap: 10px;">
                        <button type="submit" name="modifier_mot_de_passe" class="btn-submit">
                            <i class="fas fa-key"></i> Changer le mot de passe
                        </button>
                        <a href="mon-compte.php" class="btn-cancel">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include 'includes/user_footer.php'; ?>
</body>

</html>