<?php
require_once '../../inc.php';

echo '_POST:<br>';
var_dump($_POST);

echo '<br>_GET:<br>';
var_dump($_GET);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>admin panel</title>
        <style type="text/css">
            .row{
                width: 200px;
                float: left;
            }
            .row2{
                width: 250px;
                float: left;
            }
            
            #wrapper {
				width: 750px;
			}
        </style>
    </head>
    <body>
		<fieldset id="wrapper">
			<legend>Admin Panel</legend>
			<label>Page Head</label>
			<div>
				<div class="row2">
					<form action="#" method="post">
						<input type="text" name="linkHeadPicture" placeholder="LinkHeader"/>
						<input type="submit" name="submit" value="Submit" onclick="(this.form)" tabindex="1"/>
					</form>
				</div>
				<label>Edit Header*</label>
			</div>
			<p></p>
			<p></p>
			<label>Page Navigation</label>
			<div>
				<div class="row2">
					<form action="#" method="post">
						<input type="text" name="newTabName" placeholder="Tab name"/>
						<input type="submit" name="submit" value="Create" onclick="(this.form)" tabindex="1"/>
					</form>
				</div>
			</div>
			<label>Create new Tab*</label>
			<p></p>
			<p></p>
			<fieldset>
				<div>
					<div>
						<label style="margin-right: 25px;"> tabName 1 </label>
						<input type="submit" name="submit" value="Modify" onclick="(this.form)" tabindex="1"/>
						<input type="submit" name="submit" value="Delete" onclick="(this.form)" tabindex="1"/>
					</div>
				</div>
				<div>
					<div>
						<label style="margin-right: 25px;"> tabName 2 </label>
						<input type="submit" name="submit" value="Modify" onclick="(this.form)" tabindex="1"/>
						<input type="submit" name="submit" value="Delete" onclick="(this.form)" tabindex="1"/>
					</div>
				</div>
			</fieldset>
		</fieldset>

		<!--Roberts Form -->

		<fieldset style="background-color: #B0B0B0; width: 750px">
			<form action="#" method="post">
				<select name="tabDropDown">
					<?php
						$statement = $db->prepare('SELECT page_id, name FROM pages');
						$statement->execute();
						while($row = $statement->fetch())
						{
							echo '<option value="'.$row['page_id'].'">'.$row['name'].'</option>';
						}
					?>
				</select>
			</form>
			<label style="margin-left: 10px">Select wich page you want to edit</label>
			<p></p>
			<fieldset style="background-color: #D0D0D0;">
				<div class="row">
					<div>
						<form action="#" method="post">
							<select name="amountBlocks">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</form>
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
				<div class="row">
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
				<form action="#" method="post">
					<select name="selectBlock">
						<option value="block1">block1</option>
						<option value="block2">block2</option>
					</select>
				</form>
				<label style="margin-left: 10px">Select wich block you want to edit</label>
				<p></p>
				<fieldset style="background-color: #F0F0F0;">
					<div class="row">
						<form action="#" method="post">
							<select name="titleFont">
								<!-- INSERT STYLES HERE -->
							</select>
						</form>
						<p></p>
						<form action="#" method="post">
							<select name="textFont">
								<!-- INSERT STYLES HERE -->
							</select>
						</form>
					</div>
					<div class="row">
						<label>title font</label>
						<p></p>
						<label>text font</label>
					</div>
				</fieldset>
				<fieldset style="background-color: #F0F0F0;">
					<form action="#" method="post">
						<div class="row">
							<input type="text" name="pictureDir"/>
						</div>
						<div>
							<input type="submit" name="submit" value="SUBMIT"/>
							<label style="margin-left: 10px">submit block picture</label>
						</div>
					</form>
					<p></p>
					<div>
						<!--picture uploaded comes here with this code-->
						<form action="#" method="post">
							<div class="row">
								<!-- insert code to view pictures uploaded --> picture.jpg
							</div>
							<div class="row">
								<input type="submit" name="delete" value="DELETE"/>
								<input type="submit" name="modify" value="MODIFY"/>
							</div>
						</form>
						<!--/end-->
					</div>
				</fieldset>
				<fieldset style="background-color: #F0F0F0;">
					<form action="#" method="post">
						<div class="row">
							<input name="title" placeholder="insert title">
						</div>
						<div>
							<textarea name="textBox" rows="5" cols="75" placeholder="insert text"></textarea>
						</div>
						<div>
							<input type="submit" name="submitModify" value="SUBMIT/MODIFY"/>
						</div>
					</form>
				</fieldset>
			</fieldset>
		</fieldset>
    </body>
</html>
