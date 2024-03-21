<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendre</title>
    <link rel="stylesheet" href="../css/vendre.css">
</head>
<body>
<?php include('../nav_bar.php') ?>
    
<section class="section">

       <?php include('../page/dashbord_commercent.php') ?>
       
        <div class="container2">
            <div class="box-produit">
                <h1>Vendre un Produit <span> Remplissez ce formulaire</span></h1>
            </div>

            <div class="formulaire">
            <form>
        <div>
            <label for="productName">Nom du Produit :</label>
            <input type="text" id="productName" name="productName" required>
        </div>

        <div>
            <label for="category">Catégorie :</label>
            <select id="category" name="category" required>
                <option value="Électronique">Électronique</option>
                <option value="Vêtements">Vêtements</option>
                <option value="Livres">Livres</option>
                <option value="Électroménagers">Électroménagers</option>
                <option value="Meubles">Meubles</option>
                <option value="Jouets">Jouets</option>
                <option value="Articles de sport">Articles de sport</option>
                <option value="Beauté et soins personnels">Beauté et soins personnels</option>
                <option value="Alimentation">Alimentation</option>
                <option value="Animaux de compagnie">Animaux de compagnie</option>
                <option value="Outils et équipement">Outils et équipement</option>
                <option value="Arts">Arts</option>
            </select>
        </div>

        <div>
            <label for="category"> Sous Catégorie :</label>
            <select id="category" name="category" required>
                <option value="Électronique">Homme</option>
                <option value="Vêtements">Enfant</option>
                <option value="Livres">Femme</option>
                <option value="Électroménagers">Mixte</option>
            </select>
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="price">Prix :</label>
            <input type="number" id="price" name="price" min="0.01" step="0.01" required>
        </div>

        <div>
            <label for="quantity">Quantité en stock :</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
        </div>

        <div>
            <label for="productImage" class="label-file">Sélectionner une Image</label>
            <span id="productImageLabel"></span>
            <input type="file" id="productImage" name="productImage" accept="image/*" onchange="displayImagePreview()"
                required>
            <div id="imagePreviewContainer"></div>
        </div>
        <button type="submit">Publier le Produit</button>

        <script>
            function displayImagePreview() {
                const input = document.getElementById('productImage');
                const label = document.getElementById('productImageLabel');
                const previewContainer = document.getElementById('imagePreviewContainer');

                label.textContent = ''; // Réinitialise le texte du label

                const files = input.files;

                if (files.length > 0) {
                    const file = files[0]; // Prend uniquement le premier fichier
                    label.textContent = file.name;

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewContainer.innerHTML = ''; // Réinitialise le contenu du conteneur

                        const img = document.createElement('img');
                        img.src = e.target.result;

                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                }
            }
        </script>
    </form>
            </div>

           
        </div>
    </section>
</body>
</html>