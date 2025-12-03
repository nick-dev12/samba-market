<?php
/**
 * Contrôleur pour la gestion des utilisateurs
 * Programmation procédurale uniquement
 */

require_once __DIR__ . '/../models/model_users.php';

/**
 * Traite l'inscription d'un nouvel utilisateur
 * @return array Tableau avec 'success' (bool) et 'message' (string)
 */
function process_user_inscription() {
    $errors = [];
    $success = false;
    $message = '';
    
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return ['success' => false, 'message' => ''];
    }
    
    // Récupération et validation des données
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';
    
    // Validation du nom
    if (empty($nom)) {
        $errors[] = 'Le nom est obligatoire.';
    } elseif (strlen($nom) < 2) {
        $errors[] = 'Le nom doit contenir au moins 2 caractères.';
    }
    
    // Validation du prénom
    if (empty($prenom)) {
        $errors[] = 'Le prénom est obligatoire.';
    } elseif (strlen($prenom) < 2) {
        $errors[] = 'Le prénom doit contenir au moins 2 caractères.';
    }
    
    // Validation de l'email
    if (empty($email)) {
        $errors[] = 'L\'email est obligatoire.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'email n\'est pas valide.';
    } elseif (user_email_exists($email)) {
        $errors[] = 'Cet email est déjà utilisé.';
    }
    
    // Validation du téléphone
    if (empty($telephone)) {
        $errors[] = 'Le téléphone est obligatoire.';
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $telephone)) {
        $errors[] = 'Le format du téléphone n\'est pas valide.';
    }
    
    // Validation du mot de passe
    if (empty($password)) {
        $errors[] = 'Le mot de passe est obligatoire.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
    }
    
    // Validation de la confirmation du mot de passe
    if (empty($password_confirm)) {
        $errors[] = 'La confirmation du mot de passe est obligatoire.';
    } elseif ($password !== $password_confirm) {
        $errors[] = 'Les mots de passe ne correspondent pas.';
    }
    
    // Si aucune erreur, procéder à l'inscription
    if (empty($errors)) {
        // Hashage du mot de passe
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        // Création de l'utilisateur
        $user_id = create_user($nom, $prenom, $email, $telephone, $password_hash);
        
        if ($user_id) {
            $success = true;
            $message = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
        } else {
            $errors[] = 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.';
        }
    }
    
    // Retourner le résultat
    if ($success) {
        return ['success' => true, 'message' => $message];
    } else {
        $message = !empty($errors) ? implode('<br>', $errors) : 'Une erreur est survenue.';
        return ['success' => false, 'message' => $message];
    }
}

/**
 * Traite la connexion d'un utilisateur
 * @return array Tableau avec 'success' (bool), 'message' (string) et 'user' (array|false)
 */
function process_user_login() {
    $errors = [];
    $success = false;
    $message = '';
    $user = false;
    
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return ['success' => false, 'message' => '', 'user' => false];
    }
    
    // Récupération des données
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $accepte_conditions = isset($_POST['accepte_conditions']) && $_POST['accepte_conditions'] == '1';
    
    // Validation de l'email
    if (empty($email)) {
        $errors[] = 'L\'email est obligatoire.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'L\'email n\'est pas valide.';
    }
    
    // Validation du mot de passe
    if (empty($password)) {
        $errors[] = 'Le mot de passe est obligatoire.';
    }
    
    // Validation de l'acceptation des conditions
    if (!$accepte_conditions) {
        $errors[] = 'Vous devez accepter les conditions d\'utilisation pour vous connecter.';
    }
    
    // Si aucune erreur de validation, vérifier les identifiants
    if (empty($errors)) {
        // Récupérer l'utilisateur par email
        $user = get_user_by_email($email);
        
        if ($user) {
            // Vérifier le statut
            if ($user['statut'] !== 'actif') {
                $errors[] = 'Votre compte est désactivé. Contactez le support.';
            } elseif (password_verify($password, $user['password'])) {
                // Mot de passe correct
                $success = true;
                $message = 'Connexion réussie !';
                
                // Mettre à jour l'acceptation des conditions d'utilisation
                if ($accepte_conditions) {
                    update_user_accepte_conditions($user['id'], true);
                }
            } else {
                $errors[] = 'Email ou mot de passe incorrect.';
            }
        } else {
            $errors[] = 'Email ou mot de passe incorrect.';
        }
    }
    
    // Retourner le résultat
    if ($success) {
        return ['success' => true, 'message' => $message, 'user' => $user];
    } else {
        $message = !empty($errors) ? implode('<br>', $errors) : 'Une erreur est survenue.';
        return ['success' => false, 'message' => $message, 'user' => false];
    }
}

?>

