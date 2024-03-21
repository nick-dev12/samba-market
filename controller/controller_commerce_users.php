<?php

require_once(__DIR__ . '/../model/commerce_users.php');



// Vérification si le bouton valider est cliqué
if (isset($_POST['valider'])) {
    // Récupération des données du formulaire
    // Déclaration des variables 
    $nom = $mail = $tel = $boutique = $ville = $pass = $cpass = '';

    $id = uniqid();

    // Vérification du nom
    if (empty($_POST['nom'])) {
        $erreurs = "Le nom est obligatoire";
    } else {
        $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8'); // Échapper les caractères spéciaux
    }

    // Vérification du mail
    if (empty($_POST['mail'])) {
        $erreurs = "email est obligatoire";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $erreurs = "L'email n'est pas valide";
    } else {
        $mail = $_POST['mail'];

        // Vérifier si des résultats ont été trouvés
        if (verifieEmail($db, $mail)) {
            // L'e-mail est déjà utilisé
        } else {
            $erreurs = "L'e-mail est déjà utilisé";
        }


    }

    // Vérification du téléphone  
    if (empty($_POST['phone'])) {
        $erreurs = "Le téléphone est obligatoire";
    } else {
        $phone = $_POST['phone'];
    }

    // Vérification du nom de boutique
    if (empty($_POST['boutique'])) {
        $erreurs = "Le nom de la boutique est obligatoire";
    } else {
        $boutique = htmlspecialchars($_POST['boutique']);
    }

    // Vérification de la ville
    if (empty($_POST['ville'])) {
        $erreurs = "La ville est obligatoire";
    } else {
        $ville = htmlspecialchars($_POST['ville']);
    }

    // Vérification de la ville
    if (empty($_FILES['images'])) {
        $erreurs = "Choisisser une photo de profil";
    } else {
        // Récupérer les données du formulaire
        $images = $_FILES['images'];
        // Vérifier qu'un fichier est uploadé
        if ($images['error'] == 0) {

            // Récupérer le nom et le chemin temporaire
            $fileName = $images['name'];
            $tmpName = $images['tmp_name'];

            // Ajouter l'identifiant unique au nom du fichier
            $uniqueFileName = $id . '_' . $fileName;

            // Déplacer le fichier dans le répertoire audio
            $targetFile = '../upload/' . $uniqueFileName;
            move_uploaded_file($tmpName, $targetFile);
        }
    }

    // Vérification du mot de passe
    if (empty($_POST['pass'])) {
        $erreurs = "Le mot de passe est obligatoire";
    } else {
        $pass = $_POST['pass'];
    }

    // Vérification de la confirmation du mot de passe
    if (empty($_POST['cpass'])) {
        $erreurs = "La confirmation du mot de passe est obligatoire";
    } else {
        $cpass = $_POST['cpass'];
    }

    // Vérification de la correspondance des mots de passe
    if ($pass !== $cpass) {
        $erreurs = "Les mots de passe ne correspondent pas !";
    }

    // Si aucune erreur n'est détectée, procédez à l'insertion 
    if (empty($erreurs)) {
        // Hachage du mot de passe
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        if (insertCommerce_users($db, $nom, $mail, $phone, $boutique, $ville, $uniqueFileName, $pass)) {
             // Redirection vers une page de confirmation
        header('Location: ../commerçant.php');
        exit;
        }
        
    }
}



// connextion des utilisateurs
if (isset($_POST['validers'])) {
    $mail=$phone='';
    $user_id = $_POST['mail'];

    if (filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
        $mail = $user_id;
    } elseif (is_numeric($user_id)) {
        $phone = $user_id;
    } else {
        $erreurs = "Identifiant invalide";
    }

    if (empty($erreurs)) {
        $user = getUsers ($db, $mail, $phone);

        if ($mail && !$user) {
            $erreurs = "Email incorrect";
        } elseif ($phone && !$user) {
            $erreurs = "Numéro incorrect";
        } else {
            $pass = $_POST['pass'];
            if (empty($pass)) {
                $erreurs = "Mot de passe requis";
            } elseif (!password_verify($pass, $user['pass'])) {
                $erreurs = "Mot de passe incorrect";
            } else {
                // Connexion réussie
                $_SESSION['commercant_id'] = $user['id_users']; // Initialisation de la variable de session
                header('location: index.php');
                exit();
            }
        }
    }
}


if (isset($_SESSION['commercant_id'])) {
    $commercant = infoUsers($db, $_SESSION['commercant_id']);
}
