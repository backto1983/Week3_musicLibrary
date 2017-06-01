<?php ob_start(); ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Deleting Album</title>
        </head>
            <body>
                <?php
                    require_once ('db.php');
                    $sql = "DELETE FROM albums WHERE albumID = :albumID";
                    $cmd = $conn->prepare($sql);
                    $cmd->bindParam(':albumID', $_GET['albumID'], PDO::PARAM_INT);
                    $cmd->execute();
                    $conn = null;
                    header('location:albums.php');
                ?>
            </body>
    </html>
<?php ob_flush(); ?>