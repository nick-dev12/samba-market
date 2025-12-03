<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de Confidentialité - Trésor Africain</title>
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
        <h1><i class="fas fa-shield-alt"></i> Politique de Confidentialité</h1>
        
        <p><strong>Dernière mise à jour : <?php echo date('d/m/Y'); ?></strong></p>
        
        <h2>1. Introduction</h2>
        <p>
            Trésor Africain s'engage à protéger la confidentialité de vos informations personnelles. 
            Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos données.
        </p>
        
        <h2>2. Données Collectées</h2>
        <p>Nous collectons les informations suivantes :</p>
        <ul>
            <li>Nom et prénom</li>
            <li>Adresse email</li>
            <li>Numéro de téléphone</li>
            <li>Informations de commande et de livraison</li>
            <li>Données de navigation (cookies)</li>
        </ul>
        
        <h2>3. Utilisation des Données</h2>
        <p>Vos données sont utilisées pour :</p>
        <ul>
            <li>Traiter vos commandes</li>
            <li>Vous contacter concernant vos commandes</li>
            <li>Améliorer nos services</li>
            <li>Vous envoyer des communications marketing (avec votre consentement)</li>
        </ul>
        
        <h2>4. Protection des Données</h2>
        <p>
            Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos informations 
            personnelles contre tout accès non autorisé, modification, divulgation ou destruction.
        </p>
        
        <h2>5. Partage des Données</h2>
        <p>
            Nous ne vendons, n'échangeons ni ne louons vos informations personnelles à des tiers. 
            Vos données peuvent être partagées uniquement avec nos prestataires de services pour 
            la livraison de vos commandes.
        </p>
        
        <h2>6. Vos Droits</h2>
        <p>Vous avez le droit de :</p>
        <ul>
            <li>Accéder à vos données personnelles</li>
            <li>Modifier vos informations</li>
            <li>Supprimer votre compte</li>
            <li>Vous opposer au traitement de vos données</li>
        </ul>
        
        <h2>7. Cookies</h2>
        <p>
            Notre site utilise des cookies pour améliorer votre expérience de navigation. 
            Vous pouvez désactiver les cookies dans les paramètres de votre navigateur.
        </p>
        
        <h2>8. Contact</h2>
        <p>
            Pour toute question concernant cette politique de confidentialité, contactez-nous à : 
            <a href="mailto:service@tresor-africain.com">service@tresor-africain.com</a>
        </p>
        
        <a href="javascript:history.back()" class="back-link">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    
    <?php include('footer.php'); ?>
</body>
</html>

