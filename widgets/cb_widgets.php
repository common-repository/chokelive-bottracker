<?php
if(!class_exists('chokelive_bottrack_widgets'))
{

	class chokelive_bottrack_widgets
	{
		public function __construct()
		{
			//add_action('admin_init', array(&$this, 'admin_init'));
			add_action( 'widgets_init', array(&$this, 'myplugin_register_widgets'));
		}
		
		function myplugin_register_widgets() {
		register_widget( 'CBWidget' );
}	
		
	}
	

class CBWidget extends WP_Widget {

	function CBWidget() {
		// Instantiate the parent object
		parent::__construct( false, 'ChokeLive BotTracker' );
	}
	

	function widget( $args, $instance ) {
		// Widget output
## Google Bot Last Visit Report ##
if(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/googlebot/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
{
$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
$today = gmdate("j-F-Y g:i a",time()+60*60*7);

$to      = get_option('cb_setting_email');
$subject = "Bot detected on ".$_SERVER['SERVER_NAME'];
$message = "$today - Bot crawled $url \r\n".$_SERVER['HTTP_USER_AGENT'];
$headers = 'From: admin@chokelive.com' . "\r\n" .
    'Reply-To: chokelive@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

## Display ##
$line=$today."\r\n";
//$file = fopen("googlebot.txt","w+");
//fputs($file, $line);
//fclose($file);
update_option('cb-bot-visited', $line);


}
$botvisited = get_option('cb-bot-visited');
echo "Last GoogleBot visited[W] : <br/>$botvisited ";


		
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {
		// Output admin widget options form
	}
	
	
	
	
}


	
	
}



?>