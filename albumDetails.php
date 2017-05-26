<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Album Details</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <main class="container">
            <h1>Album Details</h1>
            <?php
                if (!empty($_GET['albumID'])) //If albumID is not empty, populate it
                    $albumID = $_GET['albumID'];
                else
                    $albumID = null;
                    $title = null;
                    $year = null;
                    $artist = null;
                    $genrePicked = null;

                if (!empty($albumID)) {
                    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358165', 'gc200358165','lyXAs4jl8F');
                    $sql = "SELECT * FROM albums WHERE albumID = :albumID";
                    $cmd = $conn->prepare($sql);
                    $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);
                    $cmd->execute();
                    $album = $cmd->fetch();
                    $conn = null;
                    $title = $album['title'];
                    $year = $album['year'];
                    $artist = $album['artist'];
                    $genrePicked = $album['genre'];
                }
            ?>
            <form method="post" action="saveAlbum.php">
                <fieldset class="form-group">
                    <label for="title" class="col-sm-1">Title: *</label>
                    <input name="title" id="title" required placeholder="Album Title" value="<?php echo $title ?>"/>
                </fieldset>

                <fieldset class="from-group">
                    <label for="year" class="col-sm-1">Year:</label>
                    <input name="year" id="year" type="number" min="1900" placeholder="Year Released" value="<?php echo $year ?>"/>
                </fieldset>

                <fieldset class="form-group">
                    <label for="artist" class="col-sm-1">Artist: *</label>
                    <input name="artist" id="artist" required placeholder="Artist Name" value="<?php echo $artist ?>"/>
                </fieldset>

                <fieldset>
                    <label for="genre" class="col-sm-1">Genre: *</label>
                    <select name="genre" id="genre">
                        <?php
                            //Connect to the database
                            $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358165', 'gc200358165','lyXAs4jl8F');
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //$conn->setAttribute(attribute: PDO::ERRMODE_EXCEPTION); --> mistake??
                            //Create the SQL statement
                            $sql = "SELECT * FROM genres";
                            //Prepare and execute the SQL statement
                            $cmd = $conn->prepare($sql);
                            $cmd->execute();
                            $genres = $cmd->fetchAll();
                            //Loop over the results to build the list
                            foreach ($genres as $genre)
                            {
                                if ($genrePicked == $genre['genre'])
                                    echo '<option selected>'.$genre['genre'].'</option>';
                                else
                                    echo '<option>'.$genre['genre'].'</option>';
                            }
                            //Disconnect from the database
                            $conn = null;
                        ?>
                    </select>
                </fieldset>
                <input name="albumID" id="albumID" value="<?php echo $albumID ?>" type="hidden"/>
                <button class="btn btn-success col-sm-offset-1">Save</button>
            </form>
        </main>
    </body>
<script src="js/bootstrap.min.js"></script>
</html>

