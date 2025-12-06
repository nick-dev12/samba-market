<?php
/**
 * Page de modification de la configuration de la section trending
 * Programmation procédurale uniquement
 */

session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: ../login.php');
    exit;
}

// Récupérer la configuration actuelle
require_once __DIR__ . '/../../models/model_trending.php';
$config = get_trending_config();

// Traiter le formulaire uniquement si c'est une requête POST
$error_message = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../controllers/controller_trending.php';
    $result = process_update_trending();
    
    // Si la modification est réussie, rediriger
    if (isset($result['success']) && $result['success']) {
        $_SESSION['success_message'] = $result['message'];
        header('Location: ../parametres.php');
        exit;
    }
    
    // Afficher les messages d'erreur
    if (isset($result['success']) && !$result['success']) {
        $error_message = $result['message'];
    }
}

// Afficher le message de succès s'il existe
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Trending - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <style>
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #6b2f20;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #f0e9e9;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #918a44;
        }

        .image-preview {
            margin-top: 15px;
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .current-image {
            margin-top: 15px;
            padding: 15px;
            background: #f0e9e9;
            border-radius: 8px;
        }

        .current-image img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 6px;
            margin-top: 10px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-primary {
            background: #918a44;
            color: #ffffff;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #7a7338;
        }

        .btn-back {
            background: #f0e9e9;
            color: #6b2f20;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background: #e0d9d9;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px;
            background: #f0e9e9;
            border: 2px dashed #918a44;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: #e0d9d9;
            border-color: #7a7338;
        }
    </style>
</head>
<body>
    <?php include '../includes/nav.php'; ?>

    <section class="produits-section">
        <div class="section-title">
            <h2><i class="fas fa-fire"></i> Configuration de la Section Trending</h2>
            <p style="color: #666; font-size: 14px; margin-top: 5px;">
                Configurez le label, le titre, le bouton et l'image de la section trending
            </p>
        </div>

        <?php if (!empty($success_message)): ?>
            <div style="background: #d1e7dd; border-left: 4px solid #0f5132; color: #0f5132; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div style="background: #f8d7da; border-left: 4px solid #842029; color: #842029; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="52428800">
                <div class="form-group">
                    <label for="label">
                        <i class="fas fa-tag"></i> Label (petit texte)
                    </label>
                    <input type="text" id="label" name="label" 
                           value="<?php echo isset($_POST['label']) ? htmlspecialchars($_POST['label']) : htmlspecialchars($config['label']); ?>" 
                           required
                           placeholder="Ex: categories">
                </div>

                <div class="form-group">
                    <label for="titre">
                        <i class="fas fa-heading"></i> Titre principal
                    </label>
                    <input type="text" id="titre" name="titre" 
                           value="<?php echo isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : htmlspecialchars($config['titre']); ?>" 
                           required
                           placeholder="Ex: Enhance Your Music Experience">
                </div>

                <div class="form-group">
                    <label for="bouton_texte">
                        <i class="fas fa-hand-pointer"></i> Texte du bouton
                    </label>
                    <input type="text" id="bouton_texte" name="bouton_texte" 
                           value="<?php echo isset($_POST['bouton_texte']) ? htmlspecialchars($_POST['bouton_texte']) : htmlspecialchars($config['bouton_texte']); ?>" 
                           required
                           placeholder="Ex: Buy Now!">
                </div>

                <div class="form-group">
                    <label for="bouton_lien">
                        <i class="fas fa-link"></i> Lien du bouton
                    </label>
                    <input type="text" id="bouton_lien" name="bouton_lien" 
                           value="<?php echo isset($_POST['bouton_lien']) ? htmlspecialchars($_POST['bouton_lien']) : htmlspecialchars($config['bouton_lien']); ?>" 
                           placeholder="Ex: /produits.php ou #">
                </div>

                <div class="form-group">
                    <label for="image">
                        <i class="fas fa-image"></i> Image
                    </label>
                    <small style="display: block; color: #666; font-size: 12px; margin-bottom: 8px;">
                        Formats acceptés: JPEG, JPG, PNG, GIF, WEBP (max 50MB - Images 4K acceptées)
                    </small>
                    
                    <?php if (!empty($config['image'])): ?>
                        <div class="current-image">
                            <strong>Image actuelle:</strong>
                            <?php if ($config['image'] !== 'speaker.png'): ?>
                                <img src="../../upload/trending/<?php echo htmlspecialchars($config['image']); ?>" 
                                     alt="Image actuelle"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <?php else: ?>
                                <img src="../../image/<?php echo htmlspecialchars($config['image']); ?>" 
                                     alt="Image actuelle"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <?php endif; ?>
                            <p style="display: none; color: #666; margin-top: 10px;">
                                <i class="fas fa-info-circle"></i> Image non trouvée
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="file-input-wrapper">
                        <label for="image" class="file-input-label">
                            <i class="fas fa-upload"></i>
                            <span><?php echo !empty($config['image']) ? 'Changer l\'image' : 'Choisir une image'; ?></span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                    </div>
                    <div id="imagePreview" style="display: none; margin-top: 15px;">
                        <img src="" alt="Aperçu" class="image-preview" id="previewImg">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Enregistrer la configuration
                    </button>
                    <a href="../parametres.php" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Retour aux paramètres
                    </a>
                </div>
            </form>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>

    <script>
        // Aperçu de l'image avant upload
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        });
    </script>
</body>
</html>

