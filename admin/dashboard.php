<?php
/**
 * Page d'accueil du tableau de bord administrateur
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Administration Samba Market</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>

<body>
    <!-- Bouton menu mobile -->
    <button class="mobile-menu-toggle" id="menuToggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay pour mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="admin-container">
        <!-- Barre de navigation verticale -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <i class="fas fa-store logo-icon"></i>
                <h2>Samba Market</h2>
            </div>
            <nav class="sidebar-menu">
                <a href="dashboard.php" class="menu-item active">
                    <i class="fas fa-home"></i>
                    <span>Tableau de bord</span>
                </a>
                <a href="produits/index.php" class="menu-item">
                    <i class="fas fa-box"></i>
                    <span>Produits</span>
                </a>
                <a href="produits/ajouter.php" class="menu-item">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajouter un produit</span>
                </a>
                <a href="categories/index.php" class="menu-item">
                    <i class="fas fa-tags"></i>
                    <span>Catégories</span>
                </a>
                <a href="commandes/index.php" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Commandes</span>
                </a>
                <a href="users/index.php" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Utilisateurs</span>
                </a>
                <a href="parametres.php" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
                <a href="logout.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <main class="admin-content" id="adminContent">
            <div class="content-header">
                <h1><i class="fas fa-chart-line"></i> Tableau de Bord</h1>
                <div class="header-actions">
                    <a href="commandes/index.php" class="btn-primary" style="background: #c26638; margin-right: 10px;">
                        <i class="fas fa-shopping-bag"></i> Voir les Commandes
                    </a>
                    <a href="produits/ajouter.php" class="btn-primary">
                        <i class="fas fa-plus"></i> Nouveau Produit
                    </a>
                </div>
            </div>

            <?php
            // Récupérer les statistiques des commandes
            require_once __DIR__ . '/../models/model_commandes_admin.php';
            $total_commandes = count_commandes_by_statut();
            $en_attente = count_commandes_by_statut('en_attente');
            $prise_en_charge = count_commandes_by_statut('prise_en_charge');
            $livraison_en_cours = count_commandes_by_statut('livraison_en_cours');
            ?>

            <!-- Statistiques des commandes -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <div
                    style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border-left: 4px solid #918a44;">
                    <h3 style="color: #6b2f20; font-size: 14px; margin-bottom: 10px; font-weight: 600;">Total Commandes
                    </h3>
                    <div style="font-size: 32px; font-weight: 700; color: #918a44;"><?php echo $total_commandes; ?>
                    </div>
                </div>
                <div
                    style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border-left: 4px solid #fff3cd;">
                    <h3 style="color: #6b2f20; font-size: 14px; margin-bottom: 10px; font-weight: 600;">En Attente</h3>
                    <div style="font-size: 32px; font-weight: 700; color: #856404;"><?php echo $en_attente; ?></div>
                </div>
                <div
                    style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border-left: 4px solid #fff3cd;">
                    <h3 style="color: #6b2f20; font-size: 14px; margin-bottom: 10px; font-weight: 600;">Prise en charge
                    </h3>
                    <div style="font-size: 32px; font-weight: 700; color: #856404;"><?php echo $prise_en_charge; ?>
                    </div>
                </div>
                <div
                    style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border-left: 4px solid #cfe2ff;">
                    <h3 style="color: #6b2f20; font-size: 14px; margin-bottom: 10px; font-weight: 600;">Livraison en
                        cours
                    </h3>
                    <div style="font-size: 32px; font-weight: 700; color: #084298;"><?php echo $livraison_en_cours; ?>
                    </div>
                </div>
            </div>

            <!-- Lien rapide vers les commandes -->
            <?php if ($en_attente > 0 || $prise_en_charge > 0): ?>
                <div
                    style="background: #fff3cd; border-left: 4px solid #856404; padding: 15px; border-radius: 6px; margin-bottom: 30px;">
                    <p style="color: #856404; margin: 0; font-weight: 600;">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php if ($en_attente > 0): ?>
                            <?php echo $en_attente; ?> commande<?php echo $en_attente > 1 ? 's' : ''; ?> en attente de prise en
                            charge
                        <?php elseif ($prise_en_charge > 0): ?>
                            <?php echo $prise_en_charge; ?> commande<?php echo $prise_en_charge > 1 ? 's' : ''; ?>
                            prise<?php echo $prise_en_charge > 1 ? 's' : ''; ?> en charge,
                            prête<?php echo $prise_en_charge > 1 ? 's' : ''; ?> à être
                            expédiée<?php echo $prise_en_charge > 1 ? 's' : ''; ?>
                        <?php endif; ?>
                    </p>
                    <a href="commandes/index.php"
                        style="display: inline-block; margin-top: 10px; padding: 8px 16px; background: #856404; color: #ffffff; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: 600;">
                        <i class="fas fa-arrow-right"></i> Gérer les commandes
                    </a>
                </div>
            <?php endif; ?>

            <!-- Section produits -->
            <section class="produits-section">
                <div class="section-title">
                    <h2><i class="fas fa-box"></i> Mes Produits</h2>
                </div>

                <?php
                // Récupérer les produits depuis la base de données
                require_once __DIR__ . '/../models/model_produits.php';
                $produits = get_all_produits();
                ?>

                <?php if (empty($produits)): ?>
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                        <p>Aucun produit enregistré pour le moment.</p>
                        <a href="produits/ajouter.php" class="btn-primary" style="margin-top: 20px; display: inline-block;">
                            <i class="fas fa-plus"></i> Ajouter le premier produit
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Grille de produits -->
                    <div class="produits-grid">
                        <?php foreach ($produits as $produit): ?>
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
                                        <?php echo number_format($produit['prix'], 0, ',', ' '); ?>
                                        <span class="prix-unite">FCFA</span>
                                        <?php if ($produit['prix_promotion']): ?>
                                            <span style="color: #c26638; font-size: 12px; margin-left: 5px;">
                                                (Promo: <?php echo number_format($produit['prix_promotion'], 0, ',', ' '); ?> FCFA)
                                            </span>
                                        <?php endif; ?>
                                    </p>
                                    <p class="produit-card-stock">
                                        Stock: <span class="stock-value"><?php echo $produit['stock']; ?></span>
                                        <?php if ($produit['poids']): ?>
                                            (<?php echo htmlspecialchars($produit['poids']); ?>)
                                        <?php endif; ?>
                                    </p>
                                    <div class="produit-card-actions">
                                        <a href="produits/modifier.php?id=<?php echo $produit['id']; ?>"
                                            class="btn-card btn-edit">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <a href="produits/supprimer.php?id=<?php echo $produit['id']; ?>"
                                            class="btn-card btn-delete"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script>         /**          * Fonction pour afficher/masquer la barre latérale sur mobile          */
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const content = document.getElementById('adminContent');

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');

            // Empêcher le scroll du body quand le menu est ouvert
            if (sidebar.classList.contains('show')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }

        // Fermer le menu si on clique sur l'overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function () {
            toggleSidebar();
        });

        // Gérer le redimensionnement de la fenêtre
        window.addEventListener('resize', function () {
            if (window.innerWidth > 600) {
                const sidebar = document.getElementById('adminSidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
</body>

</html>