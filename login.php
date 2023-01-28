<?php
$timestamp = date("YmdHis");
$conn = mysqli_connect("localhost:3306", "root", "root", "hurtownia");
if($conn == false){
    echo "Błąd połączenia z bazą".mysqli_connect_error();
}

if (isset($_POST['username']) && isset($_POST['password'])){
    $sql = "SELECT IDklienta, ImieKlienta, NazwiskoKlienta
                FROM (SELECT * FROM klienci 
                               WHERE ImieKlienta = '".$_POST['username']."' OR EmailKlienta = '".$_POST['username']."') AS specific_client
                WHERE  NazwiskoKlienta = '".$_POST['password']."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = $row['ImieKlienta'];
        $_SESSION['user_id'] = $row["IDklienta"];
        header('Location: sklep.php');
        exit();
    } else {
        $error = "Błędny login lub hasło";
    }
} else $error = false;
?>
<!DOCTYPE html>
<html lang="en" xmlns:inkscape="">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Strona PHP - Baza</title>
    <link rel='stylesheet' type='text/css' href="login_style.css?v=<?php echo $timestamp;?>" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js"></script>
    <script type="application/javascript" src="login_script.js" defer></script>
  </head>
  <body>
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">Login</div>
                <div class="eula">Witaj ponownie!</div>
            </div>
            <div class="right">
                <svg viewBox="0 0 320 300">
                    <defs>
                        <linearGradient
                                inkscape:collect="always"
                                id="linearGradient"
                                x1="13"
                                y1="193.49992"
                                x2="307"
                                y2="193.49992"
                                gradientUnits="userSpaceOnUse">
                            <stop
                                    style="stop-color:#a1a7ff;"
                                    offset="0"
                                    id="stop876" />
                            <stop
                                    style="stop-color:#757eff;"
                                    offset="1"
                                    id="stop878" />
                        </linearGradient>
                    </defs>
                    <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                </svg>
              <?php
              if (isset($error) && $error) {
                echo "<script type='application/javascript'> alert('".$error."');</script>";
              }
              ?>
                <form class="form" action="login.php" method="POST" >
                    <label for="email">Imie / E-mail</label>
                    <input type="text" id="email" name="username">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password">
                    <input type="submit" id="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
