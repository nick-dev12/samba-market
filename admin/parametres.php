<?php
/**
 * Page principale des paramètres - Regroupe toutes les configurations
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit;
}

// Afficher le message de succès s'il existe
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <style>
        .parametres-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .parametre-card {
            background: #ffffff;
            border: 1px solid #f0e9e9;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .parametre-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .parametre-icon {
            width: 60px;
            height: 60px;
            background: #918a44;
            color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .parametre-title {
            font-size: 18px;
            font-weight: 600;
            color: #6b2f20;
            margin-bottom: 10px;
        }

        .parametre-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
            flex-grow: 1;
        }

        .parametre-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #918a44;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            width: fit-content;
        }

        .parametre-link:hover {
            background: #7a7338;
        }

        .parametre-link i {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <section class="produits-section">
        <div class="section-title">
            <h2><i class="fas fa-cog"></i> Paramètres et Configurations</h2>
            <p style="color: #666; font-size: 14px; margin-top: 5px;">
                Configurez les différentes sections de votre site web
            </p>
        </div>

        <?php if (!empty($success_message)): ?>
            <div style="background: #d1e7dd; border-left: 4px solid #0f5132; color: #0f5132; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <div class="parametres-grid">
            <!-- Bannière d'Accueil -->
            <div class="parametre-card">
                <div class="parametre-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="parametre-title">Bannière d'Accueil</h3>
                <p class="parametre-description">
                    Personnalisez la bannière principale de votre page d'accueil : modifiez le titre, le texte d'accroche et l'image de fond pour créer une première impression mémorable.
                </p>
                <a href="parametres/section4.php" class="parametre-link">
                    <i class="fas fa-edit"></i> Modifier la bannière
                </a>
            </div>

            <!-- Section Tendance -->
            <div class="parametre-card">
                <div class="parametre-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="parametre-title">Section Mise en Avant</h3>
                <p class="parametre-description">
                    Configurez la section de mise en avant des produits : définissez le label, le titre promotionnel, le texte du bouton d'action et l'image illustrative.
                </p>
                <a href="parametres/trending.php" class="parametre-link">
                    <i class="fas fa-edit"></i> Modifier la section
                </a>
            </div>

            <!-- Carrousel Principal -->
            <div class="parametre-card">
                <div class="parametre-icon">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <h3 class="parametre-title">Carrousel Principal</h3>
                <p class="parametre-description">
                    Gérez le carrousel d'images en haut de la page d'accueil : ajoutez, modifiez ou supprimez les slides avec leurs titres, textes et boutons d'action.
                </p>
                <a href="slider/index.php" class="parametre-link">
                    <i class="fas fa-edit"></i> Gérer le carrousel
                </a>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>

