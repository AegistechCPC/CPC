<?php 

    $dbhost = "localhost";
    $user = "root";
    $pass = "";
    $db = "adminlogin";
    $username="";
    $password="";
    $date = date("Y-m-d");
    $in = date("H:i:s");
    $con = new mysqli($dbhost, $user, $pass, $db);
    // if($con->connect_error)
    // {
    //     echo "error connecting to database";
    // }
    // else{
    //     echo "connected";
    // }
	  error_reporting(0);
	if(isset($_POST['username'])) { 
    // check if the username has been set
		$username = $_POST['username'];
    $password = $_POST['password'];

    

    $sql = "SELECT * FROM tbl_reg WHERE username = '$username' AND pass = '$password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    if($row['username'] == $username && $row['pass'] == $password)
    {
    	if (isset($_POST['login'])) 
    	{
         $result=mysqli_query($con,"INSERT INTO tbl_daily(IDN,username,fname,lname,contact,date_today) SELECT IDN,username,fname,lname,contact,'$date' FROM tbl_reg WHERE username='$username'");
       
       $row=mysqli_fetch_array($result);
       $result=mysqli_query($con,"UPDATE tbl_daily set timeIn=NOW() WHERE date_today='$date'");
       $row=mysqli_fetch_array($result);
       $message = "Login Successfully!!.";
  echo "<script type='text/javascript'>alert('$message');window.location='index.php';</script>";
         }
    elseif (isset($_POST['logout'])) 
    	{
        $result=mysqli_query($con,"UPDATE tbl_daily set timeOut=NOW() WHERE date_today='$date' ");
       $row=mysqli_fetch_array($result);
       $message = "Logout Successfully!!.";
  echo "<script type='text/javascript'>alert('$message');window.location='index.php';</script>";
    	}      
       }    
    else
    {
        $message = "Username and/or Password incorrect.\\nTry again.";
  echo "<script type='text/javascript'>alert('$message');window.location='index.php';</script>";

    }
}
    

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="assets/js/app.js"></script> -->
	<title>Collector's Login Logout</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form class="sign-in-form" action="" method="post">
					<h2 class="title">Login</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="username" placeholder="Username" >
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" placeholder="Password" >
					</div>
					<input type="submit" name="login" value="Login" class="btn solid">
					<div>	<a href="resetpass.php">Forgot Password?</a></div>
				</form>
				<form class="sign-up-form" action="" method="post">
					<h2 class="title">Logout</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="username" placeholder="Username" >
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" placeholder="Password" >
					</div>
					<input type="submit" name="logout" value="Logout" class="btn solid">
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>Want to logout ?</h3>
					<p>After all, it's worth the wait</p>
					<button class="btn transparent" id="sign-up-btn">Logout</button>
				</div>

				<img src="img/throw.svg" class="image" alt="">
			</div>

			<div class="panel right-panel">
				<div class="content">
					<h3>Want to login ?</h3>
					<p>Start a day with big energy</p>
					<button class="btn transparent" id="sign-in-btn">Login</button>
				</div>											
				<img src="img/nature.svg" class="image" alt="">
			</div>
		</div>
	</div>

	<script src="app.js"></script>
     <!-- <script type="text/javascript" src="assets/js/vue.js"></script> -->
</body>
</html>