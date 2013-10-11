<?php


if(isset($_GET['resize'])) {
	var_dump($_REQUEST);
} else {
	error_reporting(E_ALL | E_STRICT);
	require('UploadHandler.php');
	$upload_handler = new UploadHandler();
}
