<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];

if (isset($_GET['pname'])) {
  $pname =$_GET["pname"];
  $psymptom =$_GET["psymptom"];
  $peffect =$_GET["peffect"];
  $pmethod =$_GET["pmethod"];

  try {
    $sql = "INSERT INTO pests(pname, psymptom, peffect, pmethod, id)
    VALUES ('$pname', '$psymptom', '$peffect', '$pmethod', '$id')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "<script> alert('Kemasukkan Berjaya')</script>";
    echo "<script> window.location.replace('pmainpage.php?id=".$id."&name=".$name."') </script>;";

  } catch(PDOException $e) {
    echo "<script> alert(Kemasukkan Gagal')</script>";
   // echo "<script> window.location.replace('pests.php?id=".$id."&name=".$name."') </script>;";
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
    <form action="pests.php" method="get" onsubmit="return confirm('Masukkan Maklumat Baharu?')" ;>
        <div class="content" align="center">
            <p>Masukkan Maklumat Baharu Berkaitan Serangga Perosak</p>
            <hr>
            <img src="" height="200"><br>
            <input class="button" onchange="previewFile()" type="file" name="file"><br>
            <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>"><br>
            <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>"><br>
            <label for="pname"><b>Nama Serangga</b></label><br>
            <textarea id="pname" name="pname" rows="3" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="psymptom"><b>Simptom</b></label><br>
            <textarea id="psymptom" name="psymptom" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="peffect"><b>Kesan Serangan</b></label><br>
            <textarea id="peffect" name="peffect" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <label for="pmethod"><b>Kaedah Kawalan</b></label><br>
            <textarea id="pmethod" name="pmethod" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
            <input type="submit" value="Hantar">
    </form>
    <p align="center"><a href="pmainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>

</html>