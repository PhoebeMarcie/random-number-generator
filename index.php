<?php


$dice_number = 0;
$dice_type = '';

$diceTypes = [4, 6, 8, 10, 12, 20]; //die sides

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Web development
        Random number generator web app
    </title>
</head>

<body>
    <h2>
    Random number generator web app
    </h2>
    <div class="container">
        <form action="index.php" method="POST">
            <label for="dice_number">Number of Dice:</label>
            <input type="number" id="dice_number" name="dice_number" required>
            <label for="dice_sides">
                Select Dice Sides:
            </label>
            <select name="diceType" id="diceType" required>
                <?php
                foreach ($diceTypes as $dice):
                ?>
                    <option value="<?= $dice ?>"> d<?= $dice ?></option>
                <?php endforeach; ?>
            </select>


            <button type="submit" name="rollDice">Roll</button>
        </form>
    </div>

    <?php
    $rolls = [];

    // read filter,& sanitize user input
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rollDice'])) {


        $dice_number = htmlspecialchars(filter_var($_POST['dice_number'], FILTER_VALIDATE_INT));
        $dice_type = htmlspecialchars(filter_var($_POST['diceType'], FILTER_VALIDATE_INT));


        if ($dice_number > 0  && in_array($dice_type, [4, 6, 8, 10, 12, 20])) {
            // $rolls = [];
            $total = 0;

            // start rolling dice
            for ($x = 0; $x < $dice_number; $x++) {
                $roll = rand(1, $dice_type);
                $rolls[] = $roll;
                $total += $roll;
            }
        }
    } else {
        $dice_number = 0;
        $dice_type = 0;
        $rolls = [];
        $total = 0;
    }

    ?>
    <div class="results_div container">
        <h3>Results</h3>
        <p><strong>Number of Dice:</strong> <?php
                                            echo " $dice_number"
                                            ?> </p> 
        <p><strong>Dice Type:</strong> <?php
                                        echo " $dice_type"
                                        ?> </p> 
        <?php echo "<p><strong>Result of dice roll:</strong> " . implode(", ", $rolls) . "</p>" ?>

    </div>
</body>

</html>