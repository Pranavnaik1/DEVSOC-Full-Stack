<?php

$NgoName = $_POST['NgoName'];
$NgoEmail = $_POST['NgoEmail'];
$NgoPassword = $_POST['NgoPassword'];
if(!empty($NgoName)||!empty($NgoPassword)||!empty($NgoEmail))
{
$host = 'localhost'; // Replace with your database host
$dbName = 'MyPhilanthropy'; // Replace with your database name
$username = 'Atharva'; // Replace with your database username
$password = "hi123"; // Replace with your database password

// Create database connection
$conn = new mysqli($host,$username,$password,$dbName);
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
    echo"DB connected successfullly";
    $SELECT="SELECT NgoEmail From logininfo Where NgoEmail=? Limit 1";
    $INSERT ="INSERT Into logininfo(NgoName,NgoEmail,NgoPassword) values(?,?,?)";
    //Prepare Statement
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_param("s", $NgoEmail);
    $stmt->execute();
    $stmt->bind_result($NgoEmail);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    echo $rnum;
    if($rnum==0)
    {
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("sss",$NgoName,$NgoEmail,$NgoPassword);
        $stmt->execute();
        header('Location: http://localhost/idk.php');
        #echo "New Record Inserted Successfully";
    }
    
    else{
        echo "Someone already registered using this E-mail";
    }
    $stmt->close();
    $conn->close();
}
}
else
{
    echo "All fields are required...";
    die();
}
?>