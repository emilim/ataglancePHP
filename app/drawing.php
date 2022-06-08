<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATaGlange</title>
    <link rel="stylesheet" href="../css/drawing.css">
    <link rel="stylesheet" href="../css/form-popup.css">
    <script src="../javascript/form-popup.js" defer></script>
    <script src="../javascript/index.js" defer></script>
    <script src="../javascript/long-press-event.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "You are not authorized to view this page. Go back <a href= '../app/login.php'>home</a>";
    exit();
}
//require '../backend/header.php';
?>

<body>
    <div class="container">
        <flex style="height: 100%;">
            <flex-element color="rgb(93, 199, 230)" flex=" 1" text="First Element"></flex-element>
        </flex>
    </div>
    <button class="open-button" onclick="openForm()">Open Form</button>
    <div class="form-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <h1>Save</h1>

            <label for="name"><b>Nome</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" required>

            <button type="submit" class="btn" id="save">Save</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
    <div class="hide" id="rmenu">
        <textarea id="boxInfo" rows="6" cols="40" wrap="soft">lol</textarea>
        <div class="menu">
            <button id="send">Send</button>
            <button id="verticalSplit">Vertical split</button>
            <button id="horizontalSplit">Horizontal Split</button>
            <input type="color" id="color">
            <button id="remove">Remove</button>
        </div>
    </div>
</body>

</html>