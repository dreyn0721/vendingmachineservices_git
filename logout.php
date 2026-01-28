
<!-- primary #002469 -->
<?php include("init/database.php"); ?>
<?php include("init/main-functions.php"); ?>

<?php
// Vars


if( $userdata['role'] == "admin" ){
	$loc = $base_url."/admin.php";
} else {
	$loc = $base_url;
}


session_destroy();
header("Location: ".$loc);

?>
