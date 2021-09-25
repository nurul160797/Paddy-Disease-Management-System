<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];
$d_name =$_GET["d_name"];
$symptom =$_GET["symptom"];
$effect =$_GET["effect"];
$methods =$_GET["methods"];

//update operation
if (isset($_GET['operation'])) {
  try {
    $sqlupdate = "UPDATE disease SET d_name='$d_name', symptom='$symptom', effect='$effect', methods='$methods' WHERE id='$id' AND d_name='$d_name'";
    $conn->exec($sqlupdate);
    echo "<script> alert('Kemaskini Berjaya')</script>";
    echo "<script> window.location.replace('mainpage.php?id=".$id."&name=".$name."')</script>;";
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
    <form action="update.php" method="get" onsubmit="return confirm('Kemaskini Maklumat Baharu?')" ;>
        <div class="content" align="center">
            <p>Kemaskini <?php echo $d_name;?></p>
            <hr>
            <img src="" height="200"><br>
            <input class="button" onchange="previewFile()" type="file" name="uploaded_file"><br>
            <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>">
            <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>">
            <input type="hidden" placeholder="" name="d_name" value="<?php echo $d_name;?>">
            <input type="hidden" placeholder="" name="operation" value="update"><br>
            <label for="symptom"><b>Simptom</b></label><br>
            <input type="text" placeholder="" name="symptom" value="<?php echo $symptom;?>" required><br><br>
            <label for="effect"><b>Kesan Serangan</b></label><br>
            <input type="text" placeholder="" name="effect" value="<?php echo $effect;?>" required><br><br>
            <label for="methods"><b>Kaedah Kawalan</b></label><br>
            <input type="text" placeholder="" name="methods" value="<?php echo $methods;?>" required><br><br>
            <input type="submit" value="Kemaskini">
    </form>
    <p align="center"><a href="mainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>

</html>