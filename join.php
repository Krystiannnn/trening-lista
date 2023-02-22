<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

  require_once("dbconnect.php");
  $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    
      $id = ('6');
 
    
  
      $q = $conn->prepare(
        "SELECT `wypozyczenia`.`data_wyp`, `dane_wypozyczen`.`cena_doba`, `klienci`.`imie_klienta`, `samochody`.`marka`
         FROM `wypozyczenia` 
         LEFT JOIN `dane_wypozyczen` ON `dane_wypozyczen`.`id_wypozyczenia` = `wypozyczenia`.`id_wypozyczenia` 
         LEFT JOIN `klienci` ON `wypozyczenia`.`id_klienta` = `klienci`.`id_klienta` 
         LEFT JOIN `samochody` ON `dane_wypozyczen`.`id_samochodu` = `samochody`.`id_samochodu`
         WHERE `klienci`.`id_klienta` = ?");
          
      $q->bind_param("i", $id );
      $q->execute();
      
      $wynik = $q->get_result();
    
    
     



     

    while($row = $wynik->fetch_assoc()){
    
    $naame = $row['imie_klienta'];
    $date = $row['data_wyp'];
    $car = $row['marka'];
    
    echo $naame."<br>";
    echo $date."<br>";
    echo $car."<br>";

    
    }
   
    

  
  
  
  
?>
</body>
</html>