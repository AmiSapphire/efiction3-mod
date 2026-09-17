<?php
// ----------------------------------------------------------------------
// eFiction 3.0
// Copyright (c) 2007 by Tammy Keefer
// Valid HTML 4.01 Transitional
// Based on eFiction 1.1
// Copyright (C) 2003 by Rebecca Smallwood.
// http://efiction.sourceforge.net/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------

if(!defined("_CHARSET")) exit( );
$expVer = explode(".", $version);
$confirm = isset($_GET['confirm']) ? $_GET['confirm'] : false;

// silly converted update script... just to further convert collation in some tables

// messy version check, starting with version 3.5.9
if($expVer[0] == 3 && ($expVer[1] == 5 || $expVer[1] >=6 && (!isset($expVer[2]) || $expVer[2] == 9 || $expVer[2] > 0))) {
if($confirm == "yes") {
	// For converting certain fields to a chosen collation, starting with versions 3.5.9
    if($expVer[0] == 3 && ($expVer[1] == 5 || $expVer[1] >=6 && (!isset($expVer[2]) || $expVer[2] == 9 || $expVer[2] > 0))) {
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authors CHANGE `penname` `penname` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '', CHANGE `realname` `realname` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_categories CHANGE `category` `category` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_characters CHANGE `charname` `charname` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_favorites CHANGE `type` `type` CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_ratings CHANGE `rating` `rating` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_series CHANGE `title` `title` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT '', CHANGE `summary` `summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stories CHANGE `title` `title` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NOT NULL DEFAULT 'Untitled', CHANGE `summary` `summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci NULL DEFAULT NULL;");
		$alltables = dbquery("SHOW TABLES");
	}
	$update = dbquery("UPDATE ".$settingsprefix."fanfiction_settings SET version = '$version' WHERE sitekey ='".SITEKEY."'");
	$alltables = dbquery("SHOW TABLES");
	while ($table = dbassoc($alltables)) {
		foreach ($table as $db => $tablename) {
			dbquery("OPTIMIZE TABLE `".$tablename."`");
		}
	}
	if($update) $output .= write_message(_ACTIONSUCCESSFUL);
	else $output .= write_error(_ERROR);
}
else if($confirm == "no") {
	$output .= write_message(_ACTIONCANCELLED);
}
else {
  	$output .= write_message("Some fields in this setup will be converted to Unicode 14.0.  You should run the eFiction 3 Mod conversion first.  You are advised to back up your database before starting! <br />
Are you ready to convert to Unicode 14.0? <a href='admin.php?action=convert&conv=convert_1400&amp;confirm=yes'>"._YES."</a> "._OR." <a href='admin.php?action=convert&conv=convert_1400&amp;confirm=no'>"._NO."</a>");
}
}
else $output .= write_message(_ALREADYUPDATED);
?>
