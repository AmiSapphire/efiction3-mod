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

// silly converted update script... just to convert collation and engine type in some tables

// messy version check, starting with version 3.5.9
if($expVer[0] == 3 && ($expVer[1] == 5 || $expVer[1] >=6 && (!isset($expVer[2]) || $expVer[2] == 9 || $expVer[2] > 0))) {
if($confirm == "yes") {
	// For converting to eFiction 3 Mod, starting with versions 3.5.9
	if($expVer[0] == 3 && ($expVer[1] == 5 || $expVer[1] >=6 && (!isset($expVer[2]) || $expVer[2] == 9 || $expVer[2] > 0))) {
		// only if you installed the 'clean' future 3.5.9 version prior
		if (!dbassoc(dbquery("SHOW COLUMNS FROM ".TABLEPREFIX."fanfiction_settings LIKE 'setreg'")))
			dbquery("ALTER TABLE `".TABLEPREFIX."fanfiction_settings` ADD `setreg` tinyint(1) NOT NULL DEFAULT '1' AFTER `multiplecats`");
		if (!dbassoc(dbquery("SELECT * FROM fanfiction_panels WHERE panel_name = 'convert';"))) {
			dbquery("UPDATE `".TABLEPREFIX."fanfiction_panels` SET panel_order = '12' WHERE panel_name = 'modules'");
			dbquery("INSERT INTO `".TABLEPREFIX."fanfiction_panels`(`panel_name`, `panel_title`, `panel_url`, `panel_level`, `panel_hidden`, `panel_type`, `panel_order`) VALUES( 'convert', 'Archive Conversion', '', '1', '0', 'A', '11')");
		}
		// initial UTF-8 conversion
		dbquery("ALTER DATABASE $dbname DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorfields ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorinfo ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorprefs ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authors ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_blocks ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_categories ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_chapters ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_characters ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_classes ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_classtypes ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_coauthors ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_codeblocks ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_comments ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_favorites ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_inseries ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_log ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_messages ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_modules ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_news ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_pagelinks ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_panels ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_ratings ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_reviews ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_series ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_settings ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stats ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stories ENGINE=INNODB, DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_bin;");
		// phase two of UTF-8 conversion
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorfields CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorinfo CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authorprefs CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authors CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_blocks CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_categories CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_chapters CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_characters CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_classes CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_classtypes CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_coauthors CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_codeblocks CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_comments CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_favorites CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_inseries CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_log CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_messages CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_modules CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_news CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_pagelinks CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_panels CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_ratings CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_reviews CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_series CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_settings CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stats CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stories CONVERT TO CHARSET utf8mb4 COLLATE utf8mb4_bin;");
		// change collation of certain columns
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_authors CHANGE `penname` `penname` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', CHANGE `realname` `realname` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_categories CHANGE `category` `category` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_characters CHANGE `charname` `charname` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_favorites CHANGE `type` `type` CHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_ratings CHANGE `rating` `rating` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '';");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_series CHANGE `title` `title` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', CHANGE `summary` `summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
		dbquery("ALTER TABLE ".TABLEPREFIX."fanfiction_stories CHANGE `title` `title` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Untitled', CHANGE `summary` `summary` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
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
  	$output .= write_message("This setup will be converted to eFiction 3 Mod.  There is no turning back, so you are advised to back up your database before starting! <br />
Are you ready to convert to eFiction 3 Mod? <a href='admin.php?action=convert&conv=convert_mod&amp;confirm=yes'>"._YES."</a> "._OR." <a href='admin.php?action=convert&conv=convert_mod&amp;confirm=no'>"._NO."</a>");
}
}
else $output .= write_message(_ALREADYUPDATED);
?>
