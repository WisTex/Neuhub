<?php
/**
 * Name: Delivery Notice
 * Description: Display delivery status information at the top of items.
 * Version: 1.0
 * Author: DM42.Net, LLC
 * Maintainer: devhubzilla@dm42.net
 * MinVersion: 3.7.1
 */

function deliverynotice_load() { 
        Zotlabs\Extend\Hook::register('dreport_process', 'addon/deliverynotice/deliverynotice.php', 'Deliverynotice::dreport_process_hook',1,100);
        Zotlabs\Extend\Hook::register('prepare_body', 'addon/deliverynotice/deliverynotice.php', 'Deliverynotice::prepare_body_hook',1,100);
}

function deliverynotice_unload() { 
        Zotlabs\Extend\Hook::unregister_by_file('addon/deliverynotice/deliverynotice.php'); 
}


class Deliverynotice {

        public static $success_states = Array('post ignored','posted','relayed','updated','update ignored');
        public static $hardfail_states = Array('permission denied');
        public static $pending_states = Array('comment parent not found','storage filed');

        public static function maybeunjson ($value) {

                if (is_array($value)) {
                        return $value;
                }

                if ($value!=null) {
                    $decoded=json_decode($value,true);
                } else {
                    return null;
                }
            
                if (json_last_error() == JSON_ERROR_NONE) {
                    return ($decoded);
                } else {
                    return ($value);
                }
        }

        public static function maybejson ($value,$options=0) {

                if ($value!=null) {
                    if (!is_array($value)) {
                        $decoded=json_decode($value,true);
                    }
                } else {
                    return null;
                }
            
                if (is_array($value) || json_last_error() != JSON_ERROR_NONE) {
                            $encoded = json_encode($value,$options);
                    return ($encoded);
                } else {
                    return ($value);
                }
        }

        public static function dreport_process_hook(&$arr) {

                if (!is_array($arr)) { return; }

                $status = explode(':',$arr['status']);
                $status = $status[0];

                if (in_array($status,Deliverynotice::$hardfail_states)) {
                        $postopt = 'delivery_hardfail';
                } elseif (in_array($status,Deliverynotice::$pending_states)) {
                        $postopt = 'delivery_pending';
                } else {
                        $postopt = null;
                }

                $sender_channel = channelx_by_hash($arr['sender']);
                if (!$sender_channel) { return; }
                $id = intval($sender_channel['channel_id']);

                $r= q("select id,postopts from item where uid = %d and mid = '%s'",$id,dbesc($arr['message_id']));

logger ("Get postid & opts: ".print_r($r,true));
                if (!$r) { 
                        return; 
                }

                $iid = intval($r[0]['id']);
                $recipient = explode(' ',$arr['recipient']);

                if ($postopt != null) {
                        // A failure of some sort - record it so we can keep track
                        set_iconfig($iid,'delivery_status',$recipient[0],$postopt);
                } else {
                        // Message was delivered to this recipient - delete any failure recorded

                        del_iconfig($iid,'delivery_status',$recipient[0]);
                        // Check if there are any other incomplete deliveries for this message
                        $r=q("select id from iconfig where iid = %d and cat = '%s' limit 1",$iid,'delivery_status');
                        if ($r) { 
                                // There are other incomplete deliveries, nothing more to do.
                                return;
                        } else {
                                // There are no more incomplete deliveries, mark success (clear failure flags)
                                $postopt = 'delivery_success';
                        }
                }

		if($r[0]['postopts'])
			$postopts = explode(',',$r[0]['postopts']);
		else
			$postopts = [];

		$postopts[] = $postopt;

                if ($postopt == 'delivery_success') {
                        // Everything delivered, clear all the flags
                        $postopts = array_diff($postopts,Array('delivery_hardfail','delivery_pending'));
                } elseif ($postopt == 'delivery_pending') {
                        // Check for any failures
                        $r=q("select id from iconfig where iid = %d and cat = '%s' and v = '%s' limit 1",$iid,'delivery_status','delivery_hardfail');
                        if (!$r) {
                                // No remaining hard failures, so clear the delivery_hardfail flag.
                                $postopts = array_diff($postopts,Array('delivery_hardfail'));
                        }
                }

                $postopts = implode(',',array_unique($postopts));

                $r= q("update item set postopts = '%s' where id = %d",dbesc($postopts),$iid);
                
        }

        public static function prepare_body_hook(&$arr) {
                // @TODO: Create an interface that allows channel owners to ignore failures to certain recipients.
                // @TODO: Maybe make status box "dismissable".
                // @TODO: Templatize and make results translatable.
                if (!isset($arr['item']['uid']) || $arr['item']['uid'] != local_channel()) { return; }
                if ($arr['item']['author_xchan'] != get_observer_hash()) { return; }
                if (strpos($arr['item']['postopts'],'delivery_hardfail')) {
                       $status = "<div style='background-color:#ffa8a8'>Post undeliverable to some recipient channels.</div>"; 
                } elseif (strpos($arr['item']['postopts'],'delivery_pending')) { 
                       $status = "<div style='background-color:#ffdf40'>Still trying to send to some recipient channels.</div>"; 
                } else {
                       //$status = "<div style='background-color:#cfc'>Delivery completed.</div>"; 
                }

                $arr['html'] = $status.$arr['html'];
        }

}
