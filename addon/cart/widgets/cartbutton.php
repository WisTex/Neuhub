<?php

namespace Zotlabs\Widget;

class Cartbutton {

        //function widget_cartbutton ($args) {
	function widget ($args) {
		require_once('addon/cart/cart.php');
		$owner_uid = \App::$profile_uid;
		$nick = cart_getnick();
		if (!$nick) { return ''; }

		$orderhash = cart_getorderhash(false);
		if (!isset($args['sku'])) {
			return '';
		}
		$sku = preg_replace('/[^a-zA-Z0-9\-\_]/','',$args['sku']);
		$count=0;
		if ($orderhash) {
			$order = cart_loadorder($orderhash);

			$id='';
			foreach($order['items'] as $oitem) {
				if($oitem['item_sku'] == $sku) {
					if ($id == '') { $id = $oitem['id']; }
					$count=$count+$oitem['item_qty'];
				}
			}
		}

		$templateinfo = array('name'=>'basic_widgetbutton.tpl','path'=>'addon/cart/');
		call_hooks('cart_filter_widgetbutton_tpl',$templateinfo);
		$template = get_markup_template($templateinfo['name'],$templateinfo['path']);
		$item = Array('order_qty'=>$count, 'item_sku'=>$sku, 'id'=>$id);
		$arr = Array('$item'=>$item,'$posturl'=>'/cart/'.$nick.'/checkout');
		if ($args['returnhere']) {
			$arr['$returnurl'] = urlencode($_SERVER['REQUEST_URI']);
		}
		return replace_macros($template, $arr );
	}

}
//
