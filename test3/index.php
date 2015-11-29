

<?php
//Start session
session_start();	
//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_FIRST_NAME']);
unset($_SESSION['SESS_LAST_NAME']);
?>
<html>

<form name="loginform" action="login_exec.php" method="post">
<table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
<tr>
<td colspan="2">

<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
echo '<ul class="err">';
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo '<li>',$msg,'</li>';
}
echo '</ul>';
unset($_SESSION['ERRMSG_ARR']);
}
?>
</td>
</tr>
<tr>
<td width="116"><div align="right">Username</div></td>
    <td width="177"><input name="username" type="text" /></td>
    </tr>
    <tr>
    <td><div align="right">Password</div></td>
    <td><input name="password" type="password" /></td>
    </tr>
    <tr>
    <td><div align="right"></div></td>
    <td><input name="" type="submit" value="login" /></td>
</tr>
</table>
</form>

<body>
<center>
<table border="1">
	  <tr>
		<td colspan="3"><b>Release Notes:</b></td>
	  </tr>
          <tr>
		<td><i>Time/Date of Release: &nbsp </i></td>
		<td><i>Releases and Changes: &nbsp &nbsp &nbsp </i></td>
                <td><i>Released By: &nbsp </i></td>
	  </tr>
          <tr>
		<td>2:00 PM June 21</td>
		<td>+ Test 3 Created</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>9:00 PM June 21</td>
		<td>+ Test 2 Files brought in and removed the old username transfer system.</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>10:00 PM June 21</td>
		<td>+ Release Log created</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>10:10 PM June 21</td>
		<td>+ Changed the imported Test2 variables and links to Test3 links.</td>
                <td>Harry</td>
	  </tr>
          <tr>
		<td>11:15 PM June 25</td>
		<td>+ Added 4 More Users.</td>
                <td>Eric</td>
	  </tr>
          <tr>
		<td>11:15 PM June 25</td>
		<td>+ Password Censor.</td>
                <td>Eric</td>
	  </tr>
          <tr>
		<td>11:15 PM June 25</td>
		<td>+ Login_Exec.php Finished</td>
                <td>Eric</td>
	  </tr>

</center>
</body>
</html>