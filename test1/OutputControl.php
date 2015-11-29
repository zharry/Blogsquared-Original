<?
$name=  $_POST["name"];
$data = $_POST["mes"];
$file = "Output.htm";
$date = date("r");

file_put_contents( $file, "<div><i>" . $name . " Says: </i><small>" . $date . "</small><br/><b>" . $data . "</b><hr/></div>\n", FILE_APPEND);
?>
<script type="text/javascript">

window.location = "http://www.blogsquared.tk/test1/index.php"

</script>