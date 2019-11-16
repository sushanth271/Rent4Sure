<HTML>
	<HEAD>
		<TITLE>Property details</TITLE>

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

		 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
</head>


		<LINK rel="stylesheet" type="text/css" href="property_listing3.css">
		<style>
		.tab1{
			background-color: #eee;
			width:75%;
			align:center;
			border:2;
			border-color: black;
			border:width;

		}
		#img123{
			height: 250;
			background-color: #fff;
		}
		#data{
		font-size: 20;
		font-style: sans-serif;
		opacity: 0.8;
		margin-left: 30%;
		position: relative;
		}

.hunt_button
{
position:absolute;
margin-left:750px;
}
.propimg{
	position: relative;
}

#data2{
	position: absolute;
	top:20%;
	left: 30%;
	color:white;
	font-size: 30;
	font-style: sans-serif;
	opacity: 0.7;
	background-color: #393433;

}

.getting_email{
	display: none;
}


		</style>
	</HEAD>
	<BODY>
	<DIV class="header_home">
			
				<DIV class="left_of_header">
					
				
					<BUTTON class="login" style="margin-left:80%"><a href="login2.php" style="color:white;font-size:85%; opacity:0.9">LOG IN</a></BUTTON>   
					<BUTTON class="login"><a href="sign_up3.php" style="color:white;font-size:85%;opacity:0.9">SIGN UP</a></BUTTON>
				
	</DIV>

	<br>
	
	<DIV class="filters"  >
	<div class="container-fluid">
		<button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo">Filters</button>


		<div id="demo" class="collapse" style="background-color: #FAFAFA; background-size:70%">

		<br>
	<FORM method=get action=property_listing4.php>
						<select class="select_city" id="select_city" onchange="selectCity()"  style="width:20%" name="select_city">
							<option selected disabled >City</option>
							<option value="Pune" >Pune</option>
							<option value="Mumbai" >Mumbai</option>
							<option value="Delhi">New Delhi</option>
							<option value="Thane">Thane</option>
						</select>
						<select class="select_area" id="select_area" style="width:20%" name="select_area">
							<option selected disabled>Area</option>
						</select>
				
	<br>
	<br>
	<br>
	
		<font class="from"> </font><input type="date" class="fromdate" name="date_from">
		<font class="from"><span>&#8594;</span> </font><input type="date" class="todate" name="date_to">
		<br>
		<br>


		<p>
  <label for="amount">Price range:</label>
  <input type="text" id="amount" name= "slider"readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>
 
<div id="slider-range"></div>
 



		<!---<font class="from">Rent from </font><input type="text" class="fromdate" name="rent_from" style="width:10%">
		<font class="from"> Rent to</font><input type="text" class="todate" name="rent_to" style="width:10%">!-->

	<!---	<input type="range" min="500" max="50000" >   -->
		<hr >
			<select class="select_age" id="select_age" style="width:20%" name="sort_age">
				<option selected disabled >Sort</option>
				<option value="new_to_old">Newest</option>
				<option value="old_to_new" >Rating</option>
			</select>
			<br>

			<br>
			<select class="select_age" id="select_age" style="width:20%" name="number_of_rooms">
				<option selected disabled >Number of rooms</option>
				<option value="1">1</option>
				<option value="2" >2</option>
				<option value="3">3</option>
				<option value="4" >4</option>
				<option value="5">5</option>
				<option value="6" >6</option>
				<option value="7">7</option>
				<option value="8" >8</option>
				<option value="9">9</option>
				<option value="10" >10</option>
			</select>
			<br>
			<br>
		<input type="submit" name="filter_btn" value="APPLY FILTERS" class="apply_filters" s >
	</FORM>	
	</div>
	</div>

	<div id="dummy">
		<!--WRITE PHP ECHO HERE-->

		<?php
			
			//require 'vendor/autoload.php';

			$client = new MongoClient;
			$db=$client->airbnb;
			$collection=$db->host;
			echo "<TABLE class='tab1'>";
			/*if(isset($_GET["filter_btn"]))
			{
				print_r($_GET);
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
						echo "<TD>";
						echo "<div class='propimg'>";
						
						echo "<img src='fetchimage.php?listing_id=".$listing_id."' style='width:30%;height:15%; margin-left:30%; opacity:0.9; position:relative'>";
						echo "<p id='data2'>&#8377;".$doc["listings"][0]["rent"]."</p>";
						echo "</div>";
						echo '</TD>';
						echo "</TR>";
						echo "<TR>";
						echo "<TD><p id='data'>".$doc["fname"]." ".$doc["lname"]."</p></TD>";
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
				}
				echo "</TABLE>";
			}
			else
			{*/
				
				$city=$_GET["select_city"];
				$query='{"listings.city":"'.$city.'"}';
				//echo $query;
				$doclist=$collection->find(
					json_decode($query)
					);
				
				foreach ($doclist as $doc) {
					foreach ($doc['listings'] as $listing) {
					
						echo "<form method=get action='listing_default.php'>";
						echo "<TR>";
						$listing_id=(string)$listing['listing_id'];
						//var_dump($res);
						echo '<TD>';
						echo "<div class='propimg'>";
						
						echo "<img src='fetchimage.php?listing_id=".$listing_id."'     style='width:30%;height:15%; margin-left:30%; opacity:0.9; position:relative;'>";
						echo "<p id='data2'>&#8377;".$listing["rent"]."</p>";
						echo "</div>";
						echo '</TD>';
						echo "</TR>";
						echo "<TR>";
					
						echo "<TD><p id='data'>".$doc["fname"]." ".$doc["lname"]."</p></TD>";
						
						echo "</TR>";
						//echo "<TR>";
						//echo "<TD><p id='data'>Rs.".$doc["listings"][0]["rent"]."per day.</p></TD>";
						//echo "</TR>";
						echo "<TR>";
						echo "<TD><p id='data'>Area name</p></TD>";
						echo "</TR>";
						echo "<INPUT TYPE='hidden' name='listing_id' value=".$listing['listing_id'].">";
						echo "<INPUT TYPE='hidden' name='fromdate' value=".$_GET['date_from'].">";
						echo "<INPUT TYPE='hidden' name='todate' value=".$_GET['date_to'].">";
						echo "<TR><TD style='padding-bottom:7%'><a href='listing_default.php'><INPUT TYPE='submit' id='hunt_btn' name='hunt' value='Take me there' class='hunt_btn'></a></TD></TR>";
						echo "</form>";

						
					}
						//var_dump($doc);
						//print_r($doc);
					# code...
				}
				echo "</TABLE>";
			//}			


		?>
	</div>
	
	
	</DIV>

	<hr>
	<br>
	
	<script>

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


	 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 200,
      max: 50000,
      values: [ 300, 1000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
      " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>


	</BODY>
</HTML>