<?php
include_once('sac.php');

$o = new SAC();

// Suppression d'un produit par référence
if (isset($_GET['supprimer'])) {
    $ref = $_GET['supprimer'];
    
    // Récupérer la photo pour la supprimer du dossier upload
    $produit = $o->getByRef($ref);
    if ($produit && !empty($produit['photo'])) {
        $cheminPhoto = 'upload/' . $produit['photo'];
        if (file_exists($cheminPhoto)) {
            @unlink($cheminPhoto);
        }
    }
    
    // Supprimer le produit de la base
    $o->supprimerParRef($ref);
    
    header('Location: liste.php');
    exit;
}

$req = $o->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste des produits - Vito Market</title>
</head>
<body>

    <header>
        <h1>Liste des produits</h1>
    </header>

    <div class="actions">
        <a href="insertion.php">+ Ajouter un produit</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="index.php">Accueil</a>
    </div>

    <table class="table-produits">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Référence</th>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Prix (DT)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($req->rowCount() == 0): ?>
                <tr>
                    <td colspan="6">Aucun produit enregistré</td>
                </tr>
            <?php else: ?>
                <?php while ($p = $req->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td>
                            <?php if (!empty($p->photo)): ?>
                                <img src="upload/<?php echo htmlspecialchars($p->photo); ?>" alt="photo produit" width="80" height="80">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($p->ref); ?></td>
                        <td><?php echo htmlspecialchars($p->cat); ?></td>
                        <td><?php echo htmlspecialchars($p->marque); ?></td>
                        <td><?php echo number_format((float)$p->prix, 2); ?> DT</td>
                        <td>
                            <a class="btn-supprimer" href="liste.php?supprimer=<?php echo urlencode($p->ref); ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

