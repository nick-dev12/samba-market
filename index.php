<?php

if(isset($_COOKIE['commercant_id'])){
    $commercant_id = $_COOKIE['commercant_id'];
 }else{
    $commercant_id = '';
 }

// Inclusion du fichier de connexion à la BDD

// Récupérez l'ID du commerçant à partir de la session
// Récupérez l'ID de l'utilisateur depuis la variable de session
include ('controller/controller_commerce_users.php')
?>











<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/teste.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/animate.min.css">


</head>

<body>

 <?php include('src/navbare.php') ?>


    <div class="slider-area owl-carousel">
        <div class="slider-item">
            <img src="/image/slider-1.png" alt="">
            <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="box">
                <h1>Bienvenue au Samba-Market</h1>
                <p>Le shopping en ligne pour tous vos besoins : accessoires, vêtements, bijoux et autres </p>
                <button>Commencer dès maintenant </button>
            </div>
        </div>
        <div class="slider-item">
            <img src="/image/sho.avif" alt="">
            <div class="box">
                <h1>Des boutiques locales qui répondes à vos besoins</h1>
                <p>Découvrez les meilleurs commerçants près de chez vous pour trouver ce dont vous avez besoin.</p>
                <button>Explorer dès maintenant </button>
            </div>
        </div>
        <div class="slider-item">
            <img src="/image/asd.jpg" alt="">
            <div class="box">
                <h1>Le shopping malin et facile</h1>
                <p>Tous vos achats au même endroit, livrés où vous voulez, quand vous voulez. Le shopping simplifié !
                </p>
                <button>Voir les produits </button>
            </div>
        </div>
        <div class="slider-item">
            <img src="/image/tendance.jpg" alt="">
            <div class="box">
                <h1>Les tendances de demain à petit prix</h1>
                <p>
                    Dénichez les produits et marques émergentes à la pointe de la mode.
                </p>
                <button>Explorer dès maintenant</button>
            </div>
        </div>


    </div>

    <!-- <div class="slider owl-carousel boot">
            <div class="slider-item">
                <img src="/image/slider-1.png" alt="">
                <div class="text">
                    <h1>bienvenue au Samba-Market</h1>
                    <p>le shopping en ligne pour tous vos besoins : accessoires, vêtements, bijoux et autres </p>
                    <button>commencer dès maintenant </button>
                </div>
            </div>

            
            <div class="box">
                <img src="/image/sho.avif" alt="">
                <div class="text">
                    <h1>des boutiques locales qui répondes à vos besoins</h1>
                    <p>Découvrez les meilleurs commerçants près de chez vous pour trouver ce dont vous avez besoin.</p>
                    <button>explorer dès maintenant </button>
                </div>
            </div>

            <div class="box">
                <img src="/image/asd.jpg" alt="">
                <div class="text">
                    <h1>Le shopping malin et facile</h1>
                    <p>Tous vos achats au même endroit, livrés où vous voulez, quand vous voulez. Le shopping simplifié !</p>
                    <button>voir les produits </button>
                </div>
            </div>
        </div> -->


    <section class="section3">
        <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-right">
            <img src="/image/service-10.png" alt="">
            <img src="/image/service-5.png" alt="">
            <img src="/image/service-6.png" alt="">
        </div>
        <div data-aos="fade-left" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-left">
            <img src="/image/service-7.png" alt="">
            <img src="/image/service-8.png" alt="">
            <img src="/image/service-9.png" alt="">
        </div>
    </section>

    <div class="affiches">
        <div class="box1">
            <div>
                <h1>Des legumes fraits</h1>
                <p>Decouvrer une large varieter de legumes locals</p>
                <button>Explorer</button>
            </div>
            <img class="liste" src="/image/Liste-des-legumes-verts-removebg-preview.png" alt="">
        </div>
        <div class="box1">
            <img class="puma" src="/image/basket-removebg-preview.png" alt="">
            <div>
                <h1>Des basketes sous mesure</h1>
                <p>Tous vos baskets au meilleurs prix</p>
                <button>Explorer</button>
            </div>
            <img class="s1" src="/image/s1.png" alt="">
            <img class="s2" src="/image/s2-removebg-preview.png" alt="">
            <img class="s3" src="/image/s3-removebg-preview.png" alt="">
            <img class="s4" src="/image/s4-removebg-preview.png" alt="">
            <img class="s5" src="/image/s5-removebg-preview.png" alt="">
        </div>
    </div>



    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>PRODUITS VEDETTES</h1>
            <span></span>
        </div>

        <div class="box2">
            <span><i class="fa-solid fa-chevron-left"></i></span>
            <span><i class="fa-solid fa-chevron-right"></i></span>
        </div>

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/upload/sac1.jpg" alt="">
                <p>6000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">sac a main</p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/t-shirt1.jpg" alt="">
                <p>12000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">t-shirt hummel</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/montre1.jpg" alt="">
                <p>25000<span>fca</span></p>
                <span class="vendu">120 vendu</span>
                <p id="nom">montre de lux</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/sac2.jpg" alt="">
                <p>6000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">sac a main</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/collier.jpg" alt="">
                <p>8000<span>fca</span></p>
                <span class="vendu">18 vendu</span>
                <p id="nom">collier de sortie</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/chaussures 1.jpg" alt="">
                <p>10000<span>fca</span></p>
                <span class="vendu">243 vendu</span>
                <p id="nom">chaussures nike</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>


    <section class="section4">
        <div class="slider ">
            <div class="box">
                <img src="/image/vedet.jpg" alt="">
                <div class="text">
                    <h1>bienvenue au Samba-Market</h1>
                </div>
            </div>
        </div>

    </section>
    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>PRODUITS POPULAIRES</h1>
            <span></span>
        </div>

        <div class="box2">
            <span><i class="fa-solid fa-chevron-left"></i></span>
            <span><i class="fa-solid fa-chevron-right"></i></span>
        </div>

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/upload/ventilateur.jpg" alt="">
                <p>6000<span>fca</span></p>
                <span class="vendu">670vendu</span>
                <p id="nom">ventilateur</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/A12.jpg" alt="">
                <p>12000<span>fca</span></p>
                <span class="vendu">234 vendu</span>
                <p id="nom">samsung galaxy A12</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/meches1.jpg" alt="">
                <p>25000<span>fca</span></p>
                <span class="vendu">547 vendu</span>
                <p id="nom">meches a cheuveux</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/SPARK-7.png" alt="">
                <p>67000<span>fca</span></p>
                <span class="vendu">1200 vendu</span>
                <p id="nom">spark 7</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/robe1.jpg" alt="">
                <p>16000<span>fca</span></p>
                <span class="vendu">20 vendu</span>
                <p id="nom">robe de soire</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/sweat-capuche-femme-300vdx-1.jpg" alt="">
                <p>21000<span>fca</span></p>
                <span class="vendu">243 vendu</span>
                <p id="nom">sweat-capuche-femme</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/collier.jpg" alt="">
                <p>8000<span>fca</span></p>
                <span class="vendu">18 vendu</span>
                <p id="nom">collier de sortie</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>




    <section class="section4">
        <div class="slider ">
            <div class="box">
                <img src="/image/medame.jpg" alt="">
                <div class="text">
                    <h1>explorer plus de produits</h1>
                </div>
            </div>
        </div>

    </section>

    <div class="produit_afiche">
        <div class="box">
            <img data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" src="/image/belles.jpg" alt="">
            <h1 data-aos="fade-left" data-aos-delay="300" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom">Nouvelle douceur</h1>
        </div>
    </div>



    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>Tout pour la maison au meilleur prix</h1>
            <span></span>
        </div>

        <div class="box2">
            <span><i class="fa-solid fa-chevron-left"></i></span>
            <p>Équipez votre intérieur malin avec nos produits design au meilleur rapport qualité/prix.</p>
            <span><i class="fa-solid fa-chevron-right"></i></span>
        </div>

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/image/chaise1.avif" alt="">
                <p>6000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">sac a main</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/chaise2.jpeg" alt="">
                <p>12000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">t-shirt hummel</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/rido1.jpg" alt="">
                <p>25000<span>fca</span></p>
                <span class="vendu">120 vendu</span>
                <p id="nom">montre de lux</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/fauteuil1.jpg" alt="">
                <p>6000<span>fca</span></p>
                <span class="vendu">0 vendu</span>
                <p id="nom">sac a main</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/ampoule1.jpg" alt="">
                <p>8000<span>fca</span></p>
                <span class="vendu">18 vendu</span>
                <p id="nom">collier de sortie</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/rideaux.jpg" alt="">
                <p>10000<span>fca</span></p>
                <span class="vendu">243 vendu</span>
                <p id="nom">chaussures nike</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>


    <footer>
        <span>developper par @nick jomas</span>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/owl.carousel.js"></script>
    <script src="/js/owl.animate.js"></script>
    <script src="/js/owl.autoplay.js"></script>

    <script>
        $(document).ready(function() {
            // Initialiser le carrousel 1 avec la portée appropriée
            $('.carousel1').owlCarousel({
                items: 5,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 6000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 600,
                stagePadding: 1,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
            });
            var carousel1 = $('.carousel1').owlCarousel();
            $('.owl-next').click(function() {
                carousel1.trigger('next.owl.carousel');
            })
            $('.owl-prev').click(function() {
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
                smartSpeed: 600,
                stagePadding: 1,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
            });
            var carousel2 = $('.carousel2').owlCarousel();
            $('.owl-next2').click(function() {
                carousel2.trigger('next.owl.carousel');
            })
            $('.owl-prev2').click(function() {
                carousel2.trigger('prev.owl.carousel');
            })

            // Tableau d'animations
            c
        });
    </script>

    <script>
        // ..
        AOS.init();
    </script>

</body>

</html>