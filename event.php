<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];

if (isset($_GET['ename'])) {
  $ename =$_GET["ename"];
  $place =$_GET["place"];
  $edate =$_GET["edate"];
  $etime =$_GET["etime"];

  try {
    $sql = "INSERT INTO event(ename, place, edate, etime, id)
    VALUES ('$ename', '$place', '$edate', '$etime', '$id')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "<script> alert('Kemasukkan Berjaya')</script>";
    echo "<script> window.location.replace('emainpage.php?id=".$id."&name=".$name."') </script>;";

  } catch(PDOException $e) {
    echo "<script> alert('Kemasukkan Gagal')</script>";
    echo "<script> window.location.replace('event.php?id=".$id."&name=".$name."') </script>;";
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
    <form action="event.php" method="get" onsubmit="return confirm('Masukkan Aktiviti Baharu?')" ;>
        <div class="content" align="center">
            <p>Masukkan Aktiviti Baharu</p>
            <hr>
            <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>"><br>
            <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>"><br>
            <label for="ename"><b>Nama Aktiviti</b></label><br>
            <textarea id="ename" name="ename" rows="3" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="place"><b>Tempat</b></label><br>
            <textarea id="place" name="place" rows="3" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="edate"><b>Tarikh</b></label><br>
            <textarea id="edate" name="edate" rows="2" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="time"><b>Masa</b></label><br>
            <textarea id="etime" name="etime" rows="2" cols=50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <input type="submit" value="Hantar">
    </form>
    <p align="center"><a href="emainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>

</html>