<link rel="stylesheet" href="../css/nabare.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">

<div class="info"><span><i class="fa-solid fa-phone fa-2xs"></i>+241 77 12 20 41</span>
    <span><i class="fa-solid fa-envelope fa-2xs"></i>support@Samba-Market.com
    </span>
</div>
<nav>
    <a class="logo" href="/index.php"><img src="/image/samba-market.png" alt=""></a>
    <div class="container">
        

        <form action="" method="post">
            <input type="search" name="search" id="search">
            <label for="submit"><i class="fa-solid fa-magnifying-glass fa-2xs"></i></label>
            <input type="submit" value="" id="submit" name="submit">
        </form>

        <div class="box1">
            <span><i class="fa-solid fa-cart-shopping fa-xs"></i></span>
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
        $explode_nom = explode(' ' , $commercant['nom']) ;
        $nom = $explode_nom['0'];
        echo $nom ;
        ?>
    </p>
   </a>

    <img class="images" src="/upload/<?= $commercant['images'] ?>" alt="">

   

    <script>
        let profil1 =document.querySelector('.nom');
        profil1.addEventListener('click', ()=>{
            
        })
    </script>
</div>

<?php else: ?>
<div class="box">
    <a href="/commerçant.php"><button>connexion</button></a>
    <a href="/inscription.php"><button>inscription</button></a>
    <a href="#"><button>boutique</button></a>
</div>
<?php endif ?>
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