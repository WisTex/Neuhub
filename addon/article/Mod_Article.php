<?php

/*
 * Neuhub Article Addon for WisTex KIMS
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * Source: https://neuhub.org/
 */

namespace Zotlabs\Module;
use App;
use Zotlabs\Web\Controller;

// ? Do web need all of these?
require_once('include/channel.php');
require_once('include/contact_widgets.php');
require_once('include/items.php');
require_once("include/bbcode.php");
require_once('include/security.php');
require_once('include/conversation.php');
require_once('include/acl_selectors.php');
require_once('include/opengraph.php');

class Article 
extends Controller {    
    function init() {        
        //  .. do what you want and exit via redirect using goaway('some url');
        // or killme() to terminate the process.
        // Commonly used for json or other api requests.
        // Emit output using echo.
        if (local_channel()) {
            $channel = App::get_channel();
            //// echo print_r($channel,true);
            //// goaway('https://example.com/user/' . $channel['channel_address']);
        
            //// echo "<p>Channel Address: " . $channel['channel_address'];
            
        
            
            
        }
    }
    function get() {
        // .. or you can return a page with your content in the middle.
        // just return your content as a string from this function.    

            //// notice( t("This is an example notification.") . EOL);        
            
            //// info("A different notification." . EOL);
        
			// grabs a template from the theme or a default template.
			//// $tpl = get_markup_template('exampleaddon.tpl');
			//// $tpl = get_markup_template('lostpass.tpl');
			
			// grabs a template included with the addon.
			$tpl = get_markup_template('exampleaddon.tpl', 'addon/exampleaddon');
	
			// replaces macros in the template.
			$oexample .= replace_macros($tpl,array(
				'$title' => t('Example Addon'),
				'$cardtitle' => t('Card Title'),
				'$desc' => t('<p>This is an example of information. <p>It can include HTML in it.'),
				'$alerttitle' => t('Warning'),
				'$alertbody' => t('This is only a test.') 
			));

            //// include("custom/wistex/kims/article.php");

            



                // Connect to WisTex KIMS™ database.
                // Uses MySQLi connection to the database, initialized in connection.php
                // * Note: this is a different database and connection than Hubzilla uses.
                //// include("custom/wistex/kims/connection.php"); 
                include("custom/wistex/kims/connection.php"); 

                // Get the slug from the URL.
                // URL will be /article/slug or /article/slug?section=x
                $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                // This gets the "slug" part of the URL.
                $rawslug = basename(parse_url($url, PHP_URL_PATH));

                // sanitize the slug for use in a database query.
                //// $sanislug = pg_escape_string($rawslug);
                $sanislug = htmlspecialchars($rawslug, ENT_QUOTES);

                // Example code and for debugging.
                //// echo "<p>URL: " . $url;
                //// echo "<br>Last Part of URL: " . basename(parse_url($url, PHP_URL_PATH));
                //// echo "<br>Everything after the domain: " . trim(parse_url($url, PHP_URL_PATH), '/');

                /* *************************************************************************************************************************** */
                // * Get the article from the WisTex KIMS database.
                // TODO: Get author information using inner join.
                // TODO: Get contributors.
                // TODO: Get related articles.

                //// $sql = 'SELECT * FROM kimsArticles WHERE ArticleSlug = ' . $sanislug;
                $sql = "SELECT * FROM kimsArticles WHERE ArticleSlug = '" . $sanislug . "'";
                //// $sql = "SELECT * FROM kimsArticles WHERE ArticleSlug = 'knowledge-base'";
                
                //// echo $sql;
                $articleresult = $conn->query($sql);
                
                if ($articleresult->num_rows > 0) {
                
                // output data of each row
                    while($row = $articleresult->fetch_assoc()) {
                
                        $ArticleID = $row["ArticleID"];
                        $ArticleTitle = $row["ArticleTitle"];
                        $ArticleSubTitle = $row["ArticleSubTitle"];
                        $ArticleSlug = $row["ArticleSlug"];
                        $ArticleLead = $row["ArticleLead"];
                        $ArticlePageTitle = $row["ArticlePageTitle"];
                        $ArticleBreadcrumbTitle = $row["ArticleBreadcrumbTitle"];
                        $ArticleType = $row["ArticleType"];
                        $ArticleTopicID = $row["ArticleTopicID"];
                        $ArticleParentID = $row["ArticleParentID"];
                        $ArticleChildrenFormat = $row["ArticleChildrenFormat"];
                        $ArticleAuthorID = $row["ArticleAuthorID"];
                        $ArticleEtAl = $row["ArticleEtAl"];
                        $ArticleEditorID = $row["ArticleEditorID"];
                        $ArticleSummary = $row["ArticleSummary"];
                        $ArticlePreText = $row["ArticlePreText"];
                        $ArticleVideo = $row["ArticleVideo"];
                        $ArticleBody = $row["ArticleBody"];
                        $ArticlePostText = $row["ArticlePostText"];
                        $ArticleMajorUpdateDate = $row["ArticleMajorUpdateDate"];
                        $ArticleMinorUpdateDate = $row["ArticleMinorUpdateDate"];
                        $ArticleVerifiedDate = $row["ArticleVerifiedDate"];
                        $ArticleActive = $row["ArticleActive"];
                        $ArticleRedirectURL = $row["ArticleRedirectURL"];
                        $ArticleRedirectType = $row["ArticleRedirectType"];
                        $ArticleAffiliateDisclaimer = $row["ArticleAffiliateDisclaimer"];
                        $ArticleDisclaimerText = $row["ArticleDisclaimerText"];
                        $ArticleReprintedWithPermission = $row["ArticleReprintedWithPermission"];
                ?>
                <!--
                    <tr>
                        <td><i class="fa fa-file"></i></td>
                        <td><a href="/article/<?php echo $ArticleSlug; ?>"><?php echo $ArticleTitle; ?></a></td>
                        <td><?php echo $ArticleLead; ?></td>
                    </tr>
                    -->
                <?php

                //// echo "<hr>";
                //// echo var_dump($row);
                $articleresultsflag = true;
                $articledata = $row;

                    }
                } else {
                    echo "<tr><td>0 results</td></tr>";
                    $articleresultsflag = false;
                }

                //// echo var_dump($articledata);

                //// echo $articledata['ArticleTitle'];
                
                // Changes the meta title of the page
                //// App::$page['title'] = $ArticlePageTitle . " - " . App::$page['title'];
                App::$page['title'] = $ArticlePageTitle;












            // $articletpl = get_markup_template('article.tpl', 'custom/wistex/kims');
            $articletpl = get_markup_template('kims_article.tpl');

            $o .= replace_macros($articletpl,array(

                '$ArticleID' => $articledata["ArticleID"],
                '$ArticleTitle' => $articledata["ArticleTitle"],
                '$ArticleSubTitle' => $articledata["ArticleSubTitle"],
                '$ArticleSlug' => $articledata["ArticleSlug"],
                '$ArticleLead' => $articledata["ArticleLead"],
                '$ArticlePageTitle' => $articledata["ArticlePageTitle"],
                '$ArticleBreadcrumbTitle' => $articledata["ArticleBreadcrumbTitle"],
                '$ArticleType' => $articledata["ArticleType"],
                '$ArticleTopicID' => $articledata["ArticleTopicID"],
                '$ArticleParentID' => $articledata["ArticleParentID"],
                '$ArticleChildrenFormat' => $articledata["ArticleChildrenFormat"],
                '$ArticleAuthorID' => $articledata["ArticleAuthorID"],
                '$ArticleEtAl' => $articledata["ArticleEtAl"],
                '$ArticleEditorID' => $articledata["ArticleEditorID"],
                '$ArticleSummary' => $articledata["ArticleSummary"],
                '$ArticlePreText' => $articledata["ArticlePreText"],
                '$ArticleVideo' => $articledata["ArticleVideo"],
                '$ArticleBody' => $articledata["ArticleBody"],
                '$ArticlePostText' => $articledata["ArticlePostText"],
                '$ArticleMajorUpdateDate' => $articledata["ArticleMajorUpdateDate"],
                '$ArticleMinorUpdateDate' => $articledata["ArticleMinorUpdateDate"],
                '$ArticleVerifiedDate' => $articledata["ArticleVerifiedDate"],
                '$ArticleActive' => $articledata["ArticleActive"],
                '$ArticleRedirectURL' => $articledata["ArticleRedirectURL"],
                '$ArticleRedirectType' => $articledata["ArticleRedirectType"],
                '$ArticleAffiliateDisclaimer' => $articledata["ArticleAffiliateDisclaimer"],
                '$ArticleDisclaimerText' => $articledata["ArticleDisclaimerText"],
                '$ArticleReprintedWithPermission' => $articledata["ArticleReprintedWithPermission"],


                '$alerttitle' => t('Warning'),
				'$alertbody' => t('This is only a test.') 
			));            

			return $o;        
        
        /*
        if (! local_channel()) {
            return login();   
        }
        */
    }
}
?>