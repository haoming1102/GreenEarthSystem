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

    //execute the query
    if($conn->query($sql) == TRUE){
        echo "<script type='text/javascript'> alert('Add successfully'); </script>";
        echo "<script type='text/javascript'> window.location='viewMaterial_c.php'</script>";


    }
    else{
      echo "Fail haha";
    }



?>
