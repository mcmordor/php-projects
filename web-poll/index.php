<?php
    $topMessage = "<p><b>Would you rather...</b></p>";

    $divContent =
    '<div>
        <form method="post">
            <ul>
                <li><input name="option" type="radio" value="hippo">
                <label>Always say everything on your mind </label></li>
                <li><input name="option" type="radio" value="bear">
                <label>Be stuck on a broken ski lift </label></li>
                <li><input name="option" type="radio" value="black-widow">
                <label>Walk through a black widow infested hallway </label></li>
                <li><input name="option" type="radio" value="snake">
                <label>Live without internet for 5 years </label></li>
                <li><input name="submit" type="submit" value="Submit"> </li>
            </ul>
        </form>
    </div>';

    $bottomMessage = "";

    // Server conditional values and connection
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASS', '1550');
            define('DB', 'webPoll');
    } else {
            define('HOST', 'localhost');
            define('USER', 'kevin440_morkev');
            define('PASS', 'slccMorkev4');
            define('DB', 'kevin440_webPoll');
    }
    $conn = mysqli_connect(HOST, USER, PASS, DB);

    if(isset($_POST["submit"])) {

        $answer         = $_POST["option"];

        // This query will return the record for the selected option.
        $search         = "SELECT * FROM poll WHERE result = '".$answer."';";
        $result         = mysqli_query($conn, $search);
        $counter        = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $counter = $rows['counter'];
            }
        }
        $counter++;

        // Query to Update Counter for specific options
        $sql            = "UPDATE poll SET counter = '$counter' WHERE result = '".$answer."';";
        $result         = mysqli_query($conn, $sql);

        $topMessage = '<a href="">GO BACK<a>';
        $topMessage .= "<p>Thanks for your submission!</p><br>";

        // Query to get the total votes for option 1
        $hCount         = "SELECT counter FROM poll WHERE result = 'hippo';";
        $hResult        = mysqli_query($conn, $hCount);
        $printH         = $hResult->fetch_object()->counter;
        $printH         = ($printH) ? $printH : 0;

        // Query to get the total votes for option 2
        $bCount         = "SELECT counter FROM poll WHERE result = 'bear';";
        $bResult        = mysqli_query($conn, $bCount);
        $printB         = $bResult->fetch_object()->counter;
        $printB         = ($printB) ? $printB : 0;

        // Query to get the total votes for option 3
        $bwCount        = "SELECT counter FROM poll WHERE result = 'black-widow';";
        $bwResult       = mysqli_query($conn, $bwCount);
        $printBW        = $bwResult->fetch_object()->counter;
        $printBW        = ($printBW) ? $printBW : 0;

        // Query to get the total votes for option 4
        $sCount         = "SELECT counter FROM poll WHERE result = 'snake';";
        $sResult        = mysqli_query($conn, $sCount);
        $printS         = $sResult->fetch_object()->counter;
        $printS         = ($printS) ? $printS : 0;
        $divContent = $divMessage;

        $bottomMessage = "<br><p>These results were provided by real participants.</p>";

        // Associative array to store votes as index value and corresponding string
        $ans = array();
        $ans[$printH]= "Always say everything on your mind:";
        $ans[$printB]= "Be stuck on a broken ski lift:";
        $ans[$printBW]= "Walk through a black widow infested hallway:";
        $ans[$printS]= "Live without internet for 5 years:";

        // Sort array
        ksort($ans);

        // Append and iterate :: print_r($ans)
        foreach($ans as $vote => $mess){
            $divMessage.= $mess.$vote." votes <br>";
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Web Poll</title>
        <link type="text/css" rel="stylesheet" href="/web-poll/css/web-poll.css" />
    </head>
    <body>
    <h2>WEB POLL</h2>
        <?php
            echo $topMessage;
            echo $divContent;
            echo $divMessage;
            echo $bottomMessage;
        ?>
    </body>
</html>