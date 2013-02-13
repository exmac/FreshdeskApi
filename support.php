<?php 
// SEE README BEFORE USE!!!
add_action('admin_menu', 'mypluginname_support_info',450);
function mypluginname_support_info() {
		add_submenu_page( 'mypluginname', 'Support', 'Support', 'manage_options', 'mypluginname_support', 'mypluginname_support');
}
function mypluginname_support() {
$license 	= get_option( 'mypluginname_license_key' );
	global $wpdb;
	if ( ! class_exists( 'Browser' ) )
		require_once 'browser.php';

	$browser =  new Browser();
if(is_callable('curl_init')){ ?>
<div class="wrap">
		<h2><?php _e('Mypluginname  Support Form'); ?></h2>
		<form method="post" action="admin.php?page=mypluginname_support">
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Your First Name:'); ?>	
						</th>
						<td>
							<input id="your_name" name="your_name" type="text" class="regular-text" value="" placeholder="Your Name"/><br />
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Your Email Address: Will be used to contact you.'); ?>	
						</th>
						<td>
							<input id="your_email" name="your_email" type="text" class="regular-text" value="" placeholder="Your Email"/><br />
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('License Key: A copy is being submitted automatically for you'); ?>
						</th>
						<td>
							<input id="mypluginname_license_key" name="mypluginname_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" readonly="readonly"/>
						</td>
					</tr>
						<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('System Info: A copy is being submitted automatically for you'); ?>
						</th>
						<td>
				<textarea  id="mypluginname-sysinfo" name="mypluginname-sysinfo" style="height:200px; width: 600px;" readonly>
### Begin System Info ###

## Please include this information when posting support requests ##

Multi-site:               <?php echo is_multisite() ? 'Yes' . "\n" : 'No' . "\n" ?>

SITE_URL:                 <?php echo site_url() . "\n"; ?>
HOME_URL:                 <?php echo home_url() . "\n"; ?>

Mypluginname Version :    <?php echo MYPLUGINNAME_VERSION . "\n"; ?>
WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>

<?php echo $browser ; ?>

PHP Version:              <?php echo PHP_VERSION . "\n"; ?>
MySQL Version:            <?php echo mysql_get_server_info() . "\n"; ?>
Web Server Info:          <?php echo $_SERVER['SERVER_SOFTWARE'] . "\n"; ?>

PHP Memory Limit:         <?php echo ini_get( 'memory_limit' ) . "\n"; ?>
PHP Post Max Size:        <?php echo ini_get( 'post_max_size' ) . "\n"; ?>
PHP Time Limit:           <?php echo ini_get( 'max_execution_time' ) . "\n"; ?>

WP_DEBUG:                 <?php echo defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' . "\n" : 'Disabled' . "\n" : 'Not set' . "\n" ?>

WP Table Prefix:          <?php echo "Length: ". strlen( $wpdb->prefix ); echo " Status:"; if ( strlen( $wpdb->prefix )>16 ) {echo " ERROR: Too Long";} else {echo " Acceptable";} echo "\n"; ?>

Show On Front:            <?php echo get_option( 'show_on_front' ) . "\n" ?>
Page On Front:            <?php $id = get_option( 'page_on_front' ); echo get_the_title( $id ) . ' #' . $id . "\n" ?>
Page For Posts:           <?php $id = get_option( 'page_on_front' ); echo get_the_title( $id ) . ' #' . $id . "\n" ?>

Session:                  <?php echo isset( $_SESSION ) ? 'Enabled' : 'Disabled'; ?><?php echo "\n"; ?>
Session Name:             <?php echo esc_html( ini_get( 'session.name' ) ); ?><?php echo "\n"; ?>
Cookie Path:              <?php echo esc_html( ini_get( 'session.cookie_path' ) ); ?><?php echo "\n"; ?>
Save Path:                <?php echo esc_html( ini_get( 'session.save_path' ) ); ?><?php echo "\n"; ?>
Use Cookies:              <?php echo ini_get( 'session.use_cookies' ) ? 'On' : 'Off'; ?><?php echo "\n"; ?>
Use Only Cookies:         <?php echo ini_get( 'session.use_only_cookies' ) ? 'On' : 'Off'; ?><?php echo "\n"; ?>

UPLOAD_MAX_FILESIZE:      <?php if ( function_exists( 'phpversion' ) ) echo ( mypluginname_let_to_num( ini_get( 'upload_max_filesize' ) )/( 1024*1024 ) )."MB"; ?><?php echo "\n"; ?>
POST_MAX_SIZE:            <?php if ( function_exists( 'phpversion' ) ) echo ( mypluginname_let_to_num( ini_get( 'post_max_size' ) )/( 1024*1024 ) )."MB"; ?><?php echo "\n"; ?>
WordPress Memory Limit:   <?php echo ( mypluginname_let_to_num( WP_MEMORY_LIMIT )/( 1024*1024 ) )."MB"; ?><?php echo "\n"; ?>
DISPLAY ERRORS:           <?php echo ( ini_get( 'display_errors' ) ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A'; ?><?php echo "\n"; ?>
FSOCKOPEN:                <?php echo ( function_exists( 'fsockopen' ) ) ? __( 'Your server supports fsockopen.', 'mypluginname' ) : __( 'Your server does not support fsockopen.', 'mypluginname' ); ?><?php echo "\n"; ?>

ACTIVE PLUGINS:

<?php
$plugins = get_plugins();
$active_plugins = get_option( 'active_plugins', array() );

foreach ( $plugins as $plugin_path => $plugin ):
	// If the plugin isn't active, don't show it.
	if ( ! in_array( $plugin_path, $active_plugins ) )
		continue;

echo $plugin['Name']; ?>: <?php echo $plugin['Version'] ."\n";

endforeach; ?>

CURRENT THEME:

<?php
if ( get_bloginfo( 'version' ) < '3.4' ) {
	$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
	echo $theme_data['Name'] . ': ' . $theme_data['Version'];
} else {
	$theme_data = wp_get_theme();
	echo $theme_data->Name . ': ' . $theme_data->Version;
}
?>


### End System Info ###
			</textarea>
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('WP Admin Details: The account used to log into WP'); ?>
						</th>
						<td>
							<input id="wp_username" name="wp_username" type="text" class="regular-text" value="" placeholder="Your Username"/><br />
							<input id="wp_password" name="wp_password" type="text" class="regular-text" value="" placeholder="Your Password"/>
						</td>
					</tr>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('FTP Details: Can be found in the Cpanel of your host'); ?>	
						</th>
						<td>
							<input id="ftp_server" name="ftp_server" type="text" class="regular-text" value="" placeholder="FTP Server"/><br />
							<input id="ftp_username" name="ftp_username" type="text" class="regular-text" value="" placeholder="Your Username"/><br />
							<input id="ftp_password" name="ftp_password" type="text" class="regular-text" value="" placeholder="Your Password"/>
						</td>
					</tr>
						<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('Description of the Problem: Be sure to include specific details and how to reproduce the problem.'); ?>
						</th>
						<td>
						<textarea  id="mypluginname-description" name="mypluginname-description" style="height:200px; width: 600px;"/></textarea>
						</td>
					</tr>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e('Submit Support Ticket'); ?>
							</th>
							<td>
									<?php wp_nonce_field( 'mypluginname_nonce', 'mypluginname_nonce' ); ?>
									<input type="submit" class="button-secondary" name="mypluginname_support_submit" value="<?php _e('Submit Support Ticket'); ?>"/>
							</td>
						</tr>
				</tbody>
			</table>	
		</form>



<?php
 
}
}
function mypluginname_support_submit() {

	// listen for our activate button to be clicked
	if( isset( $_POST['mypluginname_support_submit'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'mypluginname_nonce', 'mypluginname_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

			
		// WARNING: THESE VALUES ARE NOT CURRENTLY BEING VALIDATED!!!!
		$content =  
		"Name: ".$_POST['your_name']."\n".
		"Email: ".$_POST['your_email']."\n".
		"License Key: ".$_POST['mypluginname_license_key']."\n".
		"WP Username: ".$_POST['wp_username']."\n".
		"WP Password: ".$_POST['wp_password']."\n"."\n".
		"FTP Server: ".$_POST['ftp_server']."\n".
		"FTP Username: ".$_POST['ftp_username']."\n".
		"FTP Password: ".$_POST['ftp_password']."\n".
		"Description: ".$_POST['mypluginname-description']."\n"."\n".
		"System Info: "."\n".$_POST['mypluginname-sysinfo']."\n".
		"";
		
		
		
		require_once 'lib.freshdesk.php';

		$email = $_POST['your_email'];
		$nameofticket = "Mypluginname Internal Ticket";
		$nameofcustomer = $_POST['your_name'];
		// Parameters: email of customer, name of ticket, name of customer, content of ticket		
		create_ticket($email, $nameofticket, $nameofcustomer, $content);
	}
}
add_action('admin_init', 'mypluginname_support_submit');