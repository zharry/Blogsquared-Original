<?
$postid = 0;
while ($postid <= 100) {
           $filenamesize = "" . $postid . ".php";
           if (file_exists($filenamesize)) {
           file_put_contents($filenamesize, "", FILE_APPEND);
}else{
           file_put_contents($filenamesize, "");
}
           $size = filesize($filenamesize);
	   if ($size = 0) {
           $filename = "" . $postid . ".php";
           break 2;
}else{
	   $postid = $postid + 1;
}
}

$name = $_GET["name"];
$data = $_GET["mes"];
$file = $filename;
$date = date("r");

if (!empty($name)) {
if (!empty($data)) {
file_put_contents( $file, "<div><i>" . $name . " Says: </i><small>(" . $date . ")</small>");
file_put_contents( $file, "<br/>" . $data . "<hr/></div>\n");
}
}
?>

<?
   header( 'Location: http://www.myrandomblog.tk/test3/home.php') ;
?>
