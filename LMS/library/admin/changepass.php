<?php
session_start();
if(!$_SESSION['name']){
    header("LOCATION: login.php");
}

$name = $_SESSION['name'];


include '../connect.php';
include 'main.php';




    

$result = mysqli_query($con, "select * from admin where id=$id");
$row = mysqli_fetch_array($result);

?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<center>
<form name="chngpwd" action="changepass1.php" method="post" onSubmit="return valid();">
<div style="width:500px;">
<div class="col-md">
            <div class="form-floating mb-3">
            <input type="password" class="form-control" name="opwd" id="opwd" placeholder="Old Password">
                <label for="opwd"> Old Password </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">
            <input type="password" class="form-control" name="npwd" id="npwd" placeholder="New Password">
                <label for="npwd"> New Password </label>
            </div>
        </div>

        <div class="col-md">
            <div class="form-floating mb-3">
            <input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password">
                <label for="cpwd"> Confirm Password </label>
            </div>
  

<input type="submit" class="btn btn-md btn-success" value="Change Passowrd" name="Submit">
        </div>
</form>
</center>

<script >
function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Filed is Empty !!");
document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="")
{
alert("New Password Filed is Empty !!");
document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>
<?php
if( $_GET['pwd'] == 'changed') {
   echo '<script>  alert("Password successfully changed!");   </script>';
}
else if( $_GET['pwd'] == 'nochanged') {
   echo '<script>  alert("Old password is incorrect. Try again!");   </script>';
}else{

}
?>
  
</body>

</html>

