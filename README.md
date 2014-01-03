# guacamole-auth-hmac-easy 
  
  
## Description

This project is an authentication plugin for [Guacamole](http://guac-dev.org), an HTML5 based
remote desktop (RDP) gateway that **allows you to create URLs for connecting to your Guacamole server that pass user credential and RDP host variables, allowing you to pre-authenticate with Guacamole and connect directly to RDP sessions.**

This is made possible using a pre-shared key and a checksum variable with an expiring timestamp passed in the URL to perform a passive handshake with your Guacamole server.

This plugin is ideally suited for environments that require dynamic access to RDP sessions and your RDP host and credential information is stored in your own database.

This plugin has been implemented in a training center to support 1,000+ dynamically reserved RDP sessions for a hands-on lab environment that is powered by a homegrown MySQL database that manages the reservations.

## Project Fork

This project is a forked version of the guacamole-auth-hmac project by
Stephen Sugden (github.com/grncdr/guacamole-auth-hmac). 

This fork includes the packaged .jar extension for Guacamole 0.8.3 and a 
PHP function that you can integrate into your existing web application for 
dynamically generating URLs with connection paramater variables (from your
own database) to directly connect to RDP sessions via Guacamole RDP Gateway. 

## Installation Instructions

These instructions assume that you are using Ubuntu 12.04, herein referred to as `guac-server`.  

### Step 1. Install Guacamole 0.8.3
* Official Documentation can be found in the [Guacamole Manual](http://guac-dev.org/doc/gug/)  
* Jefferson Martin wrote [step-by-step instructions](https://gist.github.com/jeffersonmartin/8236574) for installation on Ubuntu 12.04 LTS

### Step 2. Upload .jar File to /var/lib/guacamole/classpath
1. SFTP to `guac-server` and navigate to `/var/lib/guacamole/classpath/`
2. Upload the `guacamole-auth-hmac-1.0-SNAPSHOT.jar` file to this directory.
3. Change the permissions of the `.jar` file to 777 (rwx-rwx-rwx). 

### Step 3. Update /etc/guacamole/guacamole.properties
1. SSH to `guac-server` and navigate to `/etc/guacamole`.
2. Edit the guacamole.properties file using `nano guacamole.properties`. You can use `vi` if you prefer.
3. Comment out the `auth-provider` and `user-mapping` lines using a `#`.
4. Add a three new lines with the following syntax (replace {your-key} with your secret passphrase) `auth-provider: com.stephensugden.guacamole.net.hmac.HmacAuthenticationProvider` `secret-key: {your-key}` `timestamp-age-limit: 600000`
5. Press `Ctrl+X` and `Y` to save your changes and exit.
6. Do not close your SSH session yet.

### Step 4. Restart tomcat6 and guacd services
1. Restart the tomcat6 and guacd services using the following commands: `service tomcat6 restart` `service guacd restart`
2. If for any reason you receive error messages and the services did not restart, you can try: `/etc/init.d/tomcat6 restart` `/etc/init.d/guacd restart`

### Step 5. Test URL Creation from localhost
1. Copy the `/www/` directory to a `{path}` of your choosing inside of your local machine's Apache directory.
2. Open `guacamole_url_example.php` in your favorite text editor.
3. Follow the directions in the comments and change the variables to match an RDP client in your environment.
4. Open your browser and navigate to `http://localhost/{path}/www/guacamole_url_example.php`
5. Copy the outputted URL string and paste it into a new browser tab.
6. If all went well, you should be able to see the login screen for windows. If you received an error message, see the Troubleshooting section below.

### Troubleshooting Connection Issues

* **Unauthorized** - Your security passphrase was not able to validate. Verify that you spelled it the same in the `generate_url_example.php` page as well as the `guacamole.properties` file. This error can also occur if you did not configure your auth-provider properly in the `guacamole.properties` file.
* **Unknown Error** - There was an error with the Guacamole server, likely due to version incompatibility. If you upgraded from a previous Guacamole version or are using a version earlier than 0.8.3 you will need to perform a fresh installation. 
* **Server Error** - There is a networking issue and the Guacamole server cannot reach your RDP client. Verify your network IP address and subnet configuration on both your Guacamole server and RDP client.

### Step 6. Integrate URL Creation into your Application

You can use the syntax example in generate_url_example.php to perform URL generation from your PHP application. A MySQL query example is included (commented out) for your convenience as well. Be sure to include the `includes/guacamole.php` file which has the `guacamole_url()` function.

## Project Source

For source for the guacamole-auth-hmac project and documentation for all of the paramaters, please see the original (non-forked) project readme at [https://github.com/grncdr/guacamole-auth-hmac](https://github.com/grncdr/guacamole-auth-hmac).

## License

MIT License
