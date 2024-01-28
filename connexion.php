<?php




if(isset($_COOKIE['commercant_id'])){
    $commercant_id = $_COOKIE['commercant_id'];
 }else{
    $commercant_id = '';
 }

 $erreurs = '';

 include ('controller/controller_commerce_users.php')

  

      




     // Vérification du mail
    //  $mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    //  if (!$mail) {
    //      $erreurs = "L'email n'est pas valide";
    //  } else {
         // Vérification du mot de passe
        //  $pass = $_POST['pass'];
        //  if (empty($pass)) {
        //      $erreurs = "Le mot de passe est obligatoire";
        //  } else {
             // Connexion à la base de données
 
            //  $query = "SELECT id, pass FROM commerce_users WHERE mail = :mail LIMIT 1";
            //  $stmt = $db->prepare($query);
            //  $stmt->bindParam(':mail', $mail);
            //  $stmt->execute();
            //  $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
            //  if ($stmt->rowCount() > 0 && password_verify($pass, $row['pass'])) {
                 // Mot de passe correct, définissez le cookie et redirigez
    //              $_SESSION['commercant_id'] = $row['id']; // Initialisation de la variable de session

    //              setcookie('commercant_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
    //              header('location: ../index.php');
    //              exit();
    //          } else {
    //              $erreurs = 'Email ou mot de passe incorrect !';
    //          }
    //      }
    //  }
 


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Almarai&family=Rozha+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/connextion.css">
</head>
<body>
    <nav>
        <a class="logo" href="index.php"><img src="../logo.png" alt=""></a>
        <div class="container">
            <div class="box">

                <a href="inscription.php"><button>inscription</button></a>
                <button>boutique</button>

            </div>
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


    <section class="section2">

        <div class="formulaire1">
            <img src="/undraw_login_re_4vu2.svg" alt="">
            <form method="post" action="">
                <h3>connexion</h3>

                <?php if (isset($erreurs)) : ?>
          <div class="erreur"><?php echo $erreurs; ?></div>
        <?php endif; ?>

                <div class="box1">
                    <label for="mail">adress-mail/n-telephone</label>
                    <input type="text" name="mail" id="mail">
                </div>

                <div class="box1">
                    <label for="mail">mot de passe</label>
                    <input type="password" name="pass" id="pass">
                </div>

                <input type="submit" name="validers" value="valider" id="valider">
            </form>
        </div>
    </section>

    <footer>
        <span>developper par @nick jomas</span>
    </footer>


</body>
</html>