<?php
/**
 * Page de liste des commandes non traitées (Admin)
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: ../login.php');
    exit;
}

// Récupérer toutes les commandes
require_once __DIR__ . '/../../models/model_commandes_admin.php';
$toutes_commandes = get_all_commandes();

// Filtrer pour exclure les commandes avec le statut "livree" et "annulee" (commandes non traitées)
$commandes = array_filter($toutes_commandes, function($commande) {
    return $commande['statut'] !== 'livree' && $commande['statut'] !== 'annulee';
});

// Statistiques
$total_commandes = count_commandes_by_statut();
$en_attente = count_commandes_by_statut('en_attente');
$confirmees = count_commandes_by_statut('confirmee');
$livrees = count_commandes_by_statut('livree');
$prise_en_charge = count_commandes_by_statut('prise_en_charge');
$livraison_en_cours = count_commandes_by_statut('livraison_en_cours');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes Non Traitées - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
        .commandes-stats {
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

        .commande-info .client-email {
            color: #999;
            font-size: 11px;
            margin-top: 4px;
        }

        .commande-statut {
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            align-self: flex-start;
        }

        .statut-en_attente {
            background: #fff3cd;
            color: #856404;
        }

        .statut-confirmee {
            background: #d1ecf1;
            color: #0c5460;
        }

        .statut-prise_en_charge {
            background: #fff3cd;
            color: #856404;
        }

        .statut-en_preparation {
            background: #d4edda;
            color: #155724;
        }

        .statut-livraison_en_cours {
            background: #cfe2ff;
            color: #084298;
        }

        .statut-expediee {
            background: #b3d9ff;
            color: #004085;
        }

        .statut-annulee {
            background: #f8d7da;
            color: #842029;
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

        .btn-view {
            display: inline-block;
            padding: 10px 20px;
            background-color: #918a44;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            text-align: center;
            width: 100%;
            margin-top: 15px;
        }

        .btn-view:hover {
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

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0f5132;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-link:hover {
            background-color: #155724;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <?php include '../includes/nav.php'; ?>
    
    <div class="content-header">
        <h1><i class="fas fa-shopping-bag"></i> Commandes Non Traitées</h1>
    </div>

    <!-- Statistiques -->
    <div class="commandes-stats">
        <div class="stat-box">
            <h3>Total Commandes</h3>
            <div class="stat-value"><?php echo $total_commandes; ?></div>
        </div>
        <div class="stat-box">
            <h3>En Attente</h3>
            <div class="stat-value"><?php echo $en_attente; ?></div>
        </div>
        <div class="stat-box">
            <h3>Prise en charge</h3>
            <div class="stat-value"><?php echo $prise_en_charge; ?></div>
        </div>
        <div class="stat-box">
            <h3>Livraison en cours</h3>
            <div class="stat-value"><?php echo $livraison_en_cours; ?></div>
        </div>
        <div class="stat-box">
            <h3>Livrées</h3>
            <div class="stat-value"><?php echo $livrees; ?></div>
        </div>
    </div>

    <!-- Liste des commandes -->
    <section class="content-section">
        <div class="section-header">
            <div class="section-title">
                <h2><i class="fas fa-list"></i> Commandes à Traiter (<?php echo count($commandes); ?>)</h2>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="livrees.php" class="btn-link">
                    <i class="fas fa-check-circle"></i> Voir les commandes livrées
                </a>
                <a href="annulees.php" class="btn-link" style="background-color: #842029;">
                    <i class="fas fa-ban"></i> Voir les commandes annulées
                </a>
            </div>
        </div>

        <?php if (empty($commandes)): ?>
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <h3>Aucune commande à traiter</h3>
                <p>Toutes les commandes ont été traitées et livrées.</p>
            </div>
        <?php else: ?>
            <div class="commandes-grid">
                <?php foreach ($commandes as $commande): ?>
                    <div class="commande-item">
                        <div class="commande-header">
                            <div class="commande-info">
                                <h3>Commande #<?php echo htmlspecialchars($commande['numero_commande']); ?></h3>
                                <p>
                                    <strong>Client:</strong> <?php echo htmlspecialchars($commande['user_prenom'] . ' ' . $commande['user_nom']); ?><br>
                                    <span class="client-email"><?php echo htmlspecialchars($commande['user_email']); ?></span>
                                </p>
                                <p style="margin-top: 8px;">Date: <?php echo date('d/m/Y à H:i', strtotime($commande['date_commande'])); ?></p>
                            </div>
                            <span class="commande-statut statut-<?php echo $commande['statut']; ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $commande['statut'])); ?>
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
                        </div>
                        
                        <a href="details.php?id=<?php echo $commande['id']; ?>" class="btn-view">
                            <i class="fas fa-eye"></i> Voir les détails
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include '../includes/footer.php'; ?>

</body>
</html>
