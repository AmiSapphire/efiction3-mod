<?php
define("_BASEDIR", "../");
define("_CATCHARSET", "utf-8");

include("../config.php");
 

list($tableprefix, $lang) = dbrow(dbquery("SELECT tableprefix, language FROM ".$settingsprefix."fanfiction_settings WHERE sitekey = '$sitekey'"));
define("TABLEPREFIX", $tableprefix);
 
header("Content-Type: text/javascript; charset="._CATCHARSET,true);
include("../includes/queries.php");

$catid = isset($_GET['catid']) && preg_match("/^[0-9]+$/", $_GET['catid']) ? $_GET['catid'] : -1;
$cats = dbquery("SELECT * FROM ".TABLEPREFIX."fanfiction_categories WHERE parentcatid = '$catid' OR catid = '$catid' ORDER BY leveldown, displayorder");
if(!isset($_GET['element']) || !preg_match('/^[A-Za-z_][A-Za-z0-9_.-]*$/', $_GET['element'])) $_GET['element'] = '';
echo "var el = '".addslashes($_GET['element'])."';\n";
$x = 0;
$find = array ('"', chr(150), chr(147), chr(148), chr(146));
$replace = array ('\"', "-", "\"", "\"", "'");
while($category = dbassoc($cats)) {
	echo "categories[$x] = new category(".(int)$category['parentcatid'].", ".(int)$category['catid'].", \"".urlencode(str_replace($find, $replace, stripslashes((string)$category['category'])))."\", ".$category['locked'].", ".$category['displayorder'].");\r\n";
	$x++;
}
?>
