<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // gets URL and translates into board
        $position = $_GET['board']; 
        //splits string into array for each square
        $squares = str_split($position);

        $game = new Game($squares);
        $game->display();
        //-----------------------------------------------------------------
        //Main game logic
        //-----------------------------------------------------------------
        if ($game->winner('x'))
            echo 'You win. Lucky Guesses!';
        else if ($game->winner('o'))
            echo 'I win. Muahahah';
            
        else
            echo 'No winner yet. But you are losing >:)';

        class Game {

            var $position;
            var $squaresLocal;

            function __construct($squares) {
                $this->position = $squares;
                $this->squaresLocal = $squares;
            }
             //-----------------------------------------------------------------
             //Function to check for all row matches, column matches, and the 2 
             //diagonal matches
            //-----------------------------------------------------------------
            function winner($token) {
                $won = false;
                //checks for matches on rows, for loop to go through each row
                for ($row = 0; $row < 3; $row++) {
                    if (($this->position[$row * 3] == $token) && ($this->position[($row * 3) + 1] == $token) && ($this->position[($row * 3) + 2] == $token))
                        $won = true;
                }
                //checks for matches on columns
                for ($col = 0; $col < 3; $col++) {
                    if (($this->position[$col] == $token) && ($this->position[$col + 3] == $token) && ($this->position[$col + 6] == $token))
                        $won = true;
                }
                //checks for matches in the 2 diagonals
                if (($this->position[0] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) &&
                        ($this->position[4] == $token) &&
                        ($this->position[6] == $token)) {
                    $won = true;
                }
                return $won;
            }
            //-----------------------------------------------------------------
            //Renders Game baord and calls show cell function to display when clicked
            //-----------------------------------------------------------------
            function display() {
                echo '<table cols="3" style="font-size:large;font-weight:bold">';
                echo '<tr>'; // open the first row
                for ($pos = 0; $pos < 9; $pos ++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2)
                        echo '</tr><tr>'; // start a new row for the next square
                }
                echo '</tr>';
                echo '</table>';
            }
             //-----------------------------------------------------------------
             //Function that displays each cell and alternates move dependent on 
             //whoever has had more turns
            //-----------------------------------------------------------------
            function show_cell($which) {
                $token = $this->position[$which];
                //deal with the easy case
                if ($token <> '-')
                    return '<td>' . $token . '</td>';
                //now the hard case
                $this->newposition = $this->position; // copy the original
                $nextVal = $this->pick_move();
                $this->newposition[$which] = $nextVal; //this would be their move
                $move = implode($this->newposition); //make a string from the board array

                $link = './?board=' . $move; //this is what want the link to be
                // so return a cell containing an anchor and showing a hyphen
                return '<td><a href="' . $link . '">-</a></td>';
            }
 //-----------------------------------------------------------------
        //Function to determine who's move it is. Whoever has gone less, goes next.
        //-----------------------------------------------------------------
            function pick_move() {

                $xcounter = 0;
                $ocounter = 0;
                //print_r($this->squaresLocal);
                foreach ($this->squaresLocal as $value) {
                    if ($value == "x") {
                        $xcounter++;
                        //echo "Adding to x";
                    } else if ($value == "o") {
                        $ocounter++;
                        //echo "Adding to o";
                    }
                }
                //echo "PICK_MOVE() invoked, xcounter " . $xcounter . " ocounter " . $ocounter;
                //Now compare the two counter
                if ($xcounter > $ocounter) {
                    return "o";
                } else {
                    return "x";
                }

                return "-";
            }

        }
        ?>
    </body>

</html>


