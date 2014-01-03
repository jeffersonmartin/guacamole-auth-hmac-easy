<?

/**
 *   
 *   Generate Guacamole URL Example
 *
 *   Authored by Jefferson Martin 
 *   github.com/jeffersonmartin
 *
 *   Step 1. Include guacamole_url() function
 *   
 *   In order to generate a Guacamole URL, you will
 *   need to include the guacamole_url() function
 *   by copying the guacamole.php file into your
 *   includes/ or functions/ directory and using
 *   include() or require() on the respective page.
 *   You can also copy the function syntax block
 *   into your functions.php (or similar) library.
 *
 *   Step 2. Define your secret salt passphrase
 *
 *   Enter a passphrase that will be used as a pre-
 *   shared key to perform a handshake with your
 *   Guacamole server. Be sure to add the following
 *   line to your guacamole.properties file:
 *   	secret-key: secret
 *
 *   Step 3. Define Variables for Connection Params
 *
 *   Using either a MySQL database query or static
 *   variables, define the connection parameters
 *   for connecting to your RDP session.
 *
 *   Step 4. Call the guacamole_url() Function
 *
 *   Call the function and pass your connection
 *   parameter variables (or values) in. The
 *   returned output will be the full URL string.
 *
 *   To test this, copy the /www/ directory to
 *   your Apache directory and open browser to
 *   http://localhost/{path}/www/generate_url_example.php
 *   
 */

/* Include the guacamole function */
require('includes/guacamole.php');

/* Define your Secret Passphrase */
// $secret_salt = 'MyGu4c4m0l31sT00S4lty';
$secret_salt = 'secret';


/**
 *
 *   Static Variable Example
 *
 *   The Connection ID is an arbitrary value as far as Guacamole is concerned
 *   but it is recommended to use the auto-increment value from your SQL table
 *   
 */

/* Specify the Base URL (change to your domain name) */
$base_url			= 'http://rdp.mycompany.com:8080/guacamole/client.xhtml';

/* Specify a unique connection ID */
$conn_id			= '123456789';

/* Enter the IP address or DNS Hostname for your Computer */
$host				= '10.1.1.120';

/* Specify the Protocol (rdp, vnc, ssh) to use */
$protocol			= 'rdp';

/* Call the guacamole_url Function with your Connection Parameters */
guacamole_url($base_url,$conn_id,$host,$protocol,$secret_salt);


/**
 *   
 *   MySQL Database Query Example
 *   
 */

//	
//	$base_url		= 'http://rdp.mycompany.com:8080/guacamole/client.xhtml';
//	$conn_id		= $_POST['conn_id'];
//	
//	$sql_query = mysql_query("SELECT conn_id,host,protocol,username,password FROM rdp_connections WHERE conn_id='$conn_id'") or die(mysql_error());
//	$sql_query_fa = mysql_fetch_assoc($sql_query);
//	
//	$conn_id 		= $sql_query_fa['conn_id'];
//	$host 			= $sql_query_fa['host'];
//	$protocol 		= $sql_query_fa['protocol'];
//	$username 		= $sql_query_fa['username'];
//	$password 		= $sql_query_fa['password'];
//	
//	guacamole_url($base_url,$conn_id,$host,$protocol,$secret_salt);
//

?>