<p class="text-center">
<?
//if we have a valid access token, make an API call
if(!empty($access_token)) {
	echo "The requested page '".$page."' is not available, sorry for the inconvenience.";
	echo "<a href=\"?page=tasks\">Enter Moodledo</a>";
} else {
	echo "If you are not redirected automatically, please click on the following link";
	echo "<a href=\"".$toodledo->getAuthURL()."\">Connect Toodledo</a>";
}
?>
</p>
