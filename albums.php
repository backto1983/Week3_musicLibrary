<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Albums</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <h1>Albums</h1>
        <a href="albumDetails.php">Add A New Album</a>
    <?php
        $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358165', 'gc200358165','lyXAs4jl8F');

        $sql = "SELECT * FROM albums";

        $cmd = $conn->prepare($sql);

        $cmd->execute();

        $albums = $cmd->fetchAll();

        $conn = null;

        echo '<table class="table table-striped table-hover"><tr>
                  <th>Album Title</th>
                  <th>Year</th>
                  <th>Artist</th>
                  <th>Genre</th>
                  <th>Edit</th>
                  <th>Delete</th></tr>';

        foreach($albums as $album) {
            echo '<tr><td>'.$album['title'].'</td>
                      <td>'.$album['year'].'</td>
                      <td>'.$album['artist'].'</td>
                      <td>'.$album['genre'].'</td>
                      <th><a href="albumDetails.php?albumID='.$album['albumID'].'" class="btn btn-primary">Edit</a></th>
                      <td><a href="deleteAlbum.php?albumID='.$album['albumID'].'" class="btn btn-danger confirmation">Delete</a></td></tr>';
        }
        echo '</table>';
    ?>
    </body>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script> <!--Custom js--!>
</html>
