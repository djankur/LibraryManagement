<?php
session_start();
if (!$_SESSION['s_name']) {
    header("LOCATION: login.php");
}
$s_name = $_SESSION['s_name'];

include '../connect.php';
$s_id = $_GET["s_id"];

$result = mysqli_query($con, "select * from student where s_id=$s_id");
$row = mysqli_fetch_array($result);

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

    <link rel="stylesheet" href="css/stylen.css">

</head>

<style>
    html {
        overflow: auto;
    }

    body {
        padding: 0px;
        margin: 0px;
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
                                <li><a href="studentpanel.php#home-section" class="nav-link">Home</a></li>
                                <li><a href="studentpanel.php#profile-section" class="nav-link">Profile</a></li>
                                <li><a href="studentpanel.php#borrow-section" class="nav-link">Borrowed Books</a></li>
                                <li><a href="logout.php" class="nav-link">Log-out</a></li>
                            </ul>
                        </nav>
                    </div>


                    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
            </div>

        </header>



        <div class="site-blocks-cover">


            <div class="site-section">
                <div class="container" style="margin-top: 30px;">
                    <h2 class="section-title mb-3">Update Profile</h2>

                    <form action="editprofile1.php" method="POST">


                        <div class="row g-2">

                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="id"> ID </label>
                                    <input type="text" class="form-control" name="s_id" id="id" placeholder="ID" value="<?php echo $row["s_id"] ?>" readonly>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">

                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="name"> Name </label>
                                    <input type="text" class="form-control" name="s_name" id="name" placeholder="Name" value="<?php echo $row["s_name"] ?>" readonly>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">

                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="password"> Password </label>
                                    <input type="text" class="form-control" name="s_password" id="password" placeholder="password" value="<?php echo $row["s_password"] ?>">
                                    
                                </div>
                            </div>
                        </div>


                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="email"> E-mail </label>
                                    <input type="email" class="form-control" name="s_email" id="email" placeholder="E-mail" value="<?php echo $row["s_email"] ?>">
                                   

                                </div>
                            </div>


                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="phone"> Phone </label>
                                    <input type="text" class="form-control" name="s_phone" id="phone" placeholder="Phone" value="<?php echo $row["s_phone"] ?>">
                                   
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                <label for="address"> Address </label>
                                    <input type="text" class="form-control" name="s_address" id="address" placeholder="Address" value="<?php echo $row["s_address"] ?>" readonly>
                                    
                                </div>
                            </div>



                            <div class="col-md">
                                

                                <label for="department"> Department </label>
                                    <select class="form-control" id="branch_select" name="department" required disabled = "true">
                                        <option value="MCA" <?php if ($row["department"] == "MCA") echo ' selected="selected"'; ?>>Master of Computer Application</option>
                                        <option value="CIV" <?php if ($row["department"] == "CIV") echo ' selected="selected"'; ?>>Civil Engineering</option>
                                        <option value="CSE" <?php if ($row["department"] == "CSE") echo ' selected="selected"'; ?>>Computer Science Engineering</option>
                                        <option value="MEC" <?php if ($row["department"] == "MEC") echo ' selected="selected"'; ?>>Mechanical Engineering</option>
                                        <option value="EEE" <?php if ($row["department"] == "EEE") echo ' selected="selected"'; ?>>Electrical & Electronics Engineering</option>
                                    </select>

                                
                            </div>
                        </div>



                        <input type="submit" class="btn btn-md btn-success" value="Update Profile" name="submit">

                    </form>


                </div>

            </div>

        </div>




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