<?php
/**
 * Page de liste des commandes annulées par l'utilisateur
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer les commandes annulées de l'utilisateur
require_once __DIR__ . '/../models/model_commandes.php';

// Traitement de la recommandation (ajouter les produits au panier)
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recommander'])) {
    $commande_id = isset($_POST['commande_id']) ? (int) $_POST['commande_id'] : 0;

    if ($commande_id > 0) {
        // Vérifier que la commande est annulée et appartient à l'utilisateur
        $commande = get_commande_by_id($commande_id, $_SESSION['user_id']);

        if ($commande && $commande['statut'] === 'annulee') {
            // Récupérer les produits de la commande
            require_once __DIR__ . '/../models/model_panier.php';
            $produits_commande = get_commande_produits($commande_id);

            if (!empty($produits_commande)) {
                $added_count = 0;
                foreach ($produits_commande as $produit) {
                    // Vérifier si le produit existe encore et est actif
                    require_once __DIR__ . '/../models/model_produits.php';
                    $produit_info = get_produit_by_id($produit['produit_id']);

                    if ($produit_info && $produit_info['statut'] === 'actif' && $produit_info['stock'] > 0) {
                        // Vérifier si le produit est déjà dans le panier
                        $panier_existant = is_in_panier($_SESSION['user_id'], $produit['produit_id']);
                        if ($panier_existant) {
                            // Mettre à jour la quantité
                            $new_quantite = min($panier_existant['quantite'] + $produit['quantite'], $produit_info['stock']);
                            if (update_panier_quantite($panier_existant['id'], $new_quantite)) {
                                $added_count++;
                            }
                        } else {
                            // Ajouter au panier
                            $quantite = min($produit['quantite'], $produit_info['stock']);
                            if (add_to_panier($_SESSION['user_id'], $produit['produit_id'], $quantite)) {
                                $added_count++;
                            }
                        }
                    }
                }

                if ($added_count > 0) {
                    header('Location: ../panier.php?recommande=1&count=' . $added_count);
                    exit;
                } else {
                    $error_message = 'Aucun produit disponible à recommander.';
                }
            } else {
                $error_message = 'Aucun produit trouvé dans cette commande.';
            }
        } else {
            $error_message = 'Cette commande ne peut pas être recommandée.';
        }
    }
}

// Récupérer toutes les commandes de l'utilisateur
$commandes = get_commandes_by_user($_SESSION['user_id']);

// Filtrer pour afficher uniquement les commandes annulées
$commandes_annulees = array_filter($commandes, function ($commande) {
    return $commande['statut'] === 'annulee';
});
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes Annulées - Samba Market</title>
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

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .btn-recommander {
            display: inline-block;
            padding: 10px 20px;
            background-color: #918a44;
            color: #ffffff;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            width: 100%;
        }

        .btn-recommander:hover {
            background-color: #6b2f20;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-recommander i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <?php include 'includes/user_nav.php'; ?>

    <div class="content-header">
        <h1><i class="fas fa-times-circle"></i> Commandes Annulées</h1>
    </div>

    <section class="content-section">
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

        <div class="section-title">
            <h2><i class="fas fa-list"></i> Mes Commandes Annulées (<?php echo count($commandes_annulees); ?>)</h2>
        </div>

        <?php if (empty($commandes_annulees)): ?>
            <div style="text-align: center; padding: 40px; color: #666;">
                <i class="fas fa-ban" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                <p>Aucune commande annulée pour le moment.</p>
                <a href="mes-commandes.php" class="btn-view-categories"
                    style="margin-top: 20px; display: inline-block;">
                    <i class="fas fa-arrow-left"></i> Retour aux commandes
                </a>
            </div>
        <?php else: ?>
            <div class="commandes-grid">
                <?php foreach ($commandes_annulees as $commande): ?>
                    <div class="commande-item">
                        <div class="commande-header">
                            <div class="commande-info">
                                <h3>Commande #<?php echo htmlspecialchars($commande['numero_commande']); ?></h3>
                                <p>Date: <?php echo date('d/m/Y à H:i', strtotime($commande['date_commande'])); ?></p>
                            </div>
                            <span class="commande-statut statut-annulee" style="align-self: flex-start;">
                                Annulée
                            </span>
                        </div>
                        <div class="commande-details">
                            <div class="detail-item">
                                <label>Montant total</label>
                                <div class="value"><?php echo number_format($commande['montant_total'], 0, ',', ' '); ?> FCFA
                                </div>
                            </div>
                            <div class="detail-item">
                                <label>Adresse</label>
                                <div class="value"
                                    style="font-size: 11px; max-width: 150px; text-align: right; word-break: break-word;">
                                    <?php echo htmlspecialchars(substr($commande['adresse_livraison'], 0, 30)); ?>...
                                </div>
                            </div>
                            <div class="detail-item">
                                <label>Téléphone</label>
                                <div class="value" style="font-size: 12px;">
                                    <?php echo htmlspecialchars($commande['telephone_livraison']); ?>
                                </div>
                            </div>
                        </div>

                        <div
                            style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #f0e9e9; display: flex; flex-direction: column; gap: 10px;">
                            <a href="commande-categorie.php?commande_id=<?php echo $commande['id']; ?>"
                                class="btn-view-categories"
                                style="margin-top: 0; padding: 10px 15px; font-size: 13px; text-align: center;">
                                <i class="fas fa-eye"></i> Voir les produits
                            </a>

                            <!-- Bouton Recommander -->
                            <form method="POST" action="" style="margin: 0;">
                                <input type="hidden" name="commande_id" value="<?php echo $commande['id']; ?>">
                                <button type="submit" name="recommander" class="btn-recommander">
                                    <i class="fas fa-redo"></i> Recommander
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include 'includes/user_footer.php'; ?>
</body>

</html>

