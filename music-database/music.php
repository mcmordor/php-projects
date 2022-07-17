<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Music Database</title>
        <link type="text/css" rel="stylesheet" href="/music-database/css/music.css" />
        <script src="/music-database/js/music.js"></script>
    </head>
    <body>
        <div class="music-wrapper">
        <h2> </h2>
            <?php
                $music_args = array(
                    "BRIGHTSIDE - The Lumineers", 
                    "CLOUD NINE - Kygo", 
                    "LOAD - Metallica", 
                    "METEORA - Linkin Park", 
                    "LONDON CALLING - The Clash", 
                    "IMAGINE - John Lenon",
                    "NEVERMIND - Nirvana",
                    "MOTHERSHIP - Led Zeppelin",
                    "RACINE CARRÉE - Stromae",
                    "XOXO - The Maine");

                echo '<table>
                <tr> <th> <b>Favorite Albums</b> </th> </tr>';

                // Display each element of array in random order.
                shuffle($music_args);
                foreach($music_args as $m){
                    echo '<tr> <td> '.$m. '</td> </tr>';
                }
                
                echo '</table>';
            ?>
        </div>
    </body>
</html>