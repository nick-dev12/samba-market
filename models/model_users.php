<?php
/**
 * Modèle pour la gestion des utilisateurs
 * Programmation procédurale uniquement
 */

// Inclusion du fichier de connexion à la BDD
require_once __DIR__ . '/../conn/conn.php';

/**
 * Vérifie si un utilisateur existe déjà avec cet email
 * @param string $email L'email à vérifier
 * @return bool True si l'email existe, False sinon
 */
function user_email_exists($email) {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Récupère un utilisateur par son email
 * @param string $email L'email de l'utilisateur
 * @return array|false Les données de l'utilisateur ou False si non trouvé
 */
function get_user_by_email($email) {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ? $user : false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Récupère un utilisateur par son ID
 * @param int $id L'ID de l'utilisateur
 * @return array|false Les données de l'utilisateur ou False si non trouvé
 */
function get_user_by_id($id) {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $user ? $user : false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Crée un nouvel utilisateur
 * @param string $nom Le nom de l'utilisateur
 * @param string $prenom Le prénom de l'utilisateur
 * @param string $email L'email de l'utilisateur
 * @param string $telephone Le téléphone de l'utilisateur
 * @param string $password_hash Le mot de passe hashé
 * @return int|false L'ID de l'utilisateur créé ou False en cas d'erreur
 */
function create_user($nom, $prenom, $email, $telephone, $password_hash) {
    global $db;
    
    try {
        $stmt = $db->prepare("
            INSERT INTO users (nom, prenom, email, telephone, password, date_creation, statut) 
            VALUES (:nom, :prenom, :email, :telephone, :password, NOW(), 'actif')
        ");
        
        $result = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'password' => $password_hash
        ]);
        
        if ($result) {
            return $db->lastInsertId();
        }
        
        return false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Met à jour les informations d'un utilisateur
 * @param int $id L'ID de l'utilisateur
 * @param array $data Les nouvelles données
 * @return bool True en cas de succès, False sinon
 */
function update_user($id, $data) {
    global $db;
    
    try {
        $stmt = $db->prepare("
            UPDATE users SET
                nom = :nom,
                prenom = :prenom,
                email = :email,
                telephone = :telephone
            WHERE id = :id
        ");
        
        return $stmt->execute([
            'id' => $id,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'telephone' => $data['telephone']
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Récupère tous les utilisateurs avec leurs statistiques de commandes
 * @return array Tableau des utilisateurs avec leurs statistiques
 */
function get_all_users_with_stats() {
    global $db;
    
    try {
        $stmt = $db->prepare("
            SELECT 
                u.id,
                u.nom,
                u.prenom,
                u.email,
                u.telephone,
                u.date_creation,
                u.statut,
                COUNT(DISTINCT c.id) as nb_commandes,
                COUNT(DISTINCT CASE WHEN c.statut = 'livree' THEN c.id END) as nb_commandes_livrees
            FROM users u
            LEFT JOIN commandes c ON u.id = c.user_id
            GROUP BY u.id
            ORDER BY nb_commandes DESC, nb_commandes_livrees DESC, u.date_creation DESC
        ");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $users ? $users : [];
    } catch (PDOException $e) {
        return [];
    }
}

/**
 * Met à jour le statut d'un utilisateur (actif/inactif)
 * @param int $id L'ID de l'utilisateur
 * @param string $statut Le nouveau statut ('actif' ou 'inactif')
 * @return bool True en cas de succès, False sinon
 */
function update_user_statut($id, $statut) {
    global $db;
    
    try {
        $stmt = $db->prepare("UPDATE users SET statut = :statut WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'statut' => $statut
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Met à jour l'acceptation des conditions d'utilisation par un utilisateur
 * @param int $id L'ID de l'utilisateur
 * @param bool $accepte True si accepté, False sinon
 * @return bool True en cas de succès, False sinon
 */
function update_user_accepte_conditions($id, $accepte = true) {
    global $db;
    
    try {
        $stmt = $db->prepare("UPDATE users SET accepte_conditions = :accepte WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'accepte' => $accepte ? 1 : 0
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

?>

