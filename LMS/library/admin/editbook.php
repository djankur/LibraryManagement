<?php
session_start();
if (!$_SESSION['name']) {
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];
include '../connect.php';
include 'main.php';




$isbn=$_GET["isbn"];

    

$result = mysqli_query($con, "select * from books where isbn=$isbn");
$row = mysqli_fetch_array($result);

?>


                      

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>





     <h1 style="text-align: center;">Edit Form</h1>
    <form action="editbook1.php" method="POST" enctype="multipart/form-data">
        
    <div class="row g-2">
       
    <div class="col-md">
            <div class="form-floating mb-3 ">

                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="<?php echo $row["isbn"] ?>" readonly>
                <label for="isbn"> ISBN </label>
            </div>
        </div>
 </div>

    <div class="row g-2">

    <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="b_name" id="book_name" placeholder="Bookname"value="<?php echo $row["b_name"] ?>" required>
                <label for="book_name"> Book Name </label>
            </div>
        </div>
   

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="b_description" id="description" placeholder="Description" value="<?php echo $row["b_description"] ?>" required> 
                <label for="description"> Description </label>
            </div>
        </div>

        </div>

        <div class="row g-2">
    <div class="col-md">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="quantity" min="1" max="100" id="quantity" placeholder="Quantity" value="<?php echo $row["quantity"] ?>" readonly required>
                <label for="quantity"> Quantity </label>

            </div>
        </div>
   

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="author" id="author" placeholder="Author" value="<?php echo $row["author"] ?>" required>
                <label for="author"> Author </label>
            </div>
        </div>
        </div>

    <div class="row g-2">

    <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="year" id="year" placeholder="Year of publishing" value="<?php echo $row["year"] ?>" required>
                <label for="year"> year </label>
            </div>
        </div>
    

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="category" id="category" placeholder="Category" value="<?php echo $row["category"] ?>" required>
                <label for="category"> Category </label>
            </div>
        </div>

    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="language" id="language" placeholder="Language" value="<?php echo $row["language"] ?>" required>
                <label for="language"> Language </label>
            </div>
        </div>

        <div class="col-md">
            <div><label for="file"> Photo </label>

                <input type="file" class="form-control" name="file" id="file" value="<?php echo $row["photo"] ?>" required>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-md btn-success" value="Update Book" name="submit">

    </form>
    
    

 </body>

     </body>
 </html> 


