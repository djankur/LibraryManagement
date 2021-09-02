<?php
session_start();
if (!$_SESSION['name']) {
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];

include '../connect.php';

include 'main.php';
// $con=mysqli_connect("localhost","root1","pass","library")or die("can't connect...");

$sql = ("SELECT COUNT(s_id) FROM student");
$rs = mysqli_query($con, $sql);
$sql2 = ("SELECT COUNT(b_id) FROM book_status");
$rs2 = mysqli_query($con, $sql2);

$result = mysqli_fetch_array($rs);
$result2 = mysqli_fetch_array($rs2);

$sql3 = ("SELECT COUNT(transaction_id) FROM book_issue where issue_status='ACQ'");
$result3 = mysqli_query($con, $sql3);
$total_issue_book = mysqli_fetch_array($result3);

$sql4 = ("SELECT count(b_id) FROM book_status where status = 0");
$result4 = mysqli_query($con, $sql4);
$available_book = mysqli_fetch_array($result4);

$sql5 = ("SELECT distinct count(b_id) FROM book_issue where issue_status='RET'");
$result5 = mysqli_query($con, $sql5);
$total_returned_book = mysqli_fetch_array($result5);

echo mysqli_error($con);

?>



<div class="row">
    <div class="col">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Total Students: <?php echo $result[0]; ?> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="viewstudent.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body">Total books: <?php echo $result2[0]; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="viewbook.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Available books: <?php echo $available_book[0]; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="available.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Issued books: <?php echo $total_issue_book[0]; ?> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="issuebook.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">Return book: <?php echo $total_returned_book[0]; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="returnBook.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>



<div class="container my-4" id="viewstudent">

    <h1 style="text-align: center;">Transaction History</h1>
</div>


<div class="container my-4">
    <table class="table" id="myTable">
        <thead class="thead">
            <tr>
                <td>Transaction ID</td>
                <td>Student ID</td>
                <td>Name</td>
                <td>Book Id</td>
                <td>ISBN</td>
                <td>Book Name</td>
                <td>Status</td>
                <td>Day remaining</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php

            $query = 'SELECT * FROM (((book_issue INNER JOIN student ON book_issue.s_id = student.s_id) INNER JOIN book_status ON book_issue.b_id = book_status.b_id )INNER JOIN books ON book_status.isbn=books.isbn) order by book_issue.return_date ASC';
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
                $status = $row["issue_status"];
                $return_time = strtotime($row["return_date"]);
                $current_time = strtotime(date("Y-m-d"));
                $offset = 24 * 60 * 60;
                $remaining = $return_time - $current_time;
                $remaining_day = floor($remaining / $offset);
                $r_str = "";
                $r_status = "";
                $action = "";

                if ($status === "RET") {
                    $r_str = '<p style="text-align:center; color:white; background-color:green;">CLEAR</p>';
                    $r_status = '<p style="text-align:center; color:white; background-color:green;">RETURNED</p>';
                    $action = '<button class="btn btn-dark" disabled="disabled">RETURN</button>';
                } else {
                    $r_str = $remaining_day > 0 ? '<p style="text-align:center; color:black; background-color:yellow;">' . $remaining_day . " day remains</p>" : '<p style="text-align:center; color:black; background-color:red;">' . abs($remaining_day) . " day penalty</p>";
                    $r_status = '<p style="text-align:center; color:black; background-color:RED;">ACQUIRED</p>';
                    $action = '<button class="btn btn-dark"><a style="text-decoration:none;" href="returnBook.php?s_id=' . $row["s_id"] . '&& isbn=' . $row["isbn"] . '&& s_name=' . $row["s_name"] . '&& b_id=' . $row["b_id"] . '&& b_name=' . $row["b_name"] . '&& t_id=' . $row["transaction_id"] . '" class="action">RETURN</a></button>';
                }

                echo '
                <tr>
                    <td style="vertical-align:middle;">' . $row["transaction_id"] . '</td>
                    <td style="vertical-align:middle;">' . $row["s_id"] . '</td>
                    <td style="vertical-align:middle;">' . $row["s_name"] . '</td>
                    <td style="vertical-align:middle;">' . $row["b_id"] . '</td>
                    <td style="vertical-align:middle;">' . $row["isbn"] . '</td>
                    <td style="vertical-align:middle;">' . $row["b_name"] . '</td>
                    <td style="vertical-align:middle;">' . $r_status . '</td>
                    <td style="vertical-align:middle;">' . $r_str . '</td>
                    <td>' . $action . '</td>
                </tr>
    ';
            }
            ?>
        </tbody>


    </table>
</div>


</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2021</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>



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
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#myTable2').DataTable({
            responsive: true
        });

    });
</script>


</body>

</html>