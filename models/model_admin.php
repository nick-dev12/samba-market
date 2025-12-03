<?php
/**
 * Modèle pour la gestion des administrateurs
 * Programmation procédurale uniquement
 */

// Inclusion du fichier de connexion à la BDD
require_once __DIR__ . '/../conn/conn.php';

/**
 * Vérifie si un administrateur existe déjà avec cet email
 * @param string $email L'email à vérifier
 * @return bool True si l'email existe, False sinon
 */
function admin_email_exists($email)
{
    global $db;

    try {
        $stmt = $db->prepare("SELECT COUNT(*) FROM admin WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Vérifie si au moins un administrateur existe déjà
 * @return bool True si un admin existe, False sinon
 */
function admin_exists()
{
    global $db;

    try {
        $stmt = $db->prepare("SELECT COUNT(*) FROM admin");
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Insère un nouvel administrateur dans la base de données
 * @param string $nom Le nom de l'administrateur
 * @param string $prenom Le prénom de l'administrateur
 * @param string $email L'email de l'administrateur
 * @param string $password_hash Le mot de passe hashé
 * @return bool|int L'ID de l'admin créé en cas de succès, False en cas d'échec
 */
function create_admin($nom, $prenom, $email, $password_hash)
{
    global $db;

    try {
        $stmt = $db->prepare("
            INSERT INTO admin (nom, prenom, email, password, date_creation, statut) 
            VALUES (:nom, :prenom, :email, :password, NOW(), 'actif')
        ");

        $result = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
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
 * Récupère un administrateur par son email
 * @param string $email L'email de l'administrateur
 * @return array|false Les données de l'admin ou False si non trouvé
 */
function get_admin_by_email($email)
{
    global $db;

    try {
        $stmt = $db->prepare("SELECT * FROM admin WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        return $admin ? $admin : false;
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Met à jour la dernière connexion d'un administrateur
 * @param int $admin_id L'ID de l'administrateur
 * @return bool True en cas de succès, False sinon
 */
function update_admin_last_login($admin_id)
{
    global $db;

    try {
        $stmt = $db->prepare("UPDATE admin SET derniere_connexion = NOW() WHERE id = :id");
        return $stmt->execute(['id' => $admin_id]);
    } catch (PDOException $e) {
        return false;
    }
}

?>