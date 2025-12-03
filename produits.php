<?php
session_start();

// Inclusion des modèles
require_once __DIR__ . '/models/model_produits.php';

// Récupérer les 20 premiers produits
$produits_tous = [];
$total_produits = 0;
if (file_exists(__DIR__ . '/models/model_produits.php')) {
    $produits_tous = get_all_produits_paginated(0, 20);
    $total_produits = count_all_produits_actifs();
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
    <title>Tous nos produits - Tresor Africain</title>
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
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .produits-page-header {
            background: linear-gradient(135deg, #918a44 0%, #c26638 100%);
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
            margin-bottom: 40px;
        }

        .produits-page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .produits-page-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .produits-container-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn-voir-plus {
            padding: 15px 40px;
            background: #918a44;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 30px auto;
        }

        .btn-voir-plus:hover {
            background: #7a7338;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(145, 138, 68, 0.3);
        }

        .btn-voir-plus:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .produits-count {
            text-align: center;
            margin-top: 15px;
            color: #666;
            font-size: 14px;
        }

        /* Assurer que le contenu principal a un espacement suffisant pour le footer */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .produits-container-wrapper {
            flex: 1;
            padding-bottom: 100px;
            margin-bottom: 0;
        }

        /* S'assurer que le footer est bien positionné et ne se superpose pas */
        .footer {
            margin-top: 80px;
            position: relative;
            width: 100%;
            clear: both;
            flex-shrink: 0;
        }

        /* Espacement supplémentaire pour la section des produits */
        .section00 {
            margin-bottom: 60px;
        }

        /* S'assurer que le wrapper principal a un espacement suffisant */
        .produits-page-header {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <?php include('nav_bar.php'); ?>

    <div class="produits-page-header">
        <h1><i class="fas fa-box"></i> Tous nos produits</h1>
        <p>Découvrez notre sélection complète de produits naturels</p>
    </div>

    <div class="produits-container-wrapper">
        <section class="section00">
            <section class="produit_vedetes">
                <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
                    data-aos-mirror="true" data-aos-once="true" data-aos-anchor-placement="top-bottom"
                    class="articles carousel11" id="produits-container">
                    <?php if (empty($produits_tous)): ?>
                        <!-- Message si aucun produit -->
                        <div style="text-align: center; padding: 40px; color: #666; width: 100%;">
                            <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                            <p>Aucun produit disponible pour le moment.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($produits_tous as $produit): ?>
                            <?php
                            // Calculer le prix à afficher
                            $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                                ? $produit['prix_promotion']
                                : $produit['prix'];
                            $has_promotion = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix'];
                            $pourcentage_promo = $has_promotion ? round((($produit['prix'] - $produit['prix_promotion']) / $produit['prix']) * 100) : 0;
                            ?>
                            <div class="carousel" data-produit-id="<?php echo $produit['id']; ?>">
                                <img src="/upload/<?php echo htmlspecialchars($produit['image_principale'] ?? 'produit1.jpg'); ?>"
                                    alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>"
                                    onerror="this.src='/image/produit1.jpg'">
                                <p id="nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?></p>
                                <p class="prix">
                                    <?php echo number_format($prix_affichage, 0, ',', ' '); ?><span class="span1">fca</span>
                                    <?php if ($has_promotion): ?>
                                        <span class="span2"><?php echo number_format($produit['prix'], 0, ',', ' '); ?>fca</span>
                                        <span class="span3">-<?php echo $pourcentage_promo; ?>%</span>
                                    <?php endif; ?>
                                </p>
                                <p id="ville">
                                    <?php if (!empty($produit['categorie_nom'])): ?>
                                        <?php echo htmlspecialchars($produit['categorie_nom']); ?>
                                    <?php endif; ?>
                                    <?php if (!empty($produit['stock'])): ?>
                                        | Stock: <?php echo $produit['stock']; ?>
                                    <?php endif; ?>
                                </p>
                                <a href="produit.php?id=<?php echo $produit['id']; ?>">
                                    <i class="fa-solid fa-cart-shopping fa-xs"></i> Ajouter
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </article>

                <?php if (!empty($produits_tous) && $total_produits > 20): ?>
                    <div style="text-align: center; margin-top: 40px; padding: 20px;">
                        <button id="btn-voir-plus" class="btn-voir-plus" onclick="chargerPlusProduits()">
                            <i class="fas fa-chevron-down"></i> Voir plus
                        </button>
                        <p id="produits-count" class="produits-count">
                            Affichés: <span id="count-actuel">20</span> / <?php echo $total_produits; ?> produits
                        </p>
                    </div>
                <?php endif; ?>
            </section>
        </section>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();

        let offsetActuel = 20; // On a déjà affiché les 20 premiers
        const limit = 20;
        const totalProduits = <?php echo $total_produits; ?>;

        function chargerPlusProduits() {
            const btn = document.getElementById('btn-voir-plus');
            const container = document.getElementById('produits-container');
            const countActuel = document.getElementById('count-actuel');

            // Désactiver le bouton pendant le chargement
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Chargement...';

            // Faire la requête AJAX
            fetch(`api/get_produits.php?offset=${offsetActuel}&limit=${limit}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.produits.length > 0) {
                        // Ajouter les nouveaux produits
                        data.produits.forEach(produit => {
                            const div = document.createElement('div');
                            div.className = 'carousel';
                            div.setAttribute('data-produit-id', produit.id);

                            let promoHTML = '';
                            if (produit.has_promotion) {
                                promoHTML = `<span class="span2">${formatNumber(produit.prix)}fca</span>
                                             <span class="span3">-${produit.pourcentage_promo}%</span>`;
                            }

                            let categorieStock = '';
                            if (produit.categorie_nom) {
                                categorieStock += produit.categorie_nom;
                            }
                            if (produit.stock) {
                                categorieStock += (categorieStock ? ' | ' : '') + 'Stock: ' + produit.stock;
                            }

                            div.innerHTML = `
                                <img src="/upload/${produit.image_principale}" 
                                     alt="${escapeHtml(produit.nom)}"
                                     onerror="this.src='/image/produit1.jpg'">
                                <p id="nom">${escapeHtml(produit.nom)}</p>
                                <p class="prix">
                                    ${formatNumber(produit.prix_affichage)}<span class="span1">fca</span>
                                    ${promoHTML}
                                </p>
                                <p id="ville">${escapeHtml(categorieStock)}</p>
                                <a href="produit.php?id=${produit.id}">
                                    <i class="fa-solid fa-cart-shopping fa-xs"></i> Ajouter
                                </a>
                            `;

                            container.appendChild(div);
                        });

                        // Mettre à jour le compteur
                        offsetActuel += data.produits.length;
                        countActuel.textContent = offsetActuel;

                        // Vérifier s'il reste des produits
                        if (offsetActuel >= totalProduits) {
                            btn.style.display = 'none';
                        } else {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fas fa-chevron-down"></i> Voir plus';
                        }
                    } else {
                        // Plus de produits à charger
                        btn.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Erreur lors du chargement:', error);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-chevron-down"></i> Voir plus';
                    alert('Une erreur est survenue lors du chargement des produits.');
                });
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
</body>

</html>