<?php

$DonorName = $_POST['DonorName'];
$DonorEmail = $_POST['DonorEmail'];
$DonorPassword = $_POST['DonorPassword'];
#$NgoName = $_POST['NgoName'];
#$NgoEmail = $_POST['NgoEmail'];
#$NgoPassword = $_POST['NgoPassword'];
if(!empty($DonorName)||!empty($DonorEmail)||!empty($DonorPassword))#||!empty($NgoName)||!empty($NgoPassword)||!empty($NgoEmail))
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
    $SELECT="SELECT DonorEmail From logininfo Where DonorEmail=? Limit 1";
    $INSERT ="INSERT Into logininfo(DonorName,DonorEmail,DonorPassword) values(?,?,?)";
    //Prepare Statement
    $stmt=$conn->prepare($SELECT);
    $stmt->bind_param("s", $DonorEmail);
    $stmt->execute();
    $stmt->bind_result($DonorEmail);
    $stmt->store_result();
    $rnum=$stmt->num_rows;
    #echo $rnum;
    if($rnum==0)
    {
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("sss",$DonorName,$DonorEmail,$DonorPassword);
        $stmt->execute();
        #echo "New Record Inserted Successfully";
        header('Location: http://localhost/donation.html');
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