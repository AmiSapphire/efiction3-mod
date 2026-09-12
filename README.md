# eFiction 3 Mod

This version is essentially a version of 'future 3.5.9' wiith some of my internal modifications. For now, there are no auto paths to patch old eFiction versions to this version, so it has to be done manually. (The update.php file needs to be cleaned up, and the 3.5.5 update does not work properly in PHP 7 anyway.)


## Requirements

- Minimum: PHP 7.4, MySQL 5.7.7 or MariaDB 10.6
- Recommnended: PHP 8.4, MySQL 8.0 or MariaDB 11.4
- Tested Working: PHP: 7.4.33, 8.5.8; MariaDB: 10.6, 10.11, 11.4


## Installation

Same as the usual eFiction 3.x installs.


## Updating

Has to be done manually for now. Easiest if you have either unofficial versions 3.5.8, 3.5.8.f1, or future 3.5.9. If you are updating from versions 3.5.3, 3.5.5, or 3.5.6, update to at least version 3.5.8 first.

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
- Password hashes are now bcrypt with a cost of 12 instead of MD5 (though old MD5 hashed passwords still work until changed by user)
- includes/button.php: GD captcha font path handling fix for PHP 8.6/GD 2.4.0 users and remove unused variable
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
- install/corefunctions.php, user/revres.php: Trying to access array offset on null PHP warning when responding to a review fix
- stories.php, viewstory.php, includes/corefunctions.php, includes/storyblock.php, includes/storyform.php, user/revres.php: proper coauthors behavior fixes
- docs/config.php, includes/browsecategories.php, includes/categorylist.php, includes/characterlist.php, includes/userlist.php, install/install.php, user/login.php: redundant dbfunctions.php entries including cleanup
- header.php, rss.php, admin/backup.php, admin/backup_utf8.php, includes/categorylist.php, includes/userlist.php, install/install.php, languages/en.php: possible CHARSET definition breakage - mostly reverted as one former config.php line does belong in includes/dbfunctions.php
- rss.php, includes/button.php (me), languages/en.php (me): error and warning message suppression removal - rss and en were a stupid hack for the actual problem in the next item of the list
- languages/en.php: undefined variables warning fix for PHP 8.x - applies to any other language PHP files, so they should be updated - only needs one line and one additional file in the **includes** directory
- admin/settings.php, install/install.php: Do not parse the mailer directory in the Admin Panel's or installer's language setting's drop-down menus
- Bridges return! Their removal got rid of the example work, which is now updated as well
- Layout fixes and consistency changes for various sections of the script: admin settings, new/edit story pages, new/edit series pages, installer
- TinyMCE versions added; now you have a choice of TinyMCE versions 2.1.2, 3.4.8, 4.5.12, 5.3.2, and 6.8.6 - replaces eFiction 3.5.x's original 3.0.9
- Setting to enable or disable new user registrations - sorely needed for some archives

<br>

README_old.md has the noted changes and fixes from 3.5.8.f1 down to 3.5.6.
