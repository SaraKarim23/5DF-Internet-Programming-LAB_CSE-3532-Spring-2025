<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "enment";

$fullname =$_POST['fullname'];
$email=$_POST['email'];
$address=$_POST['address'];
$city=$_POST['city'];
$phone=$_POST['phone'];
$state=$_POST['state'];
$cardname=$_POST['cardname'];
$creditnumber=$_POST['creditnumber'];
$expmonth=$_POST['expmonth'];
$zip =$_POST['zip'];
$expyear=$_POST['expyear'];


$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    echo "Connection was successful<br>";
}


$sql = "INSERT INTO `transaction` (`fullname`, `email`, `address`, `city`, `phone`, `state`, `cardname`, `creditnumber`, `expmonth`, `zip`, `expyear`) VALUES ('$fullname', '$email', '$address', '$city', '$phone', '$state', '$cardname', '$creditnumber', '$expmonth', '$zip', '$expyear')";
$result = mysqli_query($conn, $sql);

if($result){
    header('location:index.php');
}
else{
    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
}
?>