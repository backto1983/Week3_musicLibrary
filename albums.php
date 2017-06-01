<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Albums</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>

    <body>
        <h1>Albums</h1>
            <?php
                #Start a session
                session_start();
                #Validate if the user is active
                if (!empty($_SESSION['email']))
                    echo '<a href="AlbumDetails.php">Add a new Album</a>';

                require_once('db.php');

                $sql = "SELECT * FROM albums";
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $albums = $cmd->fetchAll();
                $conn = null;

                echo '<table class="table table-striped table-hover">
                      <tr><th>Title</th>
                      <th>Year</th>
                      <th>Artist</th>
                      <th>Genre</th>';

                if (!empty($_SESSION['email'])){
                    echo '<th>Edit</th>
                          <th>Delete</th>';
                }
                echo '</tr>';

                foreach($albums as $album) {
                    echo '<tr><td>'.$album['title'].'</td>
                          <td>'.$album['year'].'</td>
                          <td>'.$album['artist'].'</td>
                          <td>'.$album['genre'].'</td>';

                    if (!empty($_SESSION['email'])){
                        echo '<td><a href="AlbumDetails.php?albumID='.$album['albumID'].'" class="btn btn-primary">Edit</a></td>
                              <td><a href="deleteAlbum.php?albumID='.$album['albumID'].'" class="btn btn-danger confirmation">Delete</a></td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                require_once ('footer.php');
            ?>