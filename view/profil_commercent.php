<?php 
session_start();

require('../controller/controller_commerce_users.php');



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../css/profil_commercant.css">
    <link rel="stylesheet" href="../css/b_style.css">
</head>
<body>
    <?php include('../nav_bar.php') ?>

    <section class="section">
       <?php include('../page/dashbord_commercent.php') ?>
        <div class="container2">
            <div class="infos">
                <div class="box1">

                    <img src="../image/5-techniques-pour-repérer-facilement-un-client-mécontent.webp" alt="">
                    <span class="span1" ></span>
                    <span class="span2"></span>
                    <span class="span3"></span>
                </div>
                <div class="box2">
                    <p>Glorie shop</p>
                </div>
                <div class="box3" >
                    <p>
                        nous sommes une boutique specialiser dans la vente des produis de cosmetique et autre nous vous proposont des services de caliter 
                    </p>
                </div>
            </div>
            <div class="container-box">
                <div class="box box1">
                    <h5>Produit <span>24</span></h5>
                    <ul>
                        <li>Vendu <span>12</span></li>
                        <li>Rembourser<span>2</span></li>
                        <li>commende <span>6</span></li>
                    </ul>
                </div>

                <div class="box box2">
                <h5>Categorie <span>24</span></h5>
                    <ul>
                        <li>homme <span>12</span></li>
                        <li>femme<span>2</span></li>
                        <li>enfant <span>6</span></li>
                        <li>imobilier<span>6</span></li>
                    </ul>
                </div>

                <div class="box box3">
                <h5>Clientel <span>24</span></h5>
                    <ul>
                        <li>Satisfait <span>12</span></li>
                        <li>Non satisfait<span>2</span></li>
                        <li>En cours <span>6</span></li>
                    </ul>
                </div>
            </div>


            <main class="main-container">

        <div class="charts">

          <div class="charts-card">
            <h2 class="chart-title">Top 5 Products</h2>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <h2 class="chart-title">Purchase and Sales Orders</h2>
            <div id="area-chart"></div>
          </div>

        </div>
      </main>
      <!-- End Main -->
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/scripts.js"></script>
</body>
</html>