<?php

    $access = '';

    // Evaluates the server and creates a connection
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'secure');
    } else {
        define('HOST', 'localhost');
        define('USER', 'kevin440_morkev');
        define('PASS', 'slccMorkev4');
        define('DB', 'kevin440_secure');
    }
    $conn = mysqli_connect(HOST, USER, PASS, DB);

    if(isset($_POST["submit"])){

        $name = $_POST["username"]; 
        $password = $_POST["password"]; 
        $vpassword = $_POST["v-password"]; 
        if (strcmp($password, $vpassword) !== 0) {
            $access = '<p>Password Error</p>';
        }
        $secretCode = $_POST["secret-code"];
        $hashed_password = hash('sha512', $password);
        $hashed_password2 = hash('sha512', $vpassword);

        $sql = "SELECT username FROM user_table WHERE username = '".$name."';";
        $result = mysqli_query($conn, $sql);

        $secret = "SELECT secretCode FROM secret_table WHERE secretCode = '".$secretCode."';";
        $check = mysqli_query($conn, $secret);

        $newAccount = "INSERT INTO user_table (id, username, password, password_original) VALUES (NULL, '".$name."', '".$hashed_password."', '".$password."');";

        if(($password == null || $vpassword == null) 
            || ($password != $vpassword)){
            $access = '<p>Password Error</p>';
        }
        if(mysqli_num_rows($result) > 0){ 
            $access = '<p>Username Already Exists</p>';
        } else if($name == null || $password == null) {
            $access = '<p>Cannot be Null</p>';
        } else if(mysqli_num_rows($check) == 0) {
            $access = '<p>Secret Code is Incorrect</p>';
        }
        else { 
            mysqli_query($conn, $newAccount);
            $topMessage = '<a href="index.php">Back to Login<a>';
            $access = '<p>Account Succesfully Created</p>';
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>More Secure</title>
        <link type="text/css" rel="stylesheet" href="/more-secure/css/more-secure.css" />
        <script src="js/more-secure.js"></script>
    </head>
    <body>
        <?php 
            echo $topMessage;
            echo $access; 
        ?>
        <form method="post">
            <input id="username" name="username" type="text" placeholder="Username">
            <input id="password" name="password" oninput="verifyStuff(this);" type="password" placeholder="Password">
            <input id="v-password" oninput="verifyStuff(this);" type="password" placeholder="Verify Password">
            <input id="secret-code" name= "secret-code" type="password" placeholder="Secret Code">
            <input name="submit" type="submit" value="Create Account"> 
            <input type="reset"> 
        </form>
        <p id="confirm-password"></p>
    </body>
</html>