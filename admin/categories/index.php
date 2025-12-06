<?php
/**
 * Page de liste des catégories
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: ../login.php');
    exit;
}

// Afficher le message de succès s'il existe
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Récupérer toutes les catégories
require_once __DIR__ . '/../../models/model_categories.php';
$categories = get_all_categories();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
    .categories-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        width: 100%;
    }

    .categorie-card {
        background: #ffffff;
        border: 1px solid #f0e9e9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        width: 100%;
        max-width: 300px;
    }

    .categorie-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .categorie-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        background: #f0e9e9;
    }

    .categorie-nom {
        font-size: 20px;
        font-weight: 600;
        color: #6b2f20;
        margin-bottom: 10px;
    }

    .categorie-description {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
        min-height: 40px;
    }

    .categorie-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-card {
        flex: 1;
        padding: 8px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-view {
        background-color: #918a44;
        color: #ffffff;
    }

    .btn-view:hover {
        background-color: #6b2f20;
        transform: translateY(-2px);
    }
    </style>
</head>

<body>
    <?php include '../includes/nav.php'; ?>

    <div class="content-header">
        <h1><i class="fas fa-tags"></i> Liste des Catégories</h1>
        <div class="header-actions">
            <a href="ajouter.php" class="btn-primary">
                <i class="fas fa-plus"></i> Nouvelle Catégorie
            </a>
        </div>
    </div>

    <?php if (!empty($success_message)): ?>
    <div
        style="background: #efe; border-left: 4px solid #918a44; color: #6b2f20; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
    </div>
    <?php endif; ?>

    <section class="produits-section">
        <div class="section-title">
            <h2><i class="fas fa-tags"></i> Toutes les Catégories (<?php echo count($categories); ?>)</h2>
        </div>

        <?php if (empty($categories)): ?>
        <div style="text-align: center; padding: 40px; color: #666;">
            <i class="fas fa-tags" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
            <p>Aucune catégorie enregistrée pour le moment.</p>
            <a href="ajouter.php" class="btn-primary" style="margin-top: 20px; display: inline-block;">
                <i class="fas fa-plus"></i> Ajouter la première catégorie
            </a>
        </div>
        <?php else: ?>
        <div class="categories-grid">
            <?php foreach ($categories as $categorie): ?>
            <div class="categorie-card">
                <?php if ($categorie['image']): ?>
                <img src="../../upload/<?php echo htmlspecialchars($categorie['image']); ?>"
                    alt="<?php echo htmlspecialchars($categorie['nom']); ?>" class="categorie-image"
                    onerror="this.src='../../image/produit1.jpg'">
                <?php else: ?>
                <div class="categorie-image"
                    style="display: flex; align-items: center; justify-content: center; color: #918a44; font-size: 48px;">
                    <i class="fas fa-tag"></i>
                </div>
                <?php endif; ?>
                <h3 class="categorie-nom"><?php echo htmlspecialchars($categorie['nom']); ?></h3>
                <p class="categorie-description">
                    <?php echo htmlspecialchars($categorie['description'] ?? 'Aucune description'); ?>
                </p>
                <div class="categorie-actions">
                    <a href="produits.php?id=<?php echo $categorie['id']; ?>" class="btn-card btn-view">
                        <i class="fas fa-box"></i> Voir produits
                    </a>
                    <a href="modifier.php?id=<?php echo $categorie['id']; ?>" class="btn-card btn-edit">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <a href="supprimer.php?id=<?php echo $categorie['id']; ?>" class="btn-card btn-delete"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                        <i class="fas fa-trash"></i> Supprimer
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <?php include '../includes/footer.php'; ?>