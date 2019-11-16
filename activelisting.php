<HTML>
	<HEAD>
		<TITLE>Active listings</TITLE>
		<!--<LINK rel="stylesheet" type="text/css" href="activelisting.css">-->
	</HEAD>
	<BODY>
		
			<br>
			<H1 class="details_of"><u>Active Listings :</u></H1>
			<br>
			
			<?php

				session_start();
				$client = new MongoClient;
				$db=$client->airbnb;
				$collection=$db->host;

				$email=$_SESSION["email"];

				$doc=$collection->findOne(
					array(
						"email"=> $email
						)
				);
				//var_dump($doc);
			?>


			<br><br><br><br><br>
			<?php

				$i=1;

				foreach ($doc["listings"] as $listing) {

					echo '


					<hr>


					<form method="get">

					<INPUT TYPE="button" value="Edit " name="Edit" class="upload_ad_btn_edit" onclick="myFunction(' . $i . ')">

					<br><br><br>

					<INPUT TYPE="submit" value="Remove" name="remove" class="upload_ad_btn_edit" >

					<img src="fetchimage.php?listing_id='.(string)$listing['listing_id'].'"  style="width:30%;height:15%; margin-left:30%; opacity:0.9; position:relative;">

					<H4 class="details">Number of rooms:</H4><input type="text" id="no_of_rooms'.$i.'" name="no_of_rooms" value="'.$listing["rooms"].'" disabled>

					<H4 class="details">Rent per day:</H4><input type="text" id="rent'.$i.'" name="rent" value="'.$listing["rent"].'" disabled>

					<H4 class="details">Address:</H4><input type="text" id="address'.$i.'" class="address" name="address" value="'.$listing["address"].'" disabled>

					<H4 class="details">Area:</H4><input type="text" id="area'.$i.'" name="area" value="'.$listing["area"].'" disabled>

					<H4 class="details">City</H4><input type="text" id="city'.$i.'" name="city" value="'.$listing["city"].'" disabled>

					<H4 class="details">Available from :</H4><input type="date" id="available_from'.$i.'" name="from_date" value="'.date('Y-m-d',$listing["from_date"]->sec).'" disabled>

					<H4 class="details">Available to :</H4><input type="date" id="available_till'.$i.'" name="to_date" value="'.date('Y-m-d',$listing["to_date"]->sec).'" disabled>
					
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>

					';

					echo
					'
					<input type="hidden" name="listing_id" value="'.$listing["listing_id"].'">
					<INPUT TYPE="submit" name="save" value="Save " name="upload_ad" class="upload_ad_btn">
					<br><br>
					
					</form>
					Interested users:<br><br>
					';

					$j=1;
					foreach ($listing["interested"] as $iuser) {

						//var_dump($iuser);

						echo $iuser["email"];
						echo " From: "; 
						echo date('Y-m-d', $iuser["from_date"]->sec);
						echo " To: ";
						echo date('Y-m-d', $iuser["to_date"]->sec);
						echo '
						<form method="get">
						<INPUT TYPE="submit" value="Accept " align="right"  name="accept" class="upload_ad_btn_intrested">
						<input type="hidden" name="listing_id" value="'.$listing["listing_id"].'">
						<input type="hidden" name="from_date" value="'.$iuser["from_date"].'">
						<input type="hidden" name="to_date" value="'.$iuser["to_date"].'">					
						<input type="hidden" name="email" value="'.$iuser["email"].'">
						<input type="hidden" name="rent" value="'.$listing["rent"].'">
						</form>

					';

						# code...
					};
					$i++;
				}
			?>
			<br>
		<script>
			function myFunction(x) {
			//alert("no_of_rooms"+x);
			document.getElementById("no_of_rooms"+x).disabled = false;
			document.getElementById("rent"+x).disabled = false;
			document.getElementById("address"+x).disabled = false;
			document.getElementById("area"+x).disabled = false;
			document.getElementById("city"+x).disabled = false;
			document.getElementById("available_from"+x).disabled = false;
			document.getElementById("available_till"+x).disabled = false;
			}
			
</script>
		
		<?php

			if(isset($_GET["save"]))
			{
				print_r($_GET);
				echo $_GET["from_date"]." 00:00:00";

				echo $_GET['listing_id'];
				$result=$collection->update(
					array(
						'listings.listing_id'=>new MongoId($_GET['listing_id'])
						),
					array(
							'$set'=>array(
									"listings.$.rooms"=>$_GET["no_of_rooms"],
									"listings.$.address"=>$_GET["address"],
									"listings.$.area"=>$_GET["area"],
									"listings.$.from_date"=>new MongoDate(strtotime($_GET["from_date"]." 00:00:00")),
									"listings.$.to_date"=>new MongoDate(strtotime($_GET["to_date"]." 00:00:00")),
									"listings.$.rent"=>$_GET["rent"],
			

								)
						)	
					);
					//header('Location: profile.php');
					echo "<script type='text/javascript'>window.top.location='activelisting.php';</script>";
			}

			if(isset($_GET["remove"]))
			{
				$result=$collection->update(
					array(
						'listings.listing_id'=>new MongoId($_GET['listing_id'])
						),
					array(
							'$pull'=>array(

								'listings'=>array(

									'listing_id' => new MongoId($_GET['listing_id'])
									)
								)
						)
					
					);
				var_dump($result);
				//var_dump(new MongoId($_GET['listing_id']));	
				//print_r($_GET);
				//echo "<script type='text/javascript'>window.top.location='activelisting.php';</script>";
			}

			if(isset($_GET["accept"]))
			{
				//print_r($_GET);
				$fdate=$_GET["from_date"];
				$tdate=$_GET["to_date"];
				//var_dump($fdate);
				$days=((int)substr($tdate,11)-(int)substr($fdate,11))/(3600*24);
				echo $days." ";
				$tot_rent=((int)$_GET["rent"])*($days);
				$tot_rent=$tot_rent*-1;
				$res1=$collection->update(
						array("email" => $_GET["email"]),
						array('$inc'=>array("wallet_balance"=>$tot_rent))
					);
				$tot_rent=$tot_rent*-1;
				//echo $tot_rent;

				$res1=$db->admin->update(
						array(),
						array('$inc'=>array("wallet_balance"=>$tot_rent))
					);
				//$_GET["email"];
			}

		?>




	</BODY>
</HTML>