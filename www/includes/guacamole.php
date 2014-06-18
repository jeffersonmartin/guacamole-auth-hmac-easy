<?php

/**
 *   
 *   Guacamole Authentication URL Generator
 *
 *   Authored by Jefferson Martin 
 *   github.com/jeffersonmartin/guacamole-auth-hmac
 *   
 *   Adapted from GuacamoleUrlBuilder.php by Stephen Sugden
 *   github.com/grncdr/guacamole-auth-hmac
 *
 *   This function uses the connection information for
 *   your RDP, VNC or SSH session to create a URL string
 *   that can be used to connect to your Guacamole server
 *   directly with variables stored in your own webapp.
 *   
 */

/*------------------------------------------
|                                          |
|  DO NOT CHANGE ANYTHING BELOW THIS LINE  |
|                                          |
------------------------------------------*/

function guacamole_url($base_url,$conn_id,$hostname,$protocol,$secret) {

	/* Define Variables from User Inputs */
	$guac_base_url 		= $base_url;
	$guac_conn_id		= $conn_id;
	$guac_hostname 		= $hostname;
	$guac_protocol		= $protocol;
	$guac_secret		= $secret;

	/* Set Default Value for Port Number */
	$guac_port 			= '0';

	/* Define Port Number for Known Protocols */
	if($guac_protocol=='rdp') $guac_port = '3389';
	if($guac_protocol=='vnc') $guac_port = '5900';
	if($guac_protocol=='ssh') $guac_port = '22';

	/* Set Timestamp in Milliseconds */
	$timestamp = time() * 1000;

	/* Create Signature (Checksum) using Concatenated Variables */
	$signature_concatenate = $timestamp.$guac_protocol.'hostname'.$guac_hostname.'port'.$guac_port;

	/* Encode Signature (Checksum) using Secret (Salt) */
	$signature_encode = base64_encode(hash_hmac('sha1', $signature_concatenate, $guac_secret, 1));

	/* Create URL String with Concatenated Key Pair Variables */
	$guacamole_url = $guac_base_url.'?id=c/'.$guac_conn_id.'&guac.protocol='.$guac_protocol.'&guac.hostname='.$guac_hostname.'&guac.port='.$guac_port.'&amp;timestamp='.$timestamp.'&signature='.$signature_encode;

	/* Return URL String to User */
	echo $guacamole_url;

} /* End of function guacamole_url() */

?>