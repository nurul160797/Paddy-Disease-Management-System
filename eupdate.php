<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];
$ename =$_GET["ename"];
$place =$_GET["place"];
$edate =$_GET["edate"];
$etime =$_GET["etime"];

//update operation
if (isset($_GET['operation'])) {
  try {
    $sqlupdate = "UPDATE event SET ename='$ename', place='$place', edate='$edate', etime='$etime' WHERE id='$id' AND ename='$ename'";
    $conn->exec($sqlupdate);
    echo "<script> alert('Kemaskini Berjaya')</script>";
    echo "<script> window.location.replace('emainpage.php?id=".$id."&name=".$name."')</script>;";
  } catch(PDOException $e) {
    echo "<script> alert('Kemaskini Gagal')</script>";
  }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
</head>
<p>
<h2 align='center'><?php echo $name;?></h2>
</p>
<body>
    <form action="eupdate.php" method="get" onsubmit="return confirm('Kemaskini Aktiviti?')" ;>
        <div class="content" align="center">
         <p>Kemaskini <?php echo $ename;?></p>
            <hr>
            <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>"><br>
            <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>"><br>
            <input type="hidden" placeholder="" name="ename" value="<?php echo $ename;?>">
            <input type="hidden" placeholder="" name="operation" value="eupdate"><br>
            <label for="place"><b>Tempat</b></label><br>
            <input type="text" placeholder="" name="place" value="<?php echo $place;?>" required><br><br>
            <label for="edate"><b>Tarikh</b></label><br>
            <input type="text" placeholder="" name="edate" value="<?php echo $edate;?>" required><br><br>
            <label for="etime"><b>Masa</b></label><br>
            <input type="text" placeholder="" name="etime" value="<?php echo $etime;?>" required><br><br>
            <input type="submit" value="Hantar">
    </form>
    <p align="center"><a href="emainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>

</html>