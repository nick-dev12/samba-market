<?php
/**
 * Modèle pour la gestion de la configuration de la section4
 * Programmation procédurale uniquement
 */

// Inclusion du fichier de connexion à la BDD
require_once __DIR__ . '/../conn/conn.php';

/**
 * Récupère la configuration de la section4
 * @return array|false Les données de configuration ou False si non trouvé
 */
function get_section4_config() {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT * FROM section4_config ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $config = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si aucune configuration n'existe, retourner une configuration par défaut
        if (!$config) {
            return [
                'id' => 0,
                'titre' => 'Bienvenue au Tresor Africain',
                'texte' => 'Tous les produits a petit prix',
                'image_fond' => 'market.png',
                'date_modification' => date('Y-m-d H:i:s')
            ];
        }
        
        return $config;
    } catch (PDOException $e) {
        // En cas d'erreur, retourner une configuration par défaut
        return [
            'id' => 0,
            'titre' => 'Bienvenue au Tresor Africain',
            'texte' => 'Tous les produits a petit prix',
            'image_fond' => 'market.png',
            'date_modification' => date('Y-m-d H:i:s')
        ];
    }
}

/**
 * Met à jour la configuration de la section4
 * @param array $data Les données de configuration
 * @return bool True en cas de succès, False sinon
 */
function update_section4_config($data) {
    global $db;
    
    try {
        // Vérifier si une configuration existe déjà
        $existing = get_section4_config();
        
        if ($existing && isset($existing['id']) && $existing['id'] > 0) {
            // Mettre à jour la configuration existante
            $stmt = $db->prepare("
                UPDATE section4_config 
                SET titre = :titre, 
                    texte = :texte, 
                    image_fond = :image_fond,
                    date_modification = NOW()
                WHERE id = :id
            ");
            
            return $stmt->execute([
                'id' => $existing['id'],
                'titre' => $data['titre'],
                'texte' => $data['texte'],
                'image_fond' => $data['image_fond'] ?? null
            ]);
        } else {
            // Créer une nouvelle configuration
            $stmt = $db->prepare("
                INSERT INTO section4_config (titre, texte, image_fond, date_modification) 
                VALUES (:titre, :texte, :image_fond, NOW())
            ");
            
            return $stmt->execute([
                'titre' => $data['titre'],
                'texte' => $data['texte'],
                'image_fond' => $data['image_fond'] ?? null
            ]);
        }
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Supprime l'image de fond de la section4
 * @param string $image_name Le nom de l'image à supprimer
 * @return bool True en cas de succès, False sinon
 */
function delete_section4_image($image_name) {
    if (empty($image_name)) {
        return false;
    }
    
    $upload_dir = __DIR__ . '/../upload/section4/';
    $image_path = $upload_dir . $image_name;
    
    if (file_exists($image_path)) {
        return unlink($image_path);
    }
    
    return false;
}

?>

