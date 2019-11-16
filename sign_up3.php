<HTML>
	<HEAD>
		<TITLE>SIGN UP</TITLE>
		<LINK rel="stylesheet" type="text/css" href="sign_up3.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

	
	</HEAD>
	<BODY>

		
		<DIV class="header_home">
			
				<DIV class="left_of_header">
					
				
					<BUTTON class="login" style="margin-left:80%;background-color: #C83535;"><a href="login.php" style="color:white;font-size:85%; opacity:0.9">LOG IN</a></BUTTON>   
					<BUTTON class="login"  style="background-color: #C83535; "><a href="sign_up2.php" style="color:white;font-size:85%;opacity:0.9; ">SIGN UP</a></BUTTON> 
				
	</DIV>
	</DIV>


	<BR>
	<BR>
	<DIV class="sign_up_form">
		<BR>
		<H1 style="color:black; opacity:0.6; margin-left:12%;font-family: 'Open Sans Condensed', sans-serif;'" >SIGN UP</H1>
		<br>
		<FORM method=get>
			<INPUT TYPE="text"  class="input_box" style="margin-left:12%;" name="fname" placeholder="First name"><br>
			<INPUT type="text"  class="input_box"   style="margin-left:12%;" name="lname" placeholder="Last name"><br>
			<INPUT TYPE="text" class="input_box" style="margin-left:12%;background-image: url('phone 2.png');" name="phno" placeholder="Contact No."><br>
			<INPUT type="text" name="username" class="input_box"      style="margin-left:12%; background-image: url('email.png');" name="username" placeholder="Username"><br>

			<INPUT TYPE="password" name="password" class="input_box" style="margin-left:12%; background-image: url('password.png');" name="passw" placeholder="Password"><br>
			<span style="font-family:arial;">Password must be have at least 6 characters.It  must be alphanumeric containing at least 1 Capital letter.</span>
			<INPUT type="password" name="password2" class="input_box" style="margin-left:12%; background-image: url('password.png');" name="rpassw" placeholder="Retype Password">

			<BR>
			
			<p style="font-size:14px; font-family:'Ubuntu Condensed',sans-serif;;margin-left:5%;">By signing up, I agree to the Terms of Service, Payments Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
			<INPUT TYPE="submit" name="login" value="SIGN UP" id="submit_btn" name="signup_submit">
		</FORM>
	</DIV>
	</BODY>
</HTML>



<?php
	if(isset($_GET["login"]))
	{
		$client= new MongoClient();
		$collection = $client->airbnb->host;

		if(isset($_GET["fname"])&&isset($_GET["lname"])&&isset($_GET["phno"])&&isset($_GET["username"])&&isset($_GET["password"]))
		{
			$insertResult=$collection->insert(
				array(
					'fname' => $_GET["fname"],
					'lname' => $_GET["lname"],
					'phno' => $_GET["phno"],		
					'email' => $_GET["username"],
					'passwd' => $_GET["password"],
					'wallet_balance' => (int)'0'
				)

			);
		}
		else
		{
		
				print "Enter all the values.";
		}
	}
	//var_dump($insertResult);

?>