<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BattleGame</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0/css/bootstrap.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
    <script src="js/jQuery-3.6.0.js" type="text/javascript"></script>
    <script src="bootstrap-4.0.0/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
    <div class="battle--main--container">
        <b class="battle--story">Battle Story</b>
        <p>Once upon a time there was a great hero, called Orderus, with some strengths and weaknesses, as all heroes have.</p>
        <p>As Orderus walks the ever-green forests of Emagia, he encounters some wild beasts.</p>
        <p>The battle begin.Who will be the winner?</p>
        <div class="battle--details">
            <?php

                use BattleGame\BattleInitialize;
                require 'vendor/autoload.php';

                BattleInitialize::initialize();
            ?>
        </div>
    </div>
</body>
</html>