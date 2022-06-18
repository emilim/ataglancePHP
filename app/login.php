<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATaGlange</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<?php
require '../backend/header.php';
require '../backend/db_key.php';
?>
<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: ../app/account.php');
}
?>

<body>
    <ul>
        <li><a href="account.php">Home</a></li>
        <li class="nav-item" style="float:right"><a class="waves-effect waves-light btn" href="../app/register.php">Sign up</a></li>

    </ul>
    <div class='container'>
        <div>
            <div>
                <h1>Login to your account</h1>
            </div>
        </div>
        <form method='POST' action='../backend/backend.php'>
            <div class="form-group">
                <label>Username : </label>
                <input class='form-control w-25' type="text" name="username">
                <label>Password :</label>
                <input class='form-control w-25' type="password" name="password" id="password" autocomplete="off">
            </div>
            <button class='btn btn-outline-info' type="submit" name="login" value='login' class="submit">Login</button>
        </form>
        <div id="footer-box">
            <p>Not a member? <a href="../app/register.php" class="sign-up">Sign up now</a></p>
        </div>
    </div>
</body>
<script>

</script>

</html>