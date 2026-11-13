<?php

// ----------------------------------------------------------------------
// eFiction 3.2
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



	$output .= "<div id=\"pagetitle\">"._VERSIONCHECK."</div>";

	$url = 'http://cwcyrix.nsupdate.info/_ef3m/version.txt';

	// make sure curl is installed
	if (function_exists('curl_init')) {
		$output .= write_message(_RUNNINGVERSION);
		// initialize a new curl resource
		$ch = curl_init();

		// set the url to fetch
		curl_setopt($ch, CURLOPT_URL, "$url");

		// don't give me the headers just the content
		curl_setopt($ch, CURLOPT_HEADER, 0);

		// return the value instead of printing the response to browser
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// use a user agent to mimic a browser
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64; rv:156.0) Gecko/20100101 Firefox/156.0');

		$content = curl_exec($ch);
		$currentversion = trim($content);
		$curlength = strlen($currentversion);

		if($curlength < 3 || $curlength > 7) {
			errorVer();
		}
		else $output .= write_message(_CURRENTVERSION. "$currentversion" .".");

		if ($currentversion != $version) {
			$output .= write_message (_UPDATEVERSION);
			$output .= write_message ("<a href=\"https://github.com/AmiSapphire/efiction3-mod/tags/".$currentversion."\">https://github.com/AmiSapphire/efiction3-mod/tags/".$currentversion."</a>");
		}
		else $output .= write_message (_UPTODATE);

		// remember to always close the session and free all resources
		// deprecated in PHP 8.5.0, does nothing since PHP 8.0.0
		// bugged? - https://www.php.net/manual/en/function.curl-close.php#128829
		if (version_compare(PHP_VERSION, '7.3.33', '<=')) {
			curl_close($ch);
		}
		else curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE);
	}

	else if(ini_get("allow_url_fopen")) {
		$output .= write_message(_RUNNINGVERSION);

		$location = fopen ("$url", "r");
		$buffer = '';
		while (!feof ($location)) {
			$buffer .= fgets($location, 4096);
		}
		fclose ($location);

		if ($buffer != '') {
			$currentversion = trim($buffer);
			$curlength = strlen($currentversion);

			if($curlength < 3 || $curlength > 7) {
				errorVer();
			}
			else $output .= write_message(_CURRENTVERSION. "$currentversion" .".");

			if ($currentversion != $version) {
			$output .= write_message (_UPDATEVERSION);
			$output .= write_message ("<a href=\"https://github.com/AmiSapphire/efiction3-mod/tags/".$currentversion."\">https://github.com/AmiSapphire/efiction3-mod/tags/".$currentversion."</a>");
			}
			else $output .= write_message (_UPTODATE);
		}
	}
	else {	
		$output .= write_message(_VERSIONNOTALLOWED);
	}

function errorVer(){
	global $tpl,$output;

	$output .= write_error("<center>Not a version number!</center>");
	$tpl->assign("output", $output);
	$tpl->printToScreen( );
}

?>
