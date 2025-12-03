<?php
/**
 * Page de commande
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: /user/connexion.php?redirect=commande');
    exit;
}

// Inclusion des modèles et contrôleurs
require_once __DIR__ . '/models/model_panier.php';
require_once __DIR__ . '/models/model_users.php';
require_once __DIR__ . '/controllers/controller_commandes.php';

// Traitement du formulaire
$message = '';
$message_type = '';
$commande_id = null;
$numero_commande = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_commande') {
    $result = process_create_commande();
    
    if ($result['success']) {
        // Redirection vers la page de confirmation
        header('Location: /user/mes-commandes.php?success=1&numero=' . urlencode($result['numero_commande']));
        exit;
    } else {
        $message = $result['message'];
        $message_type = 'error';
    }
}

// Récupérer les informations de l'utilisateur
$user = get_user_by_id($_SESSION['user_id']);

// Récupérer les produits du panier
$panier_items = get_panier_by_user($_SESSION['user_id']);

// Vérifier que le panier n'est pas vide
if (empty($panier_items)) {
    header('Location: /panier.php');
    exit;
}

// Calculer le total
$panier_total = get_panier_total($_SESSION['user_id']);
$nombre_total_articles = 0;
foreach ($panier_items as $item) {
    $nombre_total_articles += $item['quantite'];
}

// Inclusion de la barre de navigation
include 'nav_bar.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer la commande - Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/a_style.css">
    <style>
        .commande-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .commande-wrapper {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
            margin-top: 30px;
        }

        @media (max-width: 968px) {
            .commande-wrapper {
                grid-template-columns: 1fr;
            }
        }

        .commande-form-section {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .commande-summary-section {
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #6b2f20;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0e9e9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #000000;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #f0e9e9;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #918a44;
            box-shadow: 0 0 0 3px rgba(145, 138, 68, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group small {
            display: block;
            color: #737373;
            font-size: 12px;
            margin-top: 5px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0e9e9;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item-label {
            color: #484848;
            font-size: 14px;
        }

        .summary-item-value {
            color: #000000;
            font-weight: 600;
            font-size: 14px;
        }

        .summary-total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #918a44;
        }

        .summary-total .summary-item-label {
            font-size: 18px;
            font-weight: 700;
            color: #6b2f20;
        }

        .summary-total .summary-item-value {
            font-size: 20px;
            color: #c26638;
        }

        .btn-submit-commande {
            width: 100%;
            padding: 15px;
            background-color: #6b2f20;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit-commande:hover {
            background-color: #918a44;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 47, 32, 0.3);
        }

        .btn-submit-commande:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            transform: none;
        }

        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .panier-item-summary {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f0e9e9;
        }

        .panier-item-summary:last-child {
            border-bottom: none;
        }

        .panier-item-summary img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .panier-item-summary-info {
            flex: 1;
        }

        .panier-item-summary-info h4 {
            font-size: 14px;
            color: #000000;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .panier-item-summary-info p {
            font-size: 12px;
            color: #737373;
            margin: 0;
        }

        .panier-item-summary-price {
            font-size: 14px;
            font-weight: 600;
            color: #6b2f20;
        }

        /* Styles pour éviter que le footer s'incruste */
        .commande-container {
            margin-bottom: 100px;
            min-height: calc(100vh - 200px);
        }

        /* Styles du footer */
        .footer {
            margin-top: 5rem;
            background-color: #636363;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
            width: 100%;
            clear: both;
        }

        .footer_container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-around;
            color: #ffffff;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer_item {
            width: 250px;
            min-width: 200px;
        }

        .footer_logo {
            font-size: 3rem;
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
        }

        .footer_p {
            margin-top: 1.2rem;
            color: #ffffff;
        }

        .footer_item_titl {
            margin-bottom: 1.2rem;
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .footer_list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer_list_item {
            margin: 0.5rem 0rem;
            color: #ffffff;
        }

        .footer_list_item a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer_list_item a:hover {
            color: #918a44;
        }

        .footer_bottom {
            margin-top: 50px;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
        }

        .footer_bottom_container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
        }

        .footer_copy {
            color: #ffffff;
            padding: 1.5rem 0rem;
        }

        @media only screen and (max-width: 1070px) {
            .footer_container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer_item {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>

    <div class="commande-container">
        <h1 style="font-size: 28px; color: #6b2f20; margin-bottom: 10px;">
            <i class="fas fa-shopping-bag"></i> Passer la commande
        </h1>
        <p style="color: #737373; margin-bottom: 30px;">Veuillez remplir les informations de contact</p>

        <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <div class="commande-wrapper">
            <!-- Formulaire de commande -->
            <div class="commande-form-section">
                <h2 class="section-title">
                    <i class="fas fa-phone"></i> Informations de livraison
                </h2>

                <form method="POST" action="">
                    <input type="hidden" name="action" value="create_commande">

                    <div class="form-group">
                        <label for="telephone_livraison">
                            <i class="fas fa-phone"></i> Téléphone de livraison *
                        </label>
                        <input 
                            type="tel" 
                            id="telephone_livraison" 
                            name="telephone_livraison" 
                            required
                            placeholder="+241 XX XX XX XX"
                            value="<?php echo isset($_POST['telephone_livraison']) ? htmlspecialchars($_POST['telephone_livraison']) : htmlspecialchars($user['telephone'] ?? ''); ?>"
                        >
                        <small>Numéro de téléphone pour la livraison</small>
                    </div>

                    <div class="form-group">
                        <label for="notes">
                            <i class="fas fa-sticky-note"></i> Notes (optionnel)
                        </label>
                        <textarea 
                            id="notes" 
                            name="notes"
                            placeholder="Instructions spéciales pour la livraison (ex: code d'accès, étage, etc.)"
                        ><?php echo isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; ?></textarea>
                        <small>Ajoutez des instructions spéciales si nécessaire</small>
                    </div>

                    <button type="submit" class="btn-submit-commande">
                        <i class="fas fa-check-circle"></i> Confirmer la commande
                    </button>
                </form>
            </div>

            <!-- Résumé de la commande -->
            <div class="commande-summary-section">
                <h2 class="section-title">
                    <i class="fas fa-shopping-cart"></i> Résumé
                </h2>

                <div style="margin-bottom: 20px;">
                    <?php foreach ($panier_items as $item): ?>
                        <?php
                        $prix_unitaire = !empty($item['prix_promotion']) && $item['prix_promotion'] < $item['prix'] 
                            ? $item['prix_promotion'] 
                            : $item['prix'];
                        $prix_total_item = $prix_unitaire * $item['quantite'];
                        ?>
                        <div class="panier-item-summary">
                            <img src="/upload/<?php echo htmlspecialchars($item['image_principale']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['nom']); ?>"
                                 onerror="this.src='/image/produit1.jpg'">
                            <div class="panier-item-summary-info">
                                <h4><?php echo htmlspecialchars($item['nom']); ?></h4>
                                <p>Quantité: <?php echo $item['quantite']; ?> × <?php echo number_format($prix_unitaire, 0, ',', ' '); ?> FCFA</p>
                            </div>
                            <div class="panier-item-summary-price">
                                <?php echo number_format($prix_total_item, 0, ',', ' '); ?> FCFA
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Nombre d'articles</span>
                    <span class="summary-item-value"><?php echo $nombre_total_articles; ?></span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Nombre de produits</span>
                    <span class="summary-item-value"><?php echo count($panier_items); ?></span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Sous-total</span>
                    <span class="summary-item-value"><?php echo number_format($panier_total, 0, ',', ' '); ?> FCFA</span>
                </div>

                <div class="summary-item">
                    <span class="summary-item-label">Livraison</span>
                    <span class="summary-item-value" style="color: #737373;">À calculer</span>
                </div>

                <div class="summary-total">
                    <div class="summary-item">
                        <span class="summary-item-label">Total général</span>
                        <span class="summary-item-value"><?php echo number_format($panier_total, 0, ',', ' '); ?> FCFA</span>
                    </div>
                </div>

                <a href="/panier.php" style="display: block; text-align: center; margin-top: 20px; color: #918a44; text-decoration: none; font-weight: 500;">
                    <i class="fas fa-arrow-left"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>

