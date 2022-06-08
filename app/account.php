<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATaGlange</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "You are not authorized to view this page. Go back <a href= '../app/login.php'>home</a>";
    exit();
}
require '../backend/header.php';
?>

<body>
    <ul>
        <li><a href="../index.html">Home</a></li>
        <li style="float:right"><a class="waves-effect waves-light btn" id="newDrawing">New drawing</a></li>
        <li class="nav-item" style="float:right"><a class="waves-effect waves-light btn" href="../backend/logout.php">Logout</a></li>
    </ul>
    <h1>Welcome to the Account Page, <?php echo $_SESSION['username'] ?></h1>
    <div class="container">
        <br><br><br><br>
    </div>
    <div id="dom-target" style="display: none;">
        <?php
        echo htmlspecialchars($_SESSION['username']);
        ?>
    </div>
</body>
<script>
    function httpGet(theUrl) {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", theUrl, false); // false for synchronous request
        xmlHttp.send(null);
        return xmlHttp.responseText;
    }

    function makeid(length) {
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() *
                charactersLength));
        }
        return result;
    }

    $(document).ready(function() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var drawings = JSON.parse(this.responseText);
                console.log(drawings);
                drawings.forEach(function(drawing) {
                    var gridItem = document.createElement("div");
                    gridItem.setAttribute("class", "grid-item");
                    gridItem.setAttribute("id", drawing.id);
                    gridItem.innerHTML = "id: " + drawing.id + ", name: " + drawing.name;
                    document.getElementsByClassName("container")[0].appendChild(gridItem);
                });
            }
        };
        var div = document.getElementById("dom-target");
        var name = div.textContent.replaceAll(/\s/g, '');

        const user = JSON.stringify({
            "name": name
        });
        xmlhttp.open("GET", "../backend/requestDrawings.php?x=" + user, true);
        xmlhttp.send();

        $("#newDrawing").click(function(event) {
            event.preventDefault();
            window.open("drawing.php?id=" + makeid(10) + "&username=" + name);
        });
        $(".container").on("click", ".grid-item", function(event) {
            event.preventDefault();
            window.open("drawing.php?id=" + $(this).attr("id") + "&username=" + name);
        });
    });
</script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway');

    * {
        font-family: Raleway;
    }

    .grid-item {
        position: relative;
        font-size: 25px;
        padding: 20px;
        padding-top: 50px;
        background-color: #379AD6;
        color: #222;
        border: 1px solid white;

        align-self: start;
        justify-self: center;
    }

    .grid-item::before {
        position: absolute;
        font-size: 25px;
        font-weight: bold;
        top: 10px;
        left: 15px;
    }

    .grid-item::after {
        position: absolute;
        font-size: 25px;
        top: 10px;
        right: 15px;
        font-weight: bold;
    }

    body {
        background-color: #f2f2f2;
    }

    button {
        margin: 10px;
        width: 40%;
        padding: 10px;
    }

    html,
    body {
        height: 100%;
        overflow: hidden;
    }
</style>

</html>