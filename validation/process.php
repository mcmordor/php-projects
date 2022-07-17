<?php 
    $phone = "";
    $email = "";
    $password = "";
    $success = "";

    $pPattern = "/\(\d{3}\)\d{3}-\d{4}$/";
    $bool = false;
    $ec = 0;

    if (!empty($_POST["phone"])){
        $phone = $_POST["phone"];
    } else $ec = 1;

    if (!empty($_POST["email"])){ 
        $email = $_POST["email"];
    } else $ec = 2;

    if (!empty($_POST["password"])){ 
        $password = $_POST["password"];
    } else $ec = 3;

    // Throw exception (switch: 3) if password requirements are not satisfied.
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $space     = preg_match('/\s+/', $password);
    if(!$uppercase || !$lowercase || !$number || strlen($password) < 7 || $space) {
        $ec = 3;
        $bool = true;
    }
    // Otherwise: continue to next form with provided data.
    if (preg_match($pPattern, $phone) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $success = "<p><b>Thanks for submitting!</b><br><br>Your inputs: " . $phone . ", " . $email . ", and password (" . $password. ") were valid!</p>";
    }

    // Sequential (1) error message :: avoid overwhelming the user with requirements.
    if (!preg_match($pPattern, $phone) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $ec = 1;
    }
    if (preg_match($pPattern, $phone) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $ec = 2;
    }
    if (!preg_match($pPattern, $phone) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $ec = 4;
    }

    // If the previous statements were violated, then the user has 
    // either two (not previously defined), or all fields wrong.
    if ((!preg_match($pPattern, $phone)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && $bool == true){
        $ec = 5;
    }
    else if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && $bool == true){
        $ec = 6;
    }
    else if ((!preg_match($pPattern, $phone)) && $bool == true){
        $ec = 7;
    }

    // Save data :: valid, go to next form.
    if ($ec){
        header("location: index.php?p= " .$phone . "&e=" . $email . "&x=" . $password . "&ec=" .$ec);
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Validation</title>
        <link type="text/css" rel="stylesheet" href="/validation/css/validation.css" />
    </head>

    <body>
        <div class="main-wrapper">
            <h2>YOUR DATA IS OURS</h2>
            <?php
                echo $success;
            ?>
        </div>
    </body>
</html>