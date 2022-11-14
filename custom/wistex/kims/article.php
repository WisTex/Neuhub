<?php

/*
 * Include File for: Neuhub Article Addon for WisTex KIMS
 * Author: Scott M. Stolz
 * License: MIT (Expat version) - https://license.neuhub.org
 * Copyright (c) 2022 WisTex TechSero Ltd. Co.
 * Source: https://neuhub.org/
 */

/* *************************************************************************************************************************** */
// Use: Pull data from WisTex KIMS™ database so that it may be displayed by the Neuhub Articles Addon.
// Called from: \addon\Article\Mod_Article.php
// Requires: WisTex KIMS™ - Knowledge & Information Management System
// Security: Calling PHP file handles security. If called directly, it will crash.
// Assumptions: The database connection has been set in custom\wistex\kims\connection.php (same directory this file is in)
// Future: TODO: Better error handling.
/* *************************************************************************************************************************** */

// Connect to WisTex KIMS™ database.
// Uses MySQLi connection to the database, initialized in connection.php
// Note: this is a different database and connection than Hubzilla uses.
include("custom/wistex/kims/connection.php"); 

// Get the slug from the URL.
$slugs = explode("/", $_GET['params']);
/*
Array ( 
    [0] => one 
    [1] => hippo 
    [2] => cake 
 )
*/

// Get the article from the WisTex KIMS database.


$sql = "SELECT * FROM chNotes";
$sql = $sql . " " . "LEFT JOIN chNoteType";
$sql = $sql . " " . "ON NoteType = NoteTypeID";
$sql = $sql . " " . "WHERE NotesUserID = " . $userid;
$sql = $sql . " " . "AND NoteParentID = " . $NoteID;
$sql = $sql . " " . "ORDER BY NoteType ASC";
 
// echo $sql;
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
 
   // output data of each row
    while($row = $result->fetch_assoc()) {
 
                $ChildNoteID = $row["NoteID"];
                $ChildNoteTitle = $row["NoteTitle"];
                $ChildNoteType = $row["NoteType"];
                $ChildNoteIcon = $row["NoteIcon"];
                $ChildNoteTypeName = $row["NoteTypeName"];
                
$DisplayChildNoteIcon = $ChildNoteIcon;
if ($ChildNoteIcon == "") { $DisplayChildNoteIcon = "fa5 fa5-sticky-note"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 1) { $DisplayChildNoteIcon = "fa5 fa5-sticky-note"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 2) { $DisplayChildNoteIcon = "mdi mdi-book-open"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 3) { $DisplayChildNoteIcon = "mdi mdi-note-text"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 4) { $DisplayChildNoteIcon = "mdi mdi-file-table-box"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 5) { $DisplayChildNoteIcon = "mdi mdi-card-bulleted"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 6) { $DisplayChildNoteIcon = "fa5 fa5-file"; }
if ($ChildNoteIcon == "" and $ChildNoteType == 7) { $DisplayChildNoteIcon = "fa5 fa5-file-code"; }
?>
      <tr>
        <td><i class="<?php echo $DisplayChildNoteIcon; ?>"></i></td>
        <td><a href="/dashboard/note.php?id=<?php echo $ChildNoteID; ?>"><?php echo $ChildNoteTitle; ?></a></td>
        <td><?php echo $ChildNoteTypeName; ?></td>
      </tr>
<?php
    }
} else {
    // echo "<tr><td>0 results</td></tr>";
}
?>