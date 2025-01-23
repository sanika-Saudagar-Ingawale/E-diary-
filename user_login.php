<?php
include('connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user_username'];
    $password = $_POST['user_password'];

    $select_query = "SELECT * FROM user_table WHERE username='$username'";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['user_password'])) {
        $_SESSION['username'] = $username;

        // Remember Me functionality
        if (isset($_POST['remember_me'])) {
            setcookie('username', $username, time() + (30 * 24 * 60 * 60), '/');
        }

        echo "<script>alert('Login successful!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Login</title>
	<link rel="stylesheet" href="style.css">
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" -->
    <script><script type="text/javascript">
    	function preventBack()
    	{
    		window.history.forward()
    	};
    	setTimeout("preventBack()",0);
    	window.onload=function(){null;}
    </script>
    <style>
       body
    	{
    		overflow-x:hidden;
    	}
    </style>
</head>

<body>
<div class="container-fluide my-3 ml-5">
   <img src="diary.jpg" alt="you are offline" align="left" id="id2">
	<h2 class="text-center">USER Login</h2>
	<div class="row d-flex align-items-left justify-content-left mt-5">
		<div class="col-lg-16 col-xl-12">
			<form action="" method="post" border="1">

				<!-- username field-->
				<div class="form-outline mb-4">
					<label for="user_username" class="form-label">Username</label>
					<input type="text" id="user_username" class="form-control" placeholder="Enter your user name" autocomplete="off" required="required" name="user_username"/>
				</div>

				<!-- password field -->
				<div class="form-outline mb-4">
					<label for="user_password" class="form-label">Password</label>
					<input type="password" autocomplete="off" id="user_password" class="form-control" placeholder="Enter your user password"  required="required" name="user_password"/>
				</div>
				<div class="form-outline mb-4">
					<label><input type="checkbox" name="remember_me"> Remember Me</label>
				</div>

				 

				<div class="mt-4 pt-2">
					<input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
					<p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danser"> Register</a></p>
				</div>

			</form>
		</div>
	</div>
</div>
</body>
</html>

<?php


if(isset($_POST['user_login'])){
	 $user_username=$_POST['user_username'];
	 $user_password=$_POST['user_password'];
	
	$select_query="select * from user_table where username='$user_username'";
	$result=mysqli_query($con,$select_query);
	$row_count=mysqli_num_rows($result);
	$row_data=mysqli_fetch_assoc($result);
	if($row_count>0)
	{
		$_SESSION['username']=$user_username;
      if(password_verify($user_password,$row_data['user_password']))
      {
      	$_SESSION['username']=$user_username;
      	echo "<script>alert('login successfully')</script>";
      	echo "<script>window.location.assign
      	('profile.php')</script>";
      }
      else
	  {
		echo "<script>alert('invalid credentials')</script>";
	  }
	}
	else
	{
		echo "<script>alert('invalid credentials')</script>";
	}
}


?>






<!-- bootsrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>