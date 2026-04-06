<?php
require "database.php";

$filterGenre = "";
$filterAuteur = "";
$filterSorteer = "";

if (isset($_GET['genre'])) {
    $filterGenre = $_GET['genre'];
}
if (isset($_GET['auteur'])) {
    $filterAuteur = $_GET['auteur'];
}
if (isset($_GET['sorteer'])) {
    $filterSorteer = $_GET['sorteer'];
}

$sqlGenre = "SELECT DISTINCT genre FROM boeken ORDER BY genre";
$resultGenres = mysqli_query($conn, $sqlGenre);
$genres = mysqli_fetch_all($resultGenres, MYSQLI_ASSOC);

$sqlAuteur = "SELECT DISTINCT auteur FROM boeken ORDER BY auteur";
$resultAuteurs = mysqli_query($conn, $sqlAuteur);
$auteurs = mysqli_fetch_all($resultAuteurs, MYSQLI_ASSOC);

$query = "SELECT * FROM boeken";

if ($filterGenre != "" && $filterAuteur != "") {
    $query = $query . " WHERE genre = '$filterGenre' AND auteur = '$filterAuteur'";
} else if ($filterGenre != "") {
    $query = $query . " WHERE genre = '$filterGenre'";
} else if ($filterAuteur != "") {
    $query = $query . " WHERE auteur = '$filterAuteur'";
}

if ($filterSorteer == "prijs_asc") {
    $query = $query . " ORDER BY prijs ASC";
} else if ($filterSorteer == "prijs_desc") {
    $query = $query . " ORDER BY prijs DESC";
} else {
    $query = $query . " ORDER BY id ASC";
}

$result = mysqli_query($conn, $query);
$boeken = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bookstore</title>
</head>

<body>
    <main>
        <section class="home-container">
            <h1>Bookstore</h1>
            <form class="filter-bar" method="get" action="">
                <div class="filter-group">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="">Alle genres</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo $genre['genre']; ?>" <?php if ($filterGenre == $genre['genre']) { echo 'geselecteerd'; } ?>>
                                <?php echo $genre['genre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="auteur">Auteur</label>
                    <select name="auteur" id="auteur">
                        <option value="">Alle auteurs</option>
                        <?php foreach ($auteurs as $auteur): ?>
                            <option value="<?php echo $auteur['auteur']; ?>" <?php if ($filterAuteur == $auteur['auteur']) { echo 'geselecteerd'; } ?>> 
                                <?php echo $auteur['auteur']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sorteer">Sorteren op prijs</label>
                    <select name="sorteer" id="sorteer">
                        <option value="">Standaard</option>
                        <option value="prijs_asc" <?php if ($filterSorteer == 'prijs_asc') {
                            echo 'geselecteerd';
                        } ?>>
                            Laag naar hoog</option>
                        <option value="prijs_desc" <?php if ($filterSorteer == 'prijs_desc') {
                            echo 'geselecteerd';
                        } ?>>
                            Hoog naar laag</option>
                    </select>
                </div>

                <button type="submit" class="filter-button">Filteren</button>
            </form>

            <?php foreach ($boeken as $boek): ?>
                <div class="container">
                    <div class="book-info">
                        <h2><?php echo $boek['titel']; ?></h2>
                        <p><strong>Auteur:</strong> <?php echo $boek['auteur']; ?></p>
                        <p><strong>Prijs:</strong> €<?php echo $boek['prijs']; ?></p>
                        <p><strong>Beschrijving:</strong> <?php echo $boek['beschrijving']; ?></p>
                    </div>
                    <img src="images/<?php echo $boek['thumbnail_url']; ?>" alt="<?php echo $boek['titel']; ?>">
                    <a href="detailpagina.php?id=<?php echo $boek['id']; ?>" class="details-button">Bekijk details</a>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 Bookstore. All rights reserved.</p>
    </footer>

</body>

</html>