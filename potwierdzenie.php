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
  <meta http-equiv="refresh" content="3; URL=zamowienia.php"
  <title>Zapisywanie</title>
</head>
<body>
<nav>
</nav
<div class="content">
  <div class="bye">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <h1> Zapisywanie</h1>
    <?php
    $conn = mysqli_connect("localhost:3306", "root", "root", "hurtownia");
    mysqli_query($conn, "INSERT INTO sprzedaze(IDklienta,DataSprzedazy,IDpracownika) VALUES (".$_SESSION['user_id'].", '".date('Y-m-d')."', 1)");
    $result=mysqli_query($conn,"SELECT IDsprzedazy FROM sprzedaze WHERE IDklienta = '".$_SESSION['user_id']."' AND DataSprzedazy ='".date('Y-m-d')."'");
    $order_id=mysqli_fetch_assoc($result);
    for($i = 1; count($_SESSION['cart']) > $i; $i++){
      $bike=mysqli_fetch_assoc(mysqli_query($conn,"SELECT CenaJednostkowa FROM rowery WHERE IDroweru =".$_SESSION['cart'][$i]));
      mysqli_query($conn,"INSERT INTO szczegolysprzedazy (IDsprzedazy, IDroweru, Ilosc, CenaJednostkowa) VALUES (".$order_id['IDsprzedazy'].", ".$_SESSION['cart'][$i].", ".$_SESSION['count'][(int)$_SESSION['cart'][$i]].", ". $bike['CenaJednostkowa'].")");
    }

    $_SESSION['cart'] = array();
    $_SESSION['cart'][0] = 777;
    $_SESSION['count'] = array();
    $_SESSION['count'][0] = 777;
    ?>
  </div>
</div>
</body>
</html>

