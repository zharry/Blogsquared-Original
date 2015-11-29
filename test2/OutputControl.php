<?
$name = $_GET["name"];
$data = $_GET["mes"];
$file = "Output.php";
$date = date("r");

if (!empty($name)) {
if (!empty($data)) {
file_put_contents( $file, "<div><i>" . $name . " Says: </i><small>(" . $date . ")</small>", FILE_APPEND);
file_put_contents( $file, "<br/>" . $data . "<hr/></div>\n", FILE_APPEND);
}
}
?>

<?
   header( 'Location: http://www.myrandomblog.tk/test2/home.php?name=' . $name .'' ) ;
?>
