<?php
    session_start();
    $R_id = $_SESSION["usrid"];
    $CMaterial_id = $_POST["collectormaterialID"];


    //connect to database
    $conn = new mysqli("localhost", "root", "", "greenearth");

    // this is to find income by using id
    $id= "SELECT * FROM collectormaterial WHERE COLLECTORMATERIAL_ID = '$CMaterial_id'";
    $result = $conn->query($id);
    $row = $result->fetch_assoc();



    if($conn ->connect_error){
      die("Connection error");
    }


    $sql = "DELETE FROM collectormaterial WHERE COLLECTORMATERIAL_ID = '$CMaterial_id'";

    //execute the query
    if($conn->query($sql) == TRUE){
        echo "<script type='text/javascript'> alert('Remove successfully'); </script>";
        echo "<script type='text/javascript'> window.location='viewMaterial_c.php'</script>";


    }
    else{
      echo "<script type='text/javascript'> alert('Sorry, material cannot be removed because some of the Recycler has make appointment on the it'); </script>";
      echo "<script type='text/javascript'> window.location='viewMaterial_c.php'</script>";
    }



?>
