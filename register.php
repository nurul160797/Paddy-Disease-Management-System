<?php
include_once("dbconnect.php");

//get data first
$id =$_POST["id"];
$name =$_POST["name"];
$email =$_POST["email"];
$pass =$_POST["pass"];
//$image = generateRandomString();

//if(!empty($_FILES['uploaded_file'])){
    //$path = "profileimage/";
    //$path = $path.basename($_FILES['uploaded_file']['name']);
    //$path = $path .$image.'.jpg';
    //if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            //set the PDO error mode to exception
            $sql = "INSERT INTO user(id, name, email, pass)
            VALUES ('$id', '$name', '$email', '$pass')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "<script> alert('Pendaftaran Berjaya!!')</script>";
            echo "<script> window.location.replace('login.html')</script>";
            
        } catch(PDOException $e) {
            echo "<script> alert('Pendaftaran Gagal!!')</script>";
            echo "<script> window.location.replace('register.html')</script>";
            //echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;

    //}else{
        //echo "<script> alert('Image Upload Error!!')</script>";
        //echo "<script> window.location.replace('register.html')</script>";
    //}
//} 
//function generateRandomString($length = 10){
    //return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
//}

?>