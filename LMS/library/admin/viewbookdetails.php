<?php
session_start();
if (!$_SESSION['name']) {
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];

include '../connect.php';
include 'main.php';

$isbn = $_GET["isbn"];

$result = mysqli_query($con, "select * from book_status join books on book_status.isbn = books.isbn where book_status.isbn=$isbn");
$row1 = mysqli_fetch_array($result);
?>


<div class="row">
    <div class="col">
        <div class="container mt-3 mb-5">

            <h2 style="text-align: center;">View Book</h2>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-4">
    <div class="book_card mx-auto">
            <img src="<?php echo $row1["photo"] ?>" >
            <div class="descriptions">
                <h1><?php echo $row1["b_name"] ?></h1><br />
                <h5>ISBN : <?php echo $isbn ?></h5><br />
                <p>
                    <b>Author</b> : <?php echo $row1["author"] ?><br /></br>
                    <b>Description</b> : <?php echo $row1["b_description"] ?><br /><br />
                    <b>Year of publication</b> : <?php echo $row1["year"] ?><br /><br />
                    <b>Language</b> : <?php echo $row1["language"] ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="container-fluid">
            <table class="table" id="myTable">
                <thead class="thead">
                    <tr>
                        <td>Book ID</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $result = mysqli_query($con, "select * from book_status where isbn=$isbn");
                    while ($row = mysqli_fetch_array($result)) {
                        $status = $row["status"];
                        if ($status === "0") {

                            $r_status = '<p style="text-align:center; color:white; background-color:green;">Available</p>';
                        } else {

                            $r_status = '<p style="text-align:center; color:black; background-color:RED;">Acquired</p>';
                        }
                        echo '
                <tr>
                    <td>' . $row["b_id"] . '</td>
                    <td>' . $r_status . '</td>
                    <td><a class="btn btn-danger" href="deletebook.php?b_id=' . $row["b_id"] . '" class="action">DELETE</a></td>
                    </tr>
            ';
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</div>

<div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    
</div>
</body>

</html>