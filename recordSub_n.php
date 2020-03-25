<?php
    session_start();
    $userId = $_SESSION['usrid'];
    //$Sub_ID = $_POST['sub_id'];
    $R_id = $_POST['R_id'];
    $Mat_id = $_POST['materialID'];
    //$point = $_POST['points'];
    $weight = $_POST['weight'];




    //local date
    $date = date("Y-m-j");

    //connect to database
    $conn = new mysqli("localhost", "root", "", "greenearth");

    if($conn ->connect_error){
      die("Connection error");
    }

    //find recycler's name
    $sql10 = "SELECT * FROM user WHERE id = '$R_id'";
    $fname = $conn->query($sql10);
    $row4 = $fname->fetch_assoc();
    $recycler_name = $row4['username'];

    //find point per kg for materialLi
    $sql7 = "SELECT * FROM material WHERE MATERIAL_ID = '$Mat_id'";
    $fmat = $conn->query($sql7);
    $row2 = $fmat->fetch_assoc();
    $mat_point = $row2['POINTSPERKG'];

    //point awared
    $award = $mat_point * $weight;

    //find COLLECTORMATERIAL_ID by using material_id
    $sql8 = "SELECT * FROM collectormaterial WHERE MATERIAL_ID = '$Mat_id'";
    $fmatc = $conn->query($sql8);
    $row3 = $fmatc->fetch_assoc();
    $cm_id = $row3['COLLECTORMATERIAL_ID'];


    //find ecolevel and totalpoints of recyclers
    $sql3 = "SELECT * FROM user WHERE username = '$recycler_name'";
    $test= $conn->query($sql3);
    $row1 = $test->fetch_assoc();
    //$Recyler_lvl = $row1['ecolevel'];
    $R_total = $row1['totalpoint'];
    //$R_id = $row1['id'];


    //find total point of collector
    $sql2 = "SELECT user.username, user.totalpoint, user.ecolevel
             FROM user
             INNER JOIN collectormaterial
             ON user.id = collectormaterial.id
             INNER JOIN submission
             ON submission.COLLECTORMATERIAL_ID = collectormaterial.COLLECTORMATERIAL_ID";
   $link = $conn->query($sql2);
   $row = $link->fetch_assoc();
   $C_total = $row['totalpoint'];



    //record submission
    // $sql4 = "UPDATE submission
    //         SET WEIGHT_IN_KG = '$weight' , POINTS_AWARDED = '$award', ACTUAL_DATE = '$date', STATUS = 'Submitted'
    //         WHERE SUBMISSION_ID = '$Sub_ID'";
    $sql4 = "INSERT INTO submission (PROPOSED_DATE, WEIGHT_IN_KG, POINTS_AWARDED, ACTUAL_DATE, STATUS, RECYCLER_USERNAME, COLLECTORMATERIAL_ID )
            VALUES('$date', '$weight', '$award', '$date', 'Submitted', '$recycler_name', '$cm_id')";

    //update totalpoints of recycler
    $Rnew_total = $R_total + $award;

    //condition of ecoLevel
    if($Rnew_total < 100){
      $R_level = 'Newbie';
      }
    else if($Rnew_total >= 100 && $Rnew_total < 500){
      $R_level = 'EcoSaver';
      }
    else if($Rnew_total >= 500 && $Rnew_total < 1000){
      $R_level = 'Eco-Hero';
      }
    else{
      $R_level = 'Eco-Warrior';
      }

    //update recyler evolevel
    $sql5 = "UPDATE user
             SET totalpoint = '$Rnew_total' , ecolevel = '$R_level'
             WHERE username = '$recycler_name'";

    //update collector totalpoint
    $Cnew_total = $C_total + $award;
    $sql6 = "UPDATE user
             SET totalpoint = '$Cnew_total'
             WHERE id = '$userId'";

    //update the COLLECTORMATERIAL_ID of the submission if material not match
    // $sql9 = "UPDATE submission
    //          SET COLLECTORMATERIAL_ID = '$cm_id'
    //          WHERE SUBMISSION_ID = '$Sub_ID'";


    if(empty($weight)){
      $alert = '<div class="alert alert-danger alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	<strong> Input cannot be empty </strong></div>';
    	$_SESSION['alert'] = $alert;
    	echo "<script type='text/javascript'>
    	window.location = 'recordApp.php'; </script>";
    }

    else{
      $conn->query($sql4);
      $conn->query($sql5);
      $conn->query($sql6);
      // $conn->query($sql9);

      $alert = '<div class="alert alert-success alert-dismissible">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	<strong> Record New Submission Succesfully !! </strong></div>';
    	$_SESSION['alert'] = $alert;
    	echo "<script type='text/javascript'>
    	window.location = 'recordApp.php'; </script>";




    }




?>
