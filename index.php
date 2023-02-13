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
   $q = $conn->query("SELECT * FROM listaa");

   while($row = $q->fetch_assoc()){
    if($row['status']){
        echo '<li class="status">';
    } else {
        echo "<li>";
    }
   $name = $row['name'];
   
  
   echo $name; 
   echo "<br>";
   echo "</li>";
   }
 
?>
<form action="index.php" method="post">
    <br>
    Login:<br><input type="text" name="login" >
    <br>
    Hasło:<br><input type="password" name="haslo">
    <br>
    <input type="submit" value="Zaloguj się"  >
</form>
</body>
</html>