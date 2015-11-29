<!DOCTYPE html>
<html>

	<head>
	<script src="includes/togglehideshow.js" type="text/javascript"></script>
	<!-- JAVASCRIPT FUNCTIONS
	onload() - Hides the Hide Text
	show() - Show Text
	hide() - Hide Text
	-->
	<title>Alpha Test</title>
	</head>
	
	<body onload="pageload()">
	<center>
	
	<div id="Login_Section">
	<header>Alpha Login</header>
	<hr/>
	<a href="login.php">Main Page</a> 
	<hr/>
	</div>
	
	<br/>
	<div id="Show">
	<u onclick="show()">+ Show Release Log</u>
	</div>
	
	<div id="Hide">
	<div id="Release_Log">
	<u onclick="hide()">- Hide Release Log</u>
	<!--PUT ALL RELEASES HERE! EVEN SMALL ONES! I WILL MAKE A JAVASCRIPT THING TO TOGGLE THIS LOG!-->
	<table border="2">
	  <tr>
		<td colspan="3"><b>Release Log:</b></td>
	  </tr>
          <tr>
		<td><i>Time/Date of Release: &nbsp &nbsp &nbsp &nbsp </i></td>
		<td><i>Releases and Changes: &nbsp &nbsp &nbsp </i></td>
                <td><i>Released By: &nbsp </i></td>
	  </tr>
          <tr>
		<td>7:00 September, 04, 2013</td>
		<td>+ Random-Blog.TK Site Created!</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>4:00 September, 05, 2013</td>
		<td>+ Tests 1,2,3 Finish! Alpha 1 Begins! Starting Fresh!</td>
                <td>Harry and Eric</td>
	  </tr>
          <tr>
		<td>4:05 September ,05, 2013</td>
		<td>+ New Index.PHP created.</td>
                <td>Harry and Eric</td>
	  </tr>
          <tr>
		<td>6:25 September ,05, 2013</td>
		<td>+ Added Toggle Release Log</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>2:30PM September 15, 2013</td>
		<td>+ Entire Login System Finished</td>
                <td>Eric</td>
	  </tr>
          <tr>
		<td>2:45PM September 15, 2013</td>
		<td>- Useless Stuff Like The Original Parse Files and Also Cleaned Up Error Logs</td>
                <td>Eric</td>
	  </tr>
	</div>
	</div>
	</center>
	</body>

</html>