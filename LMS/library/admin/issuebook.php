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





<html>

<body>

  <style>
    .col {
      margin: 20px;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js">
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>


  <form class="form-issuebook" action="issuebook1.php" method="POST">

    <div class="row">

      <div class="col">
        <input type="text" name="b_id" class="form-control" onkeyup="GetDetail(this.value)" placeholder="Enter the Book ID">

      </div>

      <div class="col">
        <input type="text" name="s_id" class="form-control" onkeyup="GetStudent(this.value)" placeholder="Enter the Student ID">

      </div>

    </div>

    <div class="row">

      <div class="col">
        ISBN:
        <input type="text" name="isbn" id="isbn" class="form-control-plaintext readonly" placeholder='Invalid book id' value="" required>
      </div>

      <div class="col">
        Student Name:
        <input type="text" name="s_name" id="s_name" class="form-control-plaintext readonly" placeholder='Invalid student id' value="" required>
      </div>

    </div>

    <div class="row">
      <div class="col">
        Book Name:
        <input type="text" name="name" id="name" class="form-control-plaintext readonly" placeholder='Invalid book id' value="" required>
      </div>

      <div class="col">
        Department:
        <input type="text" name="department" id="department" class="form-control-plaintext readonly" placeholder='Invalid student id' value="" required>
      </div>
    </div>

    <div class="row">
      <div class="col">
        Status:
        <input type="text" name="status" id="status" class="form-control-plaintext readonly" placeholder='Invalid book id' value="" required>
      </div>
      <div class="col">
        Total books issued by the student:
        <input type="text" name="issued_books" id="issued_books" class="form-control-plaintext readonly" placeholder='Maximum 5 books ' value="" required>
      </div>
    </div>


    <input class="btn btn-md btn-primary btn-block text-uppercase" name="submit" id="submit" type="submit" disabled=true><br><br>

  </form>

  <script>
    // readonly fields
    $(".readonly").on('keydown paste focus mousedown', function(e) {
      if (e.keyCode != 9) // ignore tab
        e.preventDefault();
    });
  </script>

  <script>
    // onkeyup event will occur when the user 
    // release the key and calls the function
    // assigned to this event
    let disableBook = true;
    let disableStudent = true;

    function GetDetail(str) {
      document.getElementById("submit").disabled = true;
      document.getElementById("status").classList.remove("text-white", "bg-success", "bg-danger", "fw-bolder");
      document.getElementById("status").value = "";

      if (str.length == 0) {
        document.getElementById("isbn").value = "";
        document.getElementById("name").value = "";
        document.getElementById("status").value = "";
        return;
      } else {

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

          // Defines a function to be called when
          // the readyState property changes
          if (this.readyState == 4 &&
            this.status == 200) {

            // Typical action to be performed
            // when the document is ready
            var myObj = JSON.parse(this.responseText);

            // Returns the response data as a
            // string and store this array in
            // a variable assign the value 
            // received to isbn input field

            document.getElementById("isbn").value = myObj[0];

            // Assign the value received to
            // other input field
            document.getElementById("name").value = myObj[1];;
            if (myObj[2] == 1 || myObj[2] === null) {
              disableBook = true;
              if(myObj[2] == 1){
              document.getElementById("status").value = "Acquired";
              document.getElementById("status").classList.add("text-white", "bg-danger", "fw-bolder");
              document.getElementById("status").classList.remove("bg-success");
              }

            } else if (myObj[2] == 0 && myObj[2] != "") {
              disableBook = false;
              console.log(myObj);
              document.getElementById("status").value = "Available";
              document.getElementById("status").classList.add("text-white", "bg-success", "fw-bolder");
              document.getElementById("status").classList.remove("bg-danger");
            }
            if (!disableBook && !disableStudent) {
              document.getElementById("submit").disabled = false;
            }
          }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "getbookdetails.php?b_id=" + str, true);

        // Sends the request to the server
        xmlhttp.send();
      }
    }

    function GetStudent(str) {
      document.getElementById("submit").disabled = true;
      document.getElementById("issued_books").classList.remove("text-white", "bg-success", "bg-danger", "fw-bolder");

      if (str.length == 0) {
        document.getElementById("s_name").value = "";
        document.getElementById("department").value = "";
        document.getElementById("issued_books").value = "";


        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

          if (this.readyState == 4 &&
            this.status == 200) {

            var myObj = JSON.parse(this.responseText);


            document.getElementById("s_name").value = myObj[0];
            document.getElementById("department").value = myObj[1];
            document.getElementById("issued_books").value = myObj[2];

            if (myObj[2] >= 5 || myObj[2] == -1 || myObj[2] === null) {
              disableStudent = true;
              if (myObj[2] >= 5) {
                document.getElementById("issued_books").classList.add("text-white", "bg-danger", "fw-bolder");
                document.getElementById("issued_books").classList.remove("bg-success");
              }
            } else {
              disableStudent = false;
              document.getElementById("issued_books").classList.add("text-white", "bg-success", "fw-bolder");
              document.getElementById("issued_books").classList.remove("bg-danger");
              console.log(disableStudent);
              console.log(myObj[2]);
            }
            if (!disableBook && !disableStudent) {
              document.getElementById("submit").disabled = false;
            }
          }
        };

        xmlhttp.open("GET", "getstudentdetails.php?s_id=" + str, true);

        xmlhttp.send();
      }
    }
  </script>

</body>

</html>