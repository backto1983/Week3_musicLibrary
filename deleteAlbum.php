<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Deleting Album</title>
    </head>
    <body>
        <?php
            //Connect to the database
            $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200358165', 'gc200358165','lyXAs4jl8F');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Create the SQL statement
            $sql = "DELETE FROM albums WHERE albumID = :albumID";
            //Prepare and execute the SQL statement
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':albumID', $_GET['albumID'], PDO::PARAM_INT);
            $cmd->execute();
            //Disconnect from the database
            $conn = null;
            //Redirect to the ablums.php page
            header('location:albums.php');
        ?>
    </body>
</html>
<?php ob_flush(); ?>
