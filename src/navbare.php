<link rel="stylesheet" href="../css/nabare.css">



<div class="info"><span><i class="fa-solid fa-phone fa-2xs"></i>+241 77 12 20 41</span> <span><i
            class="fa-brands fa-facebook"></i><i class="fa-brands fa-youtube"></i><i class="fa-brands fa-tiktok"></i><i
            class="fa-brands fa-whatsapp"></i><i class="fa-brands fa-instagram"></i></span> <span><i
            class="fa-solid fa-envelope fa-2xs"></i>support@Samba-Market.com</span></div>
<nav>
    <a class="logo" href="/index.php"><img src="/image/panier.png" alt=""><span>S</span> <span>amba-market</span></a>
    <div class="container">


        <?php if (isset($_SESSION['user_info'])): ?>

            <div class="users">
                <p>
                    
                      <?php  echo $_SESSION['user_info']['nom'];?>
                    
                </p>
                
                <img src="/upload/<?= $_SESSION['user_info']['images'] ?>" alt="">

                <div class="box">
                    <a href="#"><button>boutique</button></a>
                    <a class="dconn" href="/conn/dconn.php">deconnection</a>
                </div>
            </div>

        <?php else: ?>
            <div class="box">
                <a href="/connexion.php"><button>connexion</button></a>
                <a href="/inscription.php"><button>inscription</button></a>
                <a href="#"><button>boutique</button></a>
            </div>
        <?php endif ?>

        <form action="" method="post">
            <input type="search" name="search" id="search">
            <label for="submit"><i class="fa-solid fa-magnifying-glass fa-2xs"></i></label>
            <input type="submit" value="" id="submit" name="submit">
        </form>

        <div class="box1">
            <span><i class="fa-solid fa-cart-shopping fa-xs"></i></span>
        </div>
    </div>
</nav>

<section class="section1">
    <div>
        <span><i class="fa-solid fa-bars"></i></span>
    </div>
    <a href="">femme</a>
    <a href="">homme</a>
    <a href="">enfant</a>
    <a href="">Téléphones portables et télécommunications</a>
    <a href="">Ordinateur et bureautique</a>
    <a href="">Electronique</a>
    <a href="">Bijoux et Accessoires</a>
    <a href="">sacs et chaussurs</a>
</section>