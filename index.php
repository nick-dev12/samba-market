<?php
session_start();


// Inclusion du fichier de connexion à la BDD

// Récupérez l'ID du commerçant à partir de la session
// Récupérez l'ID de l'utilisateur depuis la variable de session
if (file_exists(__DIR__ . '/controllers/controller_commerce_users.php')) {
    require_once __DIR__ . '/controllers/controller_commerce_users.php';
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tresor Africain</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/a_style.css">
    <link rel="stylesheet" href="/css/product-cards.css">

</head>


<body>

    <?php include('nav_bar.php') ?>


    <?php
    // Récupérer les slides depuis la base de données
    $slides = [];
    if (file_exists(__DIR__ . '/models/model_slider.php')) {
        require_once __DIR__ . '/models/model_slider.php';
        $slides_result = get_all_slides('actif'); // Récupérer uniquement les slides actifs
        $slides = is_array($slides_result) ? $slides_result : [];
    }
    ?>

    <div class="slider-area owl-carousel">
        <?php if (empty($slides)): ?>
            <!-- Slides par défaut si aucun slide n'est configuré -->
            <div class="slider-item">
                <img src="/image/produit3.avif" alt="">
                <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out"
                    data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="box">
                    <h1>Bienvenue au Trésor Africain</h1>
                    <p>Le shopping en ligne pour tous vos besoins</p>
                    <button>Commencer dès maintenant</button>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($slides as $slide): ?>
                <div class="slider-item">
                    <img src="/upload/slider/<?php echo htmlspecialchars($slide['image']); ?>"
                        alt="<?php echo htmlspecialchars($slide['titre']); ?>" onerror="this.src='/image/produit1.jpg'">
                    <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out"
                        data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="box">
                        <h1><?php echo htmlspecialchars($slide['titre']); ?></h1>
                        <p><?php echo htmlspecialchars($slide['paragraphe']); ?></p>
                        <?php if ($slide['bouton_texte']): ?>
                            <?php if ($slide['bouton_lien']): ?>
                                <a href="<?php echo htmlspecialchars($slide['bouton_lien']); ?>">
                                    <button><?php echo htmlspecialchars($slide['bouton_texte']); ?></button>
                                </a>
                            <?php else: ?>
                                <button><?php echo htmlspecialchars($slide['bouton_texte']); ?></button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>


    <section class="section3">
        <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-right">
            <img src="/image/service-10.png" alt="">
            <img src="/image/service-5.png" alt="">
            <img src="/image/service-6.png" alt="">
        </div>
        <div data-aos="fade-left" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-left">
            <img src="/image/service-7.png" alt="">
            <img src="/image/service-8.png" alt="">
            <img src="/image/service-9.png" alt="">
        </div>
    </section>

    <?php
    // Récupérer les catégories depuis la base de données
    $categories = [];
    if (file_exists(__DIR__ . '/models/model_categories.php')) {
        require_once __DIR__ . '/models/model_categories.php';
        $categories_result = get_all_categories_with_count();
        $categories = is_array($categories_result) ? $categories_result : [];
    }
    ?>

    <section class="categorie owl-carousel">
        <?php if (empty($categories)): ?>
            <!-- Message si aucune catégorie -->
            <div style="text-align: center; padding: 40px; color: #666; width: 100%;">
                <p style="font-size: 16px;">Aucune catégorie disponible pour le moment.</p>
            </div>
        <?php else: ?>
            <?php foreach ($categories as $categorie): ?>
                <a href="categorie.php?id=<?php echo $categorie['id']; ?>" style="text-decoration: none; color: inherit;">
                    <div class="item">
                        <?php if ($categorie['image']): ?>
                            <img class="img" src="/upload/<?php echo htmlspecialchars($categorie['image']); ?>"
                                alt="<?php echo htmlspecialchars($categorie['nom']); ?>" onerror="this.src='/image/produit1.jpg'">
                        <?php else: ?>
                            <img class="img" src="/image/produit1.jpg" alt="<?php echo htmlspecialchars($categorie['nom']); ?>">
                        <?php endif; ?>
                        <p><?php echo htmlspecialchars($categorie['nom']); ?></p>
                        <span><?php echo (int) $categorie['nb_produits']; ?>
                            element<?php echo (int) $categorie['nb_produits'] > 1 ? 's' : ''; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>




    <?php
    // Récupérer les produits vedettes (les plus ajoutés au panier et les plus commandés)
    $produits_vedettes = [];
    if (file_exists(__DIR__ . '/models/model_produits.php')) {
        require_once __DIR__ . '/models/model_produits.php';
        $produits_vedettes = get_produits_vedettes(20);
    }
    ?>

    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>PRODUITS VEDETTES</h1>
            <span></span>
        </div>



        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <?php if (empty($produits_vedettes)): ?>
                <!-- Message si aucun produit -->
                <div class="carousel" style="text-align: center; padding: 40px; width: 100%;">
                    <p style="color: #666; font-size: 16px;">Aucun produit publié pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($produits_vedettes as $produit): ?>
                    <?php
                    // Calculer le prix à afficher
                    $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                        ? $produit['prix_promotion']
                        : $produit['prix'];
                    $has_promotion = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix'];
                    $pourcentage_promo = $has_promotion ? round((($produit['prix'] - $produit['prix_promotion']) / $produit['prix']) * 100) : 0;
                    ?>
                    <div class="carousel">
                        <div class="image-wrapper">
                            <img src="/upload/<?php echo htmlspecialchars($produit['image_principale'] ?? 'produit1.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>"
                                onerror="this.src='/image/produit1.jpg'">
                        </div>
                        <div class="produit-content">
                            <p id="nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?></p>
                            <?php if (!empty($produit['categorie_nom'])): ?>
                                <p id="ville"><?php echo htmlspecialchars($produit['categorie_nom']); ?></p>
                            <?php endif; ?>
                            <p class="prix">
                                <?php if ($has_promotion): ?>
                                    <span class="span2"><?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA</span>
                                    <span class="prix-promo"><?php echo number_format($prix_affichage, 0, ',', ' '); ?> FCFA</span>
                                <?php else: ?>
                                    <?php echo number_format($prix_affichage, 0, ',', ' '); ?><span class="span1"> FCFA</span>
                                <?php endif; ?>
                            </p>
                            <?php if (!empty($produit['stock'])): ?>
                                <p class="produit-card-stock-info">
                                    <strong>Stock:</strong> <?php echo $produit['stock']; ?>
                                    <?php if (!empty($produit['poids'])): ?>
                                        (<?php echo htmlspecialchars($produit['poids']); ?>)
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <a href="produit.php?id=<?php echo $produit['id']; ?>">
                            <i class="fa-solid fa-cart-shopping"></i> Ajouter au panier
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </article>
    </section>


    <?php
    // Récupérer la configuration de la section4
    $section4_config = [
        'titre' => 'Bienvenue au Tresor Africain',
        'texte' => 'Tous les produits a petit prix',
        'image_fond' => 'market.png'
    ];

    if (file_exists(__DIR__ . '/models/model_section4.php')) {
        require_once __DIR__ . '/models/model_section4.php';
        $config_result = get_section4_config();
        if ($config_result) {
            $section4_config = $config_result;
        }
    }

    // Déterminer le chemin de l'image de fond
    $image_fond_path = '/image/market.png'; // Par défaut
    if (!empty($section4_config['image_fond'])) {
        $upload_path = '/upload/section4/' . htmlspecialchars($section4_config['image_fond']);
        $file_path = __DIR__ . '/upload/section4/' . $section4_config['image_fond'];
        if (file_exists($file_path)) {
            $image_fond_path = $upload_path;
        }
    }
    ?>
    <section class="section4">
        <div class="slider" style="background-image: url('<?php echo $image_fond_path; ?>');">
            <div class="box">
                <div class="text">
                    <h1><?php echo htmlspecialchars($section4_config['titre']); ?></h1>
                </div>
            </div>
            <p><?php echo htmlspecialchars($section4_config['texte']); ?></p>
            <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['commercant_id'])): ?>
                <div style="display: flex; gap: 15px; justify-content: center; margin-top: 20px;">
                    <a href="/user/inscription.php"
                        style="padding: 12px 30px; background: linear-gradient(135deg, #918a44 0%, #c26638 100%); color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-user-plus"></i> Créer un compte
                    </a>
                    <a href="/user/connexion.php"
                        style="padding: 12px 30px; background: transparent; color: #ffffff; text-decoration: none; border: 2px solid #ffffff; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </a>
                </div>
            <?php else: ?>
                <a href="/user/mon-compte.php">Mon Compte</a>
            <?php endif; ?>
        </div>
    </section>

    <?php
    // Récupérer la configuration de la section trending
    $trending_config = [
        'label' => 'categories',
        'titre' => 'Enhance Your Music Experience',
        'bouton_texte' => 'Buy Now!',
        'bouton_lien' => '#',
        'image' => 'speaker.png'
    ];

    if (file_exists(__DIR__ . '/models/model_trending.php')) {
        require_once __DIR__ . '/models/model_trending.php';
        $config_result = get_trending_config();
        if ($config_result) {
            $trending_config = $config_result;
        }
    }

    // Déterminer le chemin de l'image
    $trending_image_path = '/image/speaker.png'; // Par défaut
    if (!empty($trending_config['image'])) {
        if ($trending_config['image'] !== 'speaker.png') {
            $upload_path = '/upload/trending/' . htmlspecialchars($trending_config['image']);
            $file_path = __DIR__ . '/upload/trending/' . $trending_config['image'];
            if (file_exists($file_path)) {
                $trending_image_path = $upload_path;
            }
        } else {
            $trending_image_path = '/image/speaker.png';
        }
    }
    ?>
    <section class="section">
        <div class="container">
            <div class="trending">
                <div class="trending_content">
                    <p class="trending_p"><?php echo htmlspecialchars($trending_config['label']); ?></p>
                    <h2 class="trending_title"><?php echo htmlspecialchars($trending_config['titre']); ?></h2>
                    <a href="<?php echo htmlspecialchars($trending_config['bouton_lien']); ?>" class="trending_btn">
                        <?php echo htmlspecialchars($trending_config['bouton_texte']); ?>
                    </a>
                </div>
                <img src="<?php echo $trending_image_path; ?>"
                    alt="<?php echo htmlspecialchars($trending_config['titre']); ?>" class="trending_img"
                    onerror="this.src='/image/speaker.png'" />
            </div>
        </div>
    </section>

    <?php
    // Récupérer les produits les plus visités
    $produits_populaires = [];
    if (file_exists(__DIR__ . '/models/model_visites.php')) {
        require_once __DIR__ . '/models/model_visites.php';
        $produits_populaires = get_produits_plus_visites(10);
    }
    ?>

    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>PRODUITS POPULAIRES</h1>
            <span></span>
        </div>



        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <?php if (empty($produits_populaires)): ?>
                <!-- Message si aucun produit -->
                <div class="carousel" style="text-align: center; padding: 40px; width: 100%;">
                    <p style="color: #666; font-size: 16px;">Aucun produit publié pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($produits_populaires as $produit): ?>
                    <?php
                    // Calculer le prix à afficher
                    $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                        ? $produit['prix_promotion']
                        : $produit['prix'];
                    $has_promotion = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix'];
                    $pourcentage_promo = $has_promotion ? round((($produit['prix'] - $produit['prix_promotion']) / $produit['prix']) * 100) : 0;
                    ?>
                    <div class="carousel">
                        <div class="image-wrapper">
                            <img src="/upload/<?php echo htmlspecialchars($produit['image_principale'] ?? 'produit1.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>"
                                onerror="this.src='/image/produit1.jpg'">
                        </div>
                        <div class="produit-content">
                            <p id="nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?></p>
                            <?php if (!empty($produit['categorie_nom'])): ?>
                                <p id="ville"><?php echo htmlspecialchars($produit['categorie_nom']); ?></p>
                            <?php endif; ?>
                            <p class="prix">
                                <?php if ($has_promotion): ?>
                                    <span class="span2"><?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA</span>
                                    <span class="prix-promo"><?php echo number_format($prix_affichage, 0, ',', ' '); ?> FCFA</span>

                                <?php else: ?>
                                    <?php echo number_format($prix_affichage, 0, ',', ' '); ?><span class="span1"> FCFA</span>
                                <?php endif; ?>
                            </p>
                            <?php if (!empty($produit['stock'])): ?>
                                <p class="produit-card-stock-info">
                                    <strong>Stock:</strong> <?php echo $produit['stock']; ?>
                                    <?php if (!empty($produit['poids'])): ?>
                                        (<?php echo htmlspecialchars($produit['poids']); ?>)
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <a href="produit.php?id=<?php echo $produit['id']; ?>">
                            <i class="fa-solid fa-cart-shopping"></i> Ajouter au panier
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </article>
    </section>




    <?php
    // Récupérer les catégories les plus populaires (visites + commandes) - Maximum 2
    $top_categories = [];
    if (file_exists(__DIR__ . '/models/model_categories.php')) {
        require_once __DIR__ . '/models/model_categories.php';
        $top_categories = get_top_categories(2);
    }
    ?>

    <section class="section5">
        <h1>Top Categorie</h1>
        <div class="container">
            <?php if (empty($top_categories)): ?>
                <!-- Message si aucune catégorie -->
                <div style="text-align: center; padding: 40px; color: #666;">
                    <p>Aucune catégorie disponible pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($top_categories as $categorie): ?>
                    <?php
                    // Déterminer le chemin de l'image
                    $categorie_image_path = '/image/produit1.jpg'; // Par défaut
                    if (!empty($categorie['image'])) {
                        $upload_path = '/upload/' . htmlspecialchars($categorie['image']);
                        $file_path = __DIR__ . '/upload/' . $categorie['image'];
                        if (file_exists($file_path)) {
                            $categorie_image_path = $upload_path;
                        }
                    }
                    ?>
                    <div class="slider">
                        <img src="<?php echo $categorie_image_path; ?>" alt="<?php echo htmlspecialchars($categorie['nom']); ?>"
                            onerror="this.src='/image/produit1.jpg'">
                        <div class="box">
                            <h4><?php echo htmlspecialchars(strtoupper($categorie['nom'])); ?></h4>
                            <a href="categorie.php?id=<?php echo $categorie['id']; ?>">Voir cette categorie ></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>




    <?php
    // Récupérer les produits de la catégorie "Cosmétiques"
    $produits_cosmetiques = [];
    if (file_exists(__DIR__ . '/models/model_categories.php') && file_exists(__DIR__ . '/models/model_produits.php')) {
        require_once __DIR__ . '/models/model_categories.php';
        require_once __DIR__ . '/models/model_produits.php';

        // Récupérer la catégorie "Cosmétiques"
        $categorie_cosmetiques = get_categorie_by_nom('Les Cosmétiques');

        // Si la catégorie n'existe pas, essayer avec "Cosmétiques" (sans "Les")
        if (!$categorie_cosmetiques) {
            $categorie_cosmetiques = get_categorie_by_nom('Cosmétiques');
        }

        // Si la catégorie existe, récupérer ses produits
        if ($categorie_cosmetiques && isset($categorie_cosmetiques['id'])) {
            $produits_cosmetiques = get_produits_by_categorie($categorie_cosmetiques['id']);

            // Mélanger aléatoirement les produits
            if (!empty($produits_cosmetiques)) {
                mt_srand(time() + (int) (microtime(true) * 1000000));
                shuffle($produits_cosmetiques);
            }
        }
    }
    ?>

    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>Tout pour le corps et pour le bien-être</h1>
            <span></span>
        </div>

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <?php if (empty($produits_cosmetiques)): ?>
                <!-- Message si aucun produit -->
                <div class="carousel" style="text-align: center; padding: 40px; width: 100%;">
                    <p style="color: #666; font-size: 16px;">Aucun produit publié pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($produits_cosmetiques as $produit): ?>
                    <?php
                    // Calculer le prix à afficher
                    $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                        ? $produit['prix_promotion']
                        : $produit['prix'];
                    $has_promotion = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix'];
                    $pourcentage_promo = $has_promotion ? round((($produit['prix'] - $produit['prix_promotion']) / $produit['prix']) * 100) : 0;
                    ?>
                    <div class="carousel">
                        <div class="image-wrapper">
                            <img src="/upload/<?php echo htmlspecialchars($produit['image_principale'] ?? 'produit1.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>"
                                onerror="this.src='/image/produit1.jpg'">
                        </div>
                        <div class="produit-content">
                            <p id="nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?></p>
                            <?php if (!empty($produit['categorie_nom'])): ?>
                                <p id="ville"><?php echo htmlspecialchars($produit['categorie_nom']); ?></p>
                            <?php endif; ?>
                            <p class="prix">
                                <?php if ($has_promotion): ?>
                                    <span class="span2"><?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA</span>
                                    <span class="prix-promo"><?php echo number_format($prix_affichage, 0, ',', ' '); ?> FCFA</span>
                                <?php else: ?>
                                    <?php echo number_format($prix_affichage, 0, ',', ' '); ?><span class="span1"> FCFA</span>
                                <?php endif; ?>
                            </p>
                            <?php if (!empty($produit['stock'])): ?>
                                <p class="produit-card-stock-info">
                                    <strong>Stock:</strong> <?php echo $produit['stock']; ?>
                                    <?php if (!empty($produit['poids'])): ?>
                                        (<?php echo htmlspecialchars($produit['poids']); ?>)
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <a href="produit.php?id=<?php echo $produit['id']; ?>">
                            <i class="fa-solid fa-cart-shopping"></i> Ajouter au panier
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </article>
    </section>




    <?php
    // Récupérer les produits les plus récents (nouveautés) - Maximum 4
    $produits_nouveautes = [];
    if (file_exists(__DIR__ . '/models/model_produits.php')) {
        require_once __DIR__ . '/models/model_produits.php';
        $produits_nouveautes = get_produits_nouveautes(4);
    }

    // Classes CSS pour les différents items de la galerie
    $gallery_classes = ['gallery_item_1', 'gallery_item_2', 'gallery_item_3', 'gallery_item_4'];
    ?>

    <section class="section0">
        <div class="container">
            <div class="section_category">
                <p class="section_category_p">En vedette</p>
            </div>
            <div class="section_header">
                <h3 class="section_title">Nouveautés</h3>
            </div>
            <div class="gallery">
                <?php if (empty($produits_nouveautes)): ?>
                    <!-- Message si aucun produit -->
                    <div style="text-align: center; padding: 40px; color: #666; width: 100%; grid-column: 1 / -1;">
                        <p style="font-size: 16px;">Aucun produit publié pour le moment.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($produits_nouveautes as $index => $produit): ?>
                        <?php
                        // Déterminer le chemin de l'image
                        $produit_image_path = '/image/produit1.jpg'; // Par défaut
                        if (!empty($produit['image_principale'])) {
                            $upload_path = '/upload/' . htmlspecialchars($produit['image_principale']);
                            $file_path = __DIR__ . '/upload/' . $produit['image_principale'];
                            if (file_exists($file_path)) {
                                $produit_image_path = $upload_path;
                            }
                        }

                        // Calculer le prix à afficher
                        $prix_affichage = !empty($produit['prix_promotion']) && $produit['prix_promotion'] < $produit['prix']
                            ? $produit['prix_promotion']
                            : $produit['prix'];

                        // Description courte (limiter à 80 caractères)
                        $description = !empty($produit['description'])
                            ? htmlspecialchars(substr($produit['description'], 0, 80)) . (strlen($produit['description']) > 80 ? '...' : '')
                            : 'Découvrez ce produit naturel de qualité.';

                        // Classe CSS pour l'item
                        $gallery_class = isset($gallery_classes[$index]) ? $gallery_classes[$index] : 'gallery_item_1';
                        ?>
                        <div class="gallery_item <?php echo $gallery_class; ?>">
                            <img src="<?php echo $produit_image_path; ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>"
                                class="gallery_item_img" onerror="this.src='/image/produit1.jpg'">
                            <div class="gallery_item_content">
                                <div class="gallery_item_title"><?php echo htmlspecialchars($produit['nom']); ?></div>
                                <p class="gallery_item_p">
                                    <?php echo $description; ?>
                                </p>
                                <a href="produit.php?id=<?php echo $produit['id']; ?>" class="gallery_item_link">
                                    ACHETER MAINTENANT
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section0">
        <div class="container services_container">
            <div class="service">
                <img src="./image/icons/service-1.png" alt="" class="service_img" />
                <h3 class="service_title">Livraison rapide</h3>

            </div>
            <div class="service">
                <img src="./image/icons/service-2.png" alt="" class="service_img" />
                <h3 class="service_title">24/7 Service</h3>

            </div>
            <div class="service">
                <img src="./image/icons/service-3.png" alt="" class="service_img" />
                <h3 class="service_title">GARANTIE DE REMBOURSEMENT</h3>

            </div>
        </div>
    </section>


    <?php
    // Récupérer les 20 premiers produits
    $produits_tous = [];
    $total_produits = 0;
    if (file_exists(__DIR__ . '/models/model_produits.php')) {
        require_once __DIR__ . '/models/model_produits.php';
        $produits_tous = get_all_produits_paginated(0, 20);
        $total_produits = count_all_produits_actifs();
    }
    ?>

    <section class="section00">
        <section class="produit_vedetes">
            <div class="box1">
                <h1>Tous nos produits</h1>
            </div>

            <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
                data-aos-mirror="true" data-aos-once="true" data-aos-anchor-placement="top-bottom"
                class="articles carousel11" id="produits-container">
                <?php if (empty($produits_tous)): ?>
                    <!-- Message si aucun produit -->
                    <div style="text-align: center; padding: 40px; color: #666; width: 100%;">
                        <p style="font-size: 16px;">Aucun produit publié pour le moment.</p>
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
                            <div class="image-wrapper">
                                <img src="/upload/<?php echo htmlspecialchars($produit['image_principale'] ?? 'produit1.jpg'); ?>"
                                    alt="<?php echo htmlspecialchars($produit['nom'] ?? 'Produit'); ?>"
                                    onerror="this.src='/image/produit1.jpg'">
                            </div>
                            <div class="produit-content">
                                <p id="nom"><?php echo htmlspecialchars($produit['nom'] ?? 'Produit sans nom'); ?></p>
                                <?php if (!empty($produit['categorie_nom'])): ?>
                                    <p id="ville"><?php echo htmlspecialchars($produit['categorie_nom']); ?></p>
                                <?php endif; ?>
                                <p class="prix">
                                    <?php if ($has_promotion): ?>
                                        <span class="span2"><?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA</span>
                                        <span class="prix-promo"><?php echo number_format($prix_affichage, 0, ',', ' '); ?>
                                            FCFA</span>

                                    <?php else: ?>
                                        <?php echo number_format($prix_affichage, 0, ',', ' '); ?><span class="span1"> FCFA</span>
                                    <?php endif; ?>
                                </p>
                                <?php if (!empty($produit['stock'])): ?>
                                    <p class="produit-card-stock-info">
                                        <strong>Stock:</strong> <?php echo $produit['stock']; ?>
                                        <?php if (!empty($produit['poids'])): ?>
                                            (<?php echo htmlspecialchars($produit['poids']); ?>)
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <a href="produit.php?id=<?php echo $produit['id']; ?>">
                                <i class="fa-solid fa-cart-shopping"></i> Ajouter au panier
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </article>

            <?php if (!empty($produits_tous) && $total_produits > 20): ?>
                <div style="text-align: center; margin-top: 30px; padding: 20px;">
                    <a href="produits.php"
                        style="padding: 12px 30px; background: #918a44; color: #ffffff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-arrow-right"></i> Voir tous les produits (<?php echo $total_produits; ?>)
                    </a>
                </div>
            <?php endif; ?>
        </section>
    </section>




    <?php include('footer.php') ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/owl.carousel.js"></script>
    <script src="/js/owl.animate.js"></script>
    <script src="/js/owl.autoplay.js"></script>

    <script>
        $(document).ready(function () {

            $('.slider1').owlCarousel({
                items: 2,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 400,
                stagePadding: 0,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>',
                    '<i class="fa-solid fa-chevron-right"></i>'
                ]
            });
            var carousel2 = $('.slider1').owlCarousel();
            $('.owl-next2').click(function () {
                carousel2.trigger('next.owl.carousel');
            })
            $('.owl-prev2').click(function () {
                carousel2.trigger('prev.owl.carousel');
            })

            // Initialiser le carrousel 1 avec la portée appropriée
            $('.carousel1').owlCarousel({
                items: 5,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 600,
                stagePadding: 1,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>',
                    '<i class="fa-solid fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                        stagePadding: 10,
                        nav: false,
                        dots: true
                    },
                    576: {
                        items: 2,
                        stagePadding: 15,
                        nav: true,
                        dots: true
                    },
                    768: {
                        items: 3,
                        stagePadding: 15,
                        nav: true,
                        dots: true
                    },
                    992: {
                        items: 4,
                        stagePadding: 20,
                        nav: true,
                        dots: true
                    },
                    1200: {
                        items: 5,
                        stagePadding: 1,
                        nav: true,
                        dots: true
                    }
                }
            });
            var carousel1 = $('.carousel1').owlCarousel();
            $('.owl-next').click(function () {
                carousel1.trigger('next.owl.carousel');
            })
            $('.owl-prev').click(function () {
                carousel1.trigger('prev.owl.carousel');
            })


            $('.slider-area').owlCarousel({
                items: 1,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 800,
                stagePadding: 1,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>',
                    '<i class="fa-solid fa-chevron-right"></i>'
                ]
            });
            var carousel2 = $('.carousel2').owlCarousel();
            $('.owl-next2').click(function () {
                carousel2.trigger('next.owl.carousel');
            })
            $('.owl-prev2').click(function () {
                carousel2.trigger('prev.owl.carousel');
            })


            $('.categorie').owlCarousel({
                items: 5,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 2000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 600,
                stagePadding: 20,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>',
                    '<i class="fa-solid fa-chevron-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 2,
                        stagePadding: 10,
                        nav: false,
                        dots: true
                    },
                    576: {
                        items: 2,
                        stagePadding: 15,
                        nav: true,
                        dots: true
                    },
                    768: {
                        items: 3,
                        stagePadding: 15,
                        nav: true,
                        dots: true
                    },
                    992: {
                        items: 4,
                        stagePadding: 20,
                        nav: true,
                        dots: true
                    },
                    1200: {
                        items: 5,
                        stagePadding: 20,
                        nav: true,
                        dots: true
                    }
                }
            });
            var carousel2 = $('.carousel2').owlCarousel();
            $('.owl-next2').click(function () {
                carousel2.trigger('next.owl.carousel');
            })
            $('.owl-prev2').click(function () {
                carousel2.trigger('prev.owl.carousel');
            })

        });
    </script>

    <script>
        // ..
        AOS.init();
    </script>

</body>

</html>