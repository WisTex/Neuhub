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
// Catalyst uses "Code\Widget"
// Raconteur uses "Code\Widget"
namespace Zotlabs\Widget;
// namespace Code\Widget;



// "class Examplewidget" is used for Hubzilla
// "class Examplewidget implements WidgetInterface" is used for Streams, Raconteur, and Catalyst.
// "class Examplewidget implements WidgetInterface" is used for Neuhub if you uploaded \Zotlabs\Widget\WidgetInterface.php
// Uncomment the correct line below depending on if you use Streams or Hubzilla

// class Examplewidget {
// class Magicsignon_text_login implements WidgetInterface {
class Magicsignon_text_login {

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

			// You can also output raw HTML. It all gets shoved into the object.
			// Both Redbasic and Neuhub themes use Bootstrap, so you can include Bootstrap-specific classes in your HTML.
			?>

    <div class="card mb-3">
        <div class="card-body">
            <h3 style="">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor" />
                </svg>
                Magic Sign On
            </h3>
            <p class="card-text" style="margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can <a href="/rmagic">remotely authenticate</a> with your existing social identity.</p>
            <!-- <p>Magic Sign On is also known as Magic Auth, Remote Magic, RMagic, or Remote Authentication.</p> -->
        </div>
		<!--
        <div class="card-footer">
            <p><small>Magic Sign On is also known as Magic Auth, Remote Magic, RMagic, or Remote Authentication.</small></p>
        </div>
		-->
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
