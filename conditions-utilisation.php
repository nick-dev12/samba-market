<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditions d'Utilisation - Trésor Africain</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/a_style.css">
    <style>
        .legal-page {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .legal-page h1 {
            color: #6b2f20;
            font-size: 32px;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 3px solid #918a44;
            padding-bottom: 15px;
        }
        .legal-page h2 {
            color: #918a44;
            font-size: 22px;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .legal-page p {
            color: #000000;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 15px;
            text-align: justify;
        }
        .legal-page ul {
            margin: 15px 0;
            padding-left: 30px;
        }
        .legal-page li {
            color: #000000;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 10px;
        }
        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background: #918a44;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .back-link:hover {
            background: #6b2f20;
        }
    </style>
</head>
<body>
    <?php include('nav_bar.php'); ?>
    
    <div class="legal-page">
        <h1><i class="fas fa-file-contract"></i> Conditions d'Utilisation</h1>
        
        <p><strong>Dernière mise à jour : <?php echo date('d/m/Y'); ?></strong></p>
        
        <h2>1. Acceptation des Conditions</h2>
        <p>
            En accédant et en utilisant le site Trésor Africain, vous acceptez d'être lié par 
            ces conditions d'utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser notre site.
        </p>
        
        <h2>2. Utilisation du Site</h2>
        <p>Vous vous engagez à :</p>
        <ul>
            <li>Utiliser le site de manière légale et conforme</li>
            <li>Ne pas tenter d'accéder à des zones non autorisées</li>
            <li>Ne pas perturber le fonctionnement du site</li>
            <li>Fournir des informations exactes lors de vos commandes</li>
        </ul>
        
        <h2>3. Commandes et Paiements</h2>
        <p>
            Toutes les commandes sont soumises à acceptation. Nous nous réservons le droit de refuser 
            ou d'annuler toute commande. Les prix sont indiqués en FCFA et peuvent être modifiés à tout moment.
        </p>
        
        <h2>4. Produits</h2>
        <p>
            Nous nous efforçons d'afficher les produits avec précision. Cependant, nous ne garantissons pas 
            que les descriptions, images ou autres contenus sont exacts, complets ou à jour.
        </p>
        
        <h2>5. Livraison</h2>
        <p>
            Les délais de livraison sont indicatifs et peuvent varier. Nous ne sommes pas responsables 
            des retards dus à des circonstances indépendantes de notre volonté.
        </p>
        
        <h2>6. Propriété Intellectuelle</h2>
        <p>
            Tout le contenu du site (textes, images, logos) est la propriété de Trésor Africain et 
            est protégé par les lois sur la propriété intellectuelle.
        </p>
        
        <h2>7. Limitation de Responsabilité</h2>
        <p>
            Trésor Africain ne sera pas responsable des dommages directs, indirects, accessoires ou 
            consécutifs résultant de l'utilisation ou de l'impossibilité d'utiliser le site.
        </p>
        
        <h2>8. Modifications</h2>
        <p>
            Nous nous réservons le droit de modifier ces conditions d'utilisation à tout moment. 
            Les modifications entrent en vigueur dès leur publication sur le site.
        </p>
        
        <h2>9. Contact</h2>
        <p>
            Pour toute question concernant ces conditions d'utilisation, contactez-nous à : 
            <a href="mailto:service@tresor-africain.com">service@tresor-africain.com</a>
        </p>
        
        <a href="javascript:history.back()" class="back-link">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>

