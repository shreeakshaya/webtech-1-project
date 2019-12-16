<?php
  session_start();
	require "config.php";
	ob_start();
?>
<html>
<body>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="login_1.css"/>
</head>

<body>

<h3 style="font-family:Castellar;font-size:200%;padding-left:60x;padding-bottom:10px" >OnlineMerchant</h3>



<div class="back" style="float:left;margin-left:70px;" >
<form  class="form" action="login_1.php" method="post">
<center style="font-family:Microsoft JhengHei Light;"><h1><b>Login</b></h1></center>

<div class="s">
    <p style="font-family:Microsoft JhengHei Light;"><b>User Name</b></p>
	
    <input type="text" placeholder="Username" name="uname" required >
	<br>
	<p style="font-family:Microsoft JhengHei Light;"><b>Password</b></p>
	
  <input type="password" placeholder="Enter Password" name="psw" required>
  
      <input type="checkbox"  name="remember"> Remember me
    

    <input type="submit" id="login_btn" value="Login" name="login">
	<p style="font-family:Microsoft JhengHei Light;">Don't Have An Account??</p>
	<a href="signup.php" ><input type="button"  id="login_btn" value="CreateAccount" style="max-width:120px"></a>
	
	<span  class="pw"> <a href="#">Forgot password?</a></span>
  </div>
 
  
  
  
  
</div>

</form>
<?php
  if(isset($_POST['login']))
	{
    $username=$_POST['uname'];
    $password=$_POST['psw'];
  
    

    $query="select * from user WHERE uname='$username' AND psw='$password'";
    $query_run=mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0)
    {
        $_SESSION['uname']=$username;
        header('location:homepage1_1.php');
    }
    else
    {
      echo '<script type="text/javascript"> alert("Invalid credentials") </script> ';
    }
  }
?>		
</body>
</html>