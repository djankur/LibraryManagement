<?php
session_start();
if (!$_SESSION['s_name']) {
    header("LOCATION: login.php");
}
$s_name = $_SESSION['s_name'];

include '../connect.php';
$sql = mysqli_query($con, "SELECT * FROM student WHERE s_name='$s_name'");
$row1 = mysqli_fetch_array($sql);
$ss_id = $row1["s_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Library management system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900|Playfair+Display:400,700,900 " rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<style>
    html {
        overflow: auto;
    }

    body {
        padding: 0px;
        margin: 0px;
        overflow-x: hidden;
    }

    ::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    ::-webkit-scrollbar-track {
        background-color: #ebebeb;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #6d6d6d;
    }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-6 col-xl-2">
                        <h1 class="mb-0 site-logo m-0 p-0"><a href="studentpanel.php" class="mb-0">Library</a></h1>
                    </div>

                    <div class="col-12 col-md-10 d-none d-xl-block">
                        <nav class="site-navigation position-relative text-right" role="navigation">

                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                <li><a href="#home-section" class="nav-link">Home</a></li>
                                <li><a href="#profile-section" class="nav-link">Profile</a></li>
                                <li><a href="#borrow-section" class="nav-link">Borrowed Books</a></li>
                                <li><a href="logout.php" class="nav-link">Log-out</a></li>
                            </ul>
                        </nav>
                    </div>


                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>

        </header>



        <div class="site-blocks-cover overlay" style="background-image: url(../admin/images/background.jpg);" data-aos="fade" id="home-section">


            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col text-center">
                        <h1>LIBRARY MANAGEMENT SYSTEM</h1>
                        <h3 style="color: white; padding:100px;" class="mb-5">Welcome <?php echo $s_name ?>.</h3>

                    </div>
                </div>
            </div>

            <a href="#profile-section" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
        </div>


        <div class="site-section" id="profile-section">
            <div class="container">
                <h2 class="section-title mb-3">Profile</h2>

                <div class="card text-white bg-dark mb-3" style="height: 500px;">
                    <div class="card-body d-flex justify-content-around align-content-center flex-wrap" style="margin-left: 150px; margin-right: 150px;">
                        <div class="1">
                            <h3>ID: </h3>
                            <h3>Name: </h3>
                            <h3>Department:</h3>
                            <h3>E-mail: </h3>
                            <h3>Phone:</h3>
                            <h3>Address: </h3>
                        </div>
                        <div class="2">
                         <h3> <?php echo $row1["s_id"]; ?></h3>
                         <h3> <?php echo $row1["s_name"]; ?></h3>
                         <h3> <?php echo $row1["department"]; ?></h3>
                         <h3> <?php echo $row1["s_email"]; ?></h3>
                         <h3> <?php echo $row1["s_phone"]; ?></h3>
                         <h3> <?php echo $row1["s_address"]; ?></h3>
 
                        </div>
                    </div>
                </div>


            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mt-4">
                    <a href="editprofile.php?s_id=<?php echo $row1["s_id"] ?>" class="btn btn-primary btn-block">Edit Profile</a>
                </div>
            </div>
        </div>



        <section class="site-section border-bottom" id="borrow-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-7 text-left">
                        <h2 class="section-title mb-3">Borrowed Books</h2>
                    </div>
                </div>
               
                <table class="table" id="myTable">
        <thead class="thead">
            <tr>
                <th>Book Id</th>
                <th>ISBN</th>
                <th>Book Name</th>
                <th>Status</th>
                <th>Day remaining</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $query = "SELECT * FROM book_issue WHERE s_id=$ss_id ORDER BY issue_status ASC";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
                $status = $row["issue_status"];
                $return_time = strtotime($row["return_date"]);
                $current_time = strtotime(date("Y-m-d"));
                $offset = 24 * 60 * 60;
                $remaining = $return_time - $current_time;
                $remaining_day = floor($remaining / $offset);
            
            $bb_id=$row["b_id"];
            $iisbn=mysqli_query($con, "SELECT * FROM book_status WHERE b_id=$bb_id");
            $rowi=mysqli_fetch_array($iisbn);
            $bbname=$rowi["isbn"];
            $bname=mysqli_query($con, "SELECT * FROM books WHERE isbn=$bbname");
            $rowb=mysqli_fetch_array($bname);

                if ($status === "RET") {
                    $r_str = '<p style="text-align:center; color:white; background-color:green;">CLEAR</p>';
                    $r_status = '<p style="text-align:center; color:white; background-color:green;">RETURNED</p>';
                } else {
                    $r_str = $remaining_day > 0 ? '<p style="text-align:center; color:black; background-color:yellow;">' . $remaining_day . " day remains</p>" : '<p style="text-align:center; color:black; background-color:red;">' . abs($remaining_day) . " day penalty</p>";
                    $r_status = '<p style="text-align:center; color:black; background-color:RED;">ACQUIRED</p>';                }

                echo '
                <tr>
                    <td style="vertical-align:middle;">' . $row["b_id"] . '</td>
                    <td style="vertical-align:middle;">' . $rowi["isbn"] . '</td>
                    <td style="vertical-align:middle;">' . $rowb["b_name"] . '</td>
                    <td style="vertical-align:middle;">' . $r_status . '</td>
                    <td style="vertical-align:middle;">' . $r_str . '</td>
                </tr>
    ';
            }
            ?>
        </tbody>


    </table>

            </div>
        </section>



    </div> <!-- .site-wrap -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>


    <script src="js/main.js"></script>

</body>

</html>