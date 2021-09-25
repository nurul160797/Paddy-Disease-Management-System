<?php
include_once("dbconnect.php");

echo "<head><link rel='stylesheet' href='styles.css'><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\"></head>";

try{
    //$sql = "SELECT * FROM disease";
    if (isset($_GET['subject'])){
      $subject = $_GET['subject'];
      $sql = "SELECT * FROM disease WHERE d_name LIKE '%$subject%' ORDER BY d_name ASC";
  }else{
      $sql = "SELECT * FROM disease";
  }
  
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //$count = $stmt->rowCount();
    $disease = $stmt->fetchAll();

    echo "<h1 align='center'>Maklumat Berkaitan Penyakit Padi</h1>";
    echo "<hr>";
    echo "
        <form class=\"example\" action=\"diseaseinfo.php\" style=\"margin:auto;max-width:300px\">
        <input type=\"text\" placeholder=\"Cari berdasarkan nama penyakit..\" name=\"subject\">
        <button type=\"submit\">Cari</button>
        </form>";

    //echo "<h2 align='center'>PADDY DISEASE INFORMATION</h2>";
    echo "<table border = '4' align = 'center'>
    <tr>
        <th>Gambar</th>
        <th>Nama Penyakit</th>
        <th>Simptom</th>
        <th>Kesan Serangan</th>
        <th>Kaedah Kawalan</th>
        
    </tr>";

    foreach($disease as $disease) {
        echo "<tr>";
        echo "<td><img src='' width='150' height='150' class = 'center'></td>";
        echo "<td>".$disease['d_name']."</td>";
        echo "<td>".$disease['symptom']."</td>";
        echo "<td>".$disease['effect']."</td>";
        echo "<td>".$disease['methods']."</td>";
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