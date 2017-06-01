<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once ('db.php');

    $sql = "SELECT * FROM users WHERE email = :email";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email',$email,PDO::PARAM_STR, 120);
    $cmd->execute();
    $user = $cmd->fetch();

    #Validate the user
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['email']  = $user['email'];
        $_SESSION['userName'] = $user['userName'];
        header('location:albums.php');
    }
    else{ #Uuser was not found or did not have a valid password
        header('location:login.php?invalid=true');
        exit();
    }
    $conn=null;
?>