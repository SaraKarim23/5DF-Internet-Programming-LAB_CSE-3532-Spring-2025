<?php




$servername = "localhost";
$username = "root";
$password = "";
$database = "enment";


$email = $_POST['email'];
$pass = $_POST['password'];



$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
    echo "Connection was successful<br>";
}


$sql = "select * from signup where email = '$email' and pass = '$pass'";


$result = mysqli_query($conn, $sql);

if($result -> fetch_row()>0){
    header('location:index.php');
}
else{
    echo "The record was not inserted successfully because of an error.";
    
}

?>