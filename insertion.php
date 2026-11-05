<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Vito Market - Ajouter un produit</title>
</head>
<body>

    <header>
        <h1>Vito Market</h1>
    </header>

    <div class="actions">
        <a href="liste.php">Liste des produits</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Accueil</a>
    </div>

    <form action="" method="post" enctype="multipart/form-data">

        Choisissez une photo :
        <input type="file" name="photo" accept="image/*" required>
        <br><br>

        Référence :
        <input type="text" name="ref" required>
        <br><br>

        Catégorie :
        <input type="text" name="cat" required>
        <br><br>

        Marque :
        <input type="text" name="marque" required>
        <br><br>

        Prix :
        <input type="number" name="prix" step="0.01" required>
        <br><br>

        <input type="submit" name="sauvgarder" value="Sauvegarder">

    </form>

    <?php

    if (isset($_POST['sauvgarder'])) {

        include_once('sac.php');

        $o = new SAC();

        $o->ref = $_POST['ref'];
        $o->cat = $_POST['cat'];
        $o->marque = $_POST['marque'];
        $o->prix = $_POST['prix'];

        $photo = basename($_FILES['photo']['name']);
        $tempfichier = $_FILES['photo']['tmp_name'];

        if (!is_dir('upload')) {
            mkdir('upload', 0777, true);
        }

        $o->photo = uniqid() . "_" . $photo;

        if (move_uploaded_file($tempfichier, "upload/" . $o->photo)) {

            $o->insert();

            echo "Produit ajouté avec succès ! <a href='liste.php'>Voir la liste</a>";

        } else {
            echo "Erreur lors du téléchargement de la photo.";
        }
    }

    ?>

</body>
</html>

