<?php

namespace Zotlabs\Widget;

class Catalogitem {

	function widget($args) {
		require_once('addon/cart/cart.php');

		if (! isset($args['sku']))
			return '';

		$nick = cart_getnick();
		if (! $nick)
			return '';

		$sku = preg_replace('/[^a-zA-Z0-9\-\_]/','',$args['sku']);
		$info = bbcode($args['info'], ['tryoembed' => false]);

		$id = '';
		$count = 0;
		$catalog_items = [];
		call_hooks('cart_get_catalog',$catalog_items);

		$catalog_item = [];
		if (isset($catalog_items[$sku]))
			$catalog_item = $catalog_items[$sku];

		if(! $catalog_item)
			return '';

		$orderhash = cart_getorderhash(false);

		if ($orderhash) {
			$order = cart_loadorder($orderhash);

			foreach ($order['items'] as $oitem) {
				if ($oitem['item_sku'] == $sku) {
					if ($id == '')
						$id = $oitem['id'];
					$count=$count+$oitem['item_qty'];
				}
			}
		}

		$templateinfo = ['name'=>'widget_catalogitem.tpl','path'=>'addon/cart/'];

		$template = get_markup_template($templateinfo['name'],$templateinfo['path']);

		$item = [
			'id'=> $id,
			'order_qty' => $count,
			'item_sku' => $catalog_item['item_sku'],
			'item_desc' => $catalog_item['item_desc'],
			'item_price' => $catalog_item['item_price'],
			'item_photo_url' => $catalog_item['item_photo_url'],
			'item_price_label' => t('Price'),
			'info' => (($info) ? $info : '')
		];

		$arr = [
			'$item'=>$item,
			'$posturl'=>'/cart/'.$nick.'/checkout'
		];

		if (isset($args['returnhere'])) {
			$arr['$returnurl'] = urlencode($_SERVER['REQUEST_URI']);
		}

		return replace_macros($template, $arr);
	}

}
