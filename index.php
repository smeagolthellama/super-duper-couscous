<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$mysqli=new mysqli("localhost","mark","top secret","konquest");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
}
if(isset($_COOKIE["user_cookie"])){
	$sql_update_user_time = 'UPDATE users SET user_last_seen=now(),user_kick_time=DATE_ADD(now(),INTERVAL 2 HOUR) WHERE user_cookie=?';
	$stmt=mysqli_prepare($mysqli,$sql_update_user_time) or die( $mysqli->error);
	mysqli_stmt_bind_param($stmt,"s",$_COOKIE["user_cookie"]);
	mysqli_stmt_execute($stmt);
}

$sql_kickusers  = 'DELETE FROM users WHERE user_kick_time < now()';
$kicks= mysqli_query($mysqli,$sql_kickusers);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel=stylesheet href=style.css>
		<title>
			index of php-on-quest.
		</title>
	</head>
	<body>
		<?php
		
			echo "<div class=backhack>";
			include 'hack.html';
			echo "</div><div class=body>";
			if(isset($_COOKIE["user_cookie"])){
				$sql_update_user_time = 'Select user_name from users WHERE user_cookie=?';
				$stmt=mysqli_prepare($mysqli,$sql_update_user_time);
				mysqli_stmt_bind_param($stmt,"i",$_COOKIE["user_cookie"]);
				mysqli_stmt_bind_result($stmt,$user_name);
				echo "<div class=debug>";
				var_dump(mysqli_stmt_execute($stmt));
				var_dump(mysqli_stmt_fetch($stmt));
				echo "</div>";
				mysqli_stmt_close($stmt);
				echo "<h1 >Greetings $user_name! The empire's fleet awaits your command sir. </h1>";
			}else{
				echo "<h1 >please choose a username and a game to join below:<br><form action=register.php method=get>Username:<input type=text name=user_name><br>Game:<input type=number name=game_id><input type=submit></form></h1>";
			}
			echo "<div class=notifs><p >incoming messages:</p>";
			require 'notifs.php';
			echo "</div>";
		?>
		</div>
	</body>
</html>
