<?php
$playerdice1 = mt_rand(1, 6);
$playerdice2 = mt_rand(1, 6);
$computerdice1 = mt_rand(1, 6);
$computerdice2 = mt_rand(1, 6);
$computerdice3 = mt_rand(1, 6);

$playerScore = $playerdice1 + $playerdice2;
$computerScore = $computerdice1 + $computerdice2 + $computerdice3;

    if ($playerScore > $computerScore) {
        $result = "You Have Beat The Computer! >:D";
    }
    elseif ($playerScore < $computerScore) {
        $result = "Computer Beat Your Butt! :(";
    }
    else {
        $result = "DRAW!!!! TRY AGAIN!!!";
    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eddie's website</title>
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<?php
include "../includes/header.php";
?>
<div id="three-column">
    <?php
    include "../includes/navigation.php";
    ?>
    <main>
        <h2>
            Your Score!: <?=$playerScore?>
        </h2>
        <img src="images/dice_3.png" alt="picture of dice 3">
        <img src="images/dice_6.png" alt="picture of dice 6">

        <h2>
            Computers Score!: <?=$computerScore?>
        </h2>
        <img src="images/dice_5.png" alt="picture of dice 5">
        <img src="images/dice_2.png" alt="picture of dice 2">
        <img src="images/dice_1.png" alt="picture of dice 1">

        <h2>
            The End Result is!: <?=$result?>
        </h2>
    </main>
</div>
<?php
include "../includes/footer.php";
?>
</body>
</html>
