<?php
/**
 * Contrôleur pour la gestion des commandes
 * Programmation procédurale uniquement
 */

require_once __DIR__ . '/../models/model_commandes.php';
require_once __DIR__ . '/../models/model_panier.php';

/**
 * Traite la création d'une commande
 * @return array Tableau avec 'success', 'message', et éventuellement 'commande_id' et 'numero_commande'
 */
function process_create_commande() {
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        return [
            'success' => false,
            'message' => 'Vous devez être connecté pour passer une commande.'
        ];
    }
    
    $user_id = $_SESSION['user_id'];
    
    // Valider les données du formulaire
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return [
            'success' => false,
            'message' => 'Méthode non autorisée.'
        ];
    }
    
    // Récupérer et valider les données
    $adresse_livraison = 'À définir'; // Adresse par défaut
    $telephone_livraison = trim($_POST['telephone_livraison'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
    
    // Validation
    if (empty($telephone_livraison)) {
        return [
            'success' => false,
            'message' => 'Le téléphone de livraison est obligatoire.'
        ];
    }
    
    // Valider le format du téléphone (basique)
    if (!preg_match('/^[0-9+\s\-()]+$/', $telephone_livraison)) {
        return [
            'success' => false,
            'message' => 'Le format du téléphone n\'est pas valide.'
        ];
    }
    
    // Récupérer les articles du panier
    $panier_items = get_panier_by_user($user_id);
    
    if (empty($panier_items)) {
        return [
            'success' => false,
            'message' => 'Votre panier est vide. Ajoutez des produits avant de passer une commande.'
        ];
    }
    
    // Vérifier le stock de chaque produit
    foreach ($panier_items as $item) {
        if ($item['stock'] < $item['quantite']) {
            return [
                'success' => false,
                'message' => 'Le stock disponible pour "' . htmlspecialchars($item['nom']) . '" est insuffisant. Stock disponible: ' . $item['stock']
            ];
        }
    }
    
    // Créer la commande
    $result = create_commande(
        $user_id,
        $panier_items,
        $adresse_livraison,
        $telephone_livraison,
        $notes ?: null
    );
    
    if ($result === false) {
        return [
            'success' => false,
            'message' => 'Une erreur est survenue lors de la création de la commande. Veuillez réessayer.'
        ];
    }
    
    if ($result['success']) {
        // Vider le panier après création de la commande
        clear_panier($user_id);
        
        return [
            'success' => true,
            'message' => 'Votre commande a été créée avec succès ! Numéro de commande: ' . $result['numero_commande'],
            'commande_id' => $result['commande_id'],
            'numero_commande' => $result['numero_commande']
        ];
    }
    
    return [
        'success' => false,
        'message' => 'Une erreur est survenue lors de la création de la commande.'
    ];
}

?>

