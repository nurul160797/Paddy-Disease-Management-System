<?php
include_once("dbconnect.php");

$id =$_GET["id"];
$name =$_GET["name"];

$sql = "SELECT * FROM user WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $user = $stmt->fetchAll();
    
    echo "<head></head><link rel='stylesheet' href='styles.css'></head>";
    echo "<p><h1 align='center'>Profile Anda</h1></p>";
    echo "<table border = '4' align = 'center'>";
    
    foreach($user as $user) {
        echo "<tr>";
        echo "<tr><td colspan='2' > <img src='images/$id.jpg' width='150' height='250' class = 'center'> </td></tr>";
        echo "<tr><td>Nama</td><td>".$user['name']."</td></tr>";
        echo "<tr><td>ID</td><td>".$user['id']."</td></tr>";
        echo "<tr><td>Email</td><td>".$user['email']."</td></tr>";
        //echo "<tr><td>Phone Number</td><td>".$user['phone']."</td></tr>";
        //echo "<tr><td>Registration Date</td><td>".date_format(date_create($user['timereg']),"d/m/Y H:i a"."</td></tr>";
    }
    echo "</table><br>";
    echo "<p align='center'><a href='mainpage.php?id=".$id."&name=".$name."'>Batal</a></p>";
?>