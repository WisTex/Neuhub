<?php

/*
 * Neuhub Messages Module
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * Source: https://neuhub.org/
 */

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

class Messages 
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

	// If not logged in with a local channel, then they should not be looking at this page.
	if (! local_channel()) {
		return login();   
	}


            // notice( t("This is an example notification.") . EOL);        
            
            // info("A different notification." . EOL);

        if (local_channel()) {
            $channel = App::get_channel();
            // echo print_r($channel,true);
            // goaway('https://example.com/user/' . $channel['channel_address']);
        
            // echo "<p>Channel Address: " . $channel['channel_address'];
        }

// Get the page number

    if (!isset ($_GET['page']) ) {  

        $page_number = 1;  

    } else {  

        $page_number = $_GET['page'];  

    }  

// variable to store the number of rows per page

$limit = 5;  

// get the initial page number

$initial_page = ($page_number-1) * $limit; 
      
// Find out total number of pages.

			// Select something from the database. Hubzilla has its own functions for that.
			// The results are put into an array.
			// $r = q("SELECT * FROM %s WHERE uid = %d", 'notify', 2);
			$r = q("SELECT * FROM %s INNER JOIN item ON link = llink WHERE notify.uid = %d ORDER BY notify.created DESC LIMIT 40", 'notify', $channel['channel_id']);
			
			// Output a specific variable from the query.
			$message = "<p>Notification: " . $r[0]['msg'] . "<hr>";

			// if you want to see what the array looks like.
			// var_dump($r);

// Get the data and format the inner part of the table using a template.
        
			// grabs a template from the theme or a default template.
			$tplrows = get_markup_template('messages_rows.tpl');
			// $tpl = get_markup_template('lostpass.tpl');
			
			// grabs a template included with the addon.
			// $tpl = get_markup_template('exampleaddon.tpl', 'addon/exampleaddon');

/*
SELECT id, xname, url, photo, created, msg, aid, uid, link, parent, seen, ntype, verb, otype, id, title, body, revision, verb, obj_type, llink, plink, item_private, item_unseen, item_starred, item_thread_top, item_nsfw, item_mentionsme, item_hidden
FROM table1, table2
INNER JOIN table1.link ON table2.llink
WHERE WHERE uid = 2;
*/

// '$seen' => (($it['seen']) ? true : false),

		if($r) {
			foreach ($r as $it) {
				$x = strip_tags(bbcode($it['body'])); // removes bbcode tags
				$xshort = mb_substr($x, 0, 130, 'utf8').'...'; // shortens it, but keeps words whole.
				$notifyid = $it['id'] - 1; // FIXME : the notify id does not always work. Using link instead.
				$tablerows .= replace_macros($tplrows,array(
					'$notifyid' => $notifyid,
					'$msg' => bbcode($it['msg']),
					'$url' => $it['url'],
					'$link' => $it['link'],
					'$xname' => $it['xname'],
					'$title' => $it['title'],
					'$body' => $xshort,
					'$photo' => $it['photo'],
					'$when' => relative_date($it['created']),
					'$unseen' => $it['item_unseen'],					
					'$new' => t('NEW'),

				));
			}
		}
		else {
			$notif_content .= t('No more system notifications.');
		}


	
			// replaces macros in the template.
			/*
			$tablerows .= replace_macros($tplrows,array(
				'$msg' => t('Example Addon'),
				'$url' => t('Card Title'),
				'$xname' => t('<p>This is an example of information. <p>It can include HTML in it.'),
				'$link' => t('Warning'),
				'$seen' => t('This is only a test.'),
				'$photo' => 'https://dev.neuhub.org/photo/profile/m/2?rev=1666101042',
			));
			*/

 // var_dump($tablerows);

// Format that data for output, and include the inner part of the table as a variable.

			// grabs a template from the theme or a default template.
			$tpl = get_markup_template('messages.tpl');
			// $tpl = get_markup_template('lostpass.tpl');
			
			// grabs a template included with the addon.
			// $tpl = get_markup_template('exampleaddon.tpl', 'addon/exampleaddon');
	
			// replaces macros in the template.
			$o .= replace_macros($tpl,array(
				'$title1' => t('Example Addon'),
				'$cardtitle' => t('Card Title'),
				'$desc' => t('<p>This is an example of information. <p>It can include HTML in it.'),
				'$alerttitle' => t('Warning'),
				'$alertbody' => t('This is only a test.'),
				'$tablerows' => $tablerows,
			));

// Return the completed template.
	
			return $o;        



        

    }}
?>