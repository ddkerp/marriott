ALTER TABLE  `venue` ADD  `enquiry_mailid` VARCHAR( 255 ) NOT NULL AFTER  `associate_name`;
ALTER TABLE  `venue` CHANGE  `enquiry_mailid`  `associate_mailid` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE  `venue` ADD  `associate_name` VARCHAR( 255 ) NOT NULL AFTER  `image_link`;