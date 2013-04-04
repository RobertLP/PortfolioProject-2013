<pre><?php
require_once '../../inc.php';

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

if(isset($_POST['linkHeadPicture']))
{
	$statement = $db->prepare('UPDATE settings SET value = :value WHERE setting = \'page_head\'');
	$statement->bindParam(':value', $_POST['linkHeadPicture'], PDO::PARAM_STR);
	if($statement->execute() === true)
	{
		$result = 'De header is bijgewerkt.';
	}
	else
	{
		$result = 'Er is iets fout gegaan bij het bijwerken van de header.';
	}
}

if(isset($_POST['newTabName']))
{
	$statement = $db->prepare('INSERT INTO pages (name) VALUES (:value)');
	$statement->bindParam(':value', $_POST['newTabName'], PDO::PARAM_STR);
	if($statement->execute() === true)
	{
		$result = 'De nieuwe pagina is gemaakt.';
	}
	else
	{
		$result = 'Er is iets fout gegaan bij het maken van de nieuwe pagina.';
	}
}

if(isset($_POST['page_id']) && isset($_POST['submit']) && $_POST['submit'] == 'Delete')
{
	$statement = $db->prepare('DELETE FROM pages WHERE page_id = :value');
	$statement->bindParam(':value', $_POST['page_id'], PDO::PARAM_INT);
	if($statement->execute() === true)
	{
		$result = 'De pagina is verwijderd.';
	}
	else
	{
		$result = 'Er is iets fout gegaan bij het verwijderen van de pagina.';
	}
}

if(isset($_POST['page_id']) && isset($_POST['submit']) && $_POST['submit'] == 'Modify' && isset($_POST['name']))
{
	$statement = $db->prepare('UPDATE pages SET name = :name WHERE page_id = :page_id');
	$statement->bindParam(':page_id', $_POST['page_id'], PDO::PARAM_INT);
	$statement->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
	if($statement->execute() === true)
	{
		$result = 'De pagina is verwijderd.';
	}
	else
	{
		$result = 'Er is iets fout gegaan bij het verwijderen van de pagina.';
	}
}

echo '$_POST: ';
print_r($_POST);

echo '$_GET: ';
print_r($_GET);


?></pre>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>admin panel</title>
        <style type="text/css">
			form {
				margin: 0;
				padding: 0;
			}
        
            .row {
                width: 200px;
                float: left;
            }

            .row2 {
                width: 250px;
                float: left;
            }

            .row3 {
                width: 200px;
                margin: 1px 50px 1px 0;
                padding: 0;
                float: left;
            }
            
            .warn {
				color: red;
			}
			
			input[type="number"] {
				width: 72px;
			}
			
			.arrow {
				font-size: 120%;
				font-weight: bold;
				
				height: 22px;
				width: 30px;
			}
            
            #wrapper {
				width: 750px;
			}
        </style>
    </head>
    <body>
    <?php
    if(isset($result))
    {
		echo '<p>'.$result.'</p>';
	}
    ?>
		<fieldset id="wrapper">
			<legend>Admin Panel</legend>
			<label>Page Head</label>
			<div>
				<div class="row2">
					<form action="." method="post">
						<input type="text" name="linkHeadPicture" placeholder="LinkHeader">
						<input type="submit" name="submit" value="Submit">
					</form>
				</div>
				<label>Edit Header*</label>
			</div>
			<p></p>
			<p></p>
			<label>Page Navigation</label>
			<div>
				<div class="row2">
					<form action="." method="post">
						<input type="text" name="newTabName" placeholder="Tab name">
						<input type="submit" name="submit" value="Create">
					</form>
				</div>
			</div>
			<label>Create new Tab*</label>
			<p></p>
			<p></p>
			<fieldset>
			<?php
				$statement = $db->prepare('SELECT page_id, name FROM pages');
				$statement->execute();
				
				$i = 0;
				while($row = $statement->fetch())
				{
					$warn = '';
					
					$i++;
					if($i > 8)
					{
						$warn = 'warn';
					}
					
					
					echo '<form method="post" action="."><div><div>';
					echo '<input type="hidden" name="page_id" value="'.$row['page_id'].'">';
					echo '<input type="text" name="name" value="'.$row['name'].'" class="row3 '.$warn.'">';
					echo '<input type="submit" name="submit" value="Modify">';
					echo '<input type="submit" name="submit" value="Delete">';
					echo '</div></div></form>';
				}
			?>
			</fieldset>
		</fieldset>

		<!--Roberts Form -->
		
		<fieldset style="background-color: #B0B0B0; width: 750px">
			<form method="get" action=".">
				<select name="page_id" onchange="this.form.submit();">
					<?php
						$statement = $db->prepare('SELECT page_id, name FROM pages');
						$statement->execute();
						while($row = $statement->fetch())
						{
							$selected = '';
							if($page['page_id'] == $row['page_id'])
							{
								$selected = 'selected';
							}
							echo '<option value="'.$row['page_id'].'" '.$selected.'>'.$row['name'].'</option>';
						}
					?>
				</select>
			</form>
			<label style="margin-left: 10px">Select wich page you want to edit</label>
			<p></p>
			<fieldset style="background-color: #D0D0D0;">
				<div class="row">
					<div>
						<input type="number" name="amountBlocks" min="1"max="10" step="1" value="<?php echo $page['num_blocks']; ?>">
						<input type="submit" value="➙" class="arrow">
					</div>
					<p></p>
					<div>
						<select name="floatBehaviour">
							<option value="floatLeft">Float Left</option>
							<option value="floatRight">Float Right</option>
							<option value="cellSwitched">Cell Switched</option>
						</select>
					</div>
				</div>
				<div class="row2">
					<div>
						<label>Amount of blocks on the page</label>
					</div>
					<p></p>
					<div>
						<label>how the page handles blocks</label>
					</div>
				</div>
			</fieldset>
			<fieldset style="background-color: #D0D0D0;">
				<select name="selectBlock">
					<option value="block1">block1</option>
					<option value="block2">block2</option>
				</select>
				<label style="margin-left: 10px">Select wich block you want to edit</label>
				<p></p>
				<fieldset style="background-color: #F0F0F0;">
					<div class="row">
						<select name="titleFont">
							<!-- INSERT STYLES HERE -->
						</select>
						<p></p>
						<select name="textFont">
							<!-- INSERT STYLES HERE -->
						</select>
					</div>
					<div class="row2">
						<label>title font</label>
						<p></p>
						<label>text font</label>
					</div>
				</fieldset>
				<fieldset style="background-color: #F0F0F0;">
					<div class="row">
						<input type="text" name="pictureDir"/>
					</div>
					<div>
						<input type="submit" name="submit" value="SUBMIT"/>
						<label style="margin-left: 10px">submit block picture</label>
					</div>
					<p></p>
					<div>
						<!--picture uploaded comes here with this code-->
						<div class="row">
							<!-- insert code to view pictures uploaded --> picture.jpg
						</div>
						<div class="row">
							<input type="submit" name="delete" value="DELETE"/>
							<input type="submit" name="modify" value="MODIFY"/>
						</div>
						<!--/end-->
					</div>
				</fieldset>
				<fieldset style="background-color: #F0F0F0;">
					<div class="row">
						<input name="title" placeholder="insert title">
					</div>
					<div>
						<textarea name="textBox" rows="5" cols="75" placeholder="insert text"></textarea>
					</div>
					<div>
						<input type="submit" name="submitModify" value="SUBMIT/MODIFY"/>
					</div>
				</fieldset>
			</fieldset>
		</fieldset>
    </body>
</html>
