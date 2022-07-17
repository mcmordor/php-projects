<?php
    include('includes/functions.php');

    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "1550");
    define("DB", "diastic");

    $conn = mysqli_connect(HOST, USER, PASS, DB);

    if (isset($_POST['seed-input']) && $_POST['seed-input'] != ""){
        $seed = $_POST['seed-input'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Diastic Machine</title>
        <link type="text/css" rel="stylesheet" href="/diastic/css/diastic.css" />
    </head>
    <body>
        <h2>Story Time</h2>
        <?php 
        if(!isset($_GET['s'])){
        echo '<form method="post" action="index.php/?s=true">
            <input name="seed-input" type="text">
            <input type="submit">
        </form>';
        } else{
        //$seed = "magic show";
        $seed = explode(" ", $seed);

        foreach($seed as $sl)
        {
        $phrase = [];
    
            for ($i = 0; $i < strlen($sl); $i++){
                $space = "";
                for($j = 0; $j < $i; $j++) $space .= "_";
    
                //table name will be a variable based on what the user chose
                $sql = 'SELECT word FROM beauty WHERE word LIKE "'
                    .$space.$sl[$i].'%" ORDER BY rand() LIMIT 1;';
                $results = mysqli_query($conn, $sql);
    
                while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC)) 
                    $phrase[] = $rows['word'];
            }
            $output = "";
            foreach($phrase as $w){
                $output .= "$w ";
            }
    
            echo "<p>$output</p>";
        }
        }
        ?>
    </body>
</html>