<?php
/**
 * Page des produits visités
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer les produits visités par l'utilisateur
require_once __DIR__ . '/../models/model_visites.php';
$produits_visites = get_produits_visites_by_user($_SESSION['user_id'], 50);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits Visités - Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/user-dashboard.css">
    <style>
    .produits-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        align-items: flex-start;
        margin-top: 20px;
    }

    .produit-card {
        background: #ffffff;
        border: 1px solid #f0e9e9;
        border-radius: 12px;
        overflow: visible;
        width: 280px;
        max-width: 300px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .produit-card {
            width: calc(50% - 10px);
            min-width: 250px;
        }
    }

    @media (max-width: 480px) {
        .produit-card {
            width: 100%;
            max-width: 100%;
        }
    }

    .produit-card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
    }

    .produit-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f9f9f9;
        display: block;
    }

    .produit-card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .produit-card-nom {
        font-size: 16px;
        font-weight: 700;
        color: #000000;
        margin-bottom: 8px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .produit-card-categorie {
        display: inline-block;
        font-size: 11px;
        color: #918a44;
        background-color: #f0e9e9;
        padding: 5px 12px;
        border-radius: 5px;
        margin-bottom: 12px;
        font-weight: 500;
    }

    .produit-card-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 15px;
        padding: 12px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border-left: 3px solid #918a44;
    }

    .produit-card-info-item {
        font-size: 12px;
        color: #484848;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .produit-card-info-item strong {
        color: #6b2f20;
        font-weight: 600;
    }

    .produit-card-prix {
        font-size: 18px;
        font-weight: 700;
        color: #c26638;
        margin-bottom: 12px;
        margin-top: 0;
    }

    .produit-card-prix-promo {
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
        margin-right: 10px;
    }

    .produit-card-actions {
        display: flex;
        gap: 10px;
        margin-top: 0;
        padding-top: 0;
    }

    .btn-card {
        flex: 1;
        padding: 12px 15px;
        text-align: center;
        text-decoration: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-block;
    }

    .btn-view {
        background-color: #918a44;
        color: #ffffff;
    }

    .btn-view:hover {
        background-color: #6b2f20;
        transform: translateY(-1px);
    }

    .date-visite {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(145, 138, 68, 0.9);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        z-index: 5;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
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
        <h1><i class="fas fa-eye"></i> Produits Visités</h1>
        <p style="color: #737373; margin-top: 10px; font-size: 14px;">
            Historique de vos consultations de produits
        </p>
    </div>

    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-history"></i> Mes Produits Visités (<?php echo count($produits_visites); ?>)</h2>
        </div>

        <?php if (empty($produits_visites)): ?>
        <div class="empty-state">
            <i class="fas fa-eye-slash"></i>
            <h3>Aucun produit visité</h3>
            <p>Vous n'avez pas encore consulté de produits. Vos consultations apparaîtront ici.</p>
            <a href="../produits.php"
                style="display: inline-block; padding: 12px 25px; background: #918a44; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                <i class="fas fa-box"></i> Découvrir nos produits
            </a>
        </div>
        <?php else: ?>
        <div class="produits-grid">
            <?php foreach ($produits_visites as $produit): ?>
            <?php
                    // Calculer le prix à afficher
                    $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                        ? $produit['prix_promotion']
                        : $produit['prix'];
                    $has_promotion = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix'];
                    ?>
            <div class="produit-card">
                <span class="date-visite"
                    title="Consulté le <?php echo date('d/m/Y à H:i', strtotime($produit['date_visite'])); ?>">
                    <i class="fas fa-clock"></i> <?php echo date('d/m/Y', strtotime($produit['date_visite'])); ?>
                </span>
                <img src="../upload/<?php echo htmlspecialchars($produit['image_principale'] ?? ''); ?>"
                    alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>" class="produit-card-image"
                    onerror="this.src='../image/produit1.jpg'">
                <div class="produit-card-body">
                    <h3 class="produit-card-nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?>
                    </h3>
                    <?php if (!empty($produit['categorie_nom'])): ?>
                    <span
                        class="produit-card-categorie"><?php echo htmlspecialchars($produit['categorie_nom']); ?></span>
                    <?php endif; ?>

                    <div class="produit-card-info">
                        <?php if (!empty($produit['poids'])): ?>
                        <div class="produit-card-info-item">
                            <strong>Poids:</strong>
                            <span><?php echo htmlspecialchars($produit['poids']); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($produit['unite'])): ?>
                        <div class="produit-card-info-item">
                            <strong>Unité:</strong>
                            <span><?php echo htmlspecialchars($produit['unite']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="produit-card-info-item">
                            <strong>Stock:</strong>
                            <span><?php echo $produit['stock']; ?> disponible(s)</span>
                        </div>
                    </div>

                    <div class="produit-card-prix">
                        <?php if ($has_promotion): ?>
                        <span
                            class="produit-card-prix-promo"><?php echo number_format($produit['prix'], 0, ',', ' '); ?>
                            FCFA</span>
                        <?php endif; ?>
                        <?php echo number_format($prix_affichage, 0, ',', ' '); ?> FCFA
                    </div>

                    <div class="produit-card-actions">
                        <a href="../produit.php?id=<?php echo $produit['id']; ?>" class="btn-card btn-view">
                            <i class="fas fa-eye"></i> Voir le produit
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <?php include 'includes/user_footer.php'; ?>

</body>

</html>