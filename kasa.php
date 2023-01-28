<?php
session_start();
if (!isset($_SESSION['login'])) {
  session_destroy();
  header('Location: login.php');
  exit;
}
if (!isset($_SESSION['cart']) && !isset($_SESSION['count'])) {
  $_SESSION['cart'] = array();
  $_SESSION['cart'][0] = 777;
  $_SESSION['count'] = array();
  $_SESSION['count'][0] = 777;
}
(int)$cart_add = isset($_GET['add_cart']) ? $_GET['add_cart'] : 0;
if(!empty((int)$cart_add)){
  if(array_search((int)$cart_add,$_SESSION['cart'],true))
  {
    $_SESSION['count'][(int)$cart_add] ++;
  }else {
    array_push($_SESSION['cart'], (int)$cart_add);
    $_SESSION['count'][(int)$cart_add] = 1;
  }
}

 $flag = isset($_GET['clear']) ? $_GET['clear'] : false;
  if($flag == true){
    $_SESSION['cart'] = array();
    $_SESSION['cart'][0] = 777;
    $_SESSION['count'] = array();
    $_SESSION['count'][0] = 777;
  }

$timestamp = date("YmdHis");

$page = isset($_GET['ID']) ? $_GET['ID'] : 1;

$conn = mysqli_connect("localhost:3306", "root", "root", "hurtownia");
if($conn == false){
  echo "Błąd połączenia z bazą".mysqli_connect_error();
}
$result = mysqli_query($conn, "SELECT * FROM sprzedaze INNER JOIN
    (SELECT IDsprzedazy, szczegolysprzedazy.IDroweru, NazwaRoweru, rowery.CenaJednostkowa, ZdjecieRoweru, Ilosc FROM rowery INNER JOIN szczegolysprzedazy on rowery.IDroweru = szczegolysprzedazy.idroweru ) AS szczegoly
ON sprzedaze.IDsprzedazy = szczegoly.IDsprzedazy WHERE sprzedaze.IDsprzedazy=".$page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style_kasa.css?v=<?php echo $timestamp;?>">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Strona PHP - Baza</title>
</head>
<body>
<nav>
  <input type="checkbox" id="menu" name="menu" class="m-menu__checkbox">
  <label class="m-menu__toggle" for="menu">
    <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#f0f0f0" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
  </label>
  <label class="m-menu__overlay" for="menu"></label>
  <div class="m-menu">
    <div class="m-menu__header">
      <label class="m-menu__toggle" for="menu">
        <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#f0f0f0" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </label>
    </div>
    <div class="m-menu__userphoto">
      <img src='pic/avatar.png' class='avatar' alt = 'Zdjęcie użytkownika'></img>
      <a href='profil.php' class='welcome'> Witaj, <?php echo $_SESSION['login'] ?>!</a>
    </div>
    <ul>
      <li>
        <label onclick="window.location.href = 'sklep.php';">
          <svg style="width: 2em; height: 2em; top: 0.5em; display: block; position: relative; float: left;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
          </svg> Sklep
        </label>
      </li>
      <li>
        <label class="a-label__chevron" for="item-2">
          <svg style="width: 2em; height: 2em; top: 0.5em; display: block; position: relative; float: left;" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 22a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm0-1a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm-10 1a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm0-1a3 3 0 1 1 0 6 3 3 0 0 1 0-6zM8.098 6H4.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .488.393l3.5 16a.5.5 0 1 1-.976.214L8.098 6zM9.5 9a.5.5 0 0 1 0-1h15a.5.5 0 0 1 .488.608l-2 9A.5.5 0 0 1 22.5 18h-11a.5.5 0 1 1 0-1h10.599l1.778-8H9.5zm2 13v-1H22v1H11.5z" fill="#000" fill-rule="nonzero"></path>
          </svg>
          Koszyk
        </label>
        <input type="checkbox" id="item-2" name="item-2" class="m-menu__checkbox">
        <div class="m-menu">
          <div class="m-menu__header">
            <label class="m-menu__toggle" for="item-2">
              <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#f0f0f0" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs">
                <path d="M19 12H6M12 5l-7 7 7 7"/>
              </svg>
            </label>
            <span style='color:white'>Koszyk</span>
          </div>
          <ul>
            <?php
            if(count($_SESSION['cart']) < 2 && !count($_SESSION['count']) < 2){
              echo "Twój koszyk jest pusty!<br/><a href='sklep.php'> Wybierz coś dla siebie! </a>";
            }else {
              for ($i = 1; $i < count($_SESSION['cart']); $i++) {
                $cart_info = mysqli_query($conn, "SELECT * FROM rowery INNER JOIN producenci
                                      ON producenci.IDproducenta = rowery.IDproducenta
                                      WHERE rowery.IDroweru =" . $_SESSION['cart'][$i]);
                $cart_details = mysqli_fetch_assoc($cart_info);
                echo "<li>
                        <label style='line-height:6em;'>
                        <img src='product_photos/" . $cart_details['IDroweru'] . ".jpg' alt='product_photo' style='float:left;height:20%;width:20%;margin-right:1em;'></img>" .
                  $cart_details['NazwaProducenta'] . " " . $cart_details['NazwaRoweru'] . "
                        <p style='float:right;'>Ilosc: " . $_SESSION['count'][(int)$cart_details['IDroweru']] . " | " . $cart_details['CenaJednostkowa'] * $_SESSION['count'][(int)$cart_details['IDroweru']] . " zł</p>
                        </label>
                    </li>";
              }
            }
            ?>
              <li style="position: absolute;width: -webkit-fill-available;bottom: 0;background: #757eff;" onclick="window.location.href = 'kasa.php';">
                <label style="color: white;text-align: center;text-decoration: underline;">
                  Przejdź do kasy
                </label>
              </li>
          </ul>
        </div>
      </li>
      <li>
        <label onclick="window.location.href = 'zamowienia.php';">
          <svg style="width: 2em; height: 2em; top: 0.5em; display: block; position: relative; float: left;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M14 2a1 1 0 0 1 1 1h3.5a.5.5 0 0 1 .5.5v16a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-16a.5.5 0 0 1 .5-.5H9a1 1 0 0 1 1-1h4zM9 4H6v15h12V4h-3v1a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V4zm6.5 11a.5.5 0 1 1 0 1h-7a.5.5 0 1 1 0-1h7zm0-3a.5.5 0 1 1 0 1h-7a.5.5 0 1 1 0-1h7zm0-3a.5.5 0 1 1 0 1h-7a.5.5 0 0 1 0-1h7zM14 3h-4v2h4V3z">
            </path>
          </svg>
          Zamówienia
        </label>
      </li>
      <li><label onclick="window.location.href = 'logout.php';">Wyloguj</label></li>
    </ul>
  </div>
</nav>
<div id="content">
  <?PHP
  if (!isset($_SESSION['cart']) && !isset($_SESSION['count'])) {echo "Twój koszyk jest pusty!<br/><a href='sklep.php'> Wybierz coś dla siebie! </a>";
  }else if(count($_SESSION['cart']) < 2 && !count($_SESSION['count']) < 2){ echo "Twój koszyk jest pusty!<br/><a href='sklep.php'> Wybierz coś dla siebie! </a>";}else{
    $summary = 0;
    echo "<h3 style='text-align: left; margin: 0; margin-left: 1em; margin-top: 1em;'>Produkty w koszyku: </h3>";
    for ($i = 1; $i < count($_SESSION['cart']); $i++) {
      $info = mysqli_query($conn, "SELECT * FROM rowery INNER JOIN producenci
                                      ON producenci.IDproducenta = rowery.IDproducenta
                                      WHERE rowery.IDroweru =" . $_SESSION['cart'][$i]);
      $cartdisplay = mysqli_fetch_assoc($info);

      echo "<div class='cards'>";
      $img = $cartdisplay['ZdjecieRoweru'];
      //                        file_put_contents('product_photos/'.$row['IDroweru']. '.jpg', $img);
      echo "<img src='product_photos/" . $cartdisplay['IDroweru'] . ".jpg' class='image' alt='product_photo'>";
      echo "<div class='text_container'>";
      echo "<div class='product_name'>" . $cartdisplay['NazwaProducenta'] . " " . $cartdisplay['NazwaRoweru'] . "
            <p style='text-align:right;margin: 2em;width: fit-content;padding:0;height: fit-content;float: right;'>" .
            $cartdisplay['CenaJednostkowa'] . " zł" . " Ilość: " . $_SESSION['count'][(int)$_SESSION['cart'][$i]] . "</p>
            </div> <p style='text-align: right;margin-right: 1em;margin-bottom:0;'>Łącznie: " . $_SESSION['count'][(int)$_SESSION['cart'][$i]] * $cartdisplay['CenaJednostkowa'] . " zł</p></div>";
      echo "</div>";
      $summary += ($_SESSION['count'][(int)$_SESSION['cart'][$i]] * $cartdisplay['CenaJednostkowa']);
    }
    echo "<div class='summary'>
            <li class ='edit_button' >
            <a href='potwierdzenie.php' class='edit_button__text' style='color: white;'>
                <svg style='width: 2em; height: 2em; top: 0.5em; display: block; position: relative; float: left;' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'>
                  <path d='M22 22a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm0-1a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm-10 1a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm0-1a3 3 0 1 1 0 6 3 3 0 0 1 0-6zM8.098 6H4.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .488.393l3.5 16a.5.5 0 1 1-.976.214L8.098 6zM9.5 9a.5.5 0 0 1 0-1h15a.5.5 0 0 1 .488.608l-2 9A.5.5 0 0 1 22.5 18h-11a.5.5 0 1 1 0-1h10.599l1.778-8H9.5zm2 13v-1H22v1H11.5z' fill='#f0f0f0' fill-rule='nonzero'></path>
                </svg>
                    <label class='edit_button__label'>Kup</label>
                </a>
            </li>
            <li class ='edit_button' >
            <a href='kasa.php?clear=true' class='edit_button__text' style='color: white;'>
                    <svg style='width: 2em;height: 2em;top: 0.5em;display: block;position: relative;float: left;color: white;' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'>
                        <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z' fill='white'></path>
                    </svg>
                    <label class='edit_button__label'>Wyczyść</label>
                </a>
            </li>
            <h3 style='text-align:right; margin-bottom:0; margin-right:2em; margin-top: 1em;'> Razem: </h3><br/>
            <p style='margin-right: 1em;text-align: right; margin-bottom: 1em;'>" . $summary . " zł</p>
          </div>";
  }
  ?>
</div>
</body>
<script>

</script>
</html>

