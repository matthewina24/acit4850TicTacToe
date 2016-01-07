<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
   
    </body>

</html>
<?php
$position = $_GET['board'];
$squares = str_split($position);

function winner($token, $position) {
    $won = false;
    //first row 
    if (($position[0] == $token) &&
        ($position[1] == $token) &&
        ($position[2] == $token)){
        $won = true;
    }
    //second row 
    else if 
        (($position[3] == $token) &&
        ($position[4] == $token) &&
        ($position[5] == $token)) {
        $won = true;
    }
    //third row 
       else if 
        (($position[6] == $token) &&
        ($position[7] == $token) &&
        ($position[8] == $token)) {
        $won = true;
    }
     //first column 
       else if 
        (($position[0] == $token) &&
        ($position[3] == $token) &&
        ($position[6] == $token)) {
        $won = true;
    }
     //second column
       else if 
        (($position[1] == $token) &&
        ($position[4] == $token) &&
        ($position[7] == $token)) {
        $won = true;
    }
     //third column
       else if 
        (($position[2] == $token) &&
        ($position[5] == $token) &&
        ($position[8] == $token)) {
        $won = true;
    }
     //top left- bottom right diagonal
       else if 
        (($position[0] == $token) &&
        ($position[4] == $token) &&
        ($position[8] == $token)) {
        $won = true;
    }
     //tbottom left - top right diagonal
       else if 
        (($position[6] == $token) &&
        ($position[4] == $token) &&
        ($position[2] == $token)) {
        $won = true;
    }
    return $won;
}
?>
  <?php   
     if (winner('x',$squares)) echo 'You win.';
     else if (winner('o',$squares)) echo 'I win.';
     else echo 'No winner yet.';
     ?>