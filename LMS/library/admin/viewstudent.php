<?php
session_start();
if (!$_SESSION['name']) {
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];

include '../connect.php';
include 'main.php';
?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<div class="container my-4">

    <h1 style="text-align: center;">View Student</h1>
</div>


<div class="container my-4">
    <table class="table" id="myTable">
        <thead class="thead">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>E-mail</td>
                <td>Phone</td>
                <td>Address</td>
                <td>Department</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php

            $result = mysqli_query($con, "select * from student");
            while ($row = mysqli_fetch_array($result)) {
                echo '
                <tr>
                    <td>' . $row["s_id"] . '</td>
                    <td>' . $row["s_name"] . '</td>
                    <td>' . $row["s_email"] . '</td>
                    <td>' . $row["s_phone"] . '</td>
                    <td>' . $row["s_address"] . '</td>
                    <td>' . $row["department"] . '</td>
                    <td><button class="btn btn-primary"><a href="editstudent.php?s_id=' . $row["s_id"] . '">EDIT</a></button>
                        <button class="btn btn-danger"><a href="deletestudent.php?s_id=' . $row["s_id"] . '" class="action">DELETE</a></button></td>
                </tr>
            ';
            }
            ?>
        </tbody>


    </table>
</div>

<div>



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
</div>
</body>

</html>