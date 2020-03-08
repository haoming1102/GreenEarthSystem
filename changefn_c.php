<?php
    session_start();
    $R_id = $_SESSION["usrid"];
    $C_name = $_POST["c_fullname"];


    //connect to database
    $conn = new mysqli("localhost", "root", "", "greenearth");

    // this is to find income by using id
    $name = "SELECT * FROM user WHERE id = '$R_ID'";
    $result = $conn->query($name);
    $row = $result->fetch_assoc();



    if($conn ->connect_error){
      die("Connection error");
    }


    $sql = "UPDATE user SET fullname = '$C_name' WHERE id = '$R_id'";

    //execute the query
    if($conn->query($sql) == TRUE){
        echo "<script type='text/javascript'> alert('Change fullname successfully'); </script>";
        echo "<script type='text/javascript'> window.location='r_pro.php'</script>";


    }
    else{
      echo "Fail";
    }



?>
