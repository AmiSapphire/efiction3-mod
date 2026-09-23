# eFiction 3 Mod

This version is essentially a version of 'future 3.5.9' wiith some of my internal modifications. Support of bcrypt passwords with old MD5 fallback, new user registrations control, and more choices of tinyMCE are a few of my modifications.


## Requirements

- Minimum: PHP 7.4, MySQL 5.7.7 or MariaDB 10.6
- Recommended: PHP 8.4, MySQL 8.0 or MariaDB 11.4
- Tested Working: PHP: 7.4.33, 8.5.8; MariaDB: 10.6, 10.11, 11.4


## Installation

Same as the usual eFiction 3.x installs.


## Updating

Just place the script over your current install like any upgrade. This script can upgrade to future 3.5.9 with a few eFiction 3 Mod entries by upgrading over versions 3.5.3 to 3.5.8. After that, go to the conversion page in the Archive Conversion Panel to convert the database to eFiction 3 Mod. If you have already upgraded to a clean version of future 3.5.9, you can just go straight to the Archive Conversion page and run the Mod conversion script, as the upgrade.php file will not run at that point.


## Notes


### PHP

This script is being tested for issues with future PHP 8.6.0, and anything actually unique to 8.6 was likely fixed. The other stuff would be related to older PHP 8 versions. Since some patches over time (starting in 2016) use PHP 7+ only behavior, this means that you can no longer use eFiction with PHP 5.6 and earlier. PHP should also use the UTF-8 character set to use this script. The entry in the ini file should say UTF-8 for default_charset.

default_charset = "UTF-8"


### Database

Due to the community changes to this script over the years, it now handles text and data as UTF-8 as opposed to ISO-8859-1. Further changes to this script here should fully handle multibyte characters now. Yes, eFiction can now finally use emoji! To fully take advantage of this archive's character set, the database server does need to connect and use the utf8mb4 collation. This is just a sample for my.cnf or equivalent, needed for older installs and versions. Note: character_set_system is hardcoded and cannot be user-set.

init-connect = 'SET NAMES utf8mb4'
<br>
character-set-server = utf8mb4
<br>
collation-server = utf8mb4_unicode_ci

- For MySQL versions starting with 8.0, the default setting for collation_server is **utf8mb4_0900_ai_ci**.
- For MariaDB versions starting with 11.8 (introduced in 11.6), the default setting for collation_server is **utf8mb4_uca1400_ai_ci**.

For MariaDB versions 10.6 to 11.4, this is needed:

old-mode =

Setting the old-mode setting as blank overrides the UTF8_IS_UTF8MB3 binding to this variable and uses the current utf8mb4 aliasing.

Reference: https://mariadb.com/docs/server/server-management/variables-and-modes/old_mode

Alternateively, in includes/mysqli_functions, you may comment the line **mysqli_query($mysqli_access, "SET NAMES UTF8;");**  and uncomment the line **mysqli_query($mysqli_access, "SET NAMES UTF8MB4;");** if you are not able to configure the database configuration. It is recommended to uncomment the line **mysqli_query($mysqli_access, "SET collation_connection = utf8mb4_bin;");** if the UTF8MB4 line is used as well.


### Installation and Usage

- The directory eFiction will be installed should have read, write and execute permissions. For Unix/Linux, it should technically be chmod'ed to 755 and chown'ed to the web server's user account. The directory should be chown'ed to the webserver user (usually daemon, www-data, or apache). Failing that, you can either chmod 755 (777 if failed somehow, should probably change it back to 755 afterwards) or create a blank config.php file (example: touch /path/to/eFiction3/config.php) in your eFiction directory and chmod that to 666.
- Creating a series entry, adding a story to the series, then removing the story from the series can leave the Number of Stories count unchanged. This is due to the fact that some references aren't calculated automatically. In the Admin Panel > Archive Maintenance section, use 'Recalculate Reviews', 'Recalculate Stories', and 'Recalculate Site Statistics', and it should rectify this issue.
- When using the category 'Only one' setting for a single category, the script strongly assumes to use catid=1 for adding a series to a category, so if that particular category was later removed, the Category: field will be empty. Doesn't help that you can still create more categories after the fact, which may muddy up things a bit. Using 'Fix Category Order' should fix this to some extent, but if that fails, database table editing in 'fanfiction_categories' to change the intended category to catid=1 AND changing AUTO_INCREMENT to 2 should suffice. If, somehow, there are no categories in the database and the AUTO_INCREMENT count is past 2, change AUTO_INCREMENT back to 1 and create the intended category.
- The initial database installation script explicitly removes all the forced latin1 charset and latin1_swedish_ci collation references starting with eFiction 3.5.5 (meaning they were last present in eFiction 3.5.3). The forced latin1 charset in the script would have caused issues with much newer database installs using utf8mb3 or utf8mb4 by default. As a result, it uses the server's database settings. It, however, does force MyISAM for its database engine, and this mod forces that to InnoDB anyway, despite it being the database server default for over 15 years. I have not seen any issues regarding the InnoDB change in eFiction 3 Mod as of yet.

<br>

# Changelog


### Future 3.5.9 release has the following changes and fixes so far:

- date fields fix
- logs fail typo fix
- PHP warning fixes
- SMTP updates/fixes and an SMTP settings tester


### eFiction 3 Mod has the following changes and fixes so far:

- Original eFiction 3 skins restored
- Future 3.5.9 SMTP database table creation oversight fixes (also install.php consistency change)
- SQL database engine change from MyISAM to InnoDB
- SQL database charset changes from latin1 to utf8mb4 (certain fields are utf8mb4 'ci' for sorting purposes and certain count purposes, however)
- Password hashes are now bcrypt with a cost of 12 instead of MD5 (though old MD5 hashed passwords still work until changed by user; they are warned beforehand)
- includes/button.php: GD captcha font path handling fix for PHP 8.6/GD 2.4.0 users and remove unused variable
- includes/plain.button.php: Undefined variable PHP warning fix
- includes/corefunctions.php: occasional foreach array|object, string given PHP warning fix
- includes/userlist.php: Uncaught TypeError for Co-Authors field in PHP 8.x when searching for a user with the first character yields no results - discovered this one entirely by accident due to a typo... slipped my hand on the keyboard!
- install/install.php: SMTP settings table column creation oversight fix, consistency changes, and cleanup
- user/manageimages.php: Add support for WebP images
- search.php: failed penname search causes PHP warning fix for PHP 8.x users - MySQL error message overwriting the Search Results header due to an assumption of an array count of author data
- series.php: category settings causing Fatal Error bug for PHP 8.x users and Undefined array key PHP warning fixes
- stories.php: add story with null category using 'Only one' setting causing Fatal Error bug fix for PHP 8.x users
- categories.php: deleting only category causing Fatal Error bug fix for PHP 8.x users
- header.php: leftover array typo oversight fix with age consent feature
- admin/settings.php: SMTP updates/fixes and test code implementation and oversights breaking Ratings and $storiespath fixes
- blocks/menu/menu.php: Array to string conversion warning when accessing the menu block page fix
- admin/panels.php: Trying to access offset array on null PHP warning when creating a new panel entry fix
- reviews.php: Prevent users/anons from trying to create/rate nonexistent or no longer existing stories and series fix and reviews page showing up to null stories/series fix
- viewseries.php: Add a check for anyone trying to access a nonexistent or no longer existing series - null series page/various PHP warnings fix
- install/corefunctions.php, user/revres.php: Trying to access array offset on null PHP warning when responding to a review fix
- reviews.php, stories.php, viewstory.php, includes/corefunctions.php, includes/storyblock.php, includes/storyform.php, user/revres.php: proper coauthors behavior fixes
- docs/config.php, includes/browsecategories.php, includes/categorylist.php, includes/characterlist.php, includes/userlist.php, install/install.php, user/login.php: redundant dbfunctions.php entries including cleanup
- header.php, rss.php, admin/backup.php, admin/backup_utf8.php, includes/categorylist.php, includes/userlist.php, install/install.php, languages/en.php: possible CHARSET definition breakage - mostly reverted as one former config.php line does belong in includes/dbfunctions.php and very old editing typo causing Uncaught ValueError: Unknown format specifier message regarding changing an author with logging enabled fix
- rss.php, includes/button.php (me), includes/plain.button.php (me), languages/en.php (me): error and warning message suppression removal - rss and en were a stupid hack for the actual problem in the next item of the list
- languages/en.php: undefined variables warning fix for PHP 8.x - applies to any other language PHP files, so they should be updated - only needs one line and one additional file in the **includes** directory
- admin/settings.php, install/install.php: Do not parse the mailer directory in the Admin Panel's or installer's language setting's drop-down menus
- admin/viewlog.php, languages/en_admin.php: some hardcoded English entries have been relocated to the Admin Panel language file
- includes/reviewform.php, includes/seriesreviews.php, reviews.php: Number of Likes - unfinished calculation fixes and updates, implement its entry in the review form as well
- Bridges return! Their removal got rid of the example work, which is now updated as well
- Layout fixes and consistency changes for various sections of the script: admin settings, new/edit story pages, new/edit series pages, installer
- TinyMCE versions added; now you have a choice of TinyMCE versions 2.1.2, 3.4.8, 4.5.12, 5.3.2, and 6.8.6 - replaces eFiction 3.5.x's original 3.0.9
- Setting to enable or disable new user registrations - sorely needed for some archives
- New Archive Conversion page for Unicode database conversions - initial Mod conversion and Unicode versions 4.0, 5.2, 9.0, 14.0

<br>

README_old.md has the noted changes and fixes from 3.5.8.f1 down to 3.5.6.
