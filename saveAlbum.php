<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Saving Album</title>
    </head>
    <body>
        <?php
            $albumID = $_POST['albumID'];
            $title = $_POST['title'];
            $year = $_POST['year'];
            $artist = $_POST['artist'];
            $genre = $_POST['genre'];

            require_once ('db.php');

            if (!empty($albumID)) {
                $sql = "UPDATE albums  
                               SET title = :title,
                                   year = :year,
                                   artist = :artist,
                                   genre = :genre
                            WHERE albumID = :albumID";
            }
            else
                $sql = "INSERT INTO albums (title,   year,  artist,  genre) VALUES (:title, :year, :artist, :genre);";

            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
            $cmd->bindParam(':year', $year, PDO::PARAM_INT, 4);
            $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);
            $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);

            if (!empty($albumID))
                $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);

            $cmd->execute();

            $conn = null;

            header('location:albums.php');
        ?>
    </body>
</html>