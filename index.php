<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
   
   require_once("connect.php");

   $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
   

   if(isset($_REQUEST['produkt']) && $_REQUEST['produkt'] != ""){
      
      $q = $conn->prepare("INSERT INTO listaa VALUES (NULL, ?, 0)");
      $q->bind_param('s', $_REQUEST['produkt']);
      $q->execute();

      
      
   }
    //łapanie issetem linku id usuwania 
   if(isset($_REQUEST['removeprodukt'])){

      $q = $conn->prepare("DELETE FROM listaa WHERE id=?");
      $q->bind_param('i', $_REQUEST['removeprodukt']);
      $q->execute();
   } 

   if(isset($_REQUEST['skreslprodukt'])){

      $q = $conn->prepare("UPDATE listaa SET statu=1 WHERE id=?");
      $q->bind_param('i', $_REQUEST['skreslprodukt']);
      $q->execute();
   } 

   $q = $conn->query("SELECT * FROM listaa");
  
   while($row = $q->fetch_assoc()){
    if($row['statu']){    //przekreślanie przez klase 
      echo '<li class="status">';
       
    } else {
      echo "<li>";
    }
   $name = $row['nam'];
  
   echo '<a href="index.php?skreslprodukt='.$row['id'].'">Skreśl</a>';
  echo $name; 
  echo '<a href="index.php?removeprodukt='.$row['id'].'">Usuń</a>';
  
   echo "<br>";
  echo "</li>";
   }
   //var_dump($_REQUEST);
?>
<form action="index.php" method="get">
    <br>
    produkt:<br><input type="text" name="produkt" id="produkt" >
    <br>
             <input type="submit" value="dodaj do listy"  >
</form>
</body>
</html>