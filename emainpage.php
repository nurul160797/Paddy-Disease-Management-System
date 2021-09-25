<?php
session_start();
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];

//if (isset($_COOKIE["$id"])){
   // echo "Value is:" .$_COOKIE["$id"];
//}
//call styles
echo "<head><link rel='stylesheet' href='styles.css'><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\"></head>";

// call session
if (isset($_SESSION["name"])){
    //echo "Welcome" .$_SESSION["name"] . "<br>";
    
// cookie and delete operation
if (isset($_COOKIE["timer"])){
    if (isset($_GET['ename'])) {
        $ename = $_GET['ename'];
        try {
            $sql = "DELETE FROM event WHERE id='$id' AND ename='$ename'";
            $conn->exec($sql);
            echo "<script> alert('Padam Berjaya)</script>";
            echo "<script> window.location.replace('emainpage.php?id=".$id."&name=".$name."')</script>;";
        } catch(PDOException $e) {
            echo "<script> alert('Padam Gagal')</script>";
        }
    }

    try{
        if (isset($_GET['list'])){
            $list = $_GET['list'];
            $sql = "SELECT * FROM event WHERE id = '$id' AND ename LIKE '%$list%' ORDER BY ename ASC";
        }else{
            $sql = "SELECT * FROM event WHERE id = '$id' ORDER BY ename ASC";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $event = $stmt->fetchAll();

        echo "<p><h2 align='center'>AKTIVITI TERKINI PPK C-2 KERPAN</h2></p>";
        echo "
        <form class=\"example\" action=\"emainpage.php\" style=\"margin:auto;max-width:300px\">
        <input type=\"text\" placeholder=\"Cari berdasarkan nama aktiviti..\" name=\"list\">
        <input type=\"hidden\" name=\"id\" value=$id>
        <input type=\"hidden\" name=\"name\" value=$name>
        <button type=\"submit\">Cari</button>
        </form>";

        echo "<table border = '2' align = 'center'>
        <tr>
            <th>Nama Aktiviti</th>
            <th>Tempat</th>
            <th>Tarikh</th>
            <th>Masa</th>
            <th>Operation</th>
        </tr>";

        foreach($event as $event) {
            echo "<tr>";
            echo "<td>".$event['ename']."</td>";
            echo "<td>".$event['place']."</td>";
            echo "<td>".$event['edate']."</td>";
            echo "<td>".$event['etime']."</td>";
            echo "<td><a href='emainpage.php?id=".$id."&name=".$name."&ename=".$event['ename']."&operation=del' onclick='return confirm(\"Padam. Anda Pasti?\");'>Padam</a><br>
            <a href='eupdate.php?id=".$id."&name=".$name."&ename=".$event['ename']."&place=".$event['place']."&edate=".$event['edate']."&etime=".$event['etime']."'>Kemaskini</a></td>";
            echo "</tr>";  
        }
        echo "</table>";
        echo "<p align='center'><a href='event.php?id=".$id."&name=".$name."'>Masukkan Aktiviti Baharu</a></p>";
        echo "<p align='center'><a href='mainpage.php?id=".$id."&name=".$name."'>Balik</a></p>";
        echo "<p align='right'><button onclick=\"window.print()\">Print</button>";
        
    
    }catch(PDOException $e) {
        echo "Error:" . $e->getMessage();
    }
}else{
    echo "<script> alert('Timer Expired!!!')</script>";
    echo "<script> window.location.replace('login.html')</script>";  
}
}else{
    echo "<script> alert('Session Expired!!!')</script>";
    echo "<script> window.location.replace('login.html')</script>"; 
}
 $conn = null;
?>