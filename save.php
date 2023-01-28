<?php
session_start();
if (!isset($_SESSION['login'])) {
    session_destroy();
    header('Location: login.php');
    exit;

}
if (!isset($_SESSION['cart']) && !isset($_SESSION['count'])) {
  header('Location: sklep.php');
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
    <meta http-equiv="refresh" content="3; URL=zamowienia.php" />
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
            $client = mysqli_query($conn, "SELECT * FROM klienci WHERE IDklienta = ". $_SESSION['user_id']);
            while($row=mysqli_fetch_assoc($client)) {
                if ($conn == false) {
                    echo "Błąd połączenia z bazą" . mysqli_connect_error();
                } else {
                    if (isset($_POST['daftar_contact'])) {
                        if(isset($_POST['mail']))
                        {
                            $mail = $_POST['mail'];
                        }else{
                            $mail=$row['EmailKlienta'];
                        }
                        if(isset($_POST['numtel']))
                        {
                            $number = $_POST['numtel'];
                        }else{
                            $number=$row['NumerKlienta'];
                        }
                        mysqli_query($conn, "UPDATE klienci SET EmailKlienta = '".$mail."', NumerKlienta = '".$number
                            ."'WHERE IDklienta = '". $_SESSION['user_id']."'");
                    }
                    else if ($_POST['daftar_billing']) {
                        if(isset($_POST['Imie']))
                        {
                            $name = $_POST['Imie'];
                        }else{
                            $name=$row['ImieKlienta'];
                        }
                        if(isset($_POST['Nazwisko']))
                        {
                            $surrname = $_POST['Nazwisko'];
                        }else{
                            $surrname = $row['NazwiskoKlienta'];
                        }
                        if(isset($_POST['Miasto']))
                        {
                            $city = $_POST['Miasto'];
                        }else{
                            $city = $row['MiastoKlienta'];
                        }
                        if(isset($_POST['Ulica']))
                        {
                            $street = $_POST['Ulica'];
                        }else{
                            $street = $row['UlicaKlienta'];
                        }
                        if(isset($_POST['Numer_Domu']))
                        {
                            $address = $_POST['Numer_Domu'];
                        }else{
                            $address = $row['NrDomuKlienta'];
                        }
                        if(isset($_POST['Kod_Pocztowy']))
                        {
                            $postal_code = $_POST['Kod_Pocztowy'];
                        }else{
                            $postal_code = $row['KodPocztowyKlienta'];
                        }
                        if(!empty($_POST['woj'])){
                          $woj = $_POST['woj'];
                        } else{
                          $woj = $row['IDwojewodztwa'];
                        }
                        mysqli_query($conn, "UPDATE klienci SET ImieKlienta = '".$name."', NazwiskoKlienta = '".$surrname.
                            "', MiastoKlienta ='".$city."', UlicaKlienta = '".$street."', NrDomuKlienta = '".$address."', KodPocztowyKlienta = '".$postal_code.
                            "', IDwojewodztwa = ".$woj." WHERE IDklienta = ".$_SESSION['user_id']);
                    }
                }
            }
        ?>
    </div>
</div>
</body>
</html>

