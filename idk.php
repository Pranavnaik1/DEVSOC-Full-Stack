<!DOCTYPE html> 
<html> 
	<head> 
		<title> Fetch Data From Database </title> 
        <title>NGO Dashboard</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
	</head> 
	<body> 
    <header>
    <h1>Welcome, NGO!</h1>
    </header>
    <section>
      <h2>Donation List</h2>
      <ul id="donation-list"></ul>
    </section>

	<table align="center" border="1px" style="width:600px; line-height:40px;">
	<tr> 
		<th colspan="4"><h2>Donor Records</h2></th> 
		</tr> 
			  <th> DonorName </th> 
			  <th> ItemName </th> 
			  <th> ItemQuantity </th> 
			  <th> ItemAddress </th> 
			  
		</tr> 

        <?php
        $conn = mysqli_connect("localhost", "root", "", "MyPhilanthropy");
        // Check connection
        
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT DonorName, ItemName, ItemQuantity, ItemAddress FROM inventory";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["DonorName"]. "</td><td>" . $row["ItemName"] . "</td><td>"
        . $row["ItemQuantity"]. "</td><td>" .$row["ItemAddress"]. "</td></tr>";
        }
        echo "</table>";
        } else { echo "0 results"; }
        $conn->close();
        ?>
    </table> 
</body>
</html>


	