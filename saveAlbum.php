<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Saving Album...</title>
    </head>
    <body>
        <?php
        $title = $_POST['title'];
        $year = $_POST['year'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];

        $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358165', 'gc200358165','lyXAs4jl8F');

        $sql = "INSERT INTO albums (title, year, artist, genre) VALUES (:title, :year, :artist, :genre);";

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':year', $year, PDO::PARAM_INT, 4);
        $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);
        $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);

        $cmd->execute();

        $conn = null;

        header('location:albums.php');
        ?>
    </body>
</html>
