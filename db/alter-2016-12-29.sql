ALTER TABLE  `contactus` ADD  `id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
ALTER TABLE  `contactus` ADD  `from_page` VARCHAR( 255 ) NOT NULL AFTER  `privacy_flag`;