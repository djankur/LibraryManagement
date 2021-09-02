<?php

// Get the s_id 
$s_id = $_REQUEST['s_id'];

include '../connect.php';

if ($s_id !== "") {

      $query = mysqli_query($con, "SELECT * FROM student WHERE s_id='$s_id'");

      if (mysqli_num_rows($query) > 0) {
      
      $row = mysqli_fetch_array($query);

      $s_name = $row["s_name"];
      $department = $row["department"];

      $issued_book = 0;
      $result =  mysqli_query($con, "SELECT * FROM book_issue WHERE s_id=$s_id and issue_status='ACQ'");

      if (mysqli_num_rows($result) > 0) {
         $issued_book = mysqli_num_rows($result);
      }

      // Store it in a array
      $result = array("$s_name", "$department", "$issued_book");
   }else {
      $result = array(NULL, NULL, NULL);
   }
}



// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
