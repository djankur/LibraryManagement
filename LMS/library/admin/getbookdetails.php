<?php

// Get the b_id 
$b_id = $_REQUEST['b_id'];

include '../connect.php';

if ($b_id !== "") {

    // Get corresponding first name and 
    // isbn for that b_id    
    $query = mysqli_query($con, "SELECT * FROM book_status WHERE b_id='$b_id'");

    if (mysqli_num_rows($query) > 0) {
     
        $row = mysqli_fetch_array($query);

        // Get the isbn
        $isbn = $row["isbn"];
        $status = $row["status"];


        $query2 = mysqli_query($con, "SELECT b_name FROM books WHERE isbn='$isbn'");
        $row2 = mysqli_fetch_array($query2);
        $name = $row2["b_name"];
        $result = array("$isbn", "$name", "$status");
    }
    else {
        $result = array(NULL, NULL, NULL);
    }
}

// Store it in a array


// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
