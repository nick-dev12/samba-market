<?php
session_start();

// Inclusion des modèles et contrôleurs
require_once __DIR__ . '/models/model_panier.php';
require_once __DIR__ . '/controllers/controller_panier.php';

// Traitement des actions du panier
$message = '';
$message_type = '';

// Message de succès après recommandation
if (isset($_GET['recommande']) && $_GET['recommande'] == '1') {
    $count = isset($_GET['count']) ? (int) $_GET['count'] : 0;
    $message = $count > 0
        ? $count . ' produit(s) de votre commande annulée ont été ajoutés au panier avec succès !'
        : 'Les produits ont été ajoutés au panier avec succès !';
    $message_type = 'success';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                $result = process_update_panier();
                $message = $result['message'];
                $message_type = $result['success'] ? 'success' : 'error';
                break;
            case 'delete':
                $result = process_delete_from_panier();
                $message = $result['message'];
                $message_type = $result['success'] ? 'success' : 'error';
                break;
        }
    }
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /user/connexion.php?redirect=panier');
    exit;
}

// Récupérer les produits du panier
$panier_items = get_panier_by_user($_SESSION['user_id']);

// Calculer le total et le nombre total d'articles
$panier_total = get_panier_total($_SESSION['user_id']);
$nombre_total_articles = 0;
foreach ($panier_items as $item) {
    $nombre_total_articles += $item['quantite'];
}

// Inclusion du fichier de connexion à la BDD (pour les autres fonctionnalités si nécessaire)
if (file_exists(__DIR__ . '/controllers/controller_commerce_users.php')) {
    require_once __DIR__ . '/controllers/controller_commerce_users.php';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier - Trésor Africain</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/a_style.css">
    <style>
    /* Styles pour la page panier */
    .panier-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .panier-title {
        font-size: 32px;
        font-weight: 700;
        color: #6b2f20;
        margin-bottom: 30px;
        text-align: center;
    }

    .message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 500;
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

    .panier-empty {
        text-align: center;
        padding: 60px 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
    }

    .panier-empty i {
        font-size: 64px;
        color: #918a44;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .panier-empty p {
        font-size: 18px;
        color: #484848;
        margin-bottom: 30px;
    }

    .panier-content {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
    }

    .panier-items {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .panier-item {
        display: flex;
        gap: 20px;
        padding: 20px;
        background-color: #ffffff;
        border: 2px solid #f0e9e9;
        border-radius: 10px;
        transition: box-shadow 0.3s;
    }

    .panier-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .panier-item-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #f0e9e9;
    }

    .panier-item-info {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .panier-item-nom {
        font-size: 18px;
        font-weight: 600;
        color: #000000;
        margin-bottom: 8px;
    }

    .panier-item-categorie {
        font-size: 13px;
        color: #918a44;
        margin-bottom: 10px;
    }

    .panier-item-prix {
        font-size: 20px;
        font-weight: 700;
        color: #6b2f20;
        margin-bottom: 15px;
    }

    .panier-item-controls {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .quantite-controls {
        display: flex;
        align-items: center;
        border: 2px solid #918a44;
        border-radius: 8px;
        overflow: hidden;
    }

    .quantite-btn {
        background-color: #918a44;
        color: #ffffff;
        border: none;
        width: 35px;
        height: 35px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantite-btn:hover {
        background-color: #6b2f20;
    }

    .quantite-input {
        width: 60px;
        height: 35px;
        border: none;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: #000000;
    }

    .panier-item-total {
        font-size: 18px;
        font-weight: 700;
        color: #c26638;
        margin-left: auto;
    }

    .btn-delete {
        background-color: #c26638;
        color: #ffffff;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-delete:hover {
        background-color: #a0522d;
    }

    .panier-summary {
        background-color: #f9f9f9;
        border: 2px solid #f0e9e9;
        border-radius: 10px;
        padding: 25px;
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .summary-title {
        font-size: 22px;
        font-weight: 700;
        color: #6b2f20;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0e9e9;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 16px;
        color: #484848;
    }

    .summary-row.total {
        font-size: 24px;
        font-weight: 700;
        color: #6b2f20;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f0e9e9;
    }

    .btn-commander {
        width: 100%;
        padding: 15px;
        background-color: #918a44;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-commander:hover {
        background-color: #6b2f20;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-commander:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
        transform: none;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .panier-content {
            grid-template-columns: 1fr;
        }

        .panier-summary {
            position: static;
        }

        .panier-item {
            flex-direction: column;
        }

        .panier-item-image {
            width: 100%;
            height: 200px;
        }
    }

    @media (max-width: 600px) {
        .panier-item-controls {
            flex-direction: column;
            align-items: flex-start;
        }

        .panier-item-total {
            margin-left: 0;
            margin-top: 10px;
        }
    }
    </style>
</head>

<body>

    <?php include('nav_bar.php') ?>

    <div class="panier-container">
        <h1 class="panier-title">Mon Panier</h1>

        <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <?php if (empty($panier_items)): ?>
        <div class="panier-empty">
            <i class="fas fa-shopping-cart"></i>
            <p>Votre panier est vide</p>
            <a href="index.php"
                style="display: inline-block; padding: 12px 24px; background-color: #918a44; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600;">
                Continuer mes achats
            </a>
        </div>
        <?php else: ?>
        <div class="panier-content">
            <!-- Liste des produits -->
            <div class="panier-items">
                <?php foreach ($panier_items as $item): ?>
                <?php
                        // Calculer le prix unitaire (promotion si disponible)
                        $prix_unitaire = !empty($item['prix_promotion']) && $item['prix_promotion'] < $item['prix']
                            ? $item['prix_promotion']
                            : $item['prix'];
                        $prix_total_item = $prix_unitaire * $item['quantite'];
                        ?>
                <div class="panier-item" data-item-id="<?php echo $item['panier_id']; ?>">
                    <img src="/upload/<?php echo htmlspecialchars($item['image_principale']); ?>"
                        alt="<?php echo htmlspecialchars($item['nom']); ?>" class="panier-item-image"
                        onerror="this.src='/image/produit1.jpg'">

                    <div class="panier-item-info">
                        <h3 class="panier-item-nom"><?php echo htmlspecialchars($item['nom']); ?></h3>
                        <p class="panier-item-categorie"><?php echo htmlspecialchars($item['categorie_nom']); ?></p>
                        <p class="panier-item-prix">
                            <span style="font-size: 16px; color: #484848;">Prix unitaire:</span>
                            <span style="font-size: 20px; font-weight: 700; color: #6b2f20;">
                                <?php echo number_format($prix_unitaire, 0, ',', ' '); ?> FCFA
                            </span>
                            <?php if (!empty($item['prix_promotion']) && $item['prix_promotion'] < $item['prix']): ?>
                            <span
                                style="font-size: 14px; color: #737373; text-decoration: line-through; margin-left: 10px;">
                                <?php echo number_format($item['prix'], 0, ',', ' '); ?> FCFA
                            </span>
                            <span
                                style="font-size: 12px; background-color: #c26638; color: #ffffff; padding: 2px 6px; border-radius: 3px; margin-left: 5px;">
                                PROMO
                            </span>
                            <?php endif; ?>
                        </p>

                        <div class="panier-item-controls">
                            <form method="POST" action="" style="display: flex; align-items: center; gap: 10px;"
                                class="update-form">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="panier_id" value="<?php echo $item['panier_id']; ?>">

                                <label style="font-size: 14px; font-weight: 600; color: #484848;">Quantité:</label>
                                <div class="quantite-controls">
                                    <button type="button" class="quantite-btn decrease-btn">-</button>
                                    <input type="number" name="quantite" class="quantite-input"
                                        value="<?php echo $item['quantite']; ?>" min="1"
                                        max="<?php echo $item['stock']; ?>" required>
                                    <button type="button" class="quantite-btn increase-btn">+</button>
                                </div>

                                <button type="submit"
                                    style="padding: 8px 15px; background-color: #918a44; color: #ffffff; border: none; border-radius: 6px; cursor: pointer; font-size: 14px;">
                                    <i class="fas fa-sync-alt"></i> Mettre à jour
                                </button>
                            </form>

                            <form method="POST" action="" style="display: inline;"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir retirer ce produit du panier ?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="panier_id" value="<?php echo $item['panier_id']; ?>">
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i> Retirer
                                </button>
                            </form>

                            <div class="panier-item-total">
                                <div style="font-size: 14px; color: #737373; margin-bottom: 4px;">
                                    <?php echo number_format($prix_unitaire, 0, ',', ' '); ?> ×
                                    <?php echo $item['quantite']; ?>
                                </div>
                                <div style="font-size: 18px; font-weight: 700; color: #c26638;">
                                    Total: <?php echo number_format($prix_total_item, 0, ',', ' '); ?> FCFA
                                </div>
                            </div>
                        </div>

                        <p style="font-size: 12px; color: #737373; margin-top: 10px;">
                            Stock disponible: <?php echo $item['stock']; ?>
                            <?php echo htmlspecialchars($item['unite']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Résumé du panier -->
            <div class="panier-summary">
                <h2 class="summary-title">Résumé du panier</h2>

                <div class="summary-row">
                    <span>Nombre d'articles:</span>
                    <span id="nombre-articles" style="font-weight: 600; color: #6b2f20;">
                        <?php echo $nombre_total_articles; ?>
                        article<?php echo $nombre_total_articles > 1 ? 's' : ''; ?>
                    </span>
                </div>

                <div class="summary-row">
                    <span>Nombre de produits:</span>
                    <span style="font-weight: 600; color: #918a44;">
                        <?php echo count($panier_items); ?> produit<?php echo count($panier_items) > 1 ? 's' : ''; ?>
                    </span>
                </div>

                <div class="summary-row" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f0e9e9;">
                    <span>Sous-total:</span>
                    <span id="subtotal" style="font-weight: 600; color: #484848;">
                        <?php echo number_format($panier_total, 0, ',', ' '); ?> FCFA
                    </span>
                </div>

                <div class="summary-row">
                    <span>Livraison:</span>
                    <span style="color: #737373;">À calculer</span>
                </div>

                <div class="summary-row total">
                    <span>Total général:</span>
                    <span id="total" style="color: #6b2f20;">
                        <?php echo number_format($panier_total, 0, ',', ' '); ?> FCFA
                    </span>
                </div>

                <a href="commande.php" class="btn-commander">
                    <i class="fas fa-shopping-bag"></i> Passer la commande
                </a>

                <a href="index.php"
                    style="display: block; text-align: center; margin-top: 15px; color: #918a44; text-decoration: none; font-weight: 500;">
                    Continuer mes achats
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php include('footer.php') ?>


    <script>
    // Gestion des boutons + et - pour la quantité
    document.querySelectorAll('.increase-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantite-input');
            const max = parseInt(input.getAttribute('max'));
            let value = parseInt(input.value) || 1;
            if (value < max) {
                value++;
                input.value = value;
            }
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantite-input');
            let value = parseInt(input.value) || 1;
            if (value > 1) {
                value--;
                input.value = value;
            }
        });
    });
    </script>

</body>

</html>