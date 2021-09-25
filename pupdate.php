<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];
$pname =$_GET["pname"];
$psymptom =$_GET["psymptom"];
$peffect =$_GET["peffect"];
$pmethod =$_GET["pmethod"];

//update operation
if (isset($_GET['operation'])) {
  try {
    $sqlupdate = "UPDATE pests SET pname='$pname', psymptom='$psymptom', peffect='$peffect', pmethod='$pmethod' WHERE id='$id' AND pname='$pname'";
    $conn->exec($sqlupdate);
    echo "<script> alert('Kemaskini Berjaya')</script>";
    echo "<script> window.location.replace('pmainpage.php?id=".$id."&name=".$name."')</script>;";
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
    <form action="pupdate.php" method="get" onsubmit="return confirm('Kemaskini Maklumat Baharu?')" ;>
        <div class="content" align="center">
            <p>Kemaskini <?php echo $pname;?></p>
            <hr>
            <img src="" height="200"><br>
            <input class="button" onchange="previewFile()" type="file" name="uploaded_file"><br>
            <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>"><br>
            <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>"><br>
            <input type="hidden" placeholder="" name="pname" value="<?php echo $pname;?>">
            <input type="hidden" placeholder="" name="operation" value="pupdate"><br>
            <label for="psymptom"><b>Simptom</b></label><br>
            <input type="text" placeholder="" name="psymptom" value="<?php echo $psymptom;?>" required><br><br>
            <label for="peffect"><b>Kesan Serangan</b></label><br>
            <input type="text" placeholder="" name="peffect" value="<?php echo $peffect;?>" required><br><br>
            <label for="pmethod"><b>Kaedah Kawalan</b></label><br>
            <input type="text" placeholder="" name="pmethod" value="<?php echo $pmethod;?>" required><br><br>
            <input type="submit" value="Hantar">
    </form>
    <p align="center"><a href="pmainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>

</html>