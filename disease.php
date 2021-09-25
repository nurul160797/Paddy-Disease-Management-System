<?php
include_once("dbconnect.php");
$id =$_GET["id"];
$name =$_GET["name"];

if (isset($_GET['d_name'])) {
  $d_name =$_GET["d_name"];
  $symptom =$_GET["symptom"];
  $effect =$_GET["effect"];
  $methods =$_GET["methods"];

  try {
    $sql = "INSERT INTO disease(d_name, symptom, effect, methods, id)
    VALUES ('$d_name', '$symptom', '$effect', '$methods', '$id')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "<script> alert('Kemasukkan Berjaya')</script>";
    echo "<script> window.location.replace('mainpage.php?id=".$id."&name=".$name."') </script>;";

  } catch(PDOException $e) {
    echo "<script> alert('Kemasukkan Gagal')</script>";
    //echo "<script> window.location.replace('disease.php?id=".$id."&name=".$name."') </script>;";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">

  <script>
    function previewFile() {
      const preview = document.querySelector('img');
      const file = document.querySelector('input[type=file]').files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
</head>
<p><h2 align='center'><?php echo $name;?></h2></p>
<body> 
<form action="disease.php" method="get" onsubmit="return confirm('Tambah Maklumat Baru?')";>
  <div class="content" align="center">
    <p>Tambah Maklumat Baru Berkaitan Penyakit Padi</p> 
    <hr>
    <img src="" height = "200"><br>
    <input class="button" onchange="previewFile()" type="file" name="uploaded_file"><br>
    <input type="hidden" placeholder="" name="id" value="<?php echo $id;?>"><br>
    <input type="hidden" placeholder="" name="name" value="<?php echo $name;?>"><br>
    <label for="d_name"><b>Nama Penyakit</b></label><br>
    <textarea id="d_name" name="d_name" rows="3" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
    <label for="symptom"><b>Simptom</b></label><br>
    <textarea id="symptom" name="symptom" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
    <label for="effect"><b>Kesan Serangan</b></label><br>
    <textarea id="effect" name="effect" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
    <label for="methods"><b>Kaedah Kawalan</b></label><br>
    <textarea id="methods" name="methods" rows="4" cols="50" style="border: 2px solid rgb(227, 238, 67)" required></textarea><br><br>
    <input type="submit" value="Hantar">
</form>
<p align="center"><a href="mainpage.php?id=<?php echo $id.'&name='.$name?>">Batal</a></p>
</body>
</html>