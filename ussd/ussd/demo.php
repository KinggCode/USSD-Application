<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["sess"] = " ";

if($_SESSION["sess"]=" "){
    $_SESSION["sess"]=0;
    echo($_SESSION["sess"]);
}
else {
    switch($_SESSION["sess"]){
        case 0: 
        echo("error");
    }

}
?>

</body>
</html>