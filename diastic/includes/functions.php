<?php 
function textExplode($text){
    $del = [" ", "\n", "\r", "", "'", '"', ",", "!", "/", "?", ".", ";", ":", "-"];
    $text = str_replace($del, $del[0], $text);
    $retArray = explode($del[0], $text);
    return $retArray;
}

function poem($seed, $conn){
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