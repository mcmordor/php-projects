<?php
echo getVariables();
    function getVariables(){
        global $pValue;
        global $eValue;
        global $xValue;
        global $ecValue;

        $displayError = (isset($_GET["v"])) ? true : false;

        if (isset($_GET['p'])) $pValue = $_GET['p']; else $pValue = "";
        if (isset($_GET['e'])) $eValue = $_GET['e']; else $pValue = "";
        if (isset($_GET['x'])) $xValue = $_GET['x']; else $pValue = "";
        if (isset($_GET['ec'])) $ecValue = $_GET['ec']; else $ecValue = 0;
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
        <h2>DATA VALIDATION</h2>
            <div class="form-wrapper">
                <form method="post" action="process.php">
                    <input name='phone' type='text' placeholder='Phone Number: (123)456-7890' value= '<?php echo $pValue; ?>'>
                    <input name= 'email' type='text' placeholder='Email Address: name@domain.com' value= '<?php echo $eValue; ?>'>
                    <input name= 'password' type='text' placeholder='Password' value= '<?php echo $xValue; ?>'>
                    <input type="submit">
                    <input type="reset" value="Reset">
                </form>

                <?php
                echo displayError($ecValue);

                    function displayError($ec){
                        $returnVal = "";

                        switch($ec){   
                            case 7: $returnVal .= '<p class ="warning">Please enter a valid phone number and password.</p>'; break; 
                            case 6: $returnVal .= '<p class ="warning">Please enter a valid email address and password.</p>'; break;   
                            case 5: $returnVal .= '<p class ="warning">Please input valid data.</p>'; break;    
                            case 4: $returnVal .= '<p class ="warning">Please input a valid phone number and email address.</p>'; break;
                            case 3: $returnVal .= '<p class ="warning">Password must contain:<br>7 characters (1 lowercase, 1 uppercase, 1 number, and no space characters).</p>'; break;
                            case 2: $returnVal .= '<p class ="warning">Please enter a valid email address.</p>'; break;
                            case 1: $returnVal .= '<p class ="warning">Please enter a valid phone number.</p>'; break;
                            default:    // empty default and break :: perhaphs, a future implementation
                            break;      
                        }
                        return $returnVal;
                    }
                ?>
            </div>
        </div>
    </body>
</html>