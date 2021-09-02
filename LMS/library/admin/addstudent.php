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





<h1 style="text-align: center;">Student Registration</h1>
<form action="addstudent1.php" method="POST">

    <div class="row g-2">

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="s_name" id="name" required placeholder="Name">
                <label for="name"> Name </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="s_password" id="password" required placeholder="Password">
                <label for="password"> Password </label>
            </div>
        </div>
    </div>


    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="s_email" id="email" required placeholder="E-mail">
                <label for="email"> E-mail </label>

            </div>
        </div>


        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="s_phone" id="phone" required placeholder="Phone">
                <label for="phone"> Phone </label>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-3">

                <input type="text" class="form-control" name="s_address" id="address" required placeholder="Address">
                <label for="address"> Address </label>
            </div>
        </div>



        <div class="col-md">
            <div class="form-floating mb-3">

                <select class="form-select" id="branch_select" name="department" required>
                    <option selected disabled value="">Select Branch</option>
                    <option value="MCA">Master of Computer Application</option>
                    <option value="CIV">Civil Engineering</option>
                    <option value="CSE">Computer Science Engineering</option>
                    <option value="MEC">Mechanical Engineering</option>
                    <option value="EEE">Electrical & Electronics Engineering</option>
                </select>
                <label for="branch_select">Branch Options</label>
            </div>
        </div>
    </div>



    <input type="submit" class="btn btn-md btn-success" value="Add Student" name="submit">

</form>


</body>

</body>