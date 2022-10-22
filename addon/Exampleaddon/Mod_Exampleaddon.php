<?php
namespace Zotlabs\Module;
use App;
use Zotlabs\Web\Controller;


require_once('include/channel.php');
require_once('include/contact_widgets.php');
require_once('include/items.php');
require_once("include/bbcode.php");
require_once('include/security.php');
require_once('include/conversation.php');
require_once('include/acl_selectors.php');
require_once('include/opengraph.php');

class Exampleaddon 
extends Controller {    
    function init() {        
        //  .. do what you want and exit via redirect using goaway('some url');
        // or killme() to terminate the process.
        // Commonly used for json or other api requests.
        // Emit output using echo.
        if (local_channel()) {
            $channel = App::get_channel();
            // echo print_r($channel,true);
            // goaway('https://example.com/user/' . $channel['channel_address']);
        
            // echo "<p>Channel Address: " . $channel['channel_address'];
            
        
            
            
        }
    }
    function get() {
        // .. or you can return a page with your content in the middle.
        // just return your content as a string from this function.    

            notice( t("This is an example notification.") . EOL);        
            
            info("A different notification." . EOL);
        
			// grabs a template from the theme or a default template.
			// $tpl = get_markup_template('exampleaddon.tpl');
			// $tpl = get_markup_template('lostpass.tpl');
			
			// grabs a template included with the addon.
			$tpl = get_markup_template('exampleaddon.tpl', 'addon/exampleaddon');
	
			// replaces macros in the template.
			$o .= replace_macros($tpl,array(
				'$title' => t('Example Addon'),
				'$cardtitle' => t('Card Title'),
				'$desc' => t('<p>This is an example of information. <p>It can include HTML in it.'),
				'$alerttitle' => t('Warning'),
				'$alertbody' => t('This is only a test.') 
			));
	
			return $o;        
        
        /*
        if (! local_channel()) {
            return login();   
        }
        */
    }}
?>