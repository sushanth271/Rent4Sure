<HTML>
	<HEAD>
		<TITLE>HOME</TITLE>
		<LINK rel="stylesheet" type="text/css" href="home3.css">
	</HEAD>
	<BODY>



		<video  id="bgvid" playsinline autoplay muted loop>
 
	<source src="airbnb.mp4" type="video/mp4">

	</video>

	
	<?php
		session_start();
		if(!$_SESSION["loggedIn"])
		{
			echo '<DIV class="header_home">
			
				<BUTTON value="HOST!" class="host_btn"  style="width:10%"><a href="prop_details.html" style="color:darkblue;font-size:75%;">Become a Host</a></BUTTON>
				<DIV class="right_of_header">
				
				<BUTTON class="login"><a href="login2.php" style="color:darkblue;font-size:75%;">LOG IN</a></BUTTON>   
				<BUTTON class="login"><a href="sign_up3.php" style="color:darkblue;font-size:75%;">SIGN UP</a></BUTTON>
				</DIV>
			</DIV>
				<BR>';
		}
		else
		{
			echo '<DIV class="header_home">
			<form method=get>
			<DIV class="right_of_header">';
			echo "Welcome, ".$_SESSION["name"];
			echo "<form method=get>";
			echo '<input type="submit" value="Log Out" class="login" name="logout">
			</DIV>
			</form>
			</DIV>';	


			//INSERT LOGOUT BUTTON HERE WITH FORM (NO ACTION AND METHOD=GET AND NAME=logout)
			//^^MAKE IT PRETTY
			/*
				if($_GET["logout"])
				{
					session_destroy();
				}
			*/
		}
		if(isset($_GET["logout"]))
		{
			session_destroy();
			header("Location: home3.php");
		}
	?>
<BR>
<BR>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="search_panel">
		<DIV class="search">
		<FORM method=get action="property_listing4.php">
		<select class="select_city" id="select_city" onchange="selectCity()"  style="width:450px" name="select_city">
			<option selected disabled >So where are you going ?</option>
			<option value="Pune" >Pune</option>
			<option value="Mumbai" >Mumbai</option>
			<option value="Delhi">New Delhi</option>
			<option value="Thane">Thane</option>
		</select>
		<select class="select_area" id="select_area" style="width:300px"  name="select_area">
			<option selected disabled>Preferred locality ? </option>
		</select>
		<font class="from">From? </font><input type="date" class="fromdate" name="date_from">
		<font class="from">To? </font><input type="date" class="todate" name="date_to">
		
		
		<br><br><br>
		<DIV class="hunt_button">
		<a href="property_listing.php" style="color:darkblue;font-size:200%;"><input type="submit" name="hunt" value="HUNT" class="hunt_btn"></a>
		</DIV>
		<BR>
		<BR>
		</FORM>
		</DIV>
</div>

	
		<BR><BR><BR><BR>
		
	
	
	
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
