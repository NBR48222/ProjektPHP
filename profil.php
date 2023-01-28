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
    $timestamp = date("YmdHis");

    $conn = mysqli_connect("localhost:3306", "root", "root", "hurtownia");
    if($conn == false){
        echo "Błąd połączenia z bazą".mysqli_connect_error();
    }
    $result = mysqli_query($conn, "SELECT * FROM klienci INNER JOIN wojewodztwa ON klienci.IDwojewodztwa = wojewodztwa.IDwojewodztwa WHERE IDklienta = ".$_SESSION['user_id']);
    if(mysqli_num_rows($result)==1) { $row = mysqli_fetch_assoc($result); } else { session_destroy(); header('Location: login.php'); exit; }

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style_profil.css?v=<?php echo $timestamp;?>">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="dropdown.js" defer></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Profil</title>
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
                  <ul style="list-style-type: none;">
                    <?php
                    for($i = 1; $i<count($_SESSION['cart']); $i++) {
                      $cart_info=mysqli_query($conn,"SELECT * FROM rowery INNER JOIN producenci
                                      ON producenci.IDproducenta = rowery.IDproducenta
                                      WHERE rowery.IDroweru =".$_SESSION['cart'][$i]);
                      $cart_details = mysqli_fetch_assoc($cart_info);
                      echo "<li style='list-style-type: none;'>
                        <label style='line-height:6em;'>
                        <img src='product_photos/" . $cart_details['IDroweru'] . ".jpg' alt='product_photo' style='float:left;width:20%;margin-right:1em;'></img>".
                        $cart_details['NazwaProducenta']." ".$cart_details['NazwaRoweru']."
                        <p style='float:right;margin:0;padding:0;'>Ilosc: ".$_SESSION['count'][(int)$cart_details['IDroweru']]." | ".$cart_details['CenaJednostkowa']*$_SESSION['count'][(int)$cart_details['IDroweru']]." zł</p>
                        </label>
                    </li>";
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
<div id="mydaftar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edycja Danych</h4>
            </div>
            <div class="modal-body">
                <form action="save.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Imie</label>
                        <input value="<?php echo $row['ImieKlienta'] ?>" type="text" class="form-control" name="Imie" placeholder="Imie">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nazwisko</label>
                        <input type="text" value="<?php echo $row['NazwiskoKlienta'] ?>" class="form-control" name="Nazwisko" placeholder="Nazwisko">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Miasto</label>
                        <input value="<?php echo $row['MiastoKlienta'] ?>" type="text" class="form-control" name="Miasto" placeholder="Miasto">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Województwo</label><br/>
                        <select name="woj">
                            <option value=0>Wybierz Wojewodztwo</option>
                                <?php
                                   $wojewodztwa = mysqli_query($conn, "SELECT * FROM wojewodztwa");
                                    while($woj = mysqli_fetch_assoc($wojewodztwa)){
                                        echo "<option value=".$woj['IDwojewodztwa'].">".$woj['NazwaWojewodztwa']."</option>>";
                                    }
                                ?>
                            </ul>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kod Pocztowy</label>
                        <input value="<?php echo $row['KodPocztowyKlienta'] ?>" type="text" class="form-control" name="Kod_Pocztowy" placeholder="Kod_Pocztowy">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ulica</label>
                        <input value="<?php echo $row['UlicaKlienta'] ?>" type="text" class="form-control" name="Ulica" placeholder="Ulica">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numer budynku / Mieszkania</label>
                        <input value="<?php echo $row['NrDomuKlienta'] ?>" type="text" class="form-control" name="Numer_Domu" placeholder="Numer_Domu">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="daftar_billing" style="background-color: #757eff; color=white; " Value="Zapisz" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal daftar -->
<div id="mydaftar2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edycja Danych</h4>
            </div>
            <div class="modal-body">
                <form action="save.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input value="<?php echo $row['EmailKlienta'] ?>" type="email" class="form-control" name="mail" placeholder="mail">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Numer telefonu</label>
                        <input value="<?php echo $row['NumerKlienta'] ?>" type="text" class="form-control" name="numtel" placeholder="numtel">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="daftar_contact" style="background-color: #757eff; color=white; "class="btn btn-success" Value="Zapisz">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal daftar -->
<div class="content">
    <div class="profile">
        <div class="top_container">
            <img src='pic/avatar.png' class="user_photo" alt="Zdjęcie Użytkownika">
        </div>
        <h3 style="text-align: left; margin: 0; margin-left: 1em; margin-top: 1em;"> Dane Billingowe: </h3>
        <div class="user_info">
            <li class ='edit_button' data-toggle="modal" data-target="#mydaftar">
                <a href="#" class="edit_button__text" style="color: white;">
                    <svg style="float: left;display: block;position: absolute;top: 0.5em;left: 1em;"width="24" stroke-width="1.5" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20 12V5.74853C20 5.5894 19.9368 5.43679 19.8243 5.32426L16.6757 2.17574C16.5632 2.06321 16.4106 2 16.2515 2H4.6C4.26863 2 4 2.26863 4 2.6V21.4C4 21.7314 4.26863 22 4.6 22H11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M8 10H16M8 6H12M8 14H11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M16 5.4V2.35355C16 2.15829 16.1583 2 16.3536 2C16.4473 2 16.5372 2.03725 16.6036 2.10355L19.8964 5.39645C19.9628 5.46275 20 5.55268 20 5.64645C20 5.84171 19.8417 6 19.6464 6H16.6C16.2686 6 16 5.73137 16 5.4Z" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M17.9541 16.9394L18.9541 15.9394C19.392 15.5015 20.102 15.5015 20.5399 15.9394V15.9394C20.9778 16.3773 20.9778 17.0873 20.5399 17.5252L19.5399 18.5252M17.9541 16.9394L14.963 19.9305C14.8131 20.0804 14.7147 20.2741 14.6821 20.4835L14.4394 22.0399L15.9957 21.7973C16.2052 21.7646 16.3988 21.6662 16.5487 21.5163L19.5399 18.5252M17.9541 16.9394L19.5399 18.5252" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                    <label class="edit_button__label">Edytuj</label>
                </a>
            </li>
            <h3 style="margin:0;"> <?php echo $row['ImieKlienta']." ".$row['NazwiskoKlienta'] ?></h3>
            <?php echo $row['MiastoKlienta']." ".$row['KodPocztowyKlienta']." ".$row['NazwaWojewodztwa']."<br/> ul.".
                       $row['UlicaKlienta']." ".$row['NrDomuKlienta']; ?>
        </div>
        <h3 style="text-align: left; margin: 0; margin-left: 1em; margin-top: 1em;"> Dane Kontaktowe: </h3>
        <div class="user_info">
            <li class ='edit_button' data-toggle="modal" data-target="#mydaftar2">
                <a href="#" class="edit_button__text" style="color: white;">
                    <svg style="float: left;display: block;position: absolute;top: 0.5em;left: 1em;"width="24" stroke-width="1.5" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M20 12V5.74853C20 5.5894 19.9368 5.43679 19.8243 5.32426L16.6757 2.17574C16.5632 2.06321 16.4106 2 16.2515 2H4.6C4.26863 2 4 2.26863 4 2.6V21.4C4 21.7314 4.26863 22 4.6 22H11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M8 10H16M8 6H12M8 14H11" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M16 5.4V2.35355C16 2.15829 16.1583 2 16.3536 2C16.4473 2 16.5372 2.03725 16.6036 2.10355L19.8964 5.39645C19.9628 5.46275 20 5.55268 20 5.64645C20 5.84171 19.8417 6 19.6464 6H16.6C16.2686 6 16 5.73137 16 5.4Z" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> <path d="M17.9541 16.9394L18.9541 15.9394C19.392 15.5015 20.102 15.5015 20.5399 15.9394V15.9394C20.9778 16.3773 20.9778 17.0873 20.5399 17.5252L19.5399 18.5252M17.9541 16.9394L14.963 19.9305C14.8131 20.0804 14.7147 20.2741 14.6821 20.4835L14.4394 22.0399L15.9957 21.7973C16.2052 21.7646 16.3988 21.6662 16.5487 21.5163L19.5399 18.5252M17.9541 16.9394L19.5399 18.5252" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/> </svg>
                    <label class="edit_button__label">Edytuj</label>
                </a>
            </li>
            <h3 style="margin:0;"> <?php echo $row['ImieKlienta']." ".$row['NazwiskoKlienta'] ?></h3>
            <?php echo "Mail: ".$row['EmailKlienta']." <br/>Numer telefonu: ". $row['NumerKlienta']; ?>
        </div>
    </div>
</div>
</body>
</html>
