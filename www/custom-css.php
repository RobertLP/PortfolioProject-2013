<?php
require_once '../inc.php';
header('Content-Type: text/css');
?>
h2 {
	font-family: <?php
		$statement = $db->prepare('SELECT font_name, font_family FROM fonts WHERE font_id=(
			SELECT value FROM settings WHERE setting="title_font_family")');
		$statement->execute();
		$row = $statement->fetch();
		echo '\''.$row['font_name'].'\', '.$row['font_family'];
	?>;

	font-size: <?php echo get_setting('title_font_size'); ?>;
}

p {
	font-family: <?php
		$statement = $db->prepare('SELECT font_name, font_family FROM fonts WHERE font_id=(
			SELECT value FROM settings WHERE setting="text_font_family")');
		$statement->execute();
		$row = $statement->fetch();
		echo '\''.$row['font_name'].'\', '.$row['font_family'];
	?>;

	font-size: <?php echo get_setting('text_font_size'); ?>;
}
