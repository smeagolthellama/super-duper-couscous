<?php
/*
 * register.php
 * 
 * Copyright 2018 Mark Gardner <mark@gaffer>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

if($_GET["user_name"]!=NULL){
	$mysqli=new mysqli("localhost","mark","top secret","konquest");
	if (mysqli_connect_errno()) {
		die ("Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
	}
	//$stmt=mysqli_stmt_init($mysqli);
	
	$stmt=	$mysqli->prepare("INSERT INTO users (user_name,user_cookie,user_game_id,user_last_seen,user_kick_time) VALUES (?,?,?,now(),DATE_ADD(now(),INTERVAL 2 HOUR));")or die( $mysqli->error);;
	
	$stmt->bind_param("sii",$_GET["user_name"],$cookie,$_GET["game_id"]);

	$cookie=base_convert(hash("md5",$_GET["user_name"].time()),16,10);
	
	echo "$cookie ";
	
	$cookie=substr($cookie,0,9);
	echo "$cookie ";
	
	$stmt->execute() or 
		die($stmt->error);
		
	setcookie("user_cookie",$cookie,time()+3600*2);
	header("Location: index.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.33" />
</head>

<body>
	
</body>

</html>
