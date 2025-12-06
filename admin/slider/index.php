<?php
/**
 * Page de liste des slides
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

// Récupérer tous les slides
require_once __DIR__ . '/../../models/model_slider.php';
$slides = get_all_slides(null); // Récupérer tous les slides (actifs et inactifs)
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Slider - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
    .slides-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        width: 100%;
    }

    .slide-card {
        background: #ffffff;
        border: 1px solid #f0e9e9;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        width: 100%;
        max-width: 450px;
        min-width: 300px !important;
    }

    .slide-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .slide-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f0e9e9;
    }

    .slide-body {
        padding: 20px;
    }

    .slide-titre {
        font-size: 18px;
        font-weight: 600;
        color: #6b2f20;
        margin-bottom: 10px;
    }

    .slide-paragraphe {
        color: #666;
        font-size: 14px;
        margin-bottom: 15px;
        line-height: 1.5;
        max-height: 60px;
        overflow: hidden;
    }

    .slide-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 12px;
        color: #666;
    }

    .slide-actions {
        display: flex;
        gap: 10px;
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

    .statut-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .statut-actif {
        background: #d4edda;
        color: #155724;
    }

    .statut-inactif {
        background: #f8d7da;
        color: #842029;
    }
    </style>
</head>

<body>
    <?php include '../includes/nav.php'; ?>

    <div class="content-header">
        <h1><i class="fas fa-images"></i> Gestion du Slider</h1>
        <div class="header-actions">
            <a href="ajouter.php" class="btn-primary">
                <i class="fas fa-plus"></i> Nouveau Slide
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
            <h2><i class="fas fa-images"></i> Slides du Carrousel (<?php echo count($slides); ?>)</h2>
        </div>

        <?php if (empty($slides)): ?>
        <div style="text-align: center; padding: 40px; color: #666;">
            <i class="fas fa-images" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
            <p>Aucun slide enregistré pour le moment.</p>
            <a href="ajouter.php" class="btn-primary" style="margin-top: 20px; display: inline-block;">
                <i class="fas fa-plus"></i> Ajouter le premier slide
            </a>
        </div>
        <?php else: ?>
        <div class="slides-grid">
            <?php foreach ($slides as $slide): ?>
            <div class="slide-card">
                <img src="../../upload/slider/<?php echo htmlspecialchars($slide['image']); ?>"
                    alt="<?php echo htmlspecialchars($slide['titre']); ?>" class="slide-image"
                    onerror="this.src='../../image/produit1.jpg'">
                <div class="slide-body">
                    <h3 class="slide-titre"><?php echo htmlspecialchars($slide['titre']); ?></h3>
                    <p class="slide-paragraphe"><?php echo htmlspecialchars($slide['paragraphe']); ?></p>
                    <div class="slide-info">
                        <span>Ordre: <?php echo $slide['ordre']; ?></span>
                        <span class="statut-badge statut-<?php echo $slide['statut']; ?>">
                            <?php echo ucfirst($slide['statut']); ?>
                        </span>
                    </div>
                    <?php if ($slide['bouton_texte']): ?>
                    <p style="font-size: 12px; color: #918a44; margin-bottom: 10px;">
                        <i class="fas fa-link"></i> Bouton: <?php echo htmlspecialchars($slide['bouton_texte']); ?>
                    </p>
                    <?php endif; ?>
                    <div class="slide-actions">
                        <a href="modifier.php?id=<?php echo $slide['id']; ?>" class="btn-card btn-edit">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="supprimer.php?id=<?php echo $slide['id']; ?>" class="btn-card btn-delete"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce slide ?');">
                            <i class="fas fa-trash"></i> Supprimer
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <?php include '../includes/footer.php'; ?>