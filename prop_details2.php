<HTML>
	<HEAD>
		<TITLE>Property details</TITLE>
		<LINK rel="stylesheet" type="text/css" href="prop_details.css">
	</HEAD>
	<BODY>
	<DIV class="header_home">
	
	</DIV>
	
	<DIV class="signup_form_internal">

		<H2 class="tell_us"><u>Tell us something about your property....</u></H2>
		
		<FORM method=post action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			<H3 class="details" >How many rooms ?</H3>
			<INPUT TYPE="text" style="margin-left:10%;" class="how_many_rooms" name="no_of_rooms">
			<H3 class="details">Address:</H3>
			<textarea  name="address" style="margin-left:10%;" class="where"></textarea>
			<H3 class="details">City:</H3>
			<select class="select_city" id="select_city" onchange="selectCity()" style="margin-left:10%;" name="city">
				<option selected disabled>City </option>
				<option value="Pune">Pune</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Delhi">New Delhi</option>
				<option value="Thane">Thane</option>
			</select>
			<H3 class="details" name="area">What area does it come under ?</H3>
			<select class="select_area" id="select_area" style="margin-left:10%;" name="area">
				<option selected disabled><H4 class="details">Locality ?</H4> </option>
			</select>
			<BR>
			<BR>
			<br>
			<H3 class="detailss" style="font-family:Helvetica;"><i>From ? </i><input type="date" class="fromdate" name="date_from" >
			<i>To ? </i></H3><input type="date" class="todate" name="date_to" > 
			<H3 class="details" >Rent per day:</H3>
			<INPUT TYPE="text" style="margin-left:10%;" class="how_many_rooms" name="rent">
			<br><br><br><br>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			<H3 class="details"><b><i>Upload an image of your property      </i></b><input type="file" class="upload_btn" name="userfile">	</H3>
			<br><br><br>
			<input type="submit" value="Upload Info" name="info_upload" class="submit_btn" style="width:450px">
			
			</FORM>
		
	</DIV>
	
	
	
	
	
	
	
	<SCRIPT>
		function selectCity()
		{
			var city=document.getElementById("select_city").value;
			var area = document.getElementById("select_area");
			area.options.length=0;
			if(city=="Pune")
			{
				 var areanames = ["FC Road","Aundh","Viman Nagar"];
				 for(var i=0;i<areanames.length;i++)
				 {
					var opt=areanames[i];
					var el = document.createElement("option");
					el.textContent=opt;
					el.value=opt;
					area.appendChild(el);
				 } 
			}
			if(city=="Mumbai")
			{
				 var areanames = ["Dadar","Santa Cruz","Churchgate"];
				 for(var i=0;i<areanames.length;i++)
				 {
					var opt=areanames[i];
					var el = document.createElement("option");
					el.textContent=opt;
					el.value=opt;
					area.appendChild(el);
				 } 
			}
			if(city=="Delhi")
			{
				 var areanames = ["Civil lines","Dwarka","CP"];
				 for(var i=0;i<areanames.length;i++)
				 {
					var opt=areanames[i];
					var el = document.createElement("option");
					el.textContent=opt;
					el.value=opt;
					area.appendChild(el);
				 } 
			}
			if(city=="Thane")
			{
				 var areanames = ["Mira road","Ghatkopar","DEF"];
				 for(var i=0;i<areanames.length;i++)
				 {
					var opt=areanames[i];
					var el = document.createElement("option");
					el.textContent=opt;
					el.value=opt;
					area.appendChild(el);
				 } 
			}
		}
	</SCRIPT>
	
	
	</BODY>
</HTML>

<?php

	if(isset($_POST["info_upload"]))
	{
		session_start();
		$client = new MongoClient();
		$db=$client->airbnb;
		$collection = $client->airbnb->host;
		$email=$_SESSION["email"];




		if(isset($_POST["no_of_rooms"])&&isset($_POST["address"])&&isset($_POST["city"])&&isset($_POST["area"])&&isset($_POST["date_from"])&&isset($_POST["date_to"])&&isset($_POST["rent"]))
		{
			$listing_id=new MongoId();
			$insertResult=$collection->update(
				array("email" => $email),
				array(
					'$push'=>
						array(
							'listings' => array(
									'rooms' => $_POST["no_of_rooms"],
									'address' => $_POST["address"],		
									'area' => $_POST["area"],
									'city' => $_POST["city"],
									'from_date' => new MongoDate(strtotime($_POST["date_from"]." 00:00:00")),
									'to_date' => new MongoDate(strtotime($_POST["date_to"]." 00:00:00")),
									'rent' => $_POST["rent"],
									'listing_id' => $listing_id,
								)
						)
				)

			);
			if(isset($_POST['info_upload']))
			{
				$uploaddir = '/home/overlord1109/uploads/';
				$_FILES['userfile']['name']="uploads.jpg";
				$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

				echo $uploadfile."<br>";

				//echo '<pre>';
				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
				   // echo "File is valid, and was successfully uploaded.\n";
				} else {
				    //echo "Possible file upload attack!\n";
				}
				$listing_id=(string)$listing_id;
				$grid = $db->getGridFS();
				$res=$grid->storeFile("/home/overlord1109/uploads/uploads.jpg", array('listing_id'=>$listing_id));
				var_dump($res);

				//echo 'Here is some more debugging info:';
				print_r($_FILES);

				//print "</pre>";

			}
		}
		else
		{
		
				print "Enter all the values.";
		}
	}
	//var_dump($insertResult);

?>