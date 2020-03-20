<?php
    session_start();
    $MaterialID = $_POST["materialID"];
    $userId = $_SESSION['usrid'];


    //connect to database
    $conn = new mysqli("localhost", "root", "", "greenearth");

    if($conn ->connect_error){
      die("Connection error");
    }


    $sql = "INSERT INTO collectormaterial (id, MATERIAL_ID)
            VALUES('$userId', '$MaterialID')";

    //check the material exist or not
    $mat = "SELECT * FROM collectormaterial WHERE MATERIAL_ID = '$MaterialID'";
    $result2 = mysqli_query($conn,$mat);

    if(mysqli_num_rows($result2) != 0)
    {
    	$alert = '<div class="alert alert-danger alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	<strong> Material with ID: ' . $MaterialID .' has already added. </strong></div>';
    	$_SESSION['alert'] = $alert;
    	echo "<script type='text/javascript'>
    	window.location = 'viewMaterial_c.php'; </script>";
    }

    else{
      //execute the query
      if($conn->query($sql) == TRUE){
        $alert = '<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> New material has been added successfully in list. </strong></div>';
        $_SESSION['alert'] = $alert;
        echo "<script type='text/javascript'>
        window.location = 'viewMaterial_c.php'; </script>";


      }
      else{
        echo "Fail";
      }

  }



?>
