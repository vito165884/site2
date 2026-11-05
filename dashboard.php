
<?php
include_once('sac.php');

$o = new SAC();
$req = $o->getConnexion()->query("SELECT COUNT(*) FROM produits");
$total = $req->fetchColumn();

$reqPrix = $o->getConnexion()->query("SELECT SUM(prix) FROM produits");
$totalPrix = $reqPrix->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Vito Market</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Dashboard Vito Market</h1>
</header>

<div class="dashboard">

    <div class="carte">
        <h3>Total des produits</h3>
        <p><?php echo $total; ?></p>
    </div>

    <div class="carte">
        <h3>Total des prix</h3>
        <p><?php echo number_format((float)$totalPrix, 2); ?> DT</p>
    </div>

    <div class="actions">
        <a href="insertion.php">+ Ajouter un produit</a>
        <a href="liste.php">Liste des produits</a>
        <a href="index.php">Accueil</a>
    </div>

</div>

</body>
</html>

