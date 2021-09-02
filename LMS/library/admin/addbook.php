<?php
session_start();
if (!$_SESSION['name']) {
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];


// $con=mysqli_connect("localhost","root1","pass","library")or die("can't connect...");
include '../connect.php';
include 'main.php';

//$name = $_GET["name"];

?>




<h1 style="text-align: center;">Input Form</h1>


<form action="addbook1.php" method="POST" enctype="multipart/form-data">

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3 ">

                <input type="text" class="form-control" name="isbn" id="isbn" onkeyup="GetDetail(this.value)" placeholder="ISBN" required>
                <label for="isbn"> ISBN </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="b_name" id="b_name" placeholder="Bookname" required>
                <label for="book_name"> Book Name </label>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
                <label for="description"> Description </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="quantity" min="1" max="100" id="quantity" placeholder="Quantity" required>
                <label for="quantity"> Quantity </label>

            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="author" id="author" placeholder="Author" required>
                <label for="author"> Author </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="year" id="year" placeholder="Year of publishing" required>
                <label for="year"> year </label>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="category" id="category" placeholder="Category" required>
                <label for="category"> Category </label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="language" id="language" placeholder="Language" required>
                <label for="language"> Language </label>
            </div>
        </div>

    </div>

    <div class="row g-2">


        <div class="col-md">
            <div><label for="file"> Photo </label>

                <input type="file" class="form-control" name="file" id="file" required>
            </div>
        </div>
        <div class="col-md">
            <input type="hidden" name="" class="form-control">
        </div>
    </div>

    <div class="col-md" style="margin-top: 20px;">
        <input type="submit" class="btn btn-md btn-success form-control" value="Add Book" name="submit">
    </div>
    </div>

</form>

<script>
    function GetDetail(str) {
        if (str.length == 0) {
            document.getElementById("b_name").value = "";
            document.getElementById("description").value = "";
            document.getElementById("quantity").value = "";
            document.getElementById("author").value = "";
            document.getElementById("year").value = "";
            document.getElementById("category").value = "";
            document.getElementById("language").value = "";
            document.getElementById("file").value = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

                if (this.readyState == 4 &&
                    this.status == 200) {

                    var myObj = JSON.parse(this.responseText);


                    document.getElementById("b_name").value = myObj[0];
                    document.getElementById("description").value = myObj[1];

                    document.getElementById("author").value = myObj[3];
                    document.getElementById("year").value = myObj[4];
                    document.getElementById("category").value = myObj[5];
                    document.getElementById("language").value = myObj[6];
                    document.getElementById("file").value = myObj[7];
                }
            };

            xmlhttp.open("GET", "getbookdetails1.php?isbn=" + str, true);

            xmlhttp.send();
        }
    }
</script>

</body>

</html>