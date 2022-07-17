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

    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])){
        // $name = $_POST["user"]; 
        // $password = $_POST["password"]; 
        $name = mysqli_real_escape_string($conn, $_POST['user']); 
        $password = mysqli_real_escape_string($conn, $_POST['password']); 

        $sql = "SELECT username, password FROM user_table WHERE username = '".$name."' AND password = '".$password."';";
        $result = mysqli_query($conn, $sql);
        $numrows = mysqli_num_rows($result);

        if($numrows > 0){ 
            // $topMessage = '<a href="">GO BACK<a>';
            $access = '<p>Access Granted</p>';

            if($name == "beavis"){
                $customMessage = '<p>Oh yeah, B is here!</p>';
            } else if($name == "butthead"){
                $customMessage = '<p>Big guy just joined!</p>';
            } else if($name == "dana"){
                $customMessage = '<p>What, lady HR here?</p>';
            } else if($name == "fox"){
                $customMessage = '<p>Welcome, Mr. SQL Injections!</p>';
            } 
        } else{
            // $topMessage = '<a href="">GO BACK<a>';
            $access = '<p>Access Denied</p>';
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Less of an Insecurity</title>
        <link type="text/css" rel="stylesheet" href="/less-insecure/css/less-insecure.css" />
    </head>
    <body>
        <?php 
            // echo $topMessage;
            echo $access; 
            echo $customMessage;
        ?>
        <form method="post">
            <input name="user" type="text" placeholder="Username" value="">
            <input name="password" type="password" placeholder="Password" value="">
            <input name= 'submit' type="submit" value="Log In">
            <input type="reset">  
            <button id= 'accountForm' formaction="create-account.php" type="submit">Create Account</button>
        </form>
    </body>
</html>