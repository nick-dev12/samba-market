<?php
// Compter les articles du panier si l'utilisateur est connecté
$panier_count = 0;
if (isset($_SESSION['user_id'])) {
    // Déterminer le chemin correct selon l'emplacement du fichier
    $model_path = file_exists(__DIR__ . '/models/model_panier.php')
        ? __DIR__ . '/models/model_panier.php'
        : dirname(__DIR__) . '/models/model_panier.php';

    if (file_exists($model_path)) {
        require_once $model_path;
        $panier_count = count_panier_items($_SESSION['user_id']);
    }
}
?>
<link rel="stylesheet" href="../css/nabare.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/nabare.css">
<style>
/* Styles améliorés pour le panier */
.panier-link {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: inherit;
    width: 40px;
    height: 40px;
}

.panier-link span i {
    font-size: 22px;
    color: #000000;
    transition: color 0.3s;
}

.panier-link:hover span i {
    color: #918a44;
}

.panier-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #c26638;
    color: #ffffff;
    border-radius: 12px;
    min-width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    border: 2.5px solid #ffffff;
    padding: 0 5px;
    box-shadow: 0 2px 6px rgba(194, 102, 56, 0.4);
    line-height: 1;
    z-index: 10;
}

.panier-badge:empty {
    display: none;
}

.panier-link:hover .panier-badge {
    background-color: #6b2f20;
    transform: scale(1.05);
    box-shadow: 0 3px 8px rgba(107, 47, 32, 0.5);
}

/* Réduction des boutons */
nav .box button {
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    border: none;
    border-radius: 5px;
    display: block;
    margin: 0 6px;
    background-color: #000000;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

nav .box button:hover {
    background-color: #918a44;
}

nav .box .dconn {
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    border: none;
    border-radius: 5px;
    display: block;
    margin: 0 6px;
    background-color: #000000;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

nav .box .dconn:hover {
    background-color: #c26638;
}

/* Avatar avec initiale */
.user-avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: #918a44;
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    margin-right: 8px;
    flex-shrink: 0;
}

.user-info {
    display: flex;
    align-items: center;
}

nav .containernav .users p {
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-right: 15px;
    display: flex;
    align-items: center;
    color: #000000;
}

/* Amélioration de l'espacement */
nav .containernav .users {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 20px;
    gap: 10px;
}

nav .box {
    height: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 20px;
    gap: 5px;
}
</style>

<div class="info">

</div>
<nav>
    <a class="logo" href="/index.php"><img src="/image/logo.jpeg" alt=""></a>
    <div class="containernav">



        <div class="box1">
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/panier.php" class="panier-link"
                title="Voir mon panier (<?php echo $panier_count; ?> article<?php echo $panier_count > 1 ? 's' : ''; ?>)">
                <span><i class="fa-solid fa-cart-shopping"></i></span>
                <?php if ($panier_count > 0): ?>
                <span class="panier-badge"><?php echo $panier_count > 99 ? '99+' : $panier_count; ?></span>
                <?php endif; ?>
            </a>
            <?php else: ?>
            <a href="/user/connexion.php?redirect=panier" class="panier-link" title="Se connecter pour voir le panier">
                <span><i class="fa-solid fa-cart-shopping"></i></span>
            </a>
            <?php endif; ?>
        </div>


        <?php if (isset($_SESSION['commercant_id'])): ?>

        <div class="users">

            <div class="box">
                <a href="#"><button>boutique</button></a>
                <a class="dconn" href="/conn/dconn.php">deconnection</a>
            </div>
            <a href="/view/profil_commercent.php">
                <p class="nom">
                    <?php
                        $explode_nom = explode(' ', $commercant['nom']);
                        $nom = $explode_nom['0'];
                        echo $nom;
                        ?>
                </p>
            </a>

            <img class="images" src="/upload/<?= $commercant['images'] ?>" alt="">



            <script>
            let profil1 = document.querySelector('.nom');
            profil1.addEventListener('click', () => {

            })
            </script>
        </div>

        <?php elseif (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])): ?>
        <!-- Utilisateur connecté -->
        <div class="users">
            <div class="box">
                <a href="/user/deconnexion.php" class="dconn">Déconnexion</a>
            </div>
            <a href="/user/mon-compte.php" style="text-decoration: none; color: inherit;">
                <p class="nom">
                    <?php
                        $user_prenom = isset($_SESSION['user_prenom']) ? $_SESSION['user_prenom'] : 'Utilisateur';
                        $initiale = strtoupper(mb_substr($user_prenom, 0, 1, 'UTF-8'));
                        ?>
                    <span class="user-avatar"><?php echo htmlspecialchars($initiale); ?></span>
                    <span class="user-name"><?php echo htmlspecialchars($user_prenom); ?></span>
                </p>
            </a>
        </div>

        <?php else: ?>
        <!-- Utilisateur non connecté -->
        <div class="box">
            <a href="/user/connexion.php"><button>Connexion</button></a>
            <a href="/user/inscription.php"><button>Inscription</button></a>
            <a href="#"><button>boutique</button></a>
        </div>
        <?php endif ?>
    </div>
</nav>

<?php
// Récupérer les catégories pour le menu de navigation
$categories_menu = [];
if (file_exists(__DIR__ . '/models/model_categories.php')) {
    require_once __DIR__ . '/models/model_categories.php';
    $categories_menu = get_all_categories();
}
?>

<section class="section1">
    <div>
        <span><i class="fa-solid fa-bars"></i></span>
    </div>
    <?php if (!empty($categories_menu)): ?>
    <?php foreach ($categories_menu as $categorie): ?>
    <a href="categorie.php?id=<?php echo $categorie['id']; ?>">
        <?php echo htmlspecialchars($categorie['nom']); ?>
    </a>
    <?php endforeach; ?>
    <?php else: ?>
    <!-- Fallback si aucune catégorie n'est disponible -->
    <a href="produits.php">Tous les produits</a>
    <?php endif; ?>
</section>