<?php
require_once 'config.php';

function get_setting($setting)
{
	global $db;
	$statement = $db->prepare('SELECT value FROM settings WHERE setting=:setting');
	$statement->bindParam(':setting', $setting, PDO::PARAM_STR);
	$statement->execute();
	$row = $statement->fetch();
	return $row['value'];
}

try
{
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_SCHEMA, DB_USER, DB_PASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
	die('Er kan geen verbinding worden gemaakt met de database');
}

session_start();
