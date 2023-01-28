<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
   $timestamp = date("YmdHis");
//?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style_logout.css?v=<?php echo $timestamp;?>">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta http-equiv="refresh" content="3; URL=login.php" />
        <title>Wylogowywanie</title>
    </head>
    <body>
        <nav>
        </nav>
        <div class="content">
            <div class="bye">
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <h1> Wylogowywanie</h1>
                <?php
                    session_destroy();
                ?>
            </div>
        </div>
    </body>
</html>

