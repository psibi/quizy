/* READ THIS!! IT HAS EVERYTHING TO GET YOU STARTED */

/******************************************************************************************
 *
 * phpUserAuth - Simple yet comprehensive user authentication/management system in PHP
 *
 * Author  : Srinath
 * Email   : srinath@iambot.net
 * Web     : http://iambot.net/projects/phpuserauth/
 * Demo    : http://iambot.net/demo/phpuserauth/
 *
 * License : Free to download, use, modify. 
 *           !!! DO NOT DISTRIBUTE OR REPRODUCE WITHOUT THE PERMISSION OF THE AUTHOR !!!	
 *           !!! WILL BE OPEN SOURCED SOON WITH PROPER LICENSE SOON !!!
 *
 * Version : 0.1
 * Date    : July 18, 2010
 *
 * Peace
 *
 *****************************************************************************************/
 

 Requirements
 ------------
	
	1) PHP 5.1+
	2) Support for json_encode, json_decode for the admin page
	2) MySQLi support
	3) MySQL database 

	In a fairly standard/recent PHP installation, all this must be available by default.
 

 I) Installation
 ---------------
 
	1) The script doesn't come with a page for installation yet. That said, its fairly simple to get started
	
	2) Grab the package from http://iambot.net/dScript/download.php?fname=./phpuserauth.zip
	
	3) Extract the directory into your website/application (Ex: If your website is www.example.com,
		but you want to use it with www.example.com/application/, put it there
	
	4) The zip file will contain a single directory called user
	
	5) Now, your directory should look like www.example.com/application/user/
	
	6) Create the tables and the default admin account for the site in your database using the file 
		userauth.sql which is inside the readme folder. Verify if the table "userauth" is created in
		your database and see if it contains a single row with username "admin"
	
	7) You need to change the config.php which is inside the lib folder (www.example.com/application/user/lib/config.php)
	
	8) The MINIMUM settings you need to update are:
		i) General Settings: SITE_NAME, SITE_PATH, ADMIN_NAME, ADMIN_EMAIL
		ii) Database Settings: DB_HOST, DB_USER, DB_PASS, DB_NAME
		iii) Mail Settings if you are using SMTP
	
	9) If you entered all the settings right, you are good to go!
	

II) Setting up admin account
-----------------------------

	1) If your installation went properly, you now have a default admin account with username "admin"
	
	2) YOU MUST LOGIN IMMEDIATELY AND CHANGE THE PASSWORD AND THE EMAIL FOR THE ADMIN ACCOUNT!!
	
	3) Goto the login page - www.example.com/application/user/login.php
	
	4) Login with the following details:
			
			Username: admin
			Password: Q8$ja~K5
			
	5) If you entered it successfully, you will be in the accounts page (account.php)
	
	6) Now goto www.example.com/application/user/resetpass.php
	
	7) Enter the current password as Q8$ja~K5 and ENTER A NEW PASSWORD AND EMAIL FOR YOURSELF!!!
	
	8) Again, CHANGE the password to something you like, AND change the EMAIL to your email address!!
	
	9) Check if you have done steps 7, 8 AGAIN!
	
	10) Now logout by accessing www.example.com/application/user/account.php?do=logout
	
	11) Try logging in again with your new password, and goto the account page to verify your new email
	
	12) If you can't login after changing your password and email, you did something wrong. Try again.
	
	
III) Admin Page
----------------

	1) Admin page is accessible ONLY for the admins (duh!)
	
	2) After logging in as admin, access: www.example.com/application/user/admin/index.php
	
	3) For now, you can only edit the details of other users. You can: 
		i) Activate/Ban/Force logout a user
		ii) Change the username
		iii) Change the userlevel (role) - For now only the three default roles are shown
		
	4) Just click on either the username, User level or Status to change
	
	6) The changes are made through AJAX, so there is nothing to submit

	5) A more comprehensive admin page coming in the next version!


IV) How to Password Protect pages:
----------------------------------

	1) In the page you want to password protect, say ww.example.com/application/purchase.php, 
		include the following lines of code RIGHT AT THE BEGINNING!!

		<?php
			require_once('user/lib/userauth.class.php');
			$user->is('ADMIN,USER');
		?>

	2) The first line is to include our main class file containing all the code relevant
		to phpUserAuth. Of course the path is relative to your application, so make sure
		you get that right

	3) The second line is the actual userlevel/role check. The above example checks if the 
		user is either an ADMIN or a normal USER. These levels are defined in the file
		config.php. You can add custom userlevels to config.php and use them too!

		If the medhod is called without any user levels like so:
			
			$user->is();

		the application checks for the default userlevels: ADMIN,MOD,USER

	4) !!! THESE LINES MUST COME RIGHT AT THE BEGINNING OF THE FILE! IT SHOULD BE THERE
		BEFORE ANY OUTPUT STARTS. !!!

		This is because the constructor of the class initializes the session by calling
		session_start() and if a cookie has to be set, it has to be done using the PHP 
		headers that are sent out BEFORE any actual server output starts.

		!!! AGAIN, put the above lines right at the beginning of the file. The method $user->is()
		should be called first for the authentication to be done properly. Only then if the user is
		not logged in/doesn't have permission to view a page, will he be redirected properly or shown
		an error message


v) FAQ
-------

	Coming Soon!


VI) Change Log
--------------

	18 July, 2010 - Initial release