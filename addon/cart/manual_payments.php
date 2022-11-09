<?php
function cart_post_manual_checkout_confirm () {

	$orderhash = cart_getorderhash(false);

    if ($_POST["orderhash"] != $orderhash) {
        notice (t('Error: order mismatch. Please try again.') . EOL );
        goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
	}

	$order = cart_loadorder($orderhash);
	cart_do_checkout ($order);
	cart_do_checkout_after ($order);
	call_hooks("cart_calc_totals_filter",$order);

	if (intval($order["order_meta"]["totals"]["OrderTotal"]) == 0) {
	        cart_do_checkout ($order);
        	cart_do_checkout_after ($order);
        	$hookinfo=Array("order"=>$order);
        	cart_do_orderpaid ($hookinfo);
		cart_manual_fulfill_order ($order); //No auto fulfillment on manual payments.
	}

	goaway(z_root() . '/cart/' . argv(1) . '/order/' . $orderhash);
}

function cart_manual_fulfill_order(&$hookdata) {
      $orderhash=$hookdata["order_hash"];
      //logger("[cart-ppbutton] - FULFILLORDER: ".print_r($orderhash,true),LOGGER_DEBUG);
      foreach ($hookdata["items"] as $item) {
        //logger("[cart-ppbutton] - Fulfill: ".print_r($item,true),LOGGER_DATA);
        if (!$item["item_fulfilled"]) {
          $itemtofulfill=Array('order_hash'=>$orderhash,'id'=>$item["id"]);
          //logger("[cart-ppbutton] FULFILL ITEM: ".print_r($itemtofulfill,true),LOGGER_DATA);
          cart_do_fulfillitem ($itemtofulfill);
          if (isset($itemtofulfill["error"])) {
              $hookdata["errors"][]=$itemtofulfill["error"];
              $item_meta=cart_getitem_meta ($item["id"],$orderhash);
              $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Auto Fulfillment Error: ".$itemtofulfill["error"];
              cart_updateitem_meta($item["id"],$item_meta,$orderhash);
          }
        }
      }
      return;
    }


function cart_checkout_complete (&$hookdata) {


}
function cart_checkout_manual (&$hookdata) {

        $page_uid = ((App::$profile_uid) ? App::$profile_uid : local_channel());
	$nick = App::$profile['channel_address'];
	//$manualpayments = get_pconfig($page_uid,'cart','enable_manual_payments');
        $manualpayments = cart_getcartconfig("enable_manual_payments");
	$manualpayments = isset($manualpayments) ? $manualpayments : false;

	if (!$manualpayments) {
		notice (t('Manual payments are not enabled.') . EOL );
		goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
	}

	$orderhash = cart_getorderhash(false);

	if (!$orderhash) {
		notice (t('Order not found.') . EOL );
		goaway(z_root() . '/cart/' . argv(1) . '/order');
	}

	$order = cart_loadorder($orderhash);
	call_hooks('cart_calc_totals',$order);
	$manualpayopts = get_pconfig($page_uid,'cart','manual_payopts');
	$manualpayopts["order_hash"]=$orderhash;
	$order["payopts"]=$manualpayopts;
	$order["finishedtext"]=t("Finished");
	$order["finishedurl"]= z_root() . '/cart/' . $nick;
   	$order["links"]["checkoutlink"] = z_root() . '/cart/' . $nick . '/checkout/start?cart='.$order["order_hash"];
        $template = get_markup_template('basic_checkout_manual_confirm.tpl','addon/cart/');
        call_hooks("cart_display_before",$order);
	$display = replace_macros($template, $order);

	$hookdata["checkoutdisplay"] = $display;
}

function cart_paymentopts_register_manual (&$hookdata) {
  global $id;

        $nick = argv(1);
        $owner = channelx_by_nick($nick); 
        if(! $owner) {
                notice( t('Invalid channel') . EOL);
                goaway('/' . argv(0));
        }

	$manualpayments = get_pconfig(App::$profile['uid'],'cart','enable_manual_payments');
	$manualpayments = isset($manualpayments) ? $manualpayments : false;
	if ($manualpayments) {
		$hookdata["manual"]=Array('title'=>'Manual Payment','html'=>"<b>Pay by Check, Money Order, or other manual payment method</b>");
	}
    return;
}

function cart_manualpayments_unload () {

    Zotlabs\Extend\Hook::unregister_by_file('addon/cart/manual_payments.php');

    }

function cart_manualpayments_load () {

    Zotlabs\Extend\Hook::register('cart_paymentopts','addon/cart/manual_payments.php','cart_paymentopts_register_manual');
    Zotlabs\Extend\Hook::register('cart_checkout_manual','addon/cart/manual_payments.php','cart_checkout_manual');
    Zotlabs\Extend\Hook::register('cart_post_manual_checkout_confirm','addon/cart/manual_payments.php','cart_post_manual_checkout_confirm');

    }
