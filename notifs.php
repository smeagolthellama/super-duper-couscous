<?php	
$mysqli=new mysqli("localhost","mark","top secret","konquest");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
}
if(isset($_COOKIE["user_cookie"])){
	$stmt=mysqli_prepare($mysqli,"
	select users1.user_name,users2.user_name,games.game_id,notifs.timestamp,
		planets1.name ,planets2.name,notifs.notif_type
		,notifs.notif_text 
	from 
		notifs,games,
		planets as planets1,
		planets as planets2,
		users as users1,
		users as users2
	where 
		planets1.game_id=games.id 
		and planets2.game_id=games.id
		and games.id=(select user_game_id from users where user_cookie=?) 
		and planets1.planet_id=notifs.planet1_id 
		and planets2.planet_id=notifs.planet2_id 
	ordrer by notifs.timestamp asc;
		") or die( $mysqli->error);
	#user cookie,
	mysqli_stmt_bind_param($stmt,"s",$_COOKIE["user_cookie"]);
	mysqli_stmt_bind_result($stmt,$username)
}
?>
