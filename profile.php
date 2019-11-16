
<!DOCTYPE html>

<HTML>
	<HEAD>
		<TITLE>User Profile</TITLE>
		<LINK rel="stylesheet" type="text/css" href="profile.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet"> 
		
		<?php
			
			session_start();
			$email=$_SESSION['email'];
			$client= new MongoClient();
			$collection = $client->airbnb->host;
			//echo $email;
			$doc=$collection->findOne(array('email' => $email));
			var_dump($doc);
			//var_dump($doc);
		?>


	</HEAD>
	<BODY>
	<DIV class="header_home">

	</DIV>
	<BR>
	<BR>
	<DIV class="sign_up_form">
		<BR>
		<H1 style="color:white;font-family:'Open Sans', sans-serif;" align="center"><u>Your Profile :</u></H1>
		<br>
		<FORM method="post" action="profile.php">
			<H4 class="email_pass" align="center" style="margin-left:4%;">First Name :</H4><INPUT TYPE="text" id="first_name" name="fname" class="input_box" style="margin-left:4%;" disabled value=<?php echo "'".$doc['fname']."'" ?>>
			<H4 class="email_pass" align="center" style="margin-left:4%;">Last Name :</H4><INPUT type="text" id="last_name" name="lname" class="input_box"   style="margin-left:4%;" disabled value=<?php echo "'".$doc['lname']."'" ?>>
			<H4 class="email_pass" align="center" style="margin-left:4%;">Contact no :</H4><INPUT TYPE="text" id="contact_no" name="phno" class="input_box" style="margin-left:4%;" disabled value=<?php echo "'".$doc['phno']."'" ?>>
			<H4 class="email_pass" align="center" style="margin-left:4%;">Wallet Balance :</H4><INPUT type="text" id="wallet" name="wallet_balance" class="input_box"      style="margin-left:4%;" disabled value=<?php echo "'".$doc['wallet_balance']."'" ?>>
			<H4 class="email_pass" align="center" style="margin-left:4%;">Password :</H4><INPUT TYPE="text" id="passwd" name="passwd" class="input_box"     style="margin-left:4%;" disabled value=<?php echo "'".$doc['passwd']."'" ?>>
			<br><H4 class="email_pass" align="center" style="margin-left:4%;"><a href="http://www.w3schools.com">Previous Activites </a> <br>
			<H4 class="email_pass" align="center" style="margin-left:4%;"><a href="http://www.w3schools.com">Active Listings</a> 
			<br>
			<BR>
			<BR>
			
			<INPUT TYPE="button" name="edit_details" value="Edit Details" id="submit_btn" style="font-family:Helvetica;" onclick="myFunction()" ><p>  </p>
			<br>
			<INPUT TYPE="submit" name="save_changes" value="Save Changes" id="submit_btn2" style="font-family:Helvetica;" alert=("Your changes have been saved.")>
			</form>
			<?php
				if(isset($_POST["save_changes"]))
				{
					$result=$collection->update(
						array("email"=>$email),
						array(
							'$set'=>
								array(
								"fname"=>$_POST["fname"],
								"lname"=>$_POST["lname"],
								"phno"=>$_POST["phno"],
								"passwd"=>$_POST["passwd"],
								)
							)
						);
					var_dump($result);
					header('Location: profile.php');
				}
			?>

			<br><br>
			<hr>
			<br>
			<FORM method="post" action="profile.php">
			<INPUT TYPE="text" name="pincode" class="input_box" style="margin-left:4%;" placeholder="Pin-Code">
			<br><br>
			<INPUT type="text" name="amount" class="input_box"   style="margin-left:4%;"  placeholder="Add Amount">
				
			<br><br>
			<INPUT TYPE="submit" name="add_balance" value="Add Balance" id="submit_btn3" style="font-family:Helvetica;">
			
			<br><br><br><br>
			<img src="money.png" style="width:100%;height:19%;">
			<br><br><br>
			
		</form>

		<?php

			if(isset($_POST["add_balance"]))
			{
				print_r($_POST);
				$upres=$collection->update(
						array("email" => $email),
						array('$inc'=>array("wallet_balance"=>(int)$_POST["amount"]))
					);
				var_dump($upres);
				header('Location: profile.php');
			}

		?>
	
	</DIV>
	<script>
			function myFunction() {
			document.getElementById("first_name").disabled = false;
			document.getElementById("last_name").disabled = false;
			document.getElementById("contact_no").disabled = false;
			
			document.getElementById("passwd").disabled = false;
			}
			
</script>
	</BODY>
</HTML>