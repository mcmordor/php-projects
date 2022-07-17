<?php
    $access = '';

    // Evaluate server and establish connection
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'users');
    } else {
        define('HOST', 'localhost');
        define('USER', 'kevin440_morkev');
        define('PASS', 'slccMorkev4');
        define('DB', 'kevin440_lessInsecure');
    }
    $conn = mysqli_connect(HOST, USER, PASS, DB);

    if(isset($_POST["submit"])){

        $name = $_POST["username"]; 
        $password = $_POST["password"]; 

        $sql = "SELECT username FROM user_table WHERE username = '".$name."';";
        $result = mysqli_query($conn, $sql);

        $newAccount = "INSERT INTO user_table (id, username, password) VALUES (NULL, '".$name."', '".$password."');";

        if(mysqli_num_rows($result) > 0){ 
            $access = '<p>Username Already Exists</p>';
        } else if($name == null || $password == null) {
            $access = '<p>Cannot be Null</p>';
        }
        else{ 
            mysqli_query($conn, $newAccount);
            $topMessage = '<a href="index.php">GO BACK<a>';
            $access = '<p>Account Succesfully Created</p>';
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Less of an Insecurity</title>
        <link type="text/css" rel="stylesheet" href="/less-insecure/css/less-insecure.css" />
        <script src="js/less-insecure.js"></script>
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
            <input name="submit" type="submit" value="Create Account"> 
            <input type="reset"> 
        </form>
        <p id="confirm-password"></p>
    </body>
</html>