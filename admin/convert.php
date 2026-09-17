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

// converted maintenance page

$convert = isset($_GET['conv']) ? $_GET['conv'] : false;
$output .= "<div id='pagetitle'>"._ARCHIVECONV."</div>";
if($convert == "convert_mod") {
	if(file_exists("admin/convert_mod.php")) include_once("admin/convert_mod.php");
}
if($convert == "convert_utf") {
	if(file_exists("admin/convert_utf.php")) include_once("admin/convert_utf.php");
}
if($convert == "convert_0900") {
	if(file_exists("admin/convert_0900.php")) include_once("admin/convert_0900.php");
}
if($convert == "convert_1400") {
	if(file_exists("admin/convert_1400.php")) include_once("admin/convert_1400.php");
}
$output .= "
<ul>
	<li><a href='admin.php?action=convert&amp;conv=convert_mod'>"._CONVERT_MOD."</a>  <A HREF=\"#\" class=\"pophelp\">[?]<span>"._HELP_CONVERTMOD."</span></A></li>
	<li><a href='admin.php?action=convert&amp;conv=convert_utf'>"._CONVERT_UTF."</a>  <A HREF=\"#\" class=\"pophelp\">[?]<span>"._HELP_CONVERTUTF."</span></A></li>
	<li><a href='admin.php?action=convert&amp;conv=convert_0900'>"._CONVERT_0900."</a>  <A HREF=\"#\" class=\"pophelp\">[?]<span>"._HELP_CONVERT0900."</span></A></li>
	<li><a href='admin.php?action=convert&amp;conv=convert_1400'>"._CONVERT_1400."</a>  <A HREF=\"#\" class=\"pophelp\">[?]<span>"._HELP_CONVERT1400."</span></A></li>
</ul>";
