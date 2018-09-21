
## [Folder & files Structure]
* <b>assets</b> : General UI files Ex: assets/css, assets/js, assets/img, assets/libs
* <b>themes</b> : Theme UI files Ex: themes/default/css, themes/default/js, themes/default/img, themes/default/libs
* <b>upload</b> : General Uploads.
* <b>includes/models</b> : MVC Models.
* <b>includes/controllers</b> : MVC Controllers.
* <b>includes/A0</b> : A0 Framework.
* <b>includes/libraries</b> : Thirdparty PHP Libraries.
* <b>includes/templates</b> : HTML Templates.
* <b>includes/data</b> : Cache and temp files.
* <b>includes/config.php</b> : Database & mail config.
* <b>includes/controller.php</b> : General config.
* <b>includes/helpers.php</b> : Any General purpose helpers.
* <b>commands</b> : Any CLI commands should be place here.



## [How To Install?]
* Open <b>includes/config.php</b>
* Set database configuration.
* Set Mail server configuration.
* Change <b>security["encryption_token"]</b> to something generic (use command php -f commands/genkey.php to generate a new one)
* From <b>includes/controller.php</b>:
  * Change <b>URI_index</b> to your URL path.
  * Set your timezone.
  * To enable Mantainance Mode set <b>Maintenance_Mode = true</b>
  * Enable or Disable error reporting using display_errors function.



## [How to place your UI?]
* Place all files related to the theme inside <b>themes/THEME_NAME</b>, Which is in my case now is default,
* So, my UI files should be under:
  * themes/default/js
  * themes/default/css
  * themes/default/img
  * themes/default/sound
* Place all General files and libraries used by all themes under assets folder:
  * assets/js
  * assets/css
  * assets/img
  * assets/libs


## [How to use Database?]

Use A0()->db object to perform all Database operations:

A0()->db->query("SELECT * FROM table_name")->result; //Returns MYSQLI natice object.

A0()->db->query("SELECT * FROM table_name")->fetch(); //Fetch single row to array. 

A0()->db->query("SELECT * FROM table_name")->fetchArray(); //Fetch all results to array. 

A0()->db->query("SELECT * FROM table_name")->fetchColumn('column_name'); //Fetch single column

A0()->db->query("SELECT * FROM table_name")->insertedId(); //Get Inserted ID

A0()->db->table('table_name')->update(['field1'=>$value1,'field2'=>$value2],$id); //Update Data

A0()->db->table('table_name')->insert(['field1'=>$value1,'field2'=>$value2]); //Insert Data

A0()->db->table('table_name')->getRow('fieldname',$value); // Get Single Row

A0()->db->affected_rows(); //Get affected rows

A0()->db->foundRows(); //Get number of rows from last select query.

A0()->db->table('tablename')->delete($value,$field='id'); //Delete Row.

A0()->db->query('SELECt * FROM table_name'); //Execute SQL.

A0()->db->query('SELECt * FROM table_name')->fetchArray(); //Get all data as array.

For more details, Please watch file: <b>includes/A0/models/databasei.php</b>



## [How to use Sessions?]
A0()->session->set("key","Value");
A0()->session->get("key");
A0()->session->remove("key");
A0()->session->destroy();



## [How to send email?]
A0()->email->sendMail($to,$subject,$message);


## [How to create models ?]
Please watch files under <b>includes/models/</b>



## [How to create controllers ?]
Please watch files under <b>includes/controllers/</b>



## [How to work with HTML templates?]
A0 uses Smarty Template engine.
Please watch files under <b>includes/templates/</b>


Explore and develop all files under <b>includes/A0</b> it's very easy to be understood.


