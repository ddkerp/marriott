Three methods to use:
* Single file (instructions below)
* Two files (putting credentials in /etc/ folder)
* CSS (optional in either of the above, sample included)

Sample Single File Installation Instructions

1) Place the phpmysqlezedit.php file in your web root or inside a web site
   * yes, you may rename it at will

2) Modify the file to include the credentials for the database. 
   * Optionally include the "table lock" variable to limit access to a single table.

3) access via http://SERVER/PATH/phpmysqlezedit.php?access=XXXX 
   * change the XXXX to a code in the file, and use it in the URL!

4) More Options and notes are inside the file itself, but you can stop here ... it's UP!

5) If you like it, donate $1 (just a dollar!) and I'll keep on uploading it. 
(Actually, I'll probably do that anyway, but it was a shot for a blatant cash request!)

Optional:

6) If you want to make it more secure, you can place the "credentials.php" file in 
   /etc/SCRIPTNAME and name it the exact same as the phpmysqlezedit.php file 
   * including the .php at the end and 
   * including any "path" in front
   * It will look for a file with the same name and path as itself in the /etc/ folder
   * Example: If you access the file via "http://example.com/goodguys/phpmysqlezedit.php", 
     then credentials file will be "/etc/goodguys/phpmysqlezedit.php"

7) Usage notes:
   * [disable] in field comment will use default value and not allow editing 
     when Adding a new record
   * clean_add variable set to TRUE will remove all text from the screen except the 
     title and fields being added
   * To add a comment Above a field in the Add Record page, use {top=Long Comments Allowed} 
     in the Field Comment. Text outside the brackets will still be in the left comment area.
     The comment will span two columns.
   * To display checkboxes and store the values in a text field, use: 
     {checkboxes='value1','value2','value3'} in the field comment. (Presently only during "Add")
   * To display a pretty field label (during "Add"): {display=Pretty Name} in field comment.
     

Note: File must be accessible to process running php (test with chmod 777 /etc/PATH -R)

_________________

Sample Installation Instructions 

* If webroot is: /srv/www/htdocs
* And the goal is a folder named: "goodguys"

cd /srv/www/htdocs
svn checkout svn://svn.code.sf.net/p/phpmysqlezedit/code/ goodguys
nano +43 goodguys/phpmysqlezedit.php

* Change "XXXX" to an access code
* Edit the DB credentials
* Optionally uncomment the "table lock" variable
* SAVE and exit (in nano that would be: ctrl X, then Y and then enter)

Surf to: http://ip_or_domain/goodguys/phpmysqlezedit.php?access=XXXX
______________

Extra Notes:
* This method will include the style sheet and a file named "credentials.php". 
  Either may be omitted or deleted.
* To use the credentials.php file, move it to /etc/goodguys/phpmysqlezedit.php
  