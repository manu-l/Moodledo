<?
if(empty($user)) {
	/* Not applying */
} else {
	//  Loaded in user.php
	echo "<script>";
	echo "var user = {";
	echo "userid : '".$user['userid']."',";
	echo "email : '".$user['email']."',";
	echo "pro : '".$user['pro']."',";
	echo "dateformat : '".$user['dateformat']."',";
	echo "timezone : '".$user['timezone']."',";
	echo "hidemonths : '".$user['hidemonths']."',";
	echo "hotlistpriority : '".$user['hotlistpriority']."',";
	echo "hotlistduedate : '".$user['hotlistduedate']."',";
	echo "hotliststar : '".$user['hotliststar']."',";
	echo "hotliststatus : '".$user['hotliststatus']."',";
	echo "showtabnums : '".$user['showtabnums']."'";
	echo "}";
	echo "</script>"; 
}
?>
