
<?php

 
// Get the isbn
$isbn = $_REQUEST['isbn'];
  
include '../connect.php';
  
if ($isbn !== "") {
      
    // Get corresponding first name and 
    // isbn for that isbn   
    $query = mysqli_query($con, "SELECT * FROM books WHERE isbn='$isbn'");

    $row = mysqli_fetch_array($query);
   
    $b_name = $row["b_name"];
    $description = $row["b_description"];
    $quantity = $row["quantity"];
    $author = $row["author"];
    $year = $row["year"];
    $category = $row["category"];
    $language = $row["language"];
    $photo = $row["photo"];

}
  
// Store it in a array
$result = array("$b_name","$description","$quantity","$author","$year","$category","$language","$photo");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;

?>