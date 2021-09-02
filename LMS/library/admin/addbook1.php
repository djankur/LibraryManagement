<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }

	#barcode{
		float: left;
		margin-left: 12px;
		padding-left: 3%;
	}
</style>
</head>
<body onload="window.print();">
<?php

include '../connect.php';
require "vendor/autoload.php";

$Bar = new Picqer\Barcode\BarcodeGeneratorHTML();

$b_name = $_POST["b_name"];
$b_description = $_POST["description"];
$quantity = $_POST["quantity"];
$author = $_POST["author"];
$year = $_POST["year"];
$category = $_POST["category"];
$isbn = $_POST["isbn"];
$language = $_POST["language"];
$file = $_FILES["file"];

if (isset($_POST['submit'])) {

	$filename = $file['name'];
	$filerror = $file['error'];
	$filetemp = $file['tmp_name'];
	$filetype = $file['type'];
	$filesize = $file['size'];
	$success_msg = false;
	$resultset = array();

	$fileExt = explode('.', $filename);
	$fileActualEXt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png');

	if (in_array($fileActualEXt, $allowed)) {
		if ($filerror === 0) {
			if ($filesize < 5120000) {
				$filenamenew = uniqid('', true) . "." . $fileActualEXt;
				$filedestination = 'uploads/' . $filenamenew;
				move_uploaded_file($filetemp, $filedestination);

				$query = "INSERT INTO books VALUES ('$b_name', '$b_description', '$quantity', '$author', '$year', '$category', '$isbn', '$filedestination', '$language') ON DUPLICATE KEY UPDATE quantity = quantity + $quantity; ";


				if (mysqli_query($con, $query)) {

					for ($i = 0; $i < $quantity; $i++) {

						$query2 = "INSERT INTO book_status VALUES (NULL,'$isbn', 0)";
						$result = mysqli_query($con, $query2);
						$success_msg = true;
					}
						if ($success_msg) {
							?>
							<SCRIPT> 
        						alert('Successfuly Generated Book IDs');
    						</SCRIPT>
							<div style="margin-left: 5%">
								<?php
								$bid_query= "SELECT b_id FROM book_status WHERE isbn = $isbn ORDER BY b_id LIMIT $quantity;";
								$res = mysqli_query($con, $bid_query);
								
								

								while($get_bid = mysqli_fetch_array($res)){
									$code = $Bar->getBarcode($get_bid['b_id'], $Bar::TYPE_CODE_128);
									echo "<div id = 'barcode'><p class='inline'><span ><b>isbn: $isbn</b></span>".$code."<span ><b>Book ID: ".$get_bid['b_id']." </b></span></p></div>&nbsp";
								}

								?>
							</div>
							<?php

					}else{
						echo "<SCRIPT> 
        				alert('Unable to process. Try again.')
       					 window.location.replace('addbook.php');
    					</SCRIPT>";
					}
				} else {
					echo mysqli_error($con);
				}
			} else {
				echo "File size should be less than 5mb";
			}
		} else {
			echo "There was an error uploading your file";
		}
	} else {
		echo " Invalid File type";
	}
}
?>
</body>
</html>

