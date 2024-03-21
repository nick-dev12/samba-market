<?php



// Inclusion du fichier de connexion à la BDD


// Déclaration d'un tableau pour stocker les erreurs
$erreurs = ''; // Initialisez un tableau pour stocker les erreurs

include_once ('../controller/controller_commerce_users.php');

?>





<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>connexion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/inscription.css">
</head>

<body>

  <?php include ('../nav_bar.php') ?>

  <section class="section2">

    <div class="formulaire1">
      <img id="img" src="../image/auth-image.png" alt="">
      <form method="post" action="" enctype="multipart/form-data">
        <h3>Compte commerçants</h3>
        <?php if (isset ($erreurs)): ?>
          <div class="erreur">
            <?php echo $erreurs; ?>
          </div>
        <?php endif; ?>
        <div class="container_box">
          <div class="container">
            <div class="box1">
              <label for="nom">Nom complet</label>
              <input type="text" name="nom" id="nom">
            </div>
            <div class="box1">
              <label for="boutique">Nom de votre boutique</label>
              <input type="text" name="boutique" id="boutique">
            </div>
            <div class="box1">
              <label for="mail">Adress mail</label>
              <input type="text" name="mail" id="mail">
            </div>

            <div class="box1 box2">
              <label for="phone">N-telephone</label>
              <input type="number" name="phone" id="phone">
            </div>



            <div class="box1">
              <label for="ville">Ville</label>
              <input type="text" name="ville" id="ville">
            </div>
          </div>

          <div class="container">
            <div class="box1">
              <p>Ajouter une photo de profil</p>
              <div class="img">
                <label for="image"><img src="/image/galerie.jpg" alt=""></label>
                <input type="file" name="images" id="image">
                <img id="imagePreview" src="" alt="Aperçu image">
              </div>

              <script>
                // Récupérer l'élément input type file
                const inputImage = document.getElementById('image');

                // Écouter le changement de fichier sélectionné
                inputImage.addEventListener('change', () => {

                  // Récupérer le premier fichier sélectionné
                  const file = inputImage.files[0];

                  // Afficher l'aperçu dans l'élément img
                  const previewImg = document.getElementById('imagePreview');
                  previewImg.src = URL.createObjectURL(file);

                });

              </script>
            </div>
            <div class="box1">
              <label for="pass">Mot de passe</label>
              <input type="password" name="pass" id="pass">
            </div>

            <div class="box1">
              <label for="cpass">Confirmation du mot de passe</label>
              <input type="password" name="cpass" id="cpass">
            </div>

            <input type="submit" name="valider" value="Inscription" id="valider">
          </div>
        </div>


      </form>
    </div>
  </section>

  <footer>
    <span>developper par @nick jomas</span>
  </footer>



  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
  <script>
    const input = document.querySelector("#phone");
    const iti = window.intlTelInput(input, {
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
      separateDialCode: true,
      autoHideDialCode: false,
      initialCountry: "auto",
      geoIpLookup: function (callback) {
        fetch("https://ipapi.co/json")
          .then(function (res) {
            return res.json();
          })
          .then(function (data) {
            callback(data.country_code);
          })
          .catch(function () {
            callback("us");
          });
      }
    });



    // Masquer la liste au clic sur le champ de téléphone
    input.addEventListener('click', function () {
      iti.closeDropdown();
    });

    // Masquer au clic en dehors du champ de téléphone
    document.addEventListener('click', function (e) {
      if (!input.contains(e.target) && !iti.container.contains(e.target)) {
        iti.closeDropdown();
      }
    });
  </script>


</body>

</html>