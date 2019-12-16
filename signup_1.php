<?php
    require "config.php";
    session_start();
    
?>
<html>

<head>
<style>
.error {color: #FF0000;}
</style>
<title>Sign Up</title>
<link rel="stylesheet" type="text/css" href="signup.css"/>
<script src="https://code.jquery.com/jquery-1.7.min.js"></script>
</head>

<body>
<?php

$nameErr = $emailErr ="";
$name = $email =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$name = test_input($_POST["uname"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  $nameErr = "Only letters and white space allowed";
		}
	
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $emailErr = "Invalid email format";
			}
		
	  
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }
  
  
?>

<div class="back" style="float: left;">
<form  class="form" action="signup.php" method="post">
<center><h2>Sign Up</h2></center>
<div class="s">
  
	<label ><b>Email Id:</b></label>
	<input style="border: 1px solid black;width: 35%;" type="text"  name="email" value="<?php echo $email;?>">
	
	<span class="error"><?php echo $emailErr;?></span>
	<br>
	
	<label ><b>UserName:</b></label>
	<span class="error"><?php echo $nameErr;?></span>
	<br>
	<input type="text" placeholder="UserName" name="uname" style="width: 65%;" value="<?php echo $name;?>"  required >
	<br>
	<label for="psw"><b>Password:</b></label>
	<input type="checkbox" onclick="myFunction()" >Show Password
	
	<br>
    <input type="password" id="myInput" placeholder="Enter Password" name="psw"  style="width: 65%;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
	<span id="result" style="color:white"></span>
	
	<br>
	<label for="cpsw"><b>Confirm Password:</b></label>
	<br>
	<input type="password" placeholder="Confirm Password"  style="width: 65%;" name="cpsw" required>
	<br>
	
    
	<label for="add"><b>Address:</b></label>
	<br>
	<input name="add" type="text">

	<br> 

<label><b>Gender:</b></label>	
	<input type="radio" class="radio_btn" name="gen" value="male" checked required>Male
	<input type="radio" class="radio_btn" name="gen" value="female" required>Female
    <br>
	
	<label for="no"><b>Contact number:<b></label>
	<input  style="border: 1px solid #ccc;width: 20%;" type="text" name="no">
	<label for="no"><b>Pincode:<b></label>
	<input  style="border: 1px solid #ccc;width: 20%;" type="text" name="pin">
	<br>
	<input name="submit_btn" type="submit" id="sign_btn" value="Sign Up">
	<a href="login_1.php"><input name="back_btn" id="sign_btn" type="button" value="Back" style="max-width:100px"></a>
</div>
</form>
<?php
	if(isset($_POST['submit_btn']))
	{
		
		$username=$_POST['uname'];
		$password=$_POST['psw'];
		$cpassword=$_POST['cpsw'];
		
		$emailid=$_POST['email'];
		$address=$_POST['add'];
		$gender=$_POST['gen'];
		$contact=$_POST['no'];
		$pincode=$_POST['pin'];
		$_SESSION['uname']=$username;

		
		if($password==$cpassword)
		{
			$query="select * from user WHERE uname ='$username'";
			$query_run=mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				
				//there is already a user with same username
				echo '<script type="text/javascript"> alert("user alredy exist try another username") </script> ';
			}
			
			else
			{
				
				function valid()
				{
					if($_SERVER["REQUEST_METHOD"] == "POST") {
						$nameErr = $emailErr ="";
						$name = $email =  "";
					
						$name = test_input($_POST["uname"]);
						$email = test_input($_POST["email"]);
	// check if name only contains letters and whitespace
				
					if (!preg_match("/^[a-zA-Z ]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
							
							return 0;
						}
							else{
								return 1;
							}
	  
						  
					}

					function test_input($data) {
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
					}
				
				}
				if (valid()==1)
				{
					
                    $query="INSERT INTO user(uname,psw,email,ad,gen,no,pin)VALUES ('$username','$password','$emailid','$address','$gender','$contact','$pincode')";
				$query_run=mysqli_query($con,$query);
				if($query_run)
				{
					echo '<script type="text/javascript"> alert("user registered go to login page to login") </script> ';
				}
				else
				{
					echo '<script type="text/javascript"> alert("Error") </script> ';
				}
			
			}
			

		}
		
	}
	else
		{
			echo'<script type="text/javascript"> alert("password and confirm password does not match") </script> ';
		}
	}

?>
</div>

</body>
<script>

$(document).ready(function() {
 
 $('#psw').keyup(function(){
	 $('#result').html(checkStrength($('#psw').val()))
 })  

 function checkStrength(password){
var strength = 0
 if (password.length < 6) {
	 $('#result').removeClass()
	 $('#result').addClass('invalid')
 }
if (password.length > 7) 
 	strength += 1
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) 
  strength += 1
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  
 	strength += 1 
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  
 strength += 1
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) 
 strength += 1
if (strength < 2 ) {
	 $('#result').removeClass()
	 $('#result').addClass('invalid')
} 
else {
	 $('#result').removeClass()
	 $('#result').addClass('valid')
}
}
});
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>