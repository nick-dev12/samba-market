<?php
/**
 * Page de gestion des utilisateurs (Admin)
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: ../login.php');
    exit;
}

// Traitement de la désactivation/activation
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_statut'])) {
    $user_id = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
    $nouveau_statut = isset($_POST['nouveau_statut']) ? $_POST['nouveau_statut'] : '';
    
    if ($user_id > 0 && in_array($nouveau_statut, ['actif', 'inactif'])) {
        require_once __DIR__ . '/../../models/model_users.php';
        if (update_user_statut($user_id, $nouveau_statut)) {
            $success_message = $nouveau_statut === 'actif' 
                ? 'Utilisateur activé avec succès !' 
                : 'Utilisateur désactivé avec succès !';
        } else {
            $error_message = 'Une erreur est survenue lors de la modification du statut.';
        }
    }
}

// Récupérer tous les utilisateurs avec leurs statistiques
require_once __DIR__ . '/../../models/model_users.php';
$users = get_all_users_with_stats();

// Statistiques globales
$total_users = count($users);
$users_actifs = count(array_filter($users, function($u) { return $u['statut'] === 'actif'; }));
$users_inactifs = count(array_filter($users, function($u) { return $u['statut'] === 'inactif'; }));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
        .users-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #918a44;
        }

        .stat-box h3 {
            color: #6b2f20;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .stat-box .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #918a44;
        }

        .users-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .user-card {
            background: #ffffff;
            border: 1px solid #f0e9e9;
            border-radius: 12px;
            padding: 20px;
            width: 280px;
            max-width: 300px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .user-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .user-card.inactive {
            opacity: 0.7;
            background: #f9f9f9;
        }

        .user-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0e9e9;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #918a44;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-name {
            font-size: 16px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 4px;
        }

        .user-email {
            font-size: 12px;
            color: #666;
            word-break: break-word;
        }

        .user-statut {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .statut-actif {
            background: #d1e7dd;
            color: #0f5132;
        }

        .statut-inactif {
            background: #f8d7da;
            color: #842029;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        .detail-item {
            font-size: 13px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed #f0e9e9;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item label {
            color: #666;
            font-size: 12px;
            font-weight: 500;
        }

        .detail-item .value {
            color: #000000;
            font-weight: 600;
            text-align: right;
            font-size: 13px;
        }

        .user-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
            background: #ffffff;
            border-radius: 6px;
            border: 1px solid #f0e9e9;
        }

        .stat-item-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-item-value {
            font-size: 20px;
            font-weight: 700;
            color: #918a44;
        }

        .user-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #f0e9e9;
        }

        .btn-action {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .btn-activate {
            background-color: #0f5132;
            color: #ffffff;
        }

        .btn-activate:hover {
            background-color: #155724;
            transform: translateY(-1px);
        }

        .btn-deactivate {
            background-color: #dc3545;
            color: #ffffff;
        }

        .btn-deactivate:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.4;
            color: #918a44;
        }

        .empty-state h3 {
            font-size: 20px;
            color: #6b2f20;
            margin-bottom: 10px;
        }

        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
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
    </style>
</head>
<body>
    <?php include '../includes/nav.php'; ?>
    
    <div class="content-header">
        <h1><i class="fas fa-users"></i> Gestion des Utilisateurs</h1>
    </div>

    <!-- Messages -->
    <?php if ($success_message): ?>
        <div class="message success">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="message error">
            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <!-- Statistiques -->
    <div class="users-stats">
        <div class="stat-box">
            <h3>Total Utilisateurs</h3>
            <div class="stat-value"><?php echo $total_users; ?></div>
        </div>
        <div class="stat-box">
            <h3>Utilisateurs Actifs</h3>
            <div class="stat-value"><?php echo $users_actifs; ?></div>
        </div>
        <div class="stat-box">
            <h3>Utilisateurs Inactifs</h3>
            <div class="stat-value"><?php echo $users_inactifs; ?></div>
        </div>
    </div>

    <!-- Liste des utilisateurs -->
    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-list"></i> Liste des Utilisateurs (<?php echo count($users); ?>)</h2>
            <p style="color: #666; font-size: 13px; margin-top: 5px;">
                Classés par nombre de commandes (du plus actif au moins actif)
            </p>
        </div>

        <?php if (empty($users)): ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Aucun utilisateur</h3>
                <p>Aucun utilisateur n'est enregistré dans le système.</p>
            </div>
        <?php else: ?>
            <div class="users-grid">
                <?php foreach ($users as $user): ?>
                    <div class="user-card <?php echo $user['statut'] === 'inactif' ? 'inactive' : ''; ?>">
                        <span class="user-statut statut-<?php echo $user['statut']; ?>">
                            <?php echo $user['statut'] === 'actif' ? 'Actif' : 'Inactif'; ?>
                        </span>
                        
                        <div class="user-header">
                            <div class="user-avatar">
                                <?php echo strtoupper(substr($user['prenom'], 0, 1)); ?>
                            </div>
                            <div class="user-info">
                                <div class="user-name">
                                    <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
                                </div>
                                <div class="user-email">
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="user-details">
                            <div class="detail-item">
                                <label>Téléphone</label>
                                <div class="value" style="font-size: 12px;">
                                    <?php echo htmlspecialchars($user['telephone']); ?>
                                </div>
                            </div>
                            <div class="detail-item">
                                <label>Date d'inscription</label>
                                <div class="value" style="font-size: 12px;">
                                    <?php echo date('d/m/Y', strtotime($user['date_creation'])); ?>
                                </div>
                            </div>
                        </div>

                        <div class="user-stats">
                            <div class="stat-item">
                                <div class="stat-item-label">Commandes</div>
                                <div class="stat-item-value"><?php echo (int)$user['nb_commandes']; ?></div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-item-label">Reçues</div>
                                <div class="stat-item-value"><?php echo (int)$user['nb_commandes_livrees']; ?></div>
                            </div>
                        </div>

                        <div class="user-actions">
                            <?php if ($user['statut'] === 'actif'): ?>
                                <form method="POST" action="" style="flex: 1; margin: 0;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="nouveau_statut" value="inactif">
                                    <button type="submit" name="toggle_statut" class="btn-action btn-deactivate"
                                            onclick="return confirm('Êtes-vous sûr de vouloir désactiver cet utilisateur ?');">
                                        <i class="fas fa-ban"></i> Désactiver
                                    </button>
                                </form>
                            <?php else: ?>
                                <form method="POST" action="" style="flex: 1; margin: 0;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <input type="hidden" name="nouveau_statut" value="actif">
                                    <button type="submit" name="toggle_statut" class="btn-action btn-activate"
                                            onclick="return confirm('Êtes-vous sûr de vouloir activer cet utilisateur ?');">
                                        <i class="fas fa-check"></i> Activer
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include '../includes/footer.php'; ?>

</body>
</html>

