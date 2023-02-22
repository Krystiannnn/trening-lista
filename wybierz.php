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

   require_once("connect.php");
   $conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

   $q = $conn->prepare("SELECT id, nam, statu FROM listaa");
   $q->execute();
   $nameresult = $q->get_result();
   
?>
<form action="wybierz.php" >

    <fieldset>
      
        <?php
           while($staffRow = $nameresult->fetch_assoc()){
            $staffId = $staffRow['id'];
            $staffname = $staffRow['nam'];
            
            echo "<input type='radio' value=$staffId name=$staffname  >$staffname";
            //echo "<option value=\"$staffId\">$staffname </option>";
        
           }

        ?>
      
    </fieldset>
    <input type="datetime-local" name="startTime" id="startTime">
    <input type="datetime-local" name="endTime" id="endTime">
    <input type="number" name="interval" id="interval" value="15">
    <input type="submit" value="Rozpisz wizyty">
    
</form>
<?php
 //skrypt automatyczne rozpisanie czasu co 15min z id wybranym spr ifem i przeformatowanie czasu
  if( isset($_REQUEST['startTime']) && isset($_REQUEST['endTime']) && isset($_REQUEST['interval']) ){
    //$staffId = $staffname;
    $startTime = strtotime($_REQUEST['startTime']);
    $endTime = strtotime($_REQUEST['endTime']);
    $interval = $_REQUEST['interval']*60; // w sekundach
    for($i = $startTime; $i < $endTime; $i += $interval){
        echo date("j.m H:i", $i) ."<br>";
    }
  }
?>
<br>
<?php

 var_dump($_REQUEST);


?>



</body>
</html>