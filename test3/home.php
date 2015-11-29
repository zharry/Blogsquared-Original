<?php
require_once('auth.php');
$username = 1
?>	        
<html>
	<head>
        <title>Test</title>
<script type="text/javascript" src="addwords.js"></script>
<script type="text/javascript" src="jscolor/jscolor.js"></script>
	</head>
	<body>

<div style="float:left; width: 60%;">
        <form method="get" action="OutputControl.php">
        <i>Welcome Back, <? echo $username ?></i><input type="hidden" name="name" value="<? echo $username ?>">
         &nbsp &nbsp <b>Color Picker:</b>
        <input class="color" name="color"><br/><br/>
        <i>Message:<small>* Required</small></i><br/>

        <!--Bold Italic Underline-->
        <input type="button" value="Line Break" onclick="br('textbox')">
        <input type="button" value="Bold" onclick="bold('textbox')"><input type="button" value="End Bold" onclick="endbold('textbox')">
        <input type="button" value="Italic" onclick="italic('textbox')"><input type="button" value="End Italic" onclick="enditalic('textbox')">
        <input type="button" value="Underline" onclick="underline('textbox')"><input type="button" value="End Underline" onclick="endunderline('textbox')">
        <br/>
       
        <!--Color Text-->
        <input type="button" value="Start Color Text" onclick="textcolor('textbox')">
        <input type="button" value="End Color" onclick="endstyle('textbox')">
        <input type="button" value="End Color Text" onclick="end('textbox')">
        <br/>

        <!--Highlight Text-->
        <input type="button" value="Start Highlighted Text" onclick="texthighligh('textbox')">
        <input type="button" value="End Highlight Color" onclick="endstyle('textbox')">
        <input type="button" value="End Highlighted Text" onclick="end('textbox')">
        <br/>

        <!--Hyperlink-->
        <input type="button" value="Start Hyperlink" onclick="hyperlink('textbox')">
        <input type="button" value="End Hyperlink Link" onclick="endhylink('textbox')">
        <input type="button" value="End Hyperlink" onclick="endhyperlink('textbox')">
        <br/>

        <!--Image-->
        <input type="button" value="Start Image" onclick="image('textbox')">
        <input type="button" value="End Image" onclick="endimage('textbox')">
        <br/>

        <br/><textarea name="mes" id="textbox" cols="80" rows="10"></textarea><br/><br/>
	<input name="submit" type="submit" value="Submit">
        <br/><br/><small><a href="http://www.myrandomblog.tk/test3/clear.php">Clear Log</a></small>
</div>
<div style="float:left; width: 40%;">
</div>
<iframe src="http://www.myrandomblog.tk/test3/Output.php" width=100% frameborder=1></iframe>
	</body>
	</html>