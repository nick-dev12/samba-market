<?php
/**
 * Page des commandes livrées
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer uniquement les commandes avec le statut "livree"
require_once __DIR__ . '/../models/model_commandes.php';
$commandes = get_commandes_by_user($_SESSION['user_id']);

// Filtrer pour ne garder que les commandes avec le statut "livree"
$commandes_livrees = array_filter($commandes, function($commande) {
    return $commande['statut'] === 'livree';
});
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes Livrées - Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/user-dashboard.css">
    <style>
        .commandes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        @media (min-width: 300px) {
            .commandes-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 300px));
            }
        }

        .commande-item {
            background: #ffffff;
            border: 1px solid #f0e9e9;
            border-radius: 12px;
            padding: 20px;
            max-width: 300px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .commande-item:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .commande-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            gap: 10px;
        }

        .commande-info {
            width: 100%;
        }

        .commande-info h3 {
            color: #6b2f20;
            font-size: 16px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .commande-info p {
            color: #666;
            font-size: 12px;
            margin: 0;
        }

        .commande-statut {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .statut-livree {
            background: #d1e7dd;
            color: #0f5132;
        }

        .commande-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0e9e9;
        }

        .detail-item {
            font-size: 13px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
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

        .btn-view-categories {
            display: inline-block;
            padding: 10px 20px;
            background-color: #918a44;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-view-categories:hover {
            background-color: #6b2f20;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        .empty-state p {
            font-size: 14px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <?php include 'includes/user_nav.php'; ?>
    
    <div class="content-header">
        <h1><i class="fas fa-check-circle"></i> Commandes Livrées</h1>
        <p style="color: #737373; margin-top: 10px; font-size: 14px;">
            Toutes les commandes que vous avez reçues
        </p>
    </div>

    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-box"></i> Mes Commandes Reçues (<?php echo count($commandes_livrees); ?>)</h2>
        </div>

        <?php if (empty($commandes_livrees)): ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>Aucune commande livrée</h3>
                <p>Vous n'avez pas encore reçu de commandes. Vos commandes livrées apparaîtront ici une fois que vous aurez confirmé la réception de vos colis.</p>
                <a href="mes-commandes.php" style="display: inline-block; padding: 12px 25px; background: #918a44; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-shopping-bag"></i> Voir mes commandes
                </a>
            </div>
        <?php else: ?>
            <div class="commandes-grid">
                <?php foreach ($commandes_livrees as $commande): ?>
                    <div class="commande-item">
                        <div class="commande-header">
                            <div class="commande-info">
                                <h3>Commande #<?php echo htmlspecialchars($commande['numero_commande']); ?></h3>
                                <p>Date: <?php echo date('d/m/Y à H:i', strtotime($commande['date_commande'])); ?></p>
                            </div>
                            <span class="commande-statut statut-livree" style="align-self: flex-start;">
                                <i class="fas fa-check-circle"></i> Reçu
                            </span>
                        </div>
                        <div class="commande-details">
                            <div class="detail-item">
                                <label>Montant total</label>
                                <div class="value"><?php echo number_format($commande['montant_total'], 0, ',', ' '); ?> FCFA</div>
                            </div>
                            <div class="detail-item">
                                <label>Adresse</label>
                                <div class="value" style="font-size: 11px; max-width: 150px; text-align: right; word-break: break-word;">
                                    <?php echo htmlspecialchars(substr($commande['adresse_livraison'], 0, 30)); ?>...
                                </div>
                            </div>
                            <div class="detail-item">
                                <label>Téléphone</label>
                                <div class="value" style="font-size: 12px;"><?php echo htmlspecialchars($commande['telephone_livraison']); ?></div>
                            </div>
                            <?php if ($commande['date_livraison']): ?>
                                <div class="detail-item">
                                    <label>Date livraison</label>
                                    <div class="value" style="font-size: 12px;"><?php echo date('d/m/Y', strtotime($commande['date_livraison'])); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #f0e9e9; display: flex; flex-direction: column; gap: 10px;">
                            <a href="commande-categorie.php?commande_id=<?php echo $commande['id']; ?>" 
                               class="btn-view-categories" 
                               style="margin-top: 0; padding: 10px 15px; font-size: 13px; text-align: center;">
                                <i class="fas fa-eye"></i> Voir les produits reçus
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include 'includes/user_footer.php'; ?>

</body>
</html>
