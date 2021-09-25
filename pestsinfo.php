<?php
include_once("dbconnect.php");

echo "<head><link rel='stylesheet' href='styles.css'><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\"></head>";

try{
    //$sql = "SELECT * FROM disease";
    if (isset($_GET['sub'])){
      $sub = $_GET['sub'];
      $sql = "SELECT * FROM pests WHERE pname LIKE '%$sub%' ORDER BY pname ASC";
  }else{
      $sql = "SELECT * FROM pests";
  }
  
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //$count = $stmt->rowCount();
    $pests = $stmt->fetchAll();

    echo "<h1 align='center'>Maklumat Berkaitan Serangga Perosak</h1>";
    echo "<hr>";
    echo "
        <form class=\"example\" action=\"pestsinfo.php\" style=\"margin:auto;max-width:300px\">
        <input type=\"text\" placeholder=\"Cari berdasarkan nama serangga..\" name=\"sub\">
        <button type=\"submit\">Cari</button>
        </form><br>"; 

    //echo "<h2 align='center'>PESTS INFORMATION</h2>";
    echo "<table border = '4' align = 'center'>
    <tr>
        <th>Gambar</th>
        <th>Nama Serangga</th>
        <th>Simptom</th>
        <th>Kesan Serangan</th>
        <th>Kaedah Kawalan</th>
        
    </tr>";

    foreach($pests as $pests) {
        echo "<tr>";
        echo "<td><img src='' width='180' height='150' class = 'center'></td>";
        echo "<td>".$pests['pname']."</td>";
        echo "<td>".$pests['psymptom']."</td>";
        echo "<td>".$pests['peffect']."</td>";
        echo "<td>".$pests['pmethod']."</td>";
        echo "</tr>";  
    }
    echo "</table>";
    //echo "<p align='right'><a href='mada.php'>Back</a></p>";
    echo "<p align='right'><button onclick=\"window.print()\">Print</button>";

}catch(PDOException $e) {
    echo "Error:" . $e->getMessage();
}
 $conn = null;
?>