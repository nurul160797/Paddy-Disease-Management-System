<?php
include_once("dbconnect.php");

echo "<head><link rel='stylesheet' href='styles.css'><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\"></head>";

try{
    $sql = "SELECT * FROM event ORDER BY ename ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //$count = $stmt->rowCount();
    $event = $stmt->fetchAll();

    echo "<h1 align='center'>AKTIVITI PPK C-2 KERPAN</h1>";
    echo "<hr>";
    echo "<br>";

    echo "<table border = '4' align = 'center'>
    <tr>
        <th>Nama Aktiviti</th>
        <th>Tempat</th>
        <th>Tarikh</th>
        <th>Masa</th>
        
    </tr>";

    foreach($event as $event) {
        echo "<tr>";
        //echo "<td>".$event['eid']."</td>";
        echo "<td>".$event['ename']."</td>";
        echo "<td>".$event['place']."</td>";
        echo "<td>".$event['edate']."</td>";
        echo "<td>".$event['etime']."</td>";
        echo "</tr>";  
    }
    echo "</table>";

}catch(PDOException $e) {
    echo "Error:" . $e->getMessage();
}
 $conn = null;
?>

