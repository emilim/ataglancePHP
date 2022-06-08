<?php
if ($_POST) {
    require 'db_key.php';
    $conn = connect_db();
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        //sanitize your input
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $passwordHashed = mysqli_real_escape_string($conn, $passwordHashed);
        //check for existing record
        $sql = "Select accounts.username From accounts Where username = '$username'";
        $sql = $conn->query($sql);
        $sql = $sql->fetch_assoc();
        if ($sql) {
            header('location: ../app/register.php');
            exit();
        } else {
            $sql = "Insert Into accounts (username, email, password) VALUES ('$username', '$email', '$passwordHashed')";
            $sql = $conn->query($sql);
            if ($sql) {
                echo "Registration succesful. You may <a href= '../app/login.php'>login</a> now";
                //header('location: index.php');
            }
            //$sql = $sql->fetch_assoc();
            //echo $username.$email.$password;
        }
    } else if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $sql = "Select * From accounts Where username = '$username'";
        $sql = $conn->query($sql);
        if ($sql) {
            $sql = $sql->fetch_assoc();
            if (password_verify($password, $sql['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                echo 'You have successfully logged-in';
                header('location: ../app/account.php');
            } else {
                echo 'Incorrect password';
            }
        } else {
            header('location: ../app/login.php');
            exit();
        }
    }
} else {
    header('location: ../app/login.php');
    exit();
}
//header('location: index.php');
