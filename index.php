<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $position = $_GET['board'];
        $squares = str_split($position);

        $game = new Game($squares);
        $game->display();
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

            function winner($token) {
                $won = false;

                for ($row = 0; $row < 3; $row++) {
                    if (($this->position[$row * 3] == $token) && ($this->position[($row * 3) + 1] == $token) && ($this->position[($row * 3) + 2] == $token))
                        $won = true;
                }

                for ($col = 0; $col < 3; $col++) {
                    if (($this->position[$col] == $token) && ($this->position[$col + 3] == $token) && ($this->position[$col + 6] == $token))
                        $won = true;
                }
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


