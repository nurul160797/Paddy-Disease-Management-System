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
    if (isset($_GET['d_name'])) {
        $d_name = $_GET['d_name'];
        try {
            $sql = "DELETE FROM disease WHERE id='$id' AND d_name='$d_name'";
            $conn->exec($sql);
            echo "<script> alert('Padam Berjaya')</script>";
            echo "<script> window.location.replace('mainpage.php?id=".$id."&name=".$name."')</script>;";
        } catch(PDOException $e) {
            echo "<script> alert('Padam Gagal')</script>";
        }
    }

    try{
        if (isset($_GET['subject'])){
            $subject = $_GET['subject'];
            $sql = "SELECT * FROM disease WHERE id = '$id' AND d_name LIKE '%$subject%' ORDER BY d_name ASC";
        }else{
            $sql = "SELECT * FROM disease WHERE id = '$id' ORDER BY d_name ASC";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        //set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $disease = $stmt->fetchAll();

        echo "<p><h2 align='center'>Maklumat Terkini Berkaitan Penyakit Padi</h2></p>";
        echo "
        <form class=\"example\" action=\"mainpage.php\" style=\"margin:auto;max-width:300px\">
        <input type=\"text\" placeholder=\"Cari berdasarkan nama penyakit..\" name=\"subject\">
        <input type=\"hidden\" name=\"id\" value=$id>
        <input type=\"hidden\" name=\"name\" value=$name>
        <button type=\"submit\">Cari</button>
        </form>";

        echo "<table border = '4' align = 'center'>
        <tr>
            <th>Gambar</th>
            <th>Nama penyakit</th>
            <th>Simptom</th>
            <th>Kesan Serangant</th>
            <th>Kaedah Kawalan</th>
            <th>Operasi</th>

        </tr>";

        foreach($disease as $disease) {
            echo "<tr>";
            echo "<td><img src='' width='180' height='180' class = 'center'></td>";
            echo "<td>".$disease['d_name']."</td>";
            echo "<td>".$disease['symptom']."</td>";
            echo "<td>".$disease['effect']."</td>";
            echo "<td>".$disease['methods']."</td>";
            echo "<td><a href='mainpage.php?id=".$id."&name=".$name."&d_name=".$disease['d_name']."&operation=del' onclick='return confirm(\"Padam. Anda Pasti?\");'>Padam</a><br>
            <a href='update.php?id=".$id."&name=".$name."&d_name=".$disease['d_name']."&symptom=".$disease['symptom']."&effect=".$disease['effect']."&methods=".$disease['methods']."'>Kemaskini</a></td>";
            echo "</tr>";  
        }
        echo "</table>";
        echo "<p align='center'><a href='disease.php?id=".$id."&name=".$name."'>Masukkan Penyakit Baharu</a></p>";
        echo "<p align='center'><a href='pmainpage.php?id=".$id."&name=".$name."'>Maklumat Serangga Perosak</a></p>";
        echo "<p align='center'><a href='emainpage.php?id=".$id."&name=".$name."'>Maklumat Aktiviti</a></p>";
        echo "<p align='center'><a href='profile.php?id=".$id."&name=".$name."'>Profile</a></p>";
        echo "<p align='center'><a href='home.php?id=".$id."&name=".$name."'>Log Keluar</a></p>";
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
