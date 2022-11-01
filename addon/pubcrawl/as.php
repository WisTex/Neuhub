<?php

use Zotlabs\Access\PermissionRoles;
use Zotlabs\Access\Permissions;
use Zotlabs\Lib\Apps;
use Zotlabs\Daemon\Master;
use Zotlabs\Lib\Activity;
use Zotlabs\Lib\ActivityStreams;
use Zotlabs\Lib\Libzot;
use Zotlabs\Lib\Libsync;
use Zotlabs\Lib\MessageFilter;
use Zotlabs\Lib\AccessList;

require_once('include/event.php');

function asencode_object($x) {

	if(($x) && (! is_array($x)) && (substr(trim($x),0,1)) === '{' ) {
		$x = json_decode($x,true);
	}

	if(is_array($x)) {

		if(array_key_exists('asld',$x)) {
			return $x['asld'];
		}

		if($x['type'] === ACTIVITY_OBJ_PERSON) {
			return asfetch_person($x);
		}

		if($x['type'] === ACTIVITY_OBJ_PROFILE) {
			return asfetch_profile($x);
		}

		if(in_array($x['type'], [ ACTIVITY_OBJ_NOTE, ACTIVITY_OBJ_ARTICLE ] )) {
			return asfetch_item($x);
		}

		if($x['type'] === ACTIVITY_OBJ_THING) {
			return asfetch_thing($x);
		}

		if($x['type'] === ACTIVITY_OBJ_EVENT) {
			return asfetch_event($x);
		}

		if($x['type'] === ACTIVITY_OBJ_PHOTO) {
			return asfetch_image($x);
		}

	}

	return $x;

}

function asfetch_person($x) {
	return asfetch_profile($x);
}

function asfetch_event($x) {

	// convert old Zot event objects to ActivityStreams Event objects

	if (array_key_exists('content',$x) && array_key_exists('dtstart',$x)) {
		$ev = bbtoevent($x['content']);
		if($ev) {

			if(! $ev['timezone'])
				$ev['timezone'] = 'UTC';

			$actor = null;
			if(array_key_exists('author',$x) && array_key_exists('link',$x['author'])) {
				$actor = $x['author']['link'][0]['href'];
			}
			$y = [
				'type'      => 'Event',
				'id'        => z_root() . '/event/' . $ev['event_hash'],
				'summary'   => bbcode($ev['summary'], [ 'cache' => true ]),
				// RFC3339 Section 4.3
				'startTime' => (($ev['adjust']) ? datetime_convert($ev['timezone'],'UTC',$ev['dtstart'], ATOM_TIME) : datetime_convert('UTC','UTC',$ev['dtstart'],'Y-m-d\\TH:i:s-00:00')),
				'content'   => bbcode($ev['description'], [ 'cache' => true ]),
				'location'  => [ 'type' => 'Place', 'content' => bbcode($ev['location'], [ 'cache' => true ]) ],
				'source'    => [ 'content' => format_event_bbcode($ev), 'mediaType' => 'text/bbcode' ],
				'actor'     => $actor,
			];
			if(! $ev['nofinish']) {
				$y['endTime'] = (($ev['adjust']) ? datetime_convert($ev['timezone'],'UTC',$ev['dtend'], ATOM_TIME) : datetime_convert('UTC','UTC',$ev['dtend'],'Y-m-d\\TH:i:s-00:00'));
			}

			// copy attachments from the passed object - these are already formatted for ActivityStreams

			if($x['attachment']) {
				$y['attachment'] = $x['attachment'];
			}

			if($actor) {
				return $y;
			}
		}
	}

	return $x;

}


function asfetch_image($x) {

	$ret = [
		'type' => 'Image',
		'id' => $x['id'],
		'name' => $x['title'],
		'content' => bbcode($x['body'], ['cache' => true ]),
		'source' => [ 'mediaType' => 'text/bbcode', 'content' => $x['body'] ],
		'published' => datetime_convert('UTC','UTC',$x['created'],ATOM_TIME),
		'updated' => datetime_convert('UTC','UTC', $x['edited'],ATOM_TIME),
		'url' => [
			'type'      => 'Link',
			'mediaType' => $x['link'][0]['type'],
			'href'      => $x['link'][0]['href'],
			'width'     => $x['link'][0]['width'],
  			'height'    => $x['link'][0]['height']
		]
	];
	return $ret;
}


function asfetch_profile($x) {
	$r = q("select * from xchan where xchan_url like '%s' limit 1",
		dbesc($x['id'] . '/%')
	);
	if(! $r) {
		$r = q("select * from xchan where xchan_hash = '%s' limit 1",
			dbesc($x['id'])
		);

	}
	if(! $r)
		return [];

	return Activity::encode_person($r[0]);

}

function asfetch_thing($x) {

	$r = q("select * from obj where obj_type = %d and obj_obj = '%s' limit 1",
		intval(TERM_OBJ_THING),
		dbesc($x['id'])
	);

	if(! $r)
		return [];

	$x = [
		'type' => 'Object',
		'id'   => z_root() . '/thing/' . $r[0]['obj_obj'],
		'name' => $r[0]['obj_term']
	];

	if($r[0]['obj_image'])
		$x['image'] = $r[0]['obj_image'];

	return $x;

}

function asfetch_item($x) {

	$r = q("select * from item where mid = '%s' limit 1",
		dbesc($x['id'])
	);
	if($r) {
		xchan_query($r,true);
		$r = fetch_post_tags($r,true);
		return asencode_item($r[0]);
	}
}

function asencode_item_collection($items,$id,$type,$extra = null) {

	$ret = [
		'id' => z_root() . '/' . $id,
		'type' => $type,
		'totalItems' => count($items),
	];
	if($extra)
		$ret = array_merge($ret,$extra);

	if($items) {
		$x = [];
		foreach($items as $i) {
			$t = asencode_activity($i);
			if($t)
				$x[] = $t;
		}
		if($type === 'OrderedCollection')
			$ret['orderedItems'] = $x;
		else
			$ret['items'] = $x;
	}

	return $ret;
}

function asencode_follow_collection($items,$id,$type,$extra = null) {

	$ret = [
		'id' => z_root() . '/' . $id,
		'type' => $type,
		'totalItems' => count($items),
	];
	if($extra)
		$ret = array_merge($ret,$extra);

	if($items) {
		$x = [];
		foreach($items as $i) {
			if($i['xchan_network'] === 'activitypub' ) {
				if($i['xchan_url']) {
					$x[] = $i['xchan_url'];
				}
			}
			else {
				if($i['xchan_addr']) {
					$x[] = 'acct:' . $i['xchan_addr'];
				}
			}
		}
		if($type === 'OrderedCollection')
			$ret['orderedItems'] = $x;
		else
			$ret['items'] = $x;
	}

	return $ret;
}




function asencode_item($i) {

	$ret = [];

	$objtype = activity_obj_mapper($i['obj_type']);

	if(intval($i['item_deleted'])) {
		$ret['type'] = 'Tombstone';
		$ret['formerType'] = $objtype;
		$ret['id'] = ((strpos($i['mid'],'http') === 0) ? $i['mid'] : z_root() . '/item/' . urlencode($i['mid']));
		return $ret;
	}

	$ret['type'] = $objtype;

	if ($i['obj']) {
		$ret = asencode_object($i['obj']);
		$ret['url'] = $i['plink'];
	}

	if ($ret['type'] === 'Note' && $objtype !== 'Question') {
		$images = false;
		$has_images = preg_match_all('/\[[zi]mg(.*?)\](.*?)\[/ism',$i['body'],$images,PREG_SET_ORDER);

		if((! $has_images) || get_pconfig($i['uid'],'activitypub','downgrade_media',true))
			$ret['type'] = 'Note';
		else
			$ret['type'] = 'Article';

	}

	if ($objtype === 'Question') {
		if ($i['obj']) {
			if (is_array($i['obj'])) {
				$ret = $i['obj'];
			}
			else {
				$ret = json_decode($i['obj'],true);
			}

			if(array_path_exists('actor/id',$ret)) {
				$ret['actor'] = $ret['actor']['id'];
			}
		}
	}

	$ret['id']   = ((strpos($i['mid'],'http') === 0) ? $i['mid'] : z_root() . '/item/' . urlencode($i['mid']));

	if(isset($i['title']))
		$ret['name'] = bbcode($i['title'], ['cache' => true ]);

	if(isset($i['summary']))
		$ret['summary'] = bbcode($i['summary'], ['cache' => true ]);

	if (strpos($i['body'], '[/crypt]') !== false) {
		$i['body'] = preg_replace_callback("/\[crypt (.*?)\](.*?)\[\/crypt\]/ism", 'bb_parse_b64_crypt', $i['body']);
	}

	$ret['content'] = bbcode($i['body'], ['cache' => true ]);

	$ret['published'] = datetime_convert('UTC','UTC',$i['created'],ATOM_TIME);
	if($i['created'] !== $i['edited'])
		$ret['updated'] = datetime_convert('UTC','UTC',$i['edited'],ATOM_TIME);
	if($i['app']) {
		$ret['generator'] = [ 'type' => 'Application', 'name' => $i['app'] ];
	}
	if($i['location'] || $i['coord']) {
		$ret['location'] = [ 'type' => 'Place' ];
		if($i['location']) {
			$ret['location']['name'] = $i['location'];
		}
		if($i['coord']) {
			$l = explode(' ',$i['coord']);
			$ret['location']['latitude'] = $l[0];
			$ret['location']['longitude'] = $l[1];
		}
	}

	$ret['attributedTo'] = $i['author']['xchan_url'];

	// Nonstandard field diaspora:guid for Friendica comaptibility
	if(Apps::addon_app_installed($i['uid'], 'diaspora'))
		$ret['diaspora:guid'] = $i['uuid'];

	$cnv = null;

	if($i['mid'] != $i['parent_mid']) {
		$ret['inReplyTo'] = ((strpos($i['thr_parent'],'http') === 0) ? $i['thr_parent'] : z_root() . '/item/' . urlencode($i['thr_parent']));
		$cnv = get_iconfig($i['parent'],'ostatus','conversation');
	}
	if(! $cnv) {
		$cnv = get_iconfig($i,'ostatus','conversation');
	}
	if($cnv) {
		$ret['conversation'] = $cnv;
	}

	$actor = $i['author']['xchan_url']; //asencode_person($i['author']);
	if($actor)
		$ret['actor'] = $actor;
	else
		return [];

	$t = Activity::encode_taxonomy($i);
	if($t) {
		$ret['tag']       = $t;
	}

	$a = asencode_attachment($i);
	if($a) {
		$ret['attachment'] = $a;
	}

	if($has_images && $ret['type'] === 'Note') {
		$img = [];
		foreach($images as $match) {
			if (strpos($match[1],'=http') === 0) {
				$img[] =  [ 'type' => 'Image', 'url' => substr($match[1],1) ];
			}
			else {
				$img[] =  [ 'type' => 'Image', 'url' => $match[2] ];
			}
		}
		if(! $ret['attachment'])
			$ret['attachment'] = [];

		$ret['attachment'] = array_merge($img,$ret['attachment']);
	}

	return $ret;
}

function asdecode_taxonomy($item) {

	$ret = [];

	if($item['tag']) {
		foreach($item['tag'] as $t) {
			if(! array_key_exists('type',$t))
				$t['type'] = 'Hashtag';

			switch($t['type']) {
				case 'Hashtag':
					$ret[] = [ 'ttype' => TERM_HASHTAG, 'url' => $t['href'], 'term' => ((substr($t['name'],0,1) === '#') ? substr($t['name'],1) : $t['name']) ];
					break;

				case 'Mention':
					$ret[] = [ 'ttype' => TERM_MENTION, 'url' => $t['href'], 'term' => ((substr($t['name'],0,1) === '@') ? substr($t['name'],1) : $t['name']) ];
					break;

				default:
					break;
			}
		}
	}

	return $ret;
}


function asencode_taxonomy($item) {

	$ret = [];

	if($item['term']) {
		foreach($item['term'] as $t) {
			switch($t['ttype']) {
				case TERM_HASHTAG:
					// href is required so if we don't have a url in the taxonomy, ignore it and keep going.
					if($t['url']) {
						$ret[] = [ 'type' => 'Hashtag', 'href' => $t['url'], 'name' => '#' . $t['term'] ];
					}
					break;

				case TERM_FORUM:
					$ret[] = [ 'type' => 'Mention', 'href' => $t['url'], 'name' => '!' . $t['term'] ];
					break;

				case TERM_MENTION:
					$ret[] = [ 'type' => 'Mention', 'href' => $t['url'], 'name' => '@' . $t['term'] ];
					break;

				default:
					break;
			}
		}
	}

	return $ret;
}

function asencode_attachment($item) {

	$ret = [];

	if($item['attach']) {
		$atts = json_decode($item['attach'],true);
		if($atts) {
			foreach($atts as $att) {
				if(strpos($att['type'],'image')) {
					$ret[] = [ 'type' => 'Image', 'url' => $att['href'] ];
				}
				else {
					$ret[] = [ 'type' => 'Link', 'mediaType' => $att['type'], 'href' => $att['href'] ];
				}
			}
		}
	}

	return $ret;
}


function asdecode_attachment($item) {

	$ret = [];

	if($item['attachment']) {
		foreach($item['attachment'] as $att) {
			$entry = [];
			if($att['href'])
				$entry['href'] = $att['href'];
			elseif($att['url'])
				$entry['href'] = $att['url'];
			if($att['mediaType'])
				$entry['type'] = $att['mediaType'];
			elseif($att['type'] === 'Image')
				$entry['type'] = 'image/jpeg';
			if($att['name'])
				$entry['name'] = htmlentities($att['name'], ENT_COMPAT, 'UTF-8');
			if($entry)
				$ret[] = $entry;
		}
	}

	return $ret;
}



function asencode_activity($i) {

	if($i['item_deleted'])
		return Activity::encode_activity($i);

	$ret   = [];
	$reply = false;

	$ret['type'] = activity_mapper($i['verb']);

	$ret['directMessage'] = (intval($i['item_private']) === 2);

	$ret['id']   = ((strpos($i['mid'],'http') === 0) ? $i['mid'] : z_root() . '/activity/' . urlencode($i['mid']));

	if (strpos($ret['id'],z_root() . '/item/') !== false) {
		$ret['id'] = str_replace('/item/','/activity/',$ret['id']);
	}
	elseif (strpos($ret['id'],z_root() . '/event/') !== false) {
		$ret['id'] = str_replace('/event/','/activity/',$ret['id']);
	}

	if($i['title'])
		$ret['name'] = html2plain(bbcode($i['title'], ['cache' => true ]));

	// Remove URL bookmark
	$i['body'] = str_replace("#^[", "[", $i['body']);

	$ret['published'] = datetime_convert('UTC','UTC',$i['created'],ATOM_TIME);
	if($i['created'] !== $i['edited'])
		$ret['updated'] = datetime_convert('UTC','UTC',$i['edited'],ATOM_TIME);
	if($i['app']) {
		$ret['generator'] = [ 'type' => 'Application', 'name' => $i['app'] ];
	}
	if($i['location'] || $i['coord']) {
		$ret['location'] = [ 'type' => 'Place' ];
		if($i['location']) {
			$ret['location']['name'] = $i['location'];
		}
		if($i['coord']) {
			$l = explode(' ',$i['coord']);
			$ret['location']['latitude'] = $l[0];
			$ret['location']['longitude'] = $l[1];
		}
	}

	$actor = $i['author']['xchan_url']; //asencode_person($i['author']);
	if($actor)
		$ret['actor'] = $actor;
	else
		return [];


	if($i['obj']) {
		$obj = asencode_object($i['obj']);
		if($obj)
			$ret['object'] = $obj;
		else
			return [];
	}
	else {
		$obj = asencode_item($i);
		if($obj)
			$ret['object'] = $obj;
		else
			return [];
	}

	if($i['target']) {
		$tgt = asencode_object($i['target']);
		if($tgt)
			$ret['target'] = $tgt;
	}

 	if(array_path_exists('object/type',$ret) && $ret['object']['type'] === 'Event' && $ret['type'] === 'Create') {
		$ret['type'] = 'Invite';
	}

	if($i['mid'] != $i['parent_mid']) {
		$reply = true;

		if (! in_array($ret['type'],[ 'Create','Update','Accept','Reject','TentativeAccept','TentativeReject' ])) {
			$ret['inReplyTo'] = ((strpos($i['thr_parent'],'http') === 0) ? $i['thr_parent'] : z_root() . '/item/' . urlencode($i['thr_parent']));
		}
		$recips = get_iconfig($i['parent'], 'activitypub', 'recips');
	}

	if($i['author_xchan'] == $i['owner_xchan'])
		$item_owner = true;

	$followers_url = z_root() . '/followers/' . substr($i['author']['xchan_addr'],0,strpos($i['author']['xchan_addr'],'@'));

	if($i['item_private']) {
		if($reply && ! $item_owner) {

			$dm = true;

			if(isset($recips['to']))
				$dm = ((in_array($i['author']['xchan_url'], $recips['to'])) ? true : false);

			$reply_url = (($dm) ? $i['owner']['xchan_url'] : $followers_url);
			$reply_addr = (($i['owner']['xchan_addr']) ? $i['owner']['xchan_addr'] : $i['owner']['xchan_name']);

			if($dm) {

				$m = [
					'type' => 'Mention',
					'href' => $reply_url,
					'name' => '@' . $reply_addr
				];
				$ret['tag'] = (($ret['object']['tag']) ? array_merge($ret['object']['tag'],$m) : $m);
			}

			$ret['to'] = [ $reply_url ];
			$ret['cc'] = [];
		}
		else {
			if(intval($i['item_private']) === 2) {
				//privacy tags to make sure dm's will be detected on mastodon as such
				$privacy_tags = as_map_acl($i, true);
				$ret['object']['tag'] = (($ret['object']['tag']) ? array_merge($ret['object']['tag'], $privacy_tags) : $privacy_tags);
			}
			$ret['to'] = []; //this is important for pleroma
			$ret['cc'] = as_map_acl($i);
		}
	}
	else {
		if($reply) {
			$ret['to'][] = $i['owner']['xchan_url'];

			if(isset($recips['to']) && in_array(ACTIVITY_PUBLIC_INBOX, $recips['to'])) {
				//visible in public timelines
				$ret['to'][] = ACTIVITY_PUBLIC_INBOX;
				$ret['cc'][] = $followers_url;
			}
			else {
				//not visible in public timelines
				$ret['to'][] = $followers_url;
				$ret['cc'][] = ACTIVITY_PUBLIC_INBOX;
			}
		}
		else {
			$ret['to'][] = ACTIVITY_PUBLIC_INBOX;
			$ret['cc'][] = $followers_url;
		}
	}

	$mentions = as_map_mentions($i);
	if(count($mentions)) {
		$ret['to'] = (($ret['to']) ? array_merge($ret['to'],$mentions) : $mentions);
	}

	// poll answers should be addressed only to the poll owner
	if($i['item_private'] && $i['obj_type'] === 'Answer') {
		$ret['to'][] = $i['owner']['xchan_url'];
		$ret['cc'] = [];
	}

	//remove values from to in cc
	$ret['cc'] = array_values(array_diff($ret['cc'], $ret['to']));

	if(array_path_exists('object/type', $ret) && in_array($ret['object']['type'], [ 'Note', 'Article', 'Question' ])) {
		if(isset($ret['to']))
			$ret['object']['to'] = $ret['to'];
		if(isset($ret['cc']))
			$ret['object']['cc'] = $ret['cc'];
	}

	return $ret;
}

function as_map_mentions($i) {

	$list = [];
	$str_list = [];
	$fixed_list = [];
	$ret = [];

	if(! $i['term']) {
		return $ret;
	}

	foreach ($i['term'] as $t) {
		if($t['ttype'] == TERM_MENTION) {
			$list[] = $t['url'];
			$str_list[] = '\'' . dbesc($t['url']) . '\'';
		}
	}

	// The xchan_url for mastodon is a text/html rendering.
	// We need to convert the mention url to an ActivityPub id.

	$qlist = implode(',',$str_list);

	if($qlist) {
		$r = dbq("SELECT xchan_hash FROM xchan WHERE xchan_url IN ( $qlist ) and xchan_network = 'activitypub'");
		$fixed_list = ids_to_array($r, 'xchan_hash');
	}

	$ret = (($fixed_list) ? $fixed_list : $list);

	return $ret;
}

function as_map_acl($i,$mentions = false) {

	$private = false;
	$list = [];

	$g = intval(get_pconfig($i['uid'],'activitypub','include_groups'));

	$x = collect_recipients($i,$private,$g);
	if(is_array($x)) {
		stringify_array_elms($x);
		if(! $x)
			return;

		$details = dbq("select xchan_hash, xchan_url, xchan_addr, xchan_name from xchan where xchan_hash in (" . implode(',',$x) . ") and xchan_network = 'activitypub'");
		if($details) {
			foreach($details as $d) {
				if($mentions) {
					$list[] = [ 'type' => 'Mention', 'href' => $d['xchan_url'], 'name' => '@' . (($d['xchan_addr']) ? $d['xchan_addr'] : $d['xchan_name']) ];
				}
				else {
					$list[] = $d['xchan_hash'];
				}
			}
		}
	}

	return $list;


}


function asencode_person($p) {

	if(! $p['xchan_url'])
		return [];

	$i = [];
	$r = q("SELECT resource_id FROM photo WHERE photo_usage = %d AND uid = %d LIMIT 1",
		intval(PHOTO_COVER),
		intval($p['channel_id'])
	);
	if($r)
		$i = $r[0];

	$ret = [];

	$ret['type']  = 'Person';
	$ret['id']    = $p['xchan_url'];
	if($p['xchan_addr'] && strpos($p['xchan_addr'],'@'))
		$ret['preferredUsername'] = substr($p['xchan_addr'],0,strpos($p['xchan_addr'],'@'));
	$ret['name']  = $p['xchan_name'];
	$ret['icon']  = [
		'type'      => 'Image',
		'mediaType' => (($p['xchan_photo_mimetype']) ? $p['xchan_photo_mimetype'] : 'image/png' ),
		'url'       => $p['xchan_photo_l'] . '?_rnd=' . random_string(8),
		'height'    => 300,
		'width'     => 300,
        ];
	if($i) {
		$ret['image']  = [
			'type'      => 'Image',
			'mediaType' => (($i['mimetype']) ? $p['mimetype'] : 'image/png' ),
			'url'       => z_root() . '/photo/' . $i['resource_id'] . '-7',
			'height'    => 435,
			'width'     => 1200,
		];
	}

	$ret['url'] = $p['xchan_url'];

	$c = channelx_by_hash($p['xchan_hash']);

	if($c) {

		$ret['inbox']       = z_root() . '/inbox/'     . $c['channel_address'];
		$ret['outbox']      = z_root() . '/outbox/'    . $c['channel_address'];
		$ret['followers']   = z_root() . '/followers/' . $c['channel_address'];
		$ret['following']   = z_root() . '/following/' . $c['channel_address'];

		$ret['endpoints']   = [ 'sharedInbox' => z_root() . '/inbox' ];

		$ret['publicKey'] = [
			'id'           => $p['xchan_url'],
			'owner'        => $p['xchan_url'],
			'publicKeyPem' => $p['xchan_pubkey']
		];

		$locs = Libzot::encode_locations($c);
		if($locs) {
			$ret['nomadicLocations'] = [];
			foreach($locs as $loc) {
				$ret['nomadicLocations'][] = [
					'id'              => $loc['url'] . '/locs/' . substr($loc['address'],0,strpos($loc['address'],'@')),
					'type'            => 'nomadicLocation',
					'locationAddress' => 'acct:' . $loc['address'],
					'locationPrimary' => (boolean) $loc['primary'],
					'locationDeleted' => (boolean) $loc['deleted']
				];
			}
		}
	}
	else {
		$collections = get_xconfig($p['xchan_hash'],'activitystreams','collections',[]);
		if($collections) {
			$ret = array_merge($ret,$collections);
		}
		else {
			$ret['inbox'] = null;
			$ret['outbox'] = null;
		}
	}

	return $ret;
}


function activity_mapper($verb) {

	$acts = [
		'http://activitystrea.ms/schema/1.0/post'      => 'Create',
		'http://activitystrea.ms/schema/1.0/share'     => 'Announce',
		'http://activitystrea.ms/schema/1.0/update'    => 'Update',
		'http://activitystrea.ms/schema/1.0/like'      => 'Like',
		'http://activitystrea.ms/schema/1.0/favorite'  => 'Like',
		'http://purl.org/zot/activity/dislike'         => 'Dislike',
		'http://activitystrea.ms/schema/1.0/tag'       => 'Add',
		'http://activitystrea.ms/schema/1.0/follow'    => 'Follow',
		'http://activitystrea.ms/schema/1.0/unfollow'  => 'Unfollow',
		'http://activitystrea.ms/schema/1.0/stop-following' => 'Unfollow',
		'http://purl.org/zot/activity/attendyes'       => 'Accept',
		'http://purl.org/zot/activity/attendno'        => 'Reject',
		'http://purl.org/zot/activity/attendmaybe'     => 'TentativeAccept'

	];


	if(array_key_exists($verb,$acts) && $acts[$verb]) {
		return $acts[$verb];
	}

	// Reactions will just map to normal activities

	if(strpos($verb,ACTIVITY_REACT) !== false)
		return 'Create';
	if(strpos($verb,ACTIVITY_MOOD) !== false)
		return 'Create';

	if(strpos($verb,ACTIVITY_POKE) !== false)
		return 'Activity';

	if($verb === 'Announce')
		return $verb;


	// We should return false, however this will trigger an uncaught execption  and crash
	// the delivery system if encountered by the JSON-LDSignature library

	logger('Unmapped activity: ' . $verb);
	return 'Create';
//	return false;
}


function activity_obj_mapper($obj) {

	$objs = [
		'http://activitystrea.ms/schema/1.0/note'           => 'Note',
		'http://activitystrea.ms/schema/1.0/comment'        => 'Note',
		'http://activitystrea.ms/schema/1.0/person'         => 'Person',
		'http://purl.org/zot/activity/profile'              => 'Profile',
		'http://activitystrea.ms/schema/1.0/photo'          => 'Image',
		'http://activitystrea.ms/schema/1.0/profile-photo'  => 'Icon',
		'http://activitystrea.ms/schema/1.0/event'          => 'Event',
		'http://activitystrea.ms/schema/1.0/wiki'           => 'Document',
		'http://purl.org/zot/activity/location'             => 'Place',
		'http://purl.org/zot/activity/chessgame'            => 'Game',
		'http://purl.org/zot/activity/tagterm'              => 'zot:Tag',
		'http://purl.org/zot/activity/thing'                => 'Object',
		'http://purl.org/zot/activity/file'                 => 'zot:File',
		'http://purl.org/zot/activity/mood'                 => 'zot:Mood',
		'Invite'                                            => 'Invite',
		'Question'                                          => 'Question'
	];

	if ($obj === 'Answer') {
		return 'Note';
	}

	if (strpos($obj,'/') === false) {
		return $obj;
	}

	if(array_key_exists($obj,$objs)) {
		return $objs[$obj];
	}

	logger('Unmapped activity object: ' . $obj);
	return 'Note';

}


function as_fetch($url) {

	if(! check_siteallowed($url)) {
		logger('blacklisted: ' . $url);
		return null;
	}

	$redirects = 0;
	$x = z_fetch_url($url,true,$redirects,
		['headers' => [ 'Accept: application/activity+json, application/ld+json; profile="https://www.w3.org/ns/activitystreams"' ]]);

	if($x['success']) {
		return $x['body'];
	}
	return null;
}

function as_follow($channel,$act) {

	$contact = null;
	$their_follow_id = null;

	/*
	 *
	 * if $act->type === 'Follow', actor is now following $channel
	 * if $act->type === 'Accept', actor has approved a follow request from $channel
	 *
	 */

	$person_obj = $act->actor;

	if($act->type === 'Follow') {
		if($act->obj['id'] !== channel_url($channel)) {
			return;
		}
		$their_follow_id  = $act->id;
	}
	elseif($act->type === 'Accept') {
		$my_follow_id = z_root() . '/follow/' . $contact['id'] . '#accept';
	}

	if(is_array($person_obj)) {

		// store their xchan and hubloc

		Activity::actor_store($person_obj['id'], $person_obj);

		// Find any existing abook record

		$r = q("select * from abook left join xchan on abook_xchan = xchan_hash where abook_xchan = '%s' and abook_channel = %d limit 1",
			dbesc($person_obj['id']),
			intval($channel['channel_id'])
		);
		if($r) {
			$contact = $r[0];
		}
	}

	$x = PermissionRoles::role_perms('social');
	$their_perms = Permissions::FilledPerms($x['perms_connect']);

	if($contact && $contact['abook_id']) {

		// A relationship of some form already exists on this site.

		switch($act->type) {

			case 'Follow':

				// A second Follow request, but we haven't approved the first one

				if($contact['abook_pending']) {
					return;
				}

				// We've already approved them or followed them first
				// Send an Accept back to them

				set_abconfig($channel['channel_id'],$person_obj['id'],'pubcrawl','their_follow_id', $their_follow_id);
				Master::Summon([ 'Notifier', 'permission_accept', $contact['abook_id'] ]);
				return;

			case 'Accept':

				// They accepted our Follow request - set default permissions (except for send_stream and post_wall)
				foreach($their_perms as $k => $v) {
					if(in_array($k, ['send_stream', 'post_wall']))
						$v = 0; // Those will be set once we accept their follow request
					set_abconfig($channel['channel_id'],$contact['abook_xchan'],'their_perms',$k,$v);
				}

				$abook_instance = $contact['abook_instance'];

				if(strpos($abook_instance,z_root()) === false) {
					if($abook_instance)
						$abook_instance .= ',';
					$abook_instance .= z_root();

					$r = q("update abook set abook_instance = '%s', abook_not_here = 0
						where abook_id = %d and abook_channel = %d",
						dbesc($abook_instance),
						intval($contact['abook_id']),
						intval($channel['channel_id'])
					);
				}

				return;
			default:
				return;

		}
	}

	// No previous relationship exists.

	if($act->type === 'Accept') {
		// This should not happen unless we deleted the connection before it was accepted.
		return;
	}

	// From here on out we assume a Follow activity to somebody we have no existing relationship with

	set_abconfig($channel['channel_id'],$person_obj['id'],'pubcrawl','their_follow_id', $their_follow_id);

	// The xchan should have been created by Activity::actor_store() above

	$r = q("select * from xchan where xchan_hash = '%s' and xchan_network = 'activitypub' limit 1",
		dbesc($person_obj['id'])
	);

	if(! $r) {
		logger('xchan not found for ' . $person_obj['id']);
		return;
	}
	$ret = $r[0];

	$p = Permissions::connect_perms($channel['channel_id']);
	$my_perms  = $p['perms'];
	$automatic = $p['automatic'];

	$closeness = get_pconfig($channel['channel_id'],'system','new_abook_closeness');
	if($closeness === false)
		$closeness = 80;

	$r = abook_store_lowlevel(
		[
			'abook_account'   => intval($channel['channel_account_id']),
			'abook_channel'   => intval($channel['channel_id']),
			'abook_xchan'     => $ret['xchan_hash'],
			'abook_closeness' => intval($closeness),
			'abook_created'   => datetime_convert(),
			'abook_updated'   => datetime_convert(),
			'abook_connected' => datetime_convert(),
			'abook_dob'       => NULL_DATE,
			'abook_pending'   => intval(($automatic) ? 0 : 1),
			'abook_instance'  => z_root()
		]
	);

	if($my_perms)
		foreach($my_perms as $k => $v)
			set_abconfig($channel['channel_id'],$ret['xchan_hash'],'my_perms',$k,$v);

	if($their_perms)
		foreach($their_perms as $k => $v)
			set_abconfig($channel['channel_id'],$ret['xchan_hash'],'their_perms',$k,$v);


	if($r) {
		logger("New ActivityPub follower for {$channel['channel_name']}");

		$new_connection = q("select * from abook left join xchan on abook_xchan = xchan_hash left join hubloc on hubloc_hash = xchan_hash where abook_channel = %d and abook_xchan = '%s' order by abook_created desc limit 1",
			intval($channel['channel_id']),
			dbesc($ret['xchan_hash'])
		);
		if($new_connection) {
			\Zotlabs\Lib\Enotify::submit(
				[
					'type'	       => NOTIFY_INTRO,
					'from_xchan'   => $ret['xchan_hash'],
					'to_xchan'     => $channel['channel_hash'],
					'link'         => z_root() . '/connedit/' . $new_connection[0]['abook_id'],
				]
			);

			if($my_perms && $automatic) {
				// send an Accept for this Follow activity
				Master::Summon([ 'Notifier', 'permission_accept', $new_connection[0]['abook_id'] ]);
				// Send back a Follow notification to them
				Master::Summon([ 'Notifier', 'permission_create', $new_connection[0]['abook_id'] ]);
			}

			$clone = array();
			foreach($new_connection[0] as $k => $v) {
				if(strpos($k,'abook_') === 0) {
					$clone[$k] = $v;
				}
			}
			unset($clone['abook_id']);
			unset($clone['abook_account']);
			unset($clone['abook_channel']);

			$abconfig = load_abconfig($channel['channel_id'],$clone['abook_xchan']);

			if($abconfig)
				$clone['abconfig'] = $abconfig;

			Libsync::build_sync_packet($channel['channel_id'], [ 'abook' => array($clone) ] );
		}
	}


	/* If there is a default group for this channel and permissions are automatic, add this member to it */

	if($channel['channel_default_group'] && $automatic) {
		$g = AccessList::by_hash($channel['channel_id'],$channel['channel_default_group']);
		if($g)
			AccessList::member_add($channel['channel_id'],'',$ret['xchan_hash'],$g['id']);
	}


	return;

}


function as_unfollow($channel,$act) {

	$contact = null;

	/* @FIXME This really needs to be a signed request. */

	/* actor is unfollowing $channel */

	$person_obj = $act->actor;

	if(is_array($person_obj)) {

		$r = q("select * from abook left join xchan on abook_xchan = xchan_hash where abook_xchan = '%s' and abook_channel = %d limit 1",
			dbesc($person_obj['id']),
			intval($channel['channel_id'])
		);
		if($r) {
			// This is just to get a list of permission names, we don't care about the values
			$x = PermissionRoles::role_perms('social');
			$my_perms = Permissions::FilledPerms($x['perms_connect']);

			// remove all permissions they provided
			foreach($my_perms as $k => $v) {
				del_abconfig($channel['channel_id'],$r[0]['xchan_hash'],'their_perms',$k);
			}
		}
	}

	return;
}

function as_create_action($channel,$observer_hash,$act) {

	if(in_array($act->obj['type'], [ 'Note', 'Article', 'Video', 'Image', 'Event', 'Question', 'Page' ])) {
		as_create_note($channel,$observer_hash,$act);
	}

}

function as_delete_action($channel,$observer_hash,$act) {

	as_delete_note($channel,$observer_hash,$act);

}

function as_announce_action($channel,$observer_hash,$act) {

	if(in_array($act->type, [ 'Announce' ])) {
		as_announce_note($channel,$observer_hash,$act);
	}

}


function as_like_action($channel,$observer_hash,$act) {

	if(in_array($act->obj['type'], [ 'Note', 'Article', 'Video', 'Image', 'Event', 'Profile' ])) {
		as_like_note($channel,$observer_hash,$act);
	}


}

// sort function width decreasing

function as_vid_sort($a,$b) {
	if($a['width'] === $b['width'])
		return 0;
	return (($a['width'] > $b['width']) ? -1 : 1);
}

function as_create_note($channel,$observer_hash,$act) {

	// Within our family of projects, Follow/Unfollow of a thread is an internal activity which should not be transmitted,
	// hence if we receive it - ignore or reject it.
	// Unfollow is not defined by ActivityStreams, which prefers Undo->Follow.
	// This may have to be revisited if AP projects start using Follow for objects other than actors.

	if (in_array($act->type, [ 'Follow', 'Unfollow' ])) {
		return false;
	}

	$s = [];

	$announce = (($act->type === 'Announce') ? true  : false);
	$is_sys_channel = is_sys_channel($channel['channel_id']);
	$parent = ((array_key_exists('inReplyTo',$act->obj) && $act->obj['inReplyTo'] && !$announce) ? urldecode($act->obj['inReplyTo']) : false);
	$allowed = true;

	if(!$parent) {
		if(!perm_is_allowed($channel['channel_id'], $observer_hash, 'send_stream') && !$is_sys_channel) {
			// Fall through on update activities since we already accepted the item.
			// We might have got it via announce or imported it manually.
			if($act->type !== 'Update') {
				logger('no permission');
				$allowed = false;
			}
		}
		$s['owner_xchan'] = $observer_hash;
	}

	if ($act->recips && (!in_array(ACTIVITY_PUBLIC_INBOX, $act->recips))) {
		$s['item_private'] = 1;

		if (array_key_exists('directMessage', $act->data)) {
			// the litebub way to determine a direct message (pleroma, friendica)
			if (intval($act->data['directMessage'])) {
				$s['item_private'] = 2;
			}
		}
		else {
			// an ugly and imperfect way to recognise a mastodon direct message
			if (
				!isset($act->raw_recips['cc']) &&
				is_array($act->raw_recips['to']) &&
				in_array(channel_url($channel), $act->raw_recips['to']) &&
				!in_array($act->actor['followers'], $act->raw_recips['to'])
			) {
				$s['item_private'] = 2;
			}
		}
	}

	if (intval($s['item_private']) === 2) {
		$allowed = true;
		if (!perm_is_allowed($channel['channel_id'], $observer_hash, 'post_mail')) {
			logger('no post_mail permission');
			$allowed = false;
		}
	}

	if (!$allowed) {
		return;
	}

	$s['author_xchan'] = $act->actor['id'];

	if ($announce) {
		$s['author_xchan'] = as_get_attributed_to_person($act);
	}

	$content = as_get_content($act->obj);

	$s['aid'] = $channel['channel_account_id'];
	$s['uid'] = $channel['channel_id'];
	$s['mid'] = ((is_array($act->obj) && isset($act->obj['id'])) ? $act->obj['id'] : $act->obj);

	if (!$s['mid']) {
		return false;
	}

	// Friendica sends the diaspora guid in a nonstandard field via AP
	$s['uuid'] = ((is_array($act->obj) && isset($act->obj['diaspora:guid'])) ? $act->obj['diaspora:guid'] : '');

	if (!$s['uuid']) {
		// If no uuid is provided we will create an uuid v5 from the mid
		$s['uuid'] = uuid_from_url($s['mid']);
	}

	if(in_array($act->obj['type'],[ 'Note','Article','Page' ])) {
		$ptr = null;

		if(array_key_exists('url',$act->obj)) {
			if(is_array($act->obj['url'])) {
				if(array_key_exists(0,$act->obj['url'])) {
					$ptr = $act->obj['url'];
				}
				else {
					$ptr = [ $act->obj['url'] ];
				}
				foreach($ptr as $vurl) {
					if(is_array($vurl) && array_key_exists('mediaType',$vurl) && $vurl['mediaType'] === 'text/html') {
						$s['plink'] = $vurl['href'];
						break;
					}
				}
			}
			elseif(is_string($act->obj['url'])) {
				$s['plink'] = $act->obj['url'];
			}
		}
	}

	if(! $s['plink']) {
		$s['plink'] = $s['mid'];
	}

	if($act->data['published']) {
		$s['created'] = datetime_convert('UTC','UTC',$act->data['published']);
	}
	elseif($act->obj['published']) {
		$s['created'] = datetime_convert('UTC','UTC',$act->obj['published']);
	}
	if($act->data['updated']) {
		$s['edited'] = datetime_convert('UTC','UTC',$act->data['updated']);
	}
	elseif($act->obj['updated']) {
		$s['edited'] = datetime_convert('UTC','UTC',$act->obj['updated']);
	}

	if(! $s['created'])
		$s['created'] = datetime_convert();

	if(! $s['edited'])
		$s['edited'] = $s['created'];

	if(! $s['parent_mid'])
		$s['parent_mid'] = $parent ? $parent : $s['mid'];

	$s['title']    = as_bb_content($content,'name');
	$s['summary']  = as_bb_content($content,'summary');
	$s['body']     = as_bb_content($content,'content');
	$s['verb']     = (($announce) ? ACTIVITY_SHARE : ACTIVITY_POST);
	$s['obj_type'] = ACTIVITY_OBJ_NOTE;
	$s['obj']      = '';
	$s['app']      = t('ActivityPub');

	// This isn't perfect but the best we can do for now.

	$s['comment_policy'] = 'authenticated';

	if($act->obj['type'] === 'Event') {
		$ev = as_bb_content($content,'event');
		if($ev) {
			$s['obj_type'] = ACTIVITY_OBJ_EVENT;
		}
	}

	if($act->obj['type'] === 'Question') {
		$s['obj_type'] = 'Question';
		$s['obj'] = $act->obj;
	}

	if ($act->obj['type'] === 'Question' && in_array($act->type,['Create','Update'])) {
		if ($act->obj['endTime']) {
			$s['comments_closed'] = datetime_convert('UTC','UTC', $act->obj['endTime']);
		}
		// pleroma
		if ($act->obj['closed']) {
			$s['comments_closed'] = datetime_convert('UTC','UTC', $act->obj['closed']);
		}
	}

	// Mastodon does not provide update timestamps when updating poll tallies which means race conditions may occur here.
	if ($act->type === 'Update' && $act->obj['type'] === 'Question' && $s['edited'] === $s['created']) {
		$s['edited'] = datetime_convert();
	}

	if($channel['channel_system']) {
		$incl = get_config('system','pubstream_incl');
		$excl = get_config('system','pubstream_excl');

		if(($incl || $excl) && !MessageFilter::evaluate($s, $incl, $excl)) {
			logger('post is filtered');
			return;
		}
	}

	$s['author_xchan'] = Activity::find_best_identity($s['author_xchan']);

	if(!$s['author_xchan']) {
		logger('No author: ' . print_r($act, true));
		return;
	}

	if($parent) {
		$p = q("select parent_mid, owner_xchan, obj_type from item where mid = '%s' and uid = %d limit 1",
			dbesc($s['parent_mid']),
			intval($s['uid'])
		);
		if(! $p) {
			$a = Activity::fetch_and_store_parents($channel, $observer_hash, $s);
			if($a) {
				$p = q("select parent_mid, owner_xchan from item where mid = '%s' and uid = %d limit 1",
					dbesc($s['parent_mid']),
					intval($s['uid'])
				);
				if(! $p) {
					logger('parent not found.');
					return;
				}
			}
			else {
				logger('could not fetch parents');
				return;

				// @TODO we maybe could accept these is we formatted the body correctly with share_bb()
				// or at least provided a link to the object
				// if(in_array($act->type,[ 'Like','Dislike' ])) {
				//	return;
				// }

				// @TODO do we actually want that?
				// if no parent was fetched, turn into a top-level post

				// turn into a top level post
				// $s['parent_mid'] = $s['mid'];
				// $s['thr_parent'] = $s['mid'];
			}
		}

		if ($p[0]['obj_type'] === 'Question') {
			if ($s['obj_type'] === ACTIVITY_OBJ_NOTE && $s['title'] && (! $s['body'])) {
				$s['obj_type'] = 'Answer';
			}
		}

		if($p[0]['parent_mid'] !== $s['parent_mid']) {
			$s['thr_parent'] = $s['parent_mid'];
		}
		else {
			$s['thr_parent'] = $p[0]['parent_mid'];
		}
		$s['parent_mid'] = $p[0]['parent_mid'];
		$s['owner_xchan'] = $p[0]['owner_xchan'];
	}

	// Make sure we use the zot6 identity where applicable

	$s['owner_xchan']  = Activity::find_best_identity($s['owner_xchan']);

	if(!$s['owner_xchan']) {
		logger('No owner: ' . print_r($act, true));
		return;
	}

	$abook = q("select * from abook where (abook_xchan = '%s' OR abook_xchan  = '%s') and abook_channel = %d ",
		dbesc($s['author_xchan']),
		dbesc($s['owner_xchan']),
		intval($channel['channel_id'])
	);

	if ($abook) {
		if (!post_is_importable($channel['channel_id'], $s, $abook)) {
			logger('post is filtered');
			return;
		}
	}

	if($act->obj['conversation']) {
		set_iconfig($s, 'ostatus', 'conversation', $act->obj['conversation'], 1);
	}

	$a = Activity::decode_taxonomy($act->obj);
	if($a) {
		$s['term'] = $a;
	}

	$a = asdecode_attachment($act->obj);
	if($a) {
		$s['attach'] = $a;
	}

	if($act->obj['type'] === 'Note' && $s['attach']) {
		$s['body'] = as_bb_attach($s['attach']) . $s['body'];
	}

	if (isset($act->obj['quoteUrl'])) {
		$quote_bbcode = Activity::get_quote_bbcode($act->obj['quoteUrl']);

		if ($s['body']) {
			$s['body'] .= "\r\n\r\n";
		}

		$s['body'] .= $quote_bbcode;
	}

	// we will need a hook here to extract magnet links e.g. peertube
	// right now just link to the largest mp4 we find that will fit in our
	// standard content region

	if(! ActivityStreams::is_response_activity($act->type)) {
		if ($act->obj['type'] === 'Video') {

			$vtypes = [
				'video/mp4',
				'video/ogg',
				'video/webm'
			];

			$mps    = [];
			$poster = null;
			$ptr    = null;

			// try to find a poster to display on the video element

			if (array_key_exists('icon',$act->obj)) {
				if (is_array($act->obj['icon'])) {
					if (array_key_exists(0,$act->obj['icon'])) {
						$ptr = $act->obj['icon'];
					}
					else {
						$ptr = [ $act->obj['icon'] ];
					}
				}
				if ($ptr) {
					foreach ($ptr as $foo) {
						if (is_array($foo) && array_key_exists('type',$foo) && $foo['type'] === 'Image' && is_string($foo['url'])) {
							$poster = $foo['url'];
						}
					}
				}
			}

			$tag = (($poster) ? '[video poster=&quot;' . $poster . '&quot;]' : '[video]' );
			$ptr = null;

			if (array_key_exists('url',$act->obj)) {
				if (is_array($act->obj['url'])) {
					if (array_key_exists(0,$act->obj['url'])) {
						$ptr = $act->obj['url'];
					}
					else {
						$ptr = [ $act->obj['url'] ];
					}
					// handle peertube's weird url link tree if we find it here
					// 0 => html link, 1 => application/x-mpegURL with 'tag' set to an array of actual media links
					foreach ($ptr as $idex) {
						if (is_array($idex) && array_key_exists('mediaType',$idex)) {
							if ($idex['mediaType'] === 'application/x-mpegURL' && isset($idex['tag']) && is_array($idex['tag'])) {
								$ptr = $idex['tag'];
								break;
							}
						}
					}

					foreach ($ptr as $vurl) {
						if (array_key_exists('mediaType',$vurl)) {
							if (in_array($vurl['mediaType'], $vtypes)) {
								if (! array_key_exists('height',$vurl)) {
									$vurl['height'] = 0;
								}
								$mps[] = $vurl;
							}
						}
					}
				}
				if ($mps) {
					usort($mps,[ '\Zotlabs\Lib\Activity', 'vid_sort' ]);
					foreach ($mps as $m) {
						if (intval($m['height']) < 500 && Activity::media_not_in_body($m['href'],$s['body'])) {
							$s['body'] .= "\n\n" . $tag . $m['href'] . '[/video]';
							break;
						}
					}
				}
				elseif (is_string($act->obj['url']) && Activity::media_not_in_body($act->obj['url'],$s['body'])) {
					$s['body'] .= "\n\n" . $tag . $act->obj['url'] . '[/video]';
				}

			}
		}

		if ($act->obj['type'] === 'Audio') {

			$atypes = [
				'audio/mpeg',
				'audio/ogg',
				'audio/wav'
			];

			$ptr = null;

			if (array_key_exists('url',$act->obj)) {
				if (is_array($act->obj['url'])) {
					if (array_key_exists(0,$act->obj['url'])) {
						$ptr = $act->obj['url'];
					}
					else {
						$ptr = [ $act->obj['url'] ];
					}
					foreach ($ptr as $vurl) {
						if (in_array($vurl['mediaType'], $atypes) && Activity::media_not_in_body($vurl['href'],$s['body'])) {
							$s['body'] .= "\n\n" . '[audio]' . $vurl['href'] . '[/audio]';
							break;
						}
					}
				}
				elseif (is_string($act->obj['url']) && Activity::media_not_in_body($act->obj['url'],$s['body'])) {
					$s['body'] .= "\n\n" . '[audio]' . $act->obj['url'] . '[/audio]';
				}
			}
			// Pleroma audio scrobbler
			elseif ($act->type === 'Listen' && array_key_exists('artist', $act->obj) && array_key_exists('title',$act->obj) && $s['body'] === EMPTY_STR) {
				$s['body'] .= "\n\n" . sprintf('Listening to \"%1$s\" by %2$s', escape_tags($act->obj['title']), escape_tags($act->obj['artist']));
				if(isset($act->obj['album'])) {
					$s['body'] .= "\n" . sprintf('(%s)', escape_tags($act->obj['album']));
				}
			}
		}

		if ($act->obj['type'] === 'Image' && strpos($s['body'],'zrl=') === false) {

			$ptr = null;

			if (array_key_exists('url',$act->obj)) {
				if (is_array($act->obj['url'])) {
					if (array_key_exists(0,$act->obj['url'])) {
						$ptr = $act->obj['url'];
					}
					else {
						$ptr = [ $act->obj['url'] ];
					}
					foreach ($ptr as $vurl) {
						if (strpos($s['body'],$vurl['href']) === false) {
							$s['body'] = '[zmg]' . $vurl['href'] . '[/zmg]' . "\n\n" . $s['body'];
							break;
						}
					}
				}
				elseif (is_string($act->obj['url'])) {
					if (strpos($s['body'],$act->obj['url']) === false) {
						$s['body'] = '[zmg]' . $act->obj['url'] . '[/zmg]' .  "\n\n" .  $s['body'];
					}
				}
			}
		}

		if ($act->obj['type'] === 'Page' && ! $s['body'])  {

			$ptr  = null;
			$purl = EMPTY_STR;

			if (array_key_exists('url',$act->obj)) {
				if (is_array($act->obj['url'])) {
					if (array_key_exists(0,$act->obj['url'])) {
						$ptr = $act->obj['url'];
					}
					else {
						$ptr = [ $act->obj['url'] ];
					}
					foreach ($ptr as $vurl) {
						if (is_array($vurl) && array_key_exists('mediaType',$vurl) && $vurl['mediaType'] === 'text/html') {
							$purl = $vurl['href'];
							break;
						}
						elseif (is_array($vurl) && array_key_exists('mimeType',$vurl) && $vurl['mimeType'] === 'text/html') {
							$purl = $vurl['href'];
							break;
						}
					}
				}
				elseif (is_string($act->obj['url'])) {
					$purl = $act->obj['url'];
				}
				if ($purl) {
					$li = z_fetch_url(z_root() . '/linkinfo?binurl=' . bin2hex($purl));
					if ($li['success'] && $li['body']) {
						$s['body'] .= "\n" . $li['body'];
					}
					else {
						$s['body'] .= "\n\n" . $purl;
					}
				}
			}
		}

		$eventptr = null;

		if ($act->obj['type'] === 'Invite' && array_path_exists('object/type', $act->obj) && $act->obj['object']['type'] === 'Event') {
			$eventptr = $act->obj['object'];
			$s['mid'] = $s['parent_mid'] = $act->obj['id'];
		}

		if ($act->obj['type'] === 'Event') {
			if ($act->type === 'Invite') {
				$s['mid'] = $s['parent_mid'] = $act->id;
			}
			$eventptr = $act->obj;
		}

		if ($eventptr) {
			$s['obj']          = [];
			$s['obj']['asld']  = $eventptr;
			$s['obj']['type']  = ACTIVITY_OBJ_EVENT;
			$s['obj']['id']    = $eventptr['id'];
			$s['obj']['title'] = html2plain($eventptr['name']);

			if (strpos($act->obj['startTime'], 'Z'))
				$s['obj']['adjust'] = true;
			else
				$s['obj']['adjust'] = false;

			$s['obj']['dtstart'] = datetime_convert('UTC', 'UTC', $eventptr['startTime']);
			if ($act->obj['endTime'])
				$s['obj']['dtend'] = datetime_convert('UTC', 'UTC', $eventptr['endTime']);
			else
				$s['obj']['nofinish'] = true;
			$s['obj']['description'] = html2bbcode($eventptr['content']);

			if (array_path_exists('location/content', $eventptr))
				$s['obj']['location'] = $eventptr['location']['content'];
		}
	}

	set_iconfig($s,'activitypub','recips',$act->raw_recips);
	if($parent) {
		set_iconfig($s,'activitypub','rawmsg',$act->raw,1);
	}

	$x = null;

	$r = q("select id, created, edited from item where mid = '%s' and uid = %d limit 1",
		dbesc($s['mid']),
		intval($s['uid'])
	);
	if($r) {
		// if we already have the item dismiss its announce
		if($announce)
			return;

		if($s['edited'] > $r[0]['edited']) {
			$s['id'] = $r[0]['id'];
			$x = item_store_update($s);
		}
		else {
			return;
		}
	}
	else {
		$x = item_store($s);
	}

	if(is_array($x) && $x['item_id']) {
		if($parent) {
			if($s['owner_xchan'] === $channel['channel_hash']) {
				// We are the owner of this conversation, so send all received comments back downstream
				Master::Summon(array('Notifier','comment-import',$x['item_id']));
			}
			$r = q("select * from item where id = %d limit 1",
				intval($x['item_id'])
			);
			if($r) {
				send_status_notifications($x['item_id'],$r[0]);
			}
		}
		sync_an_item($channel['channel_id'],$x['item_id']);
	}

}

/* this is deprecated and not used anymore
function as_announce_note($channel,$observer_hash,$act) {

	$s = [];

	$is_sys_channel = is_sys_channel($channel['channel_id']);

	if(!perm_is_allowed($channel['channel_id'], $observer_hash, 'send_stream') && !$is_sys_channel) {
		logger('no permission');
		return;
	}

	$content = as_get_content($act->obj);

	$s['owner_xchan'] = $s['author_xchan'] = $observer_hash;

	$s['aid'] = $channel['channel_account_id'];
	$s['uid'] = $channel['channel_id'];
	$s['mid'] = urldecode($act->obj['id']);
	$s['plink'] = urldecode($act->obj['id']);

	if(! $s['created'])
		$s['created'] = datetime_convert();

	if(! $s['edited'])
		$s['edited'] = $s['created'];


	$s['parent_mid'] = $s['mid'];

	$s['verb']     = ACTIVITY_POST;
	$s['obj_type'] = ACTIVITY_OBJ_NOTE;
	$s['app']      = t('ActivityPub');

	if($channel['channel_system']) {
		if(! MessageFilter::evaluate($s,get_config('system','pubstream_incl'),get_config('system','pubstream_excl'))) {
			logger('post is filtered');
			return;
		}
	}

	$abook = q("select * from abook where abook_xchan = '%s' and abook_channel = %d limit 1",
		dbesc($observer_hash),
		intval($channel['channel_id'])
	);

	if($abook) {
		if(! post_is_importable($s,$abook[0])) {
			logger('post is filtered');
			return;
		}
	}

	if($act->obj['conversation']) {
		set_iconfig($s,'ostatus','conversation',$act->obj['conversation'],1);
	}

	$a = Activity::decode_taxonomy($act->obj);
	if($a) {
		$s['term'] = $a;
	}

	$a = asdecode_attachment($act->obj);
	if($a) {
		$s['attach'] = $a;
	}

	$body = "[share author='" . urlencode($act->sharee['name']) .
		"' profile='" . $act->sharee['url'] .
		"' avatar='" . $act->sharee['photo_s'] .
		"' link='" . ((is_array($act->obj['url'])) ? $act->obj['url']['href'] : $act->obj['url']) .
		"' auth='" . ((is_matrix_url($act->obj['url'])) ? 'true' : 'false' ) .
		"' posted='" . $act->obj['published'] .
		"' message_id='" . $act->obj['id'] .
	"']";

	if($content['name'])
		$body .= as_bb_content($content,'name') . "\r\n";

	if($act->obj['type'] === 'Note' && $s['attach']) {
		$body .= as_bb_attach($s['attach']);
	}

	$body .= as_bb_content($content,'content');

	$body .= "[/share]";

	$s['title']    = as_bb_content($content,'name');
	$s['body']     = $body;

	if($act->recips && (! in_array(ACTIVITY_PUBLIC_INBOX,$act->recips)))
		$s['item_private'] = 1;

	set_iconfig($s,'activitypub','recips',$act->raw_recips);

	$r = q("select created, edited from item where mid = '%s' and uid = %d limit 1",
		dbesc($s['mid']),
		intval($s['uid'])
	);
	if($r) {
		if($s['edited'] > $r[0]['edited']) {
			$x = item_store_update($s);
		}
		else {
			return;
		}
	}
	else {
		$x = item_store($s);
	}

}
*/

function as_like_note($channel,$observer_hash,$act) {

	$s = [];

	$s['mid'] = $act->id;
	if(!$s['mid']) {
		return;
	}

	$s['parent_mid'] = ((is_array($act->obj) && isset($act->obj['id'])) ? $act->obj['id'] : $act->obj);
	if(!$s['parent_mid']) {
		return;
	}

	// Friendica sends the diaspora guid in a nonstandard field via AP
	$s['uuid'] = ((is_array($act->data) && isset($act->data['diaspora:guid'])) ? $act->data['diaspora:guid'] : '');
	if (!$s['uuid']) {
		// If no uuid is provided we will create an uuid v5 from the mid
		$s['uuid'] = uuid_from_url($s['mid']);
	}


	if($act->type === 'Like')
		$s['verb'] = ACTIVITY_LIKE;
	if($act->type === 'Dislike')
		$s['verb'] = ACTIVITY_DISLIKE;

	$r = q("select * from item where uid = %d and ( mid = '%s' or  mid = '%s' ) limit 1",
		intval($channel['channel_id']),
		dbesc($s['parent_mid']),
		dbesc(urldecode(basename($s['parent_mid'])))
	);

	if(! $r) {
		$p = Activity::fetch_and_store_parents($channel, $observer_hash, $s);
		if($p) {
			$r = q("select * from item where uid = %d and ( mid = '%s' or  mid = '%s' ) limit 1",
				intval($channel['channel_id']),
				dbesc($s['parent_mid']),
				dbesc(urldecode(basename($s['parent_mid'])))
			);
			if(! $r) {
				logger('parent not found.');
				return;
			}
		}
	}

	xchan_query($r);
	$parent_item = $r[0];

	if($parent_item['owner_xchan'] === $channel['channel_hash']) {
		if(! perm_is_allowed($channel['channel_id'], $act->actor['id'], 'post_comments')) {
			logger('no comment permission.');
			return;
		}
	}

	if($parent_item['mid'] === $parent_item['parent_mid']) {
		$s['parent_mid'] = $parent_item['mid'];
	}
	else {
		$s['thr_parent'] = $parent_item['mid'];
		$s['parent_mid'] = $parent_item['parent_mid'];
	}


	// Make sure we use the zot6 identity where applicable

	$s['owner_xchan']  = Activity::find_best_identity($parent_item['owner_xchan']);
	$s['author_xchan'] = Activity::find_best_identity($act->actor['id']);

	if(!$s['author_xchan']) {
		logger('No author: ' . print_r($act, true));
	}

	if(!$s['owner_xchan']) {
		logger('No owner: ' . print_r($act, true));
	}

	if(!$s['author_xchan'] || !$s['owner_xchan'])
		return;

	$s['aid'] = $channel['channel_account_id'];
	$s['uid'] = $channel['channel_id'];

	$post_type = (($parent_item['resource_type'] === 'photo') ? t('photo') : t('status'));

	$links = array(array('rel' => 'alternate','type' => 'text/html', 'href' => $parent_item['plink']));
	$objtype = (($parent_item['resource_type'] === 'photo') ? ACTIVITY_OBJ_PHOTO : ACTIVITY_OBJ_NOTE );

	$z = q("select * from xchan where xchan_hash = '%s'",
		dbesc($parent_item['author_xchan'])
	);
	if($z)
		$item_author = Libzot::zot_record_preferred($z, 'xchan_network');

	$object = json_encode(array(
		'type'    => $post_type,
		'id'      => $parent_item['mid'],
		'asld'    => Activity::fetch_item( ['id' => $parent_item['mid'] ] ),
		'parent'  => (($parent_item['thr_parent']) ? $parent_item['thr_parent'] : $parent_item['parent_mid']),
		'link'    => $links,
		'title'   => $parent_item['title'],
		'content' => $parent_item['body'],
		'created' => $parent_item['created'],
		'edited'  => $parent_item['edited'],
		'diaspora:guid' => $parent_item['uuid'],
		'author'  => array(
			'name'     => $item_author['xchan_name'],
			'address'  => $item_author['xchan_addr'],
			'guid'     => $item_author['xchan_guid'],
			'guid_sig' => $item_author['xchan_guid_sig'],
			'link'     => array(
				array('rel' => 'alternate', 'type' => 'text/html', 'href' => $item_author['xchan_url']),
				array('rel' => 'photo', 'type' => $item_author['xchan_photo_mimetype'], 'href' => $item_author['xchan_photo_m'])),
			),
		), JSON_UNESCAPED_SLASHES
	);

	if($act->type === 'Like')
		$bodyverb = t('%1$s likes %2$s\'s %3$s');
	if($act->type === 'Dislike')
		$bodyverb = t('%1$s doesn\'t like %2$s\'s %3$s');

	$ulink = '[url=' . $item_author['xchan_url'] . '][bdi]' . $item_author['xchan_name'] . '[/bdi][/url]';
	$alink = '[url=' . $parent_item['author']['xchan_url'] . '][bdi]' . $parent_item['author']['xchan_name'] . '[/bdi][/url]';
	$plink = '[url='. z_root() . '/display/' . gen_link_id($act->id) . ']' . $post_type . '[/url]';
	$s['body'] =  sprintf( $bodyverb, $ulink, $alink, $plink );

	$s['app']  = t('ActivityPub');

	// set the route to that of the parent so downstream hubs won't reject it.

	$s['route'] = $parent_item['route'];
	$s['item_private'] = $parent_item['item_private'];
	$s['obj_type'] = $objtype;
	$s['obj'] = $object;

	if($act->obj['conversation']) {
		set_iconfig($s,'ostatus','conversation',$act->obj['conversation'],1);
	}

	if($act->recips && (! in_array(ACTIVITY_PUBLIC_INBOX,$act->recips)))
		$s['item_private'] = 1;

	set_iconfig($s,'activitypub','recips',$act->raw_recips);

	$result = item_store($s);

	if($result['success']) {
		// if the message isn't already being relayed, notify others
		if(intval($parent_item['item_origin']))
			Master::Summon(array('Notifier','comment-import',$result['item_id']));
		sync_an_item($channel['channel_id'],$result['item_id']);
	}

	return;
}

function as_delete_note($channel,$observer_hash,$act) {

	$uid = $channel['channel_id'];
	if(is_array($act->obj))
		$mid = urldecode($act->obj['id']);
	else
		$mid = urldecode($act->obj);

	$r = q("SELECT * FROM item WHERE mid = '%s' and uid = %d LIMIT 1",
		dbesc($mid),
		intval($uid)
	);

	$i = $r[0];

	if($i['author_xchan'] !== $observer_hash)
		return;

	if($r) {
		$stage = DROPITEM_NORMAL;

		// If we are the conversation owner, propagate the delete
		if($i['owner_xchan'] === $channel['channel_hash'])
			$stage = DROPITEM_PHASE1;

		drop_item($i['id'],false, $stage);

		if($stage === DROPITEM_PHASE1) {
			Master::Summon(['Notifier', 'drop', $i['id']]);
		}
	}

	return;
}


function as_bb_attach($attach) {

	$ret = false;

	foreach($attach as $a) {
		if(strpos($a['type'],'image') !== false) {
			if($a['name'])
				$ret .= '[img=' . $a['href'] . ']' . $a['name'] . '[/img]' . "\n\n";
			else
				$ret .= '[img]' . $a['href'] . '[/img]' . "\n\n";
		}
		if(array_key_exists('type',$a) && strpos($a['type'], 'video') === 0) {
			$ret .= '[video]' . $a['href'] . '[/video]' . "\n\n";
		}
		if(array_key_exists('type',$a) && strpos($a['type'], 'audio') === 0) {
			$ret .= '[audio]' . $a['href'] . '[/audio]' . "\n\n";
		}
	}

	return $ret;
}



function as_bb_content($content,$field) {

	$ret = false;

	if (! is_array($content)) {
		btlogger('content not initialised');
		return $ret;
	}

	if (is_array($content[$field])) {
		foreach ($content[$field] as $k => $v) {
			$ret .= html2bbcode($v);
			// save this for auto-translate or dynamic filtering
			// $ret .= '[language=' . $k . ']' . html2bbcode($v) . '[/language]';
		}
	}
	else {
		if ($field === 'bbcode' && array_key_exists('bbcode',$content)) {
			$ret = $content[$field];
		}
		else {
			$ret = html2bbcode($content[$field]);
		}
	}
	if ($field === 'content' && $content['event'] && (! strpos($ret,'[event'))) {
		$ret .= format_event_bbcode($content['event']);
	}

	return $ret;
}





function as_get_content($act,$binary = false) {

	$content = [];
	$event = null;

	if ((! $act) || (! is_array($act))) {
		return $content;
	}

	if ($act['type'] === 'Event') {
		$adjust = false;
		$event = [];
		$event['event_hash'] = (($act['uuid']) ? $act['uuid'] : $act['id']);
		if (isset($act['startTime']) && substr($act['startTime'],-1,1) === 'Z') {
			$adjust = true;
			$event['adjust'] = 1;
			$event['dtstart'] = datetime_convert('UTC','UTC',$event['startTime'] . (($adjust) ? '' : 'Z'));
		}
		if (isset($act['endTime'])) {
			$event['dtend'] = datetime_convert('UTC','UTC',$event['endTime'] . (($adjust) ? '' : 'Z'));
		}
		else {
			$event['nofinish'] = true;
		}

		if (isset($act['eventRepeat'])) {
			$event['event_repeat'] = $act['eventRepeat'];
		}
	}

	foreach ([ 'name', 'summary', 'content' ] as $a) {
		if (($x = as_get_textfield($act,$a,$binary)) !== false) {
			$content[$a] = $x;
		}
	}

	if ($event && ! $binary) {
		$event['summary'] = ((is_string($content['summary'])) ? html2plain(purify_html($content['summary']),256) : '');
		if (! $event['summary']) {
			if ($content['name']) {
				$event['summary'] = ((is_string($content['name'])) ? html2plain(purify_html($content['name']),256) : '');
			}
		}
		if (! $event['summary']) {
			if ($content['content']) {
				$event['summary'] = ((is_string($content['content'])) ? html2plain(purify_html($content['content']),256) : '');
			}
		}
		if ($event['summary']) {
			$event['summary'] = substr($event['summary'],0,256);
		}
		$event['description'] = ((is_string($content['summary'])) ? html2bbcode(purify_html($content['content'])) : '');
		if ($event['summary'] && $event['dtstart']) {
			$content['event'] = $event;
		}
	}

	if (array_path_exists('source/mediaType',$act) && array_path_exists('source/content',$act)) {
		if ($act['source']['mediaType'] === 'text/bbcode') {
			$content['bbcode'] = purify_html($act['source']['content'], ['escape']);
		}
	}

	return $content;
}


function as_get_textfield($act,$field,$binary = false) {

	$content = false;

	if (array_key_exists($field,$act) && $act[$field])
		$content = (($binary) ? $act[$field] : purify_html($act[$field]));
	elseif (array_key_exists($field . 'Map',$act) && $act[$field . 'Map']) {
		foreach ($act[$field . 'Map'] as $k => $v) {
			$content[escape_tags($k)] = (($binary) ? $v : purify_html($v));
		}
	}
	return $content;
}

function as_get_attributed_to_person($act) {

	$attributed_to = '';

	if (is_array($act->obj['attributedTo'])) {
		foreach($act->obj['attributedTo'] as $a) {
			if (is_array($a) && isset($a['type']) && $a['type'] == 'Person') {
				$attributed_to = $a['id'];
			}
			elseif (is_string($a)) {
				$attributed_to = $a;
				break;
			}
		}
	}
	else {
		$attributed_to = $act->obj['attributedTo'];
	}
	return $attributed_to;

}
