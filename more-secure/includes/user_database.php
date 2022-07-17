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

    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    echo "<table>";
    $get_Pass_Users = "SELECT id, username, password, password_original FROM user_table";
    $q_result = $conn->query($get_Pass_Users);

    if ($q_result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>
        <tr>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>HASHED PASSWORD</th>
        </tr>";
        
        while($row = $q_result->fetch_assoc()) {
            echo "<tr>";
                echo "<td>". $row['username'] . "</td>";
                echo "<td>". $row['password_original'] . "</td>";
                echo "<td>". $row['password'] . "</td>";
            echo "</tr>";
            // ALTERNATIVE VERSION
            // $testVar = "Username: " . $row["username"]. " ----- Password: " . $row["password_original"]. "<br>" . "Hash: " . $row["password"]. "<br><br>";
            // echo "<tr><td>USERNAME: ". $row["username"] ."</td><td>PASSWORD: ". $row["password_original"] ."</td><td>HASH: ". $row["password"] ."</td></tr>";
            // echo $testVar;
        }
        echo "</table>";
    } else {
        echo "ERROR: Empty Database";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>More Secure</title>
        <link type="text/css" rel="stylesheet" href="/more-secure/css/db-table.css" />
    </head>
    <body>
        <?php 
            // echo $topMessage;
            echo $access; 
            // echo $customMessage;
        ?>
    </body>
</html>