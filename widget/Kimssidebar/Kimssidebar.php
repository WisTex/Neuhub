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
// Streams uses "Code\Widget"
namespace Zotlabs\Widget;
// namespace Code\Widget;



// "class Examplewidget" is used for Hubzilla
// "class Examplewidget implements WidgetInterface" is used for Streams
// "class Examplewidget implements WidgetInterface" is used for Neuhub if you uploaded \Zotlabs\Widget\WidgetInterface.php
// Uncomment the correct line below depending on if you use Streams or Hubzilla

// class Examplewidget {
class Kimssidebar implements WidgetInterface {

	public function widget(array $arguments): string {
	// function widget($arr): string {

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

			// If you are using friendly URLs, which you probably are, you can get the parameters this way:
			// This gets the URL.
			$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			echo "<p>URL: " . $url;
			echo "<br>Last Part of URL: " . basename(parse_url($url, PHP_URL_PATH));
			echo "<br>Everything after the domain: " . trim(parse_url($url, PHP_URL_PATH), '/');

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



                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-header text-danger">
                                    <h5 class="mb-0" title="Or &quot;This Article&quot; for non-developers. ;)">This Article</h5>
                                </div>
                                <div class="card-body">
                                    <ul style="margin-bottom: 0px;">
                                        <li>Add to Bookmarks</li>
                                        <li>Create Note</li>
                                        <li>Ask Question</li>
                                        <li>View Changelog</li>
                                        <li>Content Management</li>
                                        <li>Edit Article</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-header text-dark">
                                    <h5 class="mb-0">Series</h5>
                                </div>
                                <div class="card-body">
                                    <ol style="margin-bottom: 0px;">
                                        <li>Overview</li>
                                        <li>Part 1</li>
                                        <li>Section 2</li>
                                        <li>Conclusion</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="card bg-light border-info" style="margin-bottom: 16px;">
                                <div class="card-body"><span class="text-end d-inline float-end justify-content-xl-end align-items-xl-start"><span class="badge rounded-pill bg-info text-end border" style="text-align: right;">Promoted</span></span>
                                    <h4 class="text-info card-title" style="font-family: 'Roboto Slab', serif;">TechSero</h4>
                                    <h6 class="text-info card-subtitle mb-2" style="font-family: 'Roboto Slab', serif;">Web Services</h6>
                                    <p class="card-text">We can help you create a perfect online presence.</p>
                                    <ul>
                                        <li>Domain Registration</li>
                                        <li>Professional Email</li>
                                    </ul><a class="card-link" href="#">Website<i class="fa fa-external-link" style="padding-left: 4px;"></i></a><a class="card-link" href="#">Profile</a><a class="card-link" href="#">Articles</a>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-header text-primary">
                                    <h5 class="mb-0">Related Topics</h5>
                                </div>
                                <div class="card-body">
                                    <ul style="margin-bottom: 0px;">
                                        <li>Item 1</li>
                                        <li>Item 2</li>
                                        <li>Item 3</li>
                                        <li>Item 4</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-header text-info">
                                    <h5 class="mb-0">Related Resources</h5>
                                </div>
                                <div class="card-body">
                                    <ul style="margin-bottom: 0px;">
                                        <li>Item 1</li>
                                        <li>Item 2</li>
                                        <li>Item 3</li>
                                        <li>Item 4</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card bg-light border-danger" style="margin-bottom: 16px;">
                                <div class="card-body"><span class="text-end d-inline float-end justify-content-xl-end align-items-xl-start"><span class="badge rounded-pill bg-info text-end border" style="text-align: right;">Promoted</span></span>
                                    <h4 class="text-primary card-title" style="font-family: 'Roboto Slab', serif;">Extra Features</h4>
                                    <h6 class="text-danger card-subtitle mb-2" style="font-family: 'Roboto Slab', serif;">For Patrons &amp; Supporters</h6>
                                    <p class="card-text">Do you like our content? Want more? Our patrons &amp; supporters get extra features, including:</p>
                                    <ul>
                                        <li>Priority Support</li>
                                        <li>Article Requests</li>
                                        <li>Enhanced Profiles</li>
                                        <li>Early Access</li>
                                        <li>And more!</li>
                                    </ul><a class="card-link" href="#">Become a Patron</a><a class="card-link" href="#">Learn More</a>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-body">
                                    <p class="card-text" style="font-size: 14px;"><strong>Disclosure:</strong> Complete Hosting Guide is reader-supported. When you buy through links on our site, we may earn an affiliate commission.&nbsp;<a href="/affiliates">Learn more</a>.<br></p>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-body">
                                    <p class="card-text" style="font-size: 14px;"><strong>Not an Endorsement: </strong>Nothing on this website should be construed as an endorsement, recommendation, or advice, unless specifically stated as such.&nbsp;<br><a href="/affiliates">Learn more</a>.<br></p>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom: 16px;">
                                <div class="card-body">
                                    <p class="card-text" style="font-size: 14px;"><strong>Notice:</strong>&nbsp;Some of the information in this directory may be provided by the vendors themselves. Being listed in this directory should not be construed as an endorsement or recommendation. Always perform due diligence before selecting a vendor.&nbsp;<a href="/affiliates">Learn more</a>.<br></p>
                                </div>
                            </div>
    
			<?php
    
		$object = ob_get_clean();
		$output = (string)$object;
		// $output = (string)$object . " ";
		// echo gettype($output);



		// and the object ends and is returned by the function.
		// return ob_get_clean();
		// return ob_get_clean() ?? '';
		// return (string) ob_get_clean();
		return $output;
		
		
		// if you wanted to go the variable route, you could simply return the variable instead.
		// Whatever you assigned $o gets outputted.
		// return $o;
		
		// Can't make up your mind? How about both. :D
		// return ob_get_clean() . $o;    
		// Note: Only one return statement allowed.
	}

}
