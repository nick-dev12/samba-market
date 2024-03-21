<?php
session_start();


// Inclusion du fichier de connexion à la BDD

// Récupérez l'ID du commerçant à partir de la session
// Récupérez l'ID de l'utilisateur depuis la variable de session
include('controller/controller_commerce_users.php')
    ?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
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

</head>


<body>

    <?php include('nav_bar.php') ?>


    <div class="slider-area owl-carousel">
        <div class="slider-item">
            <img src="/image/produit3.avif" alt="">
            <div data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out"
                data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom" class="box">
                <h1>Bienvenue au Samba-Market</h1>
                <p>Le shopping en ligne pour tous vos besoins : accessoires, vêtements, bijoux et autres.</p>
                <button>Commencer dès maintenant</button>

            </div>
        </div>
        <div class="slider-item">
            <img src="/image/produit4.png" alt="">
            <div class="box">
                <h1>Des boutiques locales qui répondent à vos besoins</h1>
                <p>Découvrez les meilleurs commerçants près de chez vous pour trouver ce dont vous avez besoin.</p>
                <button>Explorer dès maintenant</button>

            </div>
        </div>
        <div class="slider-item">
            <img src="/image/produit1.jpg" alt="">
            <div class="box">
                <h1>Le shopping malin et facile</h1>
                <p>Tous vos achats au même endroit, livrés où vous voulez, quand vous voulez. Le shopping simplifié !
                </p>
                <button>Voir les produits</button>

            </div>
        </div>
        <div class="slider-item">
            <img src="/image/produit2.jpg" alt="">
            <div class="box">
                <h1>Les tendances de demain à petit prix</h1>
                <p>Tous vos produits du moment à des prix imbattables.</p>
                <button>Explorer dès maintenant</button>

            </div>
        </div>


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

    <section class="categorie owl-carousel">
        <div class="item">
            <img class="img" src="/image/electronique.png" alt="">
            <p>Électronique</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/vetement.png" alt="">
            <p>Vêtements</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/livre.jpg" alt="">
            <p>Livre</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Électroménagers.png" alt="">
            <p>Électroménagers</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Meubles.png" alt="">
            <p>Meubles</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Jouets.png" alt="">
            <p>Jouets</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Articles de sport.png" alt="">
            <p>Articles de sport</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Beauté et soins personnels.png" alt="">
            <p>Beauté et soins personnels</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Animaux de compagnie.png" alt="">
            <p>Animaux de compagnie</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Outils et équipement.png" alt="">
            <p>Outils et équipement</p>
            <span>26 element</span>
        </div>
        <div class="item">
            <img class="img" src="/image/Arts.png" alt="">
            <p>Arts</p>
            <span>26 element</span>
        </div>

    </section>

    <div class="affiches">
        <div class="box1">
            <h1>Explorer encore plus</h1>
        </div>
        <div class="containe-box">
            <div class="box2">
                <div class="slider1 slider owl-carousel">
                    <div class="item">
                        <img src="/image/produit4.png" alt="">
                        <h4>bonjour je suis</h4>
                        <p><span class="span1">200f</span>
                            <span class="span2">600f</span>
                            <span class="span3">-20%</span>
                        </p>
                    </div>
                    <div class="item">
                        <img src="/image/chaussure1.jpg" alt="">
                        <h4>bonjour je suis</h4>
                        <p><span class="span1">200f</span>
                            <span class="span2">600f</span>
                            <span class="span3">-20%</span>
                        </p>
                    </div>
                </div>
                <div class="slider1 slider owl-carousel">
                    <div class="item">
                        <img src="/image/produit4.png" alt="">
                        <h4>bonjour je suis</h4>
                        <p><span class="span1">200f</span>
                            <span class="span2">600f</span>
                            <span class="span3">-20%</span>
                        </p>
                    </div>
                    <div class="item">
                        <img src="/image/chaussure1.jpg" alt="">
                        <h4>bonjour je suis</h4>
                        <p><span class="span1">200f</span>
                            <span class="span2">600f</span>
                            <span class="span3">-20%</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="s_box2">
                <div class="explore">
                    <p><span class="span11">
                            </span>beauté+<span class="span22">></span></p>
                    <a href="">Explorer</a>
                </div>
                <div class="slider">
                    <img src="/image/beaute+.png" alt="">
                </div>
            </div>
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

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/upload/sac1.jpg" alt="">
                <p id="nom">sac a main</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/t-shirt1.jpg" alt="">
                <p id="nom">t-shirt hummel</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/montre1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/sac2.jpg" alt="">
                <p id="nom">sac a main</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/collier.jpg" alt="">
                <p id="nom">collier de sortie</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/chaussures 1.jpg" alt="">
                <p id="nom">chaussures nike</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>


    <section class="section4">
        <div class="slider ">
            <div class="box">
                <div class="text">
                    <h1>Bienvenue au Samba-Market</h1>
                </div>
            </div>
            <p>Tous les produits a petit prix</p>
            <a href="">Nouveau Shopping</a>
        </div>

    </section>

    <section class="section">
        <div class="container">
            <div class="trending">
                <div class="trending_content">
                    <p class="trending_p">categories</p>
                    <h2 class="trending_title">Enhance Your Music Experience</h2>
                    <a href="#" class="trending_btn">Buy Now!</a>
                </div>
                <img src="/image/speaker.png" alt="" class="trending_img" />
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

        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/upload/ventilateur.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/A12.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/meches1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/SPARK-7.png" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/robe1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/sweat-capuche-femme-300vdx-1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/collier.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>




    <section class="section5">
        <h1>Top Categorie</h1>
        <div class="container">

            <div class="slider">
                <img src="/image/produit2.jpg" alt="">
                <div class="box">
                    <h4>ENFANT</h4>
                    <a href="">Voir cette categorie ></a>
                </div>
            </div>

            <div class="slider">
                <img src="/image/chaussure.png" alt="">
                <div class="box">
                    <h4>chaussure</h4>
                    <a href="">Voir cette categorie ></a>
                </div>
            </div>

            <!-- <div class="slider">
            <img src="/image/menager.png" alt="">
            <div class="box">
                <h4>E-Menager</h4>
                <a href="">Voir cette categorie ></a>
            </div>
        </div> -->
        </div>
    </section>

    <!-- <div class="produit_afiche">
        <div class="box">
            <img data-aos="fade-right" data-aos-delay="0" data-aos-duration="700" data-aos-easing="ease-in-out"
                data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
                src="/image/belles.jpg" alt="">
            <h1 data-aos="fade-left" data-aos-delay="300" data-aos-duration="700" data-aos-easing="ease-in-out"
                data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom">Nouvelle douceur
            </h1>
        </div>
    </div> -->



    <section class="produit_vedete">
        <div class="box1">
            <span></span>
            <h1>Tout pour la maison au meilleur prix</h1>
            <span></span>
        </div>


        <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
            data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
            class="articles owl-carousel carousel1">
            <div class="carousel">
                <img src="/image/chaise1.avif" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/chaise2.jpeg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/rido1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/fauteuil1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/ampoule1.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>

            <div class="carousel">
                <img src="/upload/rideaux.jpg" alt="">
                <p id="nom">montre de lux</p>
                <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                        class="span3">-10%</span></p>
                <p id="ville">libreville</p>
                <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
            </div>
        </article>
    </section>




    <section class="section0">
        <div class="container">
            <div class="section_category">
                <p class="section_category_p">En vedette</p>
            </div>
            <div class="section_header">
                <h3 class="section_title">Nouveautés</h3>
            </div>
            <div class="gallery">
                <div class="gallery_item gallery_item_1">
                    <img src="./image/gallery/gallery-1.png" alt="" class="gallery_item_img" />
                    <div class="gallery_item_content">
                        <div class="gallery_item_title">Playstation 5</div>
                        <p class="gallery_item_p">
                            Ce qui compte, c'est de se faire plaisir.
                        </p>
                        <a href="#" class="gallery_item_link">ACHETER MAINTENANT</a>
                    </div>
                </div>
                <div class="gallery_item gallery_item_2">
                    <img src="./image/femme.png" alt="" class="gallery_item_img" />
                    <div class="gallery_item_content">
                        <div class="gallery_item_title">Femme d'honneur</div>
                        <p class="gallery_item_p">
                            Tout pour vous faire plaisir!
                        </p>
                        <a href="#" class="gallery_item_link">COMMENDER</a>
                    </div>
                </div>
                <div class="gallery_item gallery_item_3">
                    <img src="./image/airpod.png" alt="" class="gallery_item_img" />
                    <div class="gallery_item_content">
                        <div class="gallery_item_title">AirPods</div>
                        <p class="gallery_item_p">
                            Viver la musique autrement
                        </p>
                        <a href="#" class="gallery_item_link">COMMENDER</a>
                    </div>
                </div>
                <div class="gallery_item gallery_item_4">
                    <img src="./image/gallery/gallery-4.png" alt="" class="gallery_item_img" />
                    <div class="gallery_item_content">
                        <div class="gallery_item_title">Playstation 5</div>
                        <p class="gallery_item_p">
                            Lorem ipsum dolor sit amet consectetur adipisicing.
                        </p>
                        <a href="#" class="gallery_item_link">SHOP NOW</a>
                    </div>
                </div>
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


    <section class="section00">
        <section class="produit_vedetes">
            <div class="box1">
                <h1>Tous nos produits</h1>
            </div>

            <article data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000" data-aos-easing="ease-in-out"
                data-aos-mirror="true" data-aos-once="false" data-aos-anchor-placement="top-bottom"
                class="articles  carousel11">
                <div class="carousel">
                    <img src="/upload/sac1.jpg" alt="">
                    <p id="nom">sac a main</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/t-shirt1.jpg" alt="">
                    <p id="nom">t-shirt hummel</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/montre1.jpg" alt="">
                    <p id="nom">montre de lux</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/sac2.jpg" alt="">
                    <p id="nom">sac a main</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/collier.jpg" alt="">
                    <p id="nom">collier de sortie</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/chaussures 1.jpg" alt="">
                    <p id="nom">chaussures nike</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/sac1.jpg" alt="">
                    <p id="nom">sac a main</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/t-shirt1.jpg" alt="">
                    <p id="nom">t-shirt hummel</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/montre1.jpg" alt="">
                    <p id="nom">montre de lux</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/sac2.jpg" alt="">
                    <p id="nom">sac a main</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/collier.jpg" alt="">
                    <p id="nom">collier de sortie</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/chaussures 1.jpg" alt="">
                    <p id="nom">chaussures nike</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/collier.jpg" alt="">
                    <p id="nom">collier de sortie</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>

                <div class="carousel">
                    <img src="/upload/chaussures 1.jpg" alt="">
                    <p id="nom">chaussures nike</p>
                    <p class="prix">6000<span class="span1">fca</span> <span class="span2">2000fca</span> <span
                            class="span3">-10%</span></p>
                    <p id="ville">libreville</p>
                    <a href="#"><i class="fa-solid fa-cart-shopping fa-xs"></i></span> Ajouter</a>
                </div>
            </article>
        </section>
    </section>




    <footer class="footer">
        <div class="container footer_container">
            <div class="footer_item">
                <a href="#" class="footer_logo">Exclusive</a>
                <div class="footer_p">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Exercitationem fuga harum voluptate?
                </div>
            </div>
            <div class="footer_item">
                <h3 class="footer_item_titl">Assistance</h3>
                <ul class="footer_list">
                    <li class="li footer_list_item">Stockholm, Sweden</li>
                    <li class="li footer_list_item">service@samba-market.com</li>
                    <li class="li footer_list_item">+46 123 456 78</li>
                    <li class="li footer_list_item">+46 72 345 67</li>
                </ul>
            </div>
            <div class="footer_item">
                <h3 class="footer_item_titl">Utilisateur</h3>
                <ul class="footer_list">
                    <li class="li footer_list_item">Compte</li>
                    <li class="li footer_list_item">Connection / Inscription</li>
                    <li class="li footer_list_item">Panier</li>
                    <li class="li footer_list_item">Acheter</li>
                </ul>
            </div>
            <div class="footer_item">
                <h3 class="footer_item_titl">Condition generale</h3>
                <ul class="footer_list">
                    <li class="li footer_list_item">Politique de confidentialité</li>
                    <li class="li footer_list_item">Conditions d'utilisation</li>
                    <li class="li footer_list_item">FAQ</li>
                    <li class="li footer_list_item">Contact</li>
                </ul>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="container footer_bottom_container">
                <p class="footer_copy">
                    Copyright Exclusive 2023. All right reserved
                </p>
            </div>
        </div>
    </footer>

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
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
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
                items: 6,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 600,
                stagePadding: 1,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
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
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
            });
            var carousel2 = $('.carousel2').owlCarousel();
            $('.owl-next2').click(function () {
                carousel2.trigger('next.owl.carousel');
            })
            $('.owl-prev2').click(function () {
                carousel2.trigger('prev.owl.carousel');
            })


            $('.categorie').owlCarousel({
                items: 7,
                loop: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 2000,
                animateOut: 'slideOutDown',
                animateIn: 'flipInX',
                smartSpeed: 600,
                stagePadding: 20,
                nav: true,
                navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>']
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