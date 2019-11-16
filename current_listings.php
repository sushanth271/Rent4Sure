<HTML>
	<HEAD>
		<TITLE>Property details</TITLE>
		<LINK rel="stylesheet" type="text/css" href="property_listing.css">
		<style>
		.tab1{
			background-color: #eee;
			width:75%;
			align:center;
			border:2;
			border-color: black;

		}
		#img123{
			height: 250;
			background-color: #fff;
		}
		#data{
		font-size: 30;
		font-style: sans-serif;
		opacity: 0.5;
		margin-left: 35%;
		position: relative;
		}

		.hunt_button
{
position:absolute;
margin-left:750px;
}

.hunt_btn{
background-color:#ddd;
	border-radius:35px;
	border:1px solid;
	display:inline-block;
	color:black;
	font-size:17px;
	
	text-decoration:none;
	height:30px;
	
	
}

.hunt_btn{
	margin-left: 35%;
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
}
.hunt_btn:hover, .hunt_btn:focus, .hunt_btn:active {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.getting_email{
	display: none;
}


		</style>
	</HEAD>
	<BODY>
	<DIV class="header_home">
		<img src="abnb_logo.png" id="logo">
	</DIV>
	<br>
	<DIV class="filters">
	<hr>
	<font class="from">FILTERS:</font>
	<br>
	<br>	
	<FORM method=get action=property_listing.php>
		<select class="select_city" id="select_city" onchange="selectCity()"  style="width:20%" name="select_city">
			<option selected disabled >So where are you going ?</option>
			<option value="Pune" >Pune</option>
			<option value="Mumbai" >Mumbai</option>
			<option value="Delhi">New Delhi</option>
			<option value="Thane">Thane</option>
		</select>
		<select class="select_area" id="select_area" style="width:20%" name="select_area">
			<option selected disabled>Preferred locality ? </option>
		</select>
		<font class="from">From? </font><input type="date" class="fromdate" name="date_from">
		<font class="from">To? </font><input type="date" class="todate" name="date_to">
		<br>
		<br>

		<font class="from">Rent from </font><input type="text" class="fromdate" name="rent_from" style="width:10%">
		<font class="from"> Rent to</font><input type="text" class="todate" name="rent_to" style="width:10%">
	
			<select class="select_age" id="select_age" style="width:20%" name="sort_age">
				<option selected disabled >Sort by age</option>
				<option value="new_to_old">Newest to Oldest</option>
				<option value="old_to_new" >Oldest to Newest</option>
			</select>

		<input type="submit" name="filter_btn" value="APPLY FILTERS">
	</FORM>	

	<div id="dummy">
		<!--WRITE PHP ECHO HERE-->

		<?php
			
			//require 'vendor/autoload.php';

			$client = new MongoClient;
			$db=$client->airbnb;
			$collection=$db->host;
			echo "<TABLE class='tab1'>";
			
				
				$city=$_GET["select_city"];
				$query='{"listings.city":"'.$city.'"}';
				//echo $query;
				$doclist=$collection->find(
					json_decode($query)
					);
				
				foreach ($doclist as $doc) {
						echo "<form method=get action='listing_default.php'>";
						echo "<TR>";
						$listing_id=(string)$doc['listings'][0]['listing_id'];
						//var_dump($res);
						echo '<TD>';
						echo "<img src='fetchimage.php?listing_id=".$listing_id."' style='width:10%;height:10%;'>";
						echo '</TD>';
						echo "</TR>";
						echo "<TR>";
						echo "<TD><p id='data'>".$doc["fname"]." ".$doc["lname"]."</p></TD>";
						echo "</TR>";
						echo "<TR>";
						echo "<TD><p id='data'>Rs.".$doc["listings"][0]["rent"]."per day.</p></TD>";
						echo "</TR>";
						echo "<TR>";
						echo "<TD><p id='data'>Area name</p></TD>";
						echo "</TR>";
						echo "<INPUT TYPE='hidden' name='listing_id' value=".$doc['listings'][0]['listing_id'].">";
						echo "<TR><TD><a href='listing_default.php'><INPUT TYPE='submit' id='hunt_btn' name='hunt' value='Take me there' class='hunt_btn'></a></TD></TR>";
						echo "</form>";

						
						//var_dump($doc);
						//print_r($doc);
					# code...
				echo "</TABLE>";
			}			


		?>
	</div>
	
	
	</DIV>
	<hr>
	<br>
	

	</BODY>
</HTML>