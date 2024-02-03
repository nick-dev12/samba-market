<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/a_style.css" />
    <title>Connection</title>
  </head>
  <body>

  <?php include('nav_bar.php') ?>

    <section class="section">
      <div class="auth_container">
        <div class="auth_img">
          <img src="./image/auth-image.png" alt="" class="auth_image" />
        </div>
        <div class="auth_content">
          <form action="" class="auth_form">
            <h2 class="form_title">Connectez-vous à votre compte</h2>
            <p class="auth_p">Entrez vos coordonnées ci-dessous</p>
            <div class="form_group">
              <input type="email" placeholder="Email" class="form_input" />
            </div>
            <div class="form_group form_pass">
              <input
                type="password"
                placeholder="Password"
                class="form_input" />
            </div>
            <div class="form_group">
              <button class="form_btn">
                <a href="#" class="form_link">Login</a>
              </button>
            </div>
            <div class="form_group">
              <span
                >Don't have an account?
                <a href="./sign-up.html" class="form_auth_link"
                  >Reegister</a
                ></span
              >
            </div>
          </form>
        </div>
      </div>
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
          <h3 class="footer_item_titl">Support</h3>
          <ul class="footer_list">
            <li class="li footer_list_item">Stockholm, Sweden</li>
            <li class="li footer_list_item">email@gmail.com</li>
            <li class="li footer_list_item">+46 123 456 78</li>
            <li class="li footer_list_item">+46 72 345 67</li>
          </ul>
        </div>
        <div class="footer_item">
          <h3 class="footer_item_titl">Support</h3>
          <ul class="footer_list">
            <li class="li footer_list_item">Account</li>
            <li class="li footer_list_item">Login / Register</li>
            <li class="li footer_list_item">Cart</li>
            <li class="li footer_list_item">Shop</li>
          </ul>
        </div>
        <div class="footer_item">
          <h3 class="footer_item_titl">Support</h3>
          <ul class="footer_list">
            <li class="li footer_list_item">Privacy policy</li>
            <li class="li footer_list_item">Terms of use</li>
            <li class="li footer_list_item">FAQ's</li>
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="./js/app.js"></script>
  </body>
</html>
