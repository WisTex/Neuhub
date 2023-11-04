<?php

/*
 * Neuhub Messages Module
 * Version: 1.0
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

class Messages extends Controller
{
    function init()
    {
        if (local_channel()) {
            $channel = App::get_channel();
        }
    }

    function get()
    {
        if (!local_channel()) {
            return login();
        } else {
            $channel = App::get_channel();
        }

        // Get notification type
        if (!isset ($_GET['type'])) {
            $type = 0;
        } else {
            $type = intval($_GET['type']);
        }

        // Get the page number
        if (!isset ($_GET['page'])) {
            $page = 1;
        } else {
            $page = intval($_GET['page']);
        }

        $limit = 5;
        $offset = ($page - 1) * $limit;

        // Get notification total count by type and rows
        if ($type == 0) {
            $total_rows = q("SELECT COUNT(id) AS count FROM notify INNER JOIN item ON link = llink WHERE notify.uid = {$channel['channel_id']}");
            $rows = q("SELECT * FROM notify INNER JOIN item ON link = llink  WHERE notify.uid = {$channel['channel_id']} ORDER BY notify.created DESC LIMIT {$offset}, {$limit}");
        } elseif ($type == 100) {
            $total_rows = q("SELECT COUNT(id) AS count FROM notify INNER JOIN item ON link = llink WHERE notify.uid = {$channel['channel_id']} AND notify.seen = 0");
            $rows = q("SELECT * FROM notify INNER JOIN item ON link = llink WHERE notify.uid = {$channel['channel_id']} AND notify.seen = 0 ORDER BY notify.created DESC LIMIT {$offset}, {$limit}");
        } else {
            $total_rows = q("SELECT COUNT(id) AS count FROM notify INNER JOIN item ON link = llink WHERE notify.uid = {$channel['channel_id']} AND notify.ntype = {$type}");
            $rows = q("SELECT * FROM notify INNER JOIN item ON link = llink WHERE notify.uid = {$channel['channel_id']} AND notify.ntype = {$type} ORDER BY notify.created DESC LIMIT {$offset}, {$limit}");
        }

        // Parse rows
        $tplrows = get_markup_template('messages_rows.tpl');
        if ($rows) {
            foreach ($rows as $it) {
                $x = strip_tags(bbcode($it['body'])); // removes bbcode tags
                $xshort = mb_substr($x, 0, 130, 'utf8') . '...'; // shortens it, but keeps words whole.
                $notifyid = $it['id'] - 1; // FIXME : the notify id does not always work. Using link instead.
                $tablerows .= replace_macros($tplrows, array(
                    '$notifyid' => $notifyid,
                    '$msg' => bbcode($it['msg']),
                    '$url' => $it['url'],
                    '$link' => $it['link'],
                    '$xname' => $it['xname'],
                    '$title' => $it['title'],
                    '$body' => $xshort,
                    '$photo' => $it['photo'],
                    '$when' => relative_date($it['created']),
                    '$seen' => $it['seen'],
                    '$new' => t('NEW'),
                ));
            }
        } else {
            $notif_content .= t('No more system notifications.');
        }

        // Get all notifications count by type
        $total = q("SELECT COUNT(id) AS count FROM notify");
        $new = q("SELECT COUNT(id) AS count FROM notify WHERE seen = 0");
        $post = q("SELECT COUNT(id) AS count FROM notify WHERE ntype = 1");
        $forum = q("SELECT COUNT(id) AS count FROM notify WHERE ntype = 2");
        $message = q("SELECT COUNT(id) AS count FROM notify WHERE ntype = 3");
        $connection = q("SELECT COUNT(id) AS count FROM notify WHERE ntype = 4");
        $like = q("SELECT COUNT(id) AS count FROM notify WHERE ntype = 5");

        $tpl = get_markup_template('messages.tpl');

        // replaces macros in the template.
        return replace_macros($tpl, array(
            '$base_url' => z_root(),
            '$type' => $type,
            '$page' => $page,
            '$max_page' => ceil($total_rows[0]['count'] / $limit),
            '$tablerows' => $tablerows,
            '$total_count' => $total[0]['count'],
            '$new_count' => $new[0]['count'],
            '$post_count' => $post[0]['count'],
            '$forum_count' => $forum[0]['count'],
            '$message_count' => $message[0]['count'],
            '$connection_count' => $connection[0]['count'],
            '$like_count' => $like[0]['count']
        ));
    }
}
?>