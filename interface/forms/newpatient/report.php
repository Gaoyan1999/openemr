<?
include_once(dirname(__file__)."/../../globals.php");

function newpatient_report( $pid, $encounter, $cols, $id) {
	$res = sqlStatement("select * from form_encounter where pid='$pid' and encounter='$encounter' and id='$id'");
	print "<table><tr><td>\n";
	while($result = sqlFetchArray($res)) {
		print "<span class=bold>Reason: </span><span class=text>" . $result{"reason"} . "<br>\n";
		print "<span class=bold>Facility: </span><span class=text>" . $result{"facility"} . "<br>\n";
		
	}
	print "</td></tr></table>\n";
}

?>