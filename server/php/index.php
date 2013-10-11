<?php


if(isset($_GET['resize'])) {
	if(isset($_REQUEST['url'])){
		$base_width = 400;

		$url_parts = explode('/', $_REQUEST['url']);
		$filename = array_pop($url_parts);
		$data = file_get_contents('files/'.$filename);
		$src_image = imagecreatefromstring($data);
		$src_size = getimagesize('files/'.$filename);

		$relative_height = ceil(($base_width * $src_size[1]) / $src_size[0]);

		$proportion = $src_size[0] / $base_width;

		$src_x = ceil($proportion * $_REQUEST['x']);
		$src_y = ceil($proportion * $_REQUEST['y']);
		$src_w = ceil($proportion * $_REQUEST['w']);
		$src_h = ceil($proportion * $_REQUEST['h']);

		if(is_file('files/thumb_'.$filename.'.png'))
			unlink('files/thumb_'.$filename.'.png');

		$dst_image = imagecreatetruecolor(250, 250);

		imagecopyresampled ($dst_image, $src_image , 0, 0, $src_x, $src_y, 250, 250, $src_w, $src_h);
		imagepng ($dst_image, 'files/thumb_'.$filename.'.png');

		echo '<img src="'.str_replace($filename, 'thumb_'.$filename.'.png', $_REQUEST['url']).'" />';
	}
} else {
	error_reporting(E_ALL | E_STRICT);
	require('UploadHandler.php');
	$upload_handler = new UploadHandler();
}
