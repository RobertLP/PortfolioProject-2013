<?php
require_once '../inc.php';

$statement = $db->prepare('SELECT * FROM pages WHERE page_id=:page_id');
$statement->bindParam(':page_id', $_GET['page_id'], PDO::PARAM_INT);
$statement->execute();
$page = $statement->fetch(PDO::FETCH_ASSOC);

if($page === false)
{
	$statement = $db->prepare('SELECT * FROM pages ORDER BY page_id LIMIT 1');
	$statement->execute();
	$page = $statement->fetch(PDO::FETCH_ASSOC);
}

if($page === false)
{
	header('Location: ./admin/');
	die;
}

$statement = $db->prepare('SELECT * FROM blocks WHERE page_id=:page_id');
$statement->bindParam(':page_id', $page['page_id'], PDO::PARAM_INT);
$statement->execute();

$blocks = array();

while($block = $statement->fetch(PDO::FETCH_ASSOC))
{
	$blocks[] = $block;

}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>HTML main page</title>
		<link rel="stylesheet" type="text/css" href="mainPageLayout.css">
		<link rel="stylesheet" type="text/css" href="custom-css.php">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body>
		<ul id="navigation">
			<?php
				$statement = $db->prepare('SELECT page_id, name FROM pages');
				$statement->execute();
				while($row = $statement->fetch())
				{
					echo '<li class="tab'.$row['page_id'].'"><a title="'.$row['name'].'" href="/?page_id='.$row['page_id'].'"></a></li>';
				}
			?>
		</ul>
		<div id="wrapper">
			<div id="headPiece">

			</div>

			<?php
			echo '<div id="bodyPiece" class="'.$page['floats'].'">';

				foreach($blocks as $block)
				{
					echo '<div>';
					echo '<img src="'.$block['photo'].'">';
					echo '<div>';
					echo '<h2>'.$block['title'].'</h2>';
					echo '<p>'.$block['content'].'</p>';
					echo '</div>';
					echo '</div>';
				}
			echo '</div>';
			?>
			
			<div id="bottomPiece">
				Ons project is nog niet helemaal af. Sommige onderdelen zullen in het geheel nog niet werken.
			</div>
		</div>

		<script type="text/javascript">
		$(function() {
			$('#navigation a').stop().animate({'marginLeft':'-85px'},1000);

			$('#navigation > li').hover(
				function () {
					$('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
				},
				function () {
					$('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
				}
			);
		});
		</script>
	</body>
</html>
