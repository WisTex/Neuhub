<?php

/**
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * args:
 * no arguments here.
 */

// This example shows the "object" method, where we echo to an object, and then the object gets returned by the function.
// This is useful if you are copy and pasting existing code that already echos the output. 
// It is also useful if you want to output raw HTML.

// If you don't like the object method...
// You could send all of the output to a variable and then return that variable instead. (Most official widgets and addons use this method.)
// $o = "something";
// $o = $o . "something appended";
// return $o;
// If you are writing from scratch, this might be a good way to go.

// Note: custom widgets should be put in the widget folder and each widget gets its own folder.
// For example, in Hubzilla, this widget is located at /widget/Examplewidget/Examplewidget.php
// For example, in Streams, this widget is located at /Code/SiteWidget/Examplewidget/Examplewidget.php
// Notice the capital letters.
// The directory and the filename should match the class name below.
// Make sure that you do not use a widget name that conflicts with other widgets installed via other methods such as git.

// Hubzilla uses "Zotlabs\Widget"
// Streamns uses "Code\Widget"
namespace Zotlabs\Widget;
// namespace Code\Widget;

// "class Examplewidget implements WidgetInterface" is used for Streams and Neuhub
// "class Examplewidget" is used for Hubzilla
// Uncomment the correct line below depending on if you use Neuhub, Streams or Hubzilla
class Examplewidget {
// class Examplewidget implements WidgetInterface {

	function widget($arr) {

		/*
		The function returns a string which is the HTML content of the widget. 
		$args is a named array which is passed any [var] variables from the layout editor 
		For instance [widget=slugfish][var=count]3[/var][/widget] will populate $args with 
		[ 'count' => 3 ] 
		*/

		// Everything echoed between ob_start() and ob_get_clean() will output.
		ob_start(); 

			// If you need to, you can get variables from the URL.
			// Don't forget to sanitize!
			// htmlspecialchars($_GET['id'], ENT_QUOTES) for output to the screen.
			// pg_escape_string($_GET['username']) for data going into queries.
			$id = $_GET['id'];
			$page = $_GET['page'];
			
			// You can echo stuff directly since we are throwing everything into an object.
			if ($id != "") {
				echo "<p>ID: " . htmlspecialchars($id, ENT_QUOTES);
			}
			if ($page != "") {			
				echo "<p>Page: " . htmlspecialchars($page, ENT_QUOTES);   
			}
	    
			// Select something from the database. Hubzilla has its own functions for that.
			// The results are put into an array.
			$r = q("SELECT * FROM %s WHERE channel_account_id = %d", 'channel', 1);

			// Output a specific variable from the query.
			echo "<p>Channel Name for User 1: " . $r[0]['channel_name'] . "<hr>";

			// if you want to see what the array looks like.
			// var_dump($r);

			// You can also output raw HTML. It all gets shoved into the object.
			// Both Redbasic and Neuhub themes use Bootstrap, so you can include Bootstrap-specific classes in your HTML.
			?>

				<div class="alert alert-danger" role="alert">
					<span><strong>Alert Box!</strong>&nbsp;If this were an actual alert, something important would be here.</span>
				</div>

				<div class="card" style="margin-bottom: 16px;">
					<div class="card-header text-dark">
						<h5 class="mb-0">A Bootstrap Card</h5>
					</div>
					<div class="card-body">
						<ol style="margin-bottom: 0px;">
							<li>Install Hubzilla</li>
							<li>Add Neuhub</li>
							<li>???</li>
							<li>Profit!</li>
						</ol>
					</div>
				</div>
    
			<?php
    
		// and the object ends and is returned by the function.
		return ob_get_clean();
		
		// if you wanted to go the variable route, you could simply return the variable instead.
		// Whatever you assigned $o gets outputted.
		// return $o;
		
		// Can't make up your mind? How about both. :D
		// return ob_get_clean() . $o;    
		// Note: Only one return statement allowed.
	}

}
