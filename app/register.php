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
?>

<body>
    <ul>
        <li><a href="../index.html">Home</a></li>
        <li class="nav-item" style="float:right"><a class="waves-effect waves-light btn" href="../app/login.php">Login</a></li>
    </ul>
    <div class='container'>
        <div>
            <div>
                <h1>Register your Account</h1>
            </div>
        </div>
        <form action='../backend/backend.php' method='POST'>
            <div class='p-5 m-5'>
                <div class="form-group">
                    <label>Username:</label>
                    <input class='form-control w-50' type="text" name="username" required>
                    <label>Email:</label>
                    <input class='form-control w-50' type="email" name="email" required>
                    <label>Password:</label>
                    <input class='form-control w-50' type="password" name="password" required>
                    <div class='text-center mt-3 w-50'>
                        <button class='btn btn-outline-info' type='submit' value='submit' name='register'>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>