<?php
/**
 * Page tableau de bord utilisateur
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

// Récupérer uniquement les produits des commandes livrées
require_once __DIR__ . '/../models/model_commandes.php';
$produits_commandes = get_produits_commandes_by_user($_SESSION['user_id'], 'livree');

// Récupérer les statistiques
require_once __DIR__ . '/../models/model_favoris.php';
require_once __DIR__ . '/../models/model_visites.php';
$nb_commandes = count_commandes_by_user($_SESSION['user_id']);
$nb_panier = count_panier_items_by_user($_SESSION['user_id']);
$nb_favoris = count_favoris_by_user($_SESSION['user_id']);
$nb_visites = count_visites_by_user($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/user-dashboard.css">
</head>

<body>
    <?php include 'includes/user_nav.php'; ?>

    <div class="content-header">
        <h1>
            <i class="fas fa-home"></i> Bienvenue, <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
        </h1>
        <div style="margin-top: 15px;">
            <a href="../index.php" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background-color: #918a44; color: #ffffff; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; transition: all 0.3s;">
                <i class="fas fa-store"></i> Voir tous les produits
            </a>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-value"><?php echo $nb_commandes; ?></div>
            <div class="stat-label">Commandes</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-value"><?php echo $nb_panier; ?></div>
            <div class="stat-label">Articles au panier</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-value"><?php echo $nb_favoris; ?></div>
            <div class="stat-label">Favoris</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-value"><?php echo $nb_visites; ?></div>
            <div class="stat-label">Produits visités</div>
        </div>
    </div>

    <!-- Section produits commandés -->
    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-check-circle"></i> Mes Produits Livrés</h2>
        </div>

        <?php if (empty($produits_commandes)): ?>
            <div style="text-align: center; padding: 40px; color: #666;">
                <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                <p>Aucun produit livré pour le moment.</p>
                <a href="mes-commandes.php" class="btn-primary"
                    style="margin-top: 20px; display: inline-block; padding: 12px 25px; background: #918a44; color: #ffffff; text-decoration: none; border-radius: 8px;">
                    <i class="fas fa-shopping-bag"></i> Voir mes commandes
                </a>
            </div>
        <?php else: ?>
            <div class="produits-grid">
                <?php foreach ($produits_commandes as $produit): ?>
                    <?php
                    $statut_class = 'statut-actif';
                    if ($produit['statut'] == 'inactif') {
                        $statut_class = 'statut-inactif';
                    } elseif ($produit['statut'] == 'rupture_stock') {
                        $statut_class = 'statut-rupture';
                    }
                    $statut_label = ucfirst(str_replace('_', ' ', $produit['statut']));
                    ?>
                    <div class="produit-card">
                        <span class="statut-badge <?php echo $statut_class; ?>"><?php echo $statut_label; ?></span>
                        <img src="../upload/<?php echo htmlspecialchars($produit['image_principale']); ?>"
                            alt="<?php echo htmlspecialchars($produit['nom']); ?>" class="produit-card-image"
                            onerror="this.src='../image/produit1.jpg'">
                        <div class="produit-card-body">
                            <h3 class="produit-card-nom"><?php echo htmlspecialchars($produit['nom']); ?></h3>
                            <p class="produit-card-categorie">
                                <?php echo htmlspecialchars($produit['categorie_nom'] ?? 'Sans catégorie'); ?>
                            </p>
                            <p class="produit-card-prix">
                                <?php echo number_format($produit['prix_unitaire'], 0, ',', ' '); ?>
                                <span class="prix-unite">FCFA</span>
                                <?php if ($produit['prix_promotion']): ?>
                                    <span style="color: #c26638; font-size: 12px; margin-left: 5px;">
                                        (Promo: <?php echo number_format($produit['prix_promotion'], 0, ',', ' '); ?> FCFA)
                                    </span>
                                <?php endif; ?>
                            </p>
                            <p class="produit-card-stock" style="font-size: 11px; color: #918a44; margin-bottom: 5px;">
                                <strong>Quantité commandée:</strong> <?php echo $produit['quantite']; ?>
                                <?php if ($produit['poids']): ?>
                                    (<?php echo htmlspecialchars($produit['poids']); ?>)
                                <?php endif; ?>
                            </p>
                            <p class="produit-card-stock" style="font-size: 11px; color: #6b2f20;">
                                <strong>Commande:</strong> <?php echo htmlspecialchars($produit['numero_commande']); ?>
                            </p>
                            <div class="produit-card-actions">
                                <a href="../produit.php?id=<?php echo $produit['id']; ?>" class="btn-card btn-view">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <a href="mes-commandes.php" class="btn-card btn-favorite">
                                    <i class="fas fa-list"></i> Détails
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include 'includes/user_footer.php'; ?>