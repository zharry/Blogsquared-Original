<!DOCTYPE html>
<html>

	<head>
	<script src="includes/showhide.js" type="text/javascript"></script>
	<title>Blog Squared</title>
	</head>
	
	<body onload="pageload()">
	
	<div id="Admin_ShowHide_Button"><button onclick="showadmin()">Show Admin Panel</button></div>
	
	<center>
	
	<div id="Admin_Section">
	<iframe class="Admin_Section" height="800px" src="login.php" align="left" frameborder="0"></iframe>
	</div>
	<br/>
	<div id="Show">
	<u onclick="show()">+ Show Release Log</u>
	</div>
	
	<div id="Hide">
	<div id="Release_Log">
	<u onclick="hide()">- Hide Release Log</u>
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
		<td>- Useless Stuff Like The Original Parse Files</td>
                <td>Eric</td>
	  </tr>
          <tr>
		<td>1:00PM September 16, 2013</td>
		<td>- Name changed from Myrandomblog to Random-Blog to Blog Squared (BS)</td>
                <td>Eric and Harry</td>
	  </tr>
          <tr>
		<td>8:00PM September 20, 2013</td>
		<td>- Started Migration from Old Style to New Style</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>9:30PM September 20, 2013</td>
		<td>- Install.PHP Finished</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>9:50PM September 20, 2013</td>
		<td>- Register.PHP, Login.PHP, Logout.PHP, Edit-Accoun.PHP modified to fit Install.PHP</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>10:05PM September 20, 2013</td>
		<td>- Index.PHP Get's it's First Renovation</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>11:15AM September 21, 2013</td>
		<td>- Index.PHP Cobines the Previous Index Page with Admin Panel.</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>11:15AM September 15, 2013</td>
		<td>- New Style.CSS (with almost Nothing in it)-Progress towards custom styles.</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>11:20AM September 21, 2013</td>
		<td>- Offline Development Finished! Resulting Alpha2 to be released!</td>
                <td>Harry</td>
	  </tr>
	</div>
	</div>
	</center>
	</body>

</html>