<?php
try {

    require_once '../inc/accesBDD.php';

    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $options_categories = "";

    $sql = "SELECT idCategorie, nomCategorie FROM Categories ORDER BY idCategorie ASC";
    $resultat = $dbh->query($sql);

    //Création du tableau à double entrée du résultat de la requête SQL
    while ( ($une_categorie = $resultat->fetch(PDO::FETCH_ASSOC)) != FALSE) {
        $options_categories .= '<option value="' . $une_categorie['idCategorie'] . '">' . $une_categorie['nomCategorie'] . '</option>';
    }

    
} catch (Exception $e) {

    echo '<!DOCTYPE html>';
    echo '<html lang="fr"><head>';
    echo '<meta charset="utf-8">';
    echo '<title>Problème rencontré</title>';
    echo '</head><body>';

    echo '<p>' . mb_convert_encoding($e->getMessage(), 'UTF-8', 'Windows-1252') . '</p>';

    if (isset($dbh) && $dbh->errorInfo()[0] == "42000") {
        echo '<p>Erreur de syntaxe dans la requête SQL :</p>';
        echo '<pre>' . $sql . '</pre>';
    }

    echo '</body></html>';

    // Arrêt de l'exécution du script
    die;
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un produit</title>
    <link href="../../css2reco/style.css" rel="stylesheet">
</head>
<body>

<h1>Rechercher un produit</h1>
<!--Création du formulaire de la page -->
<form method="get" action="resultat_rechercher.php">

<input type="text" name="chocolat" />
<input type="submit" value="Rechercher" /><br>
</form>
<form method="get" action="resultat_categorie.php">
<select name="idCategorie">
                <?php echo $options_categories; ?>
            </select>
<input type="submit" value="Rechercher par catégorie" /><br>
</form>

<p>
<a href="client.php">Accueil client</a>
</p>
    
</body>
</html>