<?php 
    $access = '';

    if(isset($_POST['submit'])) {
        // Text file instantiation
        $textFile = fopen('includes/users.txt', 'r') or die('Unable to read file!');
        $usersFile = fread($textFile, filesize('includes/users.txt'));

        // Separate usernames and passwords into their own elements
        $fileArray = explode(',', $usersFile, 5);
        $returnString = implode('||>><<||', $fileArray);
        $finalArray = explode('||>><<||', $returnString, 8);

        // Username array
        $userArray = [];
        for ($i = 0; $i < sizeof($finalArray); $i += 2){
            $userArray[$i + 1] = $finalArray[$i];
        }

        // Password array
        $pwArray = [];
        for ($i = 1; $i < sizeof($finalArray); $i += 2){
            $pwArray[$i + 1] = $finalArray[$i];
        }

        fclose($textFile);  

        // Brute code for defined set of users
        if(in_array(strtolower($_POST['user']), $userArray) && in_array(strtolower($_POST['password']), $pwArray)){
            if(strtolower($_POST['user']) == $userArray[1] && strtolower($_POST['password']) == $pwArray[2] 
            || strtolower($_POST['user']) == $userArray[3] && strtolower($_POST['password']) == $pwArray[4] 
            || strtolower($_POST['user']) == $userArray[5] && strtolower($_POST['password']) == $pwArray[6] 
            || strtolower($_POST['user']) == $userArray[7] && strtolower($_POST['password']) == $pwArray[8]){

            $access = '<p>ACCESS GRANTED</p>';
            $userWelcome = '<p style="color: black; font-size: 32px">Welcome, ' . $_POST['user'] . '!</p>';

            } else $access = '<p>ACCESS DENIED</p>';
        } else $access = '<p>ACCESS DENIED</p>';
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insecurity</title>
        <link type="text/css" rel="stylesheet" href="/insecure/css/insecure.css" />
    </head>
    <body>
        <?php 
            ob_start();
            include ('includes/users.txt'); 
            $data = ob_get_clean();
            echo $access; 
            echo $userWelcome;
        ?>
        <form method="post">
            <input name="user" type="text" placeholder="Username">
            <input name="password" type="text" placeholder="Password">
            <input name= 'submit' type="submit" value="Log In">
            <input type="reset">   
        </form>
    </body>
</html>