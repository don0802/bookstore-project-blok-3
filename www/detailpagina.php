<?php
include 'database.php';

$id = $_GET['id'];

$query = "SELECT * FROM boeken WHERE id = $id";

$result = mysqli_query($conn, $query);

$boek = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $boek['titel']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <section class="detail-container">
        <a href="index.php" class="btn-back">&larr; Terug naar overzicht</a>
        
        <div class="detail-content">
            <div class="detail-image-wrapper">
                <img src="images/<?php echo $boek['thumbnail_url']; ?>" alt="<?php echo $boek['titel']; ?>" class="detail-image">
            </div>

            <div class="detail-info">
                <h1><?php echo $boek['titel']; ?></h1>
                
                <div class="detail-meta">
                    <p class="detail-auteur"><strong>Auteur:</strong> <?php echo $boek['auteur']; ?></p>
                    <p class="detail-prijs"><strong>Prijs:</strong> €<?php echo $boek['prijs']; ?></p>
                </div>

                <div class="detail-beschrijving">
                    <h3>Beschrijving</h3>
                    <p><?php echo $boek['beschrijving']; ?></p>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <p>&copy; 2026 Bookstore. All rights reserved.</p>
</footer>

</body>
</html>