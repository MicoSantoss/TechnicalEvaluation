<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    </head>
<body>
    <div class="wrapper">
        <h1>LOGIN</h1>
        <br>
        <form action="login-init.php" method="post">
            <input type="text" name="username" placeholder="Enter username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>
    </div>

<?php

if (isset($_GET['error'])){
    if ($_GET["error"] == "wronginput"){
       echo '<script>alert("Wrong username or Password");</script>';
    }
}

?>


</body>
</html>