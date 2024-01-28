<?php
require_once(__DIR__ . '/../conn/conn.php');

    // Vos méthodes et propriétés de modèle ici

    /**
     * Summary of insertCommerce_users
     * @param mixed $db
     * @param mixed $nom
     * @param mixed $mail
     * @param mixed $phone
     * @param mixed $boutique
     * @param mixed $ville
     * @param mixed $uniqueFileName
     * @param mixed $pass
     * @return mixed
     */
    function insertCommerce_users($db, $nom, $mail, $phone, $boutique, $ville, $uniqueFileName, $pass) {
        $sql = "INSERT INTO users (nom, mail, phone, boutique, ville, images, pass) 
                VALUES (:nom, :mail, :phone, :boutique, :ville, :images, :pass)";

        // Préparation de la requête 
        $stmt = $db->prepare($sql);

        // Association des paramètres
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':boutique', $boutique);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':images', $uniqueFileName);
        $stmt->bindParam(':pass', $pass);

        // Exécution de la requête
        return $stmt->execute();
    }



    function verifieEmail ($db,$mail){
      $query = $db->prepare("SELECT * FROM commerce_users WHERE mail = :mail");
      $query->bindParam(':mail', $mail);
      $query->execute();
      
      // Regarder si count(*) est > 0
      if($query->fetchColumn() > 0) {
          return false; // Email déjà utilisé
        } else {
          return true; // Email disponible
        }
      
      }


      function getUsers($db, $mail, $phone){
        $sql = "SELECT * FROM users WHERE mail = :mail OR phone = :phone";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetch(); // Utilisez fetch() pour obtenir la première ligne de résultat
    }

    function infoUsers($db, $commercant_id){
    
    $query = "SELECT * FROM users WHERE id_users = :commercant_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':commercant_id', $commercant_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }



?>