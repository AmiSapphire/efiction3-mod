# eFiction 3 Mod

This version is essentially a version of 'future 3.5.9' wiith some of my internal modifications. For now, there are no auto paths to patch old eFiction versions to this version, so it has to be done manually. (The update.php file needs to be cleaned up, and the 3.5.5 update does not work properly in PHP 7 anyway.)


## Requirements

- Minimum: PHP 7.4, MySQL 5.6.3 or MariaDB 10.5
- Recommnended: PHP 8.4, MySQL 7.0 or MariaDB 11.4
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
- SQL database charset changes from latin1 to utf8mb4 
- Password hashes are now bcrypt with a cost of 12 instead of MD5 (though old MD5 hashed passwords still work until changed by user)

<br>

README_old.md has the noted changes and fixes from 3.5.8.f1 down to 3.5.6.
