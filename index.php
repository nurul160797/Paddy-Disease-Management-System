<?php
session_start();
include_once("dbconnect.php");

//get data first
$email =$_POST["email"];
$pass =$_POST["pass"];

try{
    $sql = "SELECT * FROM user WHERE email = '$email' AND pass = '$pass'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    //set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    $user = $stmt->fetchAll();

    if ($count > 0){
        foreach($user as $user){
            $id = $user ['id'];
            $name = $user ['name'];

        }
        //setcookie
        setcookie("timer", "10s", time()+10000000,"/");

        //session
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $name;

            echo "<script> alert('Log Masuk Berjaya')</script>";
            echo "<script> window.location.replace('mainpage.php?id=".$id."&name=".$name."')</script>";
    }else{
            echo "<script> alert('Log Masuk Gagal')</script>";
            echo "<script> window.location.replace('login.html')</script>";  
         }
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>