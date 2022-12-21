<?php

/*
 * Include File for: Neuhub Article Addon for WisTex KIMS
 * Version: 1.0
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * Source: https://neuhub.org/
 */

/* *************************************************************************************************************************** */
// Use: Pull data from WisTex KIMS™ database so that it may be displayed by the Neuhub Articles Addon.
// Called from: \addon\Article\Mod_Article.php
// Requires: WisTex KIMS™ - Knowledge & Information Management System
// Security: Calling PHP file handles security. If called directly, it won't know which article to show.
// Assumptions: The database connection has been set in custom\wistex\kims\connection.php (same directory this file is in)
// Future: TODO: Better error handling.
/* *************************************************************************************************************************** */

// Connect to WisTex KIMS™ database.
// Uses MySQLi connection to the database, initialized in connection.php
// Note: this is a different database and connection than Hubzilla uses.
// include("custom/wistex/kims/connection.php"); 
include("./connection.php"); 

// Get the slug from the URL.
// URL will be /article/slug or /article/slug?section=x
$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// This gets the "slug" part of the URL.
$rawslug = basename(parse_url($url, PHP_URL_PATH));

// sanitize the slug for use in a database query.
// $sanislug = pg_escape_string($rawslug);
$sanislug = htmlspecialchars($rawslug, ENT_QUOTES);

// Example code and for debugging.
// echo "<p>URL: " . $url;
// echo "<br>Last Part of URL: " . basename(parse_url($url, PHP_URL_PATH));
// echo "<br>Everything after the domain: " . trim(parse_url($url, PHP_URL_PATH), '/');

/* *************************************************************************************************************************** */
// Get the article from the WisTex KIMS database.

$sql = 'SELECT * FROM kimsArticles WHERE ArticleSlug = ' . $sanislug;
$sql = "SELECT * FROM kimsArticles WHERE ArticleSlug = '" . $sanislug . "'";
$sql = "SELECT * FROM kimsArticles WHERE ArticleSlug = 'knowledge-base'";
 
// echo $sql;
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
      <tr>
        <td><i class="fa fa-file"></i></td>
        <td><a href="/article/<?php echo $ArticleSlug; ?>"><?php echo $ArticleTitle; ?></a></td>
        <td><?php echo $ArticleLead; ?></td>
      </tr>
<?php

echo "<hr>";
// echo var_dump($row);
$articleresultsflag = true;
$articledata = $row;

    }
} else {
    echo "<tr><td>0 results</td></tr>";
    $articleresultsflag = false;
}

// echo var_dump($articledata);

?>