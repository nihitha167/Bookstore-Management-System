<?php
		$DBHost = "sysmysql8.auburn.edu";
		$DBUser = "";
		$DBPass = "";
		$DBName = "";
		$conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
		
		if (mysqli_connect_errno()) {
			print "Failed to connect to database " ;
			die;
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bookstore System - Nihitha Reddy S</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  </head>
<body>
    <br>
        <center>
            <h3  style= "color:purple;"><u>
                 Online Bookstore System - Nihitha Reddy S
            </u>
            </h3>
        </center>
  <div class = "containter-fluid p-5">
	<form method="get">
			<div>
				<label for="input"><b>Enter A Input Query: </b></label>
                                <br>
				<textarea rows="3" cols="100" name="input"></textarea>
			</div>
		<button type="submit" class="btn btn-primary" name = "submit">Submit</button>
	</form>
    <?php 
        $sql_query = $_GET["input"];
        $sql_query = stripslashes($sql_query);
        $check_for_drop = strtoLower($sql_query);
        $check_for_update=strtoLower($sql_query);
        $update="update";
        $drop = "drop";
        if (strpos($check_for_drop, $drop) !== false) { ?>
        <br>
        <h6 style="color:red;">No DROP statements are allowed</h6>
        <h6 style="color:blue;">Try another query</h6>
        <?php 
        }
        elseif(empty($sql_query) and isset($_GET["submit"]) ) {     ?>
        <br> 
	<h6 style="color:red;">Empty form </h6>
        <h6 style="color:blue;"> Try another query</h6>
        <?php   
        }
        else {
        $sol = $conn->query($sql_query);
        if (mysqli_error($conn)) { ?>
        <br>
        <h6 style="color:red;"><?php print mysqli_error($conn)?></h6> 
        <?php
        }
        else {
         if (strpos($check_for_update, $update) !== false) {
             print "Updated";
        }
        $count_rows = mysqli_num_rows($sol);
        $info = mysqli_fetch_fields($sol);
    ?>
    <table  class = "table table-hover table-bordered table-striped">
	       <thead>
		      <tr>
                  <?php 
                    $count = 0;
                  foreach($info as $val) { 
                  ?>
	          <th scope="col"><?php print $val->name ?></th>
                  <?php 
                    $count++;
                    } 
                  ?>
		      </tr>
	       </thead>
	       <?php while ($row = mysqli_fetch_row($sol)) { ?> 
            <tr>  
                <?php for ($i = 0; $i < $count; $i++) { ?>
                <td><?php print $row[$i];?></td>
                <?php } ?>
            </tr>
            <?php } ?>
    </table>
 
    <?php
            if (isset($count_rows)) {
     ?>
            <h6 style="color:green;"><?php print "Number of rows displayed: ". $count_rows?></h6>
    <?php
            }
      }
    }
    ?>
</div>
<div class="container">
    <h3>Tables</h3>
  <ul >
      <li>Book</li>
      <li>Customer</li>
      <li>Employee</li>
      <li>Orders</li>
      <li>Order Details</li>
      <li>Shipper</li>
      <li>Supplier</li>
      <li>Subject</li>
  </ul>
<div>
     <div>
    <div id="m0" class="tab-pane fade in active">
      <h3>Book</h3>
        <table >
	       <thead>
               print "<tr>";
               print "<td>" . $row["BookID"] . "</td>";
               print "<td>" . $row["Title"] . "</td>";
               print "<td>" . $row["UnitPrice"] . "</td>";
               print "<td>" . $row["Author"] . "</td>";
               print "<td>" . $row["Quantity"] . "</td>";
               print "<td>" . $row["SupplierID"] . "</td>";
               print "<td>" . $row["SubjectID"] . "</td>";
               print "</tr>";	       
               </thead>
	       <?php	
		      $sql_query = "Select * FROM Book";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["BookID"] . "</td>";
             print "<td>" . $row["Title"] . "</td>";
             print "<td>" . $row["UnitPrice"] . "</td>";
             print "<td>" . $row["Author"] . "</td>";
             print "<td>" . $row["Quantity"] . "</td>";
             print "<td>" . $row["SupplierID"] . "</td>";
             print "<td>" . $row["SubjectID"] . "</td>";
             print "</tr>";
            <?php } ?>
        </table>
  </div>
    <div id="m1" class="tab-pane fade">
      	       <?php	
		      $sql_query = "SELECT * FROM Orders";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["OrderID"] . "</td>";
             print "<td>" . $row["CustomerID"] . "</td>";
             print "<td>" . $row["EmployeeID"] . "</td>";
             print "<td>" . $row["OrderDate"] . "</td>";
             print "<td>" . $row["ShippedDate"] . "</td>";
             print "<td>" . $row["ShipperID"] . "</td>";
             print "</tr>";
            <?php } ?>
        </table>
    </div>
        <div id="m2" class="tab-pane fade" >
	       <?php	
		      $sql_query = "SELECT * FROM Supplier";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["SupplierID"] . "</td>";
             print "<td>" . $row["CompanyName"] . "</td>";
             print "<td>" . $row["ContactLastName"] . "</td>";
             print "<td>" . $row["ContactFirstName"] . "</td>";
             print "<td>" . $row["Phone"] . "</td>";
             print "</tr>";
            <?php } ?>
        </table>
    </div>

    <div id="m3" class="tab-pane fade">
      	       <?php	
		      $sql_query = "SELECT * FROM Employee";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["EmployeeID"] . "</td>";
             print "<td>" . $row["LastName"] . "</td>";
             print "<td>" . $row["FirstName"] . "</td>";
             print "</tr>";
            <?php } ?>
        </table>
    </div>
    <div id="m4" class="tab-pane fade">
      	       <?php	
		      $sql_query = "SELECT * FROM OrderDetail";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["BookID"] . "</td>";
             print "<td>" . $row["OrderID"] . "</td>";
             print "<td>" . $row["Quantity"] . "</td>";
             print "</tr>";            
       <?php } ?>
        </table>
      </div>
    <div id="m5" class="tab-pane fade">
   	       <?php	
		      $sql_query = "SELECT * FROM Subject";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["SubjectID"] . "</td>";
             print "<td>" . $row["CategoryName"] . "</td>";
             print "</tr>";            
         <?php } ?>
        </table>
    </div>
   </div>
</div>
    <div id="m6" class="tab-pane fade">
      	       <?php	
		      $sql_query = "SELECT * FROM Customer";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["CustomerID"] . "</td>";
             print "<td>" . $row["LastName"] . "</td>";
             print "<td>" . $row["FirstName"] . "</td>";
             print "<td>" . $row["Phone"] . "</td>";
             print "</tr>";
            <?php } ?>
        </table>
    </div>
    <div id="m7" class="tab-pane fade">
    	       <?php	
		      $sql_query = "SELECT * FROM Shipper";
		      $sol = $conn->query($sql_query);
		      $count_rows = mysql_num_rows($sol);
            while ($row = mysqli_fetch_assoc($sol)) {
            ?> 
             print "<tr>";
             print "<td>" . $row["ShipperID"] . "</td>";
             print "<td>" . $row["ShipperName"] . "</td>";
             print "</tr>";            
       <?php } ?>
        </table>
    </div>


</body>
</html>
