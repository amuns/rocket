<?php
    include '../utils.php';
    session_start();
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <p>
        <?=flashMessages();?>
    </p>
    <form action="login-process.php" method="POST">
        Username: <input type="text" name="uname">
        <br><br>
        Password: <input type="password" name="upass">
        <br><br>
        <input type="submit" value="Log In">
    </form>
</body>
</html>