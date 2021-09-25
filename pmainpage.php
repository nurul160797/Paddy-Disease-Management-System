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
    if (isset($_GET['pname'])) {
        $pname = $_GET['pname'];
        try {
            $sql = "DELETE FROM pests WHERE id='$id' AND pname='$pname'";
            $conn->exec($sql);
            echo "<script> alert('Padam Berjaya')</script>";
            echo "<script> window.location.replace('pmainpage.php?id=".$id."&name=".$name."')</script>;";
        } catch(PDOException $e) {
            echo "<script> alert('Padam Gagal')</script>";
        }
    }

    try{
        if (isset($_GET['sub'])){
            $sub = $_GET['sub'];
            $sql = "SELECT * FROM pests WHERE id = '$id' AND pname LIKE '%$sub%' ORDER BY pname ASC";
        }else{
            $sql = "SELECT * FROM pests WHERE id = '$id' ORDER BY pname ASC";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $pests = $stmt->fetchAll();

        echo "<p><h2 align='center'>Maklumat Terkini Berkaitan Serangga Perosak</h2></p>";
        echo "
        <form class=\"example\" action=\"pmainpage.php\" style=\"margin:auto;max-width:300px\">
        <input type=\"text\" placeholder=\"Cari berdasarkan nama serangga..\" name=\"sub\">
        <input type=\"hidden\" name=\"id\" value=$id>
        <input type=\"hidden\" name=\"name\" value=$name>
        <button type=\"submit\">Cari</button>
        </form>";

        echo "<table border = '4' align = 'center'>
        <tr>
            <th>Gambar</th>
            <th>Nama Serangga</th>
            <th>Simptom</th>
            <th>Kesan Serangan</th>
            <th>Kaedah Kawalan</th>
            <th>Operasi</th>
        </tr>";

        foreach($pests as $pests) {
            echo "<tr>";
            echo "<td><img src='' width='180' height='180' class = 'center'></td>";
            echo "<td>".$pests['pname']."</td>";
            echo "<td>".$pests['psymptom']."</td>";
            echo "<td>".$pests['peffect']."</td>";
            echo "<td>".$pests['pmethod']."</td>";
            echo "<td><a href='pmainpage.php?id=".$id."&name=".$name."&pname=".$pests['pname']."&operation=del' onclick='return confirm(\"Padam. Anda Pasti?\");'>Padam</a><br>
            <a href='pupdate.php?id=".$id."&name=".$name."&pname=".$pests['pname']."&psymptom=".$pests['psymptom']."&peffect=".$pests['peffect']."&pmethod=".$pests['pmethod']."'>Kemaskini</a></td>";
            echo "</tr>";  
        }
        echo "</table>";
        echo "<p align='center'><a href='pests.php?id=".$id."&name=".$name."'>Masukkan Serangga Perosak Baharu</a></p>";
        //echo "<p align='center'><a href='pests.php?id=".$id."&name=".$name."'>Pests Information</a></p>";
        //echo "<p align='center'><a href='profile.php?id=".$id."&name=".$name."'>Your Profile</a></p>";
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