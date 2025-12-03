<?php
/**
 * Page de détails d'une commande (Admin)
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: ../login.php');
    exit;
}

// Récupérer l'ID de la commande
$commande_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($commande_id <= 0) {
    header('Location: index.php');
    exit;
}

// Récupérer la commande et ses produits
require_once __DIR__ . '/../../models/model_commandes_admin.php';
$commande = get_commande_by_id($commande_id);
$produits = get_produits_by_commande($commande_id);

if (!$commande) {
    header('Location: index.php');
    exit;
}

// Vérifier si la commande est annulée
$is_annulee = $commande['statut'] === 'annulee';

// Traiter les actions de statut (uniquement si la commande n'est pas annulée)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$is_annulee) {
    if (isset($_POST['prendre_en_charge'])) {
        // Prendre en charge la commande
        if (update_commande_statut($commande_id, 'prise_en_charge')) {
            $_SESSION['success_message'] = 'Commande prise en charge avec succès.';
            header('Location: details.php?id=' . $commande_id);
            exit;
        }
    } elseif (isset($_POST['expedier'])) {
        // Expédier la commande
        if (update_commande_statut($commande_id, 'livraison_en_cours')) {
            $_SESSION['success_message'] = 'Commande en cours de livraison.';
            header('Location: details.php?id=' . $commande_id);
            exit;
        }
    } elseif (isset($_POST['changer_statut'])) {
        // Changer le statut manuellement
        $nouveau_statut = $_POST['statut'] ?? '';
        if (in_array($nouveau_statut, ['en_attente', 'confirmee', 'prise_en_charge', 'en_preparation', 'livraison_en_cours', 'expediee', 'livree', 'annulee'])) {
            if (update_commande_statut($commande_id, $nouveau_statut)) {
                $_SESSION['success_message'] = 'Statut de la commande mis à jour avec succès.';
                header('Location: details.php?id=' . $commande_id);
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Commande #<?php echo htmlspecialchars($commande['numero_commande']); ?> - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
        .commande-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .detail-box {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .detail-box h3 {
            color: #6b2f20;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0e9e9;
        }

        .detail-item {
            margin-bottom: 12px;
        }

        .detail-item label {
            display: block;
            color: #666;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .detail-item .value {
            color: #000000;
            font-size: 15px;
            font-weight: 500;
        }

        .produits-list {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .produit-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f0e9e9;
        }

        .produit-item:last-child {
            border-bottom: none;
        }

        .produit-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 15px;
        }

        .produit-info {
            flex: 1;
        }

        .produit-info h4 {
            color: #6b2f20;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .produit-info p {
            color: #666;
            font-size: 13px;
            margin: 0;
        }

        .produit-total {
            text-align: right;
            font-weight: 600;
            color: #918a44;
        }

        .statut-form {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #6b2f20;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #f0e9e9;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-submit {
            padding: 12px 25px;
            background: #918a44;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #6b2f20;
        }

        @media (max-width: 768px) {
            .commande-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/nav.php'; ?>
    
    <div class="content-header">
        <h1>
            <i class="fas fa-shopping-bag"></i> Commande #<?php echo htmlspecialchars($commande['numero_commande']); ?>
        </h1>
        <div class="header-actions">
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div style="background: #efe; border-left: 4px solid #918a44; color: #6b2f20; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Détails de la commande -->
    <div class="commande-details">
        <div class="detail-box">
            <h3><i class="fas fa-user"></i> Informations Client</h3>
            <div class="detail-item">
                <label>Nom complet</label>
                <div class="value"><?php echo htmlspecialchars($commande['user_prenom'] . ' ' . $commande['user_nom']); ?></div>
            </div>
            <div class="detail-item">
                <label>Email</label>
                <div class="value"><?php echo htmlspecialchars($commande['user_email']); ?></div>
            </div>
            <div class="detail-item">
                <label>Téléphone</label>
                <div class="value"><?php echo htmlspecialchars($commande['user_telephone']); ?></div>
            </div>
        </div>

        <div class="detail-box">
            <h3><i class="fas fa-map-marker-alt"></i> Livraison</h3>
            <div class="detail-item">
                <label>Adresse</label>
                <div class="value"><?php echo nl2br(htmlspecialchars($commande['adresse_livraison'])); ?></div>
            </div>
            <div class="detail-item">
                <label>Téléphone livraison</label>
                <div class="value"><?php echo htmlspecialchars($commande['telephone_livraison']); ?></div>
            </div>
            <div class="detail-item">
                <label>Date commande</label>
                <div class="value"><?php echo date('d/m/Y à H:i', strtotime($commande['date_commande'])); ?></div>
            </div>
            <?php if ($commande['date_livraison']): ?>
                <div class="detail-item">
                    <label>Date livraison</label>
                    <div class="value"><?php echo date('d/m/Y à H:i', strtotime($commande['date_livraison'])); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Produits de la commande -->
    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-box"></i> Produits Commandés</h2>
        </div>

        <div class="produits-list">
            <?php foreach ($produits as $produit): ?>
                <div class="produit-item">
                    <img src="../../upload/<?php echo htmlspecialchars($produit['image_principale']); ?>" 
                         alt="<?php echo htmlspecialchars($produit['produit_nom']); ?>"
                         onerror="this.src='../../image/produit1.jpg'">
                    <div class="produit-info">
                        <h4><?php echo htmlspecialchars($produit['produit_nom']); ?></h4>
                        <p>Quantité: <?php echo $produit['quantite']; ?> | Prix unitaire: <?php echo number_format($produit['prix_unitaire'], 0, ',', ' '); ?> FCFA</p>
                    </div>
                    <div class="produit-total">
                        <?php echo number_format($produit['prix_total'], 0, ',', ' '); ?> FCFA
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0e9e9; text-align: right;">
                <h3 style="color: #6b2f20; font-size: 20px;">
                    Total: <span style="color: #918a44;"><?php echo number_format($commande['montant_total'], 0, ',', ' '); ?> FCFA</span>
                </h3>
            </div>
        </div>
    </section>

    <!-- Actions rapides -->
    <section class="content-section">
        <div class="section-title">
            <h2><i class="fas fa-tasks"></i> Actions Rapides</h2>
        </div>

        <?php if ($is_annulee): ?>
            <div style="background: #f8d7da; border-left: 4px solid #842029; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h3 style="color: #842029; margin-bottom: 10px; font-size: 18px;">
                    <i class="fas fa-ban"></i> Commande Annulée
                </h3>
                <p style="color: #721c24; margin: 0;">
                    Cette commande a été annulée. Les actions de modification ne sont pas disponibles. Vous pouvez uniquement consulter les détails.
                </p>
            </div>
        <?php endif; ?>

        <div class="statut-form">
            <div class="form-group">
                <label>Statut actuel</label>
                <div style="padding: 10px; background: #f0e9e9; border-radius: 6px; margin-bottom: 20px;">
                    <span class="statut-badge statut-<?php echo $commande['statut']; ?>" style="font-size: 14px; padding: 8px 15px;">
                        <?php 
                        $statut_display = ucfirst(str_replace('_', ' ', $commande['statut']));
                        if ($commande['statut'] == 'annulee') {
                            $statut_display = 'Annulée';
                        }
                        echo $statut_display;
                        ?>
                    </span>
                </div>
            </div>

            <!-- Actions rapides selon le statut (masquées si annulée) -->
            <?php if (!$is_annulee): ?>
            <div style="margin-bottom: 20px;">
                <?php if (in_array($commande['statut'], ['en_attente', 'confirmee'])): ?>
                    <!-- Bouton Prendre en charge - visible pour en_attente et confirmee -->
                    <form method="POST" action="" style="margin-bottom: 15px;">
                        <button type="submit" name="prendre_en_charge" class="btn-submit" style="width: 100%; background: #918a44; font-size: 16px; padding: 15px;">
                            <i class="fas fa-hand-paper"></i> Prendre en charge la commande
                        </button>
                    </form>
                    <p style="text-align: center; color: #666; font-size: 13px; margin-top: -10px;">
                        <i class="fas fa-info-circle"></i> Cliquez pour prendre en charge cette commande
                    </p>
                <?php elseif ($commande['statut'] == 'prise_en_charge'): ?>
                    <!-- Bouton Mettre en livraison - visible uniquement après prise en charge -->
                    <form method="POST" action="" style="margin-bottom: 15px;">
                        <button type="submit" name="expedier" class="btn-submit" style="width: 100%; background: #c26638; font-size: 16px; padding: 15px;">
                            <i class="fas fa-shipping-fast"></i> Mettre en livraison
                        </button>
                    </form>
                    <p style="text-align: center; color: #666; font-size: 13px; margin-top: -10px;">
                        <i class="fas fa-info-circle"></i> La commande a été prise en charge. Cliquez pour la mettre en livraison
                    </p>
                <?php elseif ($commande['statut'] == 'livraison_en_cours'): ?>
                    <div style="background: #cfe2ff; border-left: 4px solid #084298; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                        <p style="color: #084298; margin: 0; font-weight: 600;">
                            <i class="fas fa-truck"></i> Commande en cours de livraison
                        </p>
                        <p style="color: #084298; margin: 5px 0 0 0; font-size: 13px;">
                            Vous pouvez changer le statut manuellement ci-dessous pour la marquer comme "Expédiée" ou "Livrée"
                        </p>
                    </div>
                <?php elseif (in_array($commande['statut'], ['expediee', 'livree'])): ?>
                    <div style="background: #d1e7dd; border-left: 4px solid #0f5132; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                        <p style="color: #0f5132; margin: 0; font-weight: 600;">
                            <i class="fas fa-check-circle"></i> 
                            <?php echo $commande['statut'] == 'livree' ? 'Commande livrée' : 'Commande expédiée'; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Formulaire de changement manuel de statut (masqué si annulée) -->
            <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #f0e9e9;">
                <h3 style="color: #6b2f20; font-size: 16px; margin-bottom: 15px;">Changer le statut manuellement</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="statut">Nouveau statut</label>
                        <select id="statut" name="statut" required>
                            <option value="en_attente" <?php echo $commande['statut'] == 'en_attente' ? 'selected' : ''; ?>>En Attente</option>
                            <option value="confirmee" <?php echo $commande['statut'] == 'confirmee' ? 'selected' : ''; ?>>Confirmée</option>
                            <option value="prise_en_charge" <?php echo $commande['statut'] == 'prise_en_charge' ? 'selected' : ''; ?>>Prise en charge</option>
                            <option value="en_preparation" <?php echo $commande['statut'] == 'en_preparation' ? 'selected' : ''; ?>>En Préparation</option>
                            <option value="livraison_en_cours" <?php echo $commande['statut'] == 'livraison_en_cours' ? 'selected' : ''; ?>>Livraison en cours</option>
                            <option value="expediee" <?php echo $commande['statut'] == 'expediee' ? 'selected' : ''; ?>>Expédiée</option>
                            <option value="livree" <?php echo $commande['statut'] == 'livree' ? 'selected' : ''; ?>>Livrée</option>
                            <option value="annulee" <?php echo $commande['statut'] == 'annulee' ? 'selected' : ''; ?>>Annulée</option>
                        </select>
                    </div>
                    <?php if ($commande['notes']): ?>
                        <div class="form-group">
                            <label>Notes</label>
                            <div style="padding: 10px; background: #f0e9e9; border-radius: 6px;">
                                <?php echo nl2br(htmlspecialchars($commande['notes'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button type="submit" name="changer_statut" class="btn-submit">
                        <i class="fas fa-save"></i> Mettre à jour le statut
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>

