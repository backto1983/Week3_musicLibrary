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
                if (!empty($_GET['albumID']))
                    $albumID = $_GET['albumID'];
                else
                    $albumID = null;
                    $title = null;
                    $year = null;
                    $artist = null;
                    $genrePicked = null;

                if (!empty($albumID)) #Edit situation
                {
                    require_once('db.php');
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
                    <input name="title" id="title" required placeholder="Album title" value="<?php echo $title?>"/>
                </fieldset>

                <fieldset class="form-group">
                    <label for="year" class="col-sm-1">Year:</label>
                    <input name="year" id="year" type="number" min="1900" placeholder="Release Year" value="<?php echo $year ?>"/>
                </fieldset>

                <fieldset class="form-group">
                    <label for="artist" class="col-sm-1">Artist: *</label>
                    <input name="artist" id="artist" required placeholder="Artist Name" value="<?php echo $artist ?>"/>
                </fieldset>

                <fieldset>
                    <label for="genre" class="col-sm-1">Genre: *</label>
                    <select name="genre" id="genre">
                        <?php
                            #Step 1 - Connect to the DB
                            require_once ('db.php');
                            require ('db.php');
                            include_once ('db.php');
                            include ('db.php');
                            #Step 2 - Create the SQL statement
                            $sql = "SELECT * FROM genres";
                            #Step 3 - Prepare and execute the SQL statement
                            $cmd = $conn->prepare($sql);
                            $cmd->execute();
                            $genres = $cmd->fetchAll();
                            #Step 4 - Loop over the results to build the list
                            foreach ($genres as $genre) {
                                if ($genrePicked == $genre['genre'])
                                    echo '<option selected>'.$genre['genre'].'</option>';
                                else
                                    echo '<option>'.$genre['genre'].'</option>';
                            }
                            #Step 5 - Disconnect from the DB
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