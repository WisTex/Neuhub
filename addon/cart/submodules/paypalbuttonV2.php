<?php
/**
 * Name: paypalbutton
 * Description: Submodule to add a paypal payment button
 * Version: 0.3
 * MinCartVersion: 0.8
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 2.8
 */

use Zotlabs\Lib\Apps;

class Cart_paypalbuttonV2 {

    public $bearertoken;

    static function http_parse_headers($raw_headers) {
      $headers = array();
     $key = '';

      foreach(explode("\n", $raw_headers) as $i => $h) {
        $h = explode(':', $h, 2);

        if (isset($h[1])) {
            if (!isset($headers[$h[0]]))
                $headers[$h[0]] = trim($h[1]);
            elseif (is_array($headers[$h[0]])) {
                $headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])));
            }
            else {
                $headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])));
            }

            $key = $h[0];
        }
        else {
            if (substr($h[0], 0, 1) == "\t")
                $headers[$key] .= "\r\n\t".trim($h[0]);
            elseif (!$key)
                $headers[0] = trim($h[0]);
        }
      }
    return $headers;
    }


    public function __construct() {
      //load_config("cart");
    }

    static public function load (){
      Zotlabs\Extend\Hook::register('cart_addon_settings', 'addon/cart/submodules/paypalbuttonV2.php', 'Cart_paypalbuttonV2::addon_settings',1);
      Zotlabs\Extend\Hook::register('cart_addon_settings_post', 'addon/cart/submodules/paypalbuttonV2.php', 'Cart_paypalbuttonV2::addon_settings_post',1);
      Zotlabs\Extend\Hook::register('cart_paymentopts','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::register');
      Zotlabs\Extend\Hook::register('cart_checkout_paypalbutton','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::checkout');
      Zotlabs\Extend\Hook::register('cart_post_paypalbutton_checkout_confirm','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::checkout_confirm');
      Zotlabs\Extend\Hook::register('cart_post_paypalbutton_checkout_cancel','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::checkout_cancel');
      Zotlabs\Extend\Hook::register('cart_post_custom_paypal_buttonhook','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::buttonhook');
      Zotlabs\Extend\Hook::register('cart_post_custom_paypal_buttonhook_create','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::buttonhook_create');
      Zotlabs\Extend\Hook::register('cart_post_custom_paypal_buttonhook_execute','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::buttonhook_execute');
      Zotlabs\Extend\Hook::register('cart_paymentopts','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::register');
      Zotlabs\Extend\Hook::register('cart_addons_myshop_order_display','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::admin_payment_display');
      Zotlabs\Extend\Hook::register('cart_currency_filter','addon/cart/submodules/paypalbuttonV2.php','Cart_paypalbuttonV2::currency_filter');

      //notice('Loaded submodule: paypalbutton'.EOL);
    }

    static public function unload () {
      Zotlabs\Extend\Hook::unregister_by_file('addon/cart/submodules/paypalbutton.php');
      Zotlabs\Extend\Hook::unregister_by_file('addon/cart/submodules/paypalbuttonV2.php');
      //notice('UNLoaded submodule: paypalbutton'.EOL);

    }

    static public function addon_settings (&$sc) {
      $id = local_channel();
      if (! $id)
        return;

      if (! Apps::addon_app_installed($id, 'cart')) {
         return;
      }

      $enable_paypalbutton = get_pconfig ($id,'cart','paypalbutton_v2_enable');
      $sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'       => array('enable_cart_paypalbutton_v2', t('Enable Paypal Button Module (API-v2)'),
                   (isset($enable_paypalbutton) ? $enable_paypalbutton : 0),
                   '',array(t('No'),t('Yes')))));

      if (!$enable_paypalbutton) { return; }

      $paypalbutton_production = get_pconfig ($id,'cart','paypalbutton_production');
      $sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'       => array('paypalbutton_production', t('Use Production Key'),
                   (isset($paypalbutton_production) ? $paypalbutton_production : 0),
                   '',array(t('No'),t('Yes')))));


      $paypalbutton_sandboxclient = get_pconfig ($id,'cart','paypalbutton_sandboxclient');
      $sc .= replace_macros(get_markup_template('field_input.tpl'),array(
                   '$field'     => array ('paypalbutton_sandboxclient', t('Paypal Sandbox Client Key'),
                   (isset($paypalbutton_sandboxclient) ? "$paypalbutton_sandboxclient" : ''),
                   '',''
                   )));

      $paypalbutton_sandboxsecret = get_pconfig ($id,'cart','paypalbutton_sandboxsecret');
      $sc .= replace_macros(get_markup_template('field_input.tpl'),array(
                   '$field'     => array ('paypalbutton_sandboxsecret', t('Paypal Sandbox Secret Key'),
                   (isset($paypalbutton_sandboxsecret) ? $paypalbutton_sandboxsecret : ''),
                   '',''
                   )));
      $paypalbutton_productionclient = get_pconfig ($id,'cart','paypalbutton_productionclient');
      $sc .= replace_macros(get_markup_template('field_input.tpl'),array(
                   '$field'     => array ('paypalbutton_productionclient', t('Paypal Production Client Key'),
                   (isset($paypalbutton_productionclient) ? "$paypalbutton_productionclient" : ''),
                   '',''
                   )));

      $paypalbutton_productionsecret = get_pconfig ($id,'cart','paypalbutton_productionsecret');
      $sc .= replace_macros(get_markup_template('field_input.tpl'),array(
                   '$field'     => array ('paypalbutton_productionsecret', t('Paypal Production Secret Key'),
                   (isset($paypalbutton_productionsecret) ? $paypalbutton_productionsecret : ''),
                   '',''
                   )));
    }


    static public function addon_settings_post () {
      if(!local_channel())
        return;

      $prev_enable = get_pconfig(local_channel(),'cart','paypalbutton_v2_enable');

      if (!$prev_enable && (!Apps::addon_app_installed(local_channel(), 'cart') || !isset($_POST['enable_cart_paypalbutton_v2']))) {
        return;
      }


      $enable_cart_paypalbutton = isset($_POST['enable_cart_paypalbutton_v2']) ? intval($_POST['enable_cart_paypalbutton_v2']) : 0;
      set_pconfig( local_channel(), 'cart', 'paypalbutton_v2_enable', $enable_cart_paypalbutton );

      if (!$prev_enable) { return; }

      $sandbox_client = isset($_POST['paypalbutton_sandboxclient']) ? $_POST['paypalbutton_sandboxclient'] : '';
      set_pconfig( local_channel(), 'cart', 'paypalbutton_sandboxclient', $sandbox_client);
      $sandbox_secret = isset($_POST['paypalbutton_sandboxsecret']) ? $_POST['paypalbutton_sandboxsecret'] : '';
      set_pconfig( local_channel(), 'cart', 'paypalbutton_sandboxsecret', $sandbox_secret);
      $production_client = isset($_POST['paypalbutton_productionclient']) ? $_POST['paypalbutton_productionclient'] : '';
      set_pconfig( local_channel(), 'cart', 'paypalbutton_productionclient', $production_client);
      $production_secret = isset($_POST['paypalbutton_productionsecret']) ? $_POST['paypalbutton_productionsecret'] : '';
      set_pconfig( local_channel(), 'cart', 'paypalbutton_productionsecret', $production_secret);
      $paypalbutton_production = isset($_POST['paypalbutton_production']) ? intval($_POST['paypalbutton_production']) : 0;
      set_pconfig( local_channel(), 'cart', 'paypalbutton_production', $paypalbutton_production);

/*
  @TODO: Add paypal specific config $options
*/
      Cart_paypalbuttonV2::unload();
      Cart_paypalbuttonV2::load();
    }

	static public function paypal_getbearer($credentials) {

		$token = 'paypalbutton_sandbox_bearertoken';
		if ($credentials['url'] == 'https://api.paypal.com')
			$token = 'paypalbutton_bearertoken';

		$bearer = get_pconfig(\App::$profile['profile_uid'], 'cart', $token);
		$bearer = isset($bearer) ? cart_maybeunjson($bearer) : false;

		if (isset($bearer['expires']) && time() < $bearer['expires']) {
			return $bearer['access_token'];
		}

		del_pconfig(\App::$profile['profile_uid'], 'cart', $token);

		$data = 'grant_type=client_credentials';
		$ppresponse = Cart_paypalbuttonV2::paypal_post($data, $credentials, '/v1/oauth2/token', 'application/x-www-form-urlencoded');
		$bearer = cart_maybeunjson($ppresponse['data']);
		$bearer['expires'] = time() + $bearer['expires_in'];

		set_pconfig(\App::$profile['profile_uid'], 'cart', $token, cart_maybejson($bearer));

		return $bearer['access_token'];

	}

    static public function paypal_getcredentials() {
      $id=\App::$profile['profile_uid'];
      $enabled = get_pconfig(\App::$profile['profile_uid'],'cart','paypalbutton_v2_enable');
      $enabled = isset($enabled) ? $enabled : false;

      $paypal_production = get_pconfig ($id,'cart','paypalbutton_production');
      $paypal_production = (isset($paypal_production) && $paypal_production == 1) ? true : false;
      $paypal_apiurl = "https://api.sandbox.paypal.com";
      $paypal_apiurl = $paypal_production ? "https://api.paypal.com" : "https://api.sandbox.paypal.com";
      $paypal_clientkey = $paypal_production ? 'paypalbutton_productionclient' : 'paypalbutton_sandboxclient';
      $paypal_secretkey = $paypal_production ? 'paypalbutton_productionsecret' : 'paypalbutton_sandboxsecret';

      $client = get_pconfig($id,'cart',$paypal_clientkey);
      $secret = get_pconfig($id,'cart',$paypal_secretkey);

      $credentials=Array("url"=>$paypal_apiurl,"client"=>$client,"secret"=>$secret);
      $credentials["bearer"]=Cart_paypalbuttonV2::paypal_getbearer($credentials);

      return $credentials;
    }

    static public function paypal_post($data_array,$credentials=null,$endpoint=null,$contenttype="application/json",$headers=[]) {

      if (!$credentials) {
        $credentials=Cart_paypalbuttonV2::paypal_getcredentials();
      }
      $paypal_apiurl=$credentials["url"].$endpoint;
      $data=$data_array;
      $curl = curl_init($paypal_apiurl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_HEADER, true);

      $headerarray=array(
                  'Accept: application/json',
                  'Content-Type: '.$contenttype,
                  'Accept_Language: en_US',
                  'Content-Length: '.strlen($data));
      if (!isset($credentials["bearer"])) {
          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt($curl, CURLOPT_USERPWD, $credentials["client"].":".$credentials["secret"]);
      } else {
        $headerarray[]='Authorization: Bearer '.$credentials["bearer"];
      }
	foreach ($headers as $h=>$val) {
		$headerarray[] = $h.': '.$val;
	}

      curl_setopt($curl, CURLOPT_HTTPHEADER, $headerarray);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLINFO_HEADER_OUT, true);
      $result=curl_exec($curl);
      $header_len = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
      $responsecode = curl_getinfo($curl,CURLINFO_RESPONSE_CODE);
      $headers = Cart_paypalbuttonV2::http_parse_headers(substr ($result, 0, $header_len));
      $ppdata = substr ($result, $header_len);
      $ppdata = cart_maybeunjson($ppdata);

      if ($responsecode >= 200 && $responsecode <= 300) {
        $success=true;
      } else {
        $success=false;
      }
      return Array('success'=>$success,'response'=>$responsecode,'data'=>$ppdata,'headers'=>$headers);
    }


    static public function check_enabled() {

      $id = \App::$profile['profile_uid'];
      $enabled = get_pconfig(\App::$profile['profile_uid'],'cart','paypalbutton_v2_enable');
      $enabled = isset($enabled) ? $enabled : false;

      if (!$enabled) {
        notice (t('Paypal button payments are not enabled.') . EOL );
        goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
      }

      $paypal_production = get_pconfig ($id,'cart','paypalbutton_production');
      $paypal_production = (isset($paypal_production) && $paypal_production == 1) ? true : false;
      $paypal_apiurl = "https://api.sandbox.paypal.com";
      $paypal_apiurl = $paypal_production ? "https://api.paypal.com" : "https://api.sandbox.paypal.com";
      $paypal_clientkey = $paypal_production ? 'paypalbutton_productionclient' : 'paypalbutton_sandboxclient';
      $paypal_secretkey = $paypal_production ? 'paypalbutton_productionsecret' : 'paypalbutton_sandboxsecret';
      $paypal_environment = $paypal_production ? 'production' : 'sandbox';

      $client = get_pconfig($id,'cart',$paypal_clientkey);
      $secret = get_pconfig($id,'cart',$paypal_secretkey);

      $configured = false;

      if (!(strlen($client)>10) || !(strlen($secret)>10)) {
        notice (t('Paypal button payments are not properly configured.  Please choose another payment option.') . EOL );
        goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
      }

      return $paypal_environment;

    }

    static function checkout (&$hookdata) {
      $paypal_environment=Cart_paypalbuttonV2::check_enabled();
      $page_uid = ((App::$profile_uid) ? App::$profile_uid : local_channel());
      $paypal_currency=get_pconfig($page_uid,'cart','cart_currency');
      $orderhash = cart_getorderhash(false);
      $nick = argv(1);
      $ppbutton_payopts = get_pconfig($page_uid,'cart','paypalbutton_payopts');
      $ppbutton_payopts["order_hash"]=$orderhash;
      $order = cart_loadorder($orderhash);
      call_hooks('cart_calc_totals',$order);
      $order["payopts"]=$ppbutton_payopts;
      $order["buttonhook"]= z_root() . '/cart/' . $nick . '/custom/paypal_buttonhook';
      $order["finishedurl"]= z_root() . '/cart/' . $nick . '/order/'.$order["order_hash"];
      $order["links"]["checkoutlink"]= z_root() . '/cart/' . $nick . '/checkout/start?cart='.$order["order_hash"];
      $order["paypalenv"]=$paypal_environment;
      $order["currency"]=$paypal_currency;

      $paypal_credentials = self::paypal_getcredentials();

      $order["paypal_clientid"]=$paypal_credentials['client'];

      Zotlabs\Extend\Hook::insert('content_security_policy', 'Cart_paypalbuttonV2::paypal_CSP',1);
      $template = get_markup_template('basic_checkout_ppbutton-apiv2.tpl','addon/cart/submodules/');
      call_hooks("cart_display_before",$order);
      $display = replace_macros($template, $order);

      $hookdata["checkoutdisplay"] = $display;

      //TODO: Currency Selection in Plugin Settings

    }

    static function paypal_CSP(&$hookdata) {
      //$hookdata["script-src"][]="www.paypalobjects.com";
	$newhd = $hookdata;
      $newhd["script-src"][]="www.paypal.com";
      $newhd["frame-src"][]="www.paypal.com";
      $newhd["script-src"][]="www.sandbox.paypal.com";
      $newhd["frame-src"][]="www.sandbox.paypal.com";
	$hookdata = $newhd;
    }

    static function buttonhook_execute(&$hookdata){

      $orderhash = cart_getorderhash(false);

    	if (!$orderhash) {
                http_response_code(500);
                exit;
    	}

    	$order = cart_loadorder($orderhash);

      call_hooks('cart_calc_totals',$order);

      $page_uid = ((App::$profile_uid) ? App::$profile_uid : local_channel());

	$payment["body"]=[];

	$payment["headers"] = [
		'Paypal-Request-Id' => $orderhash.'-capture',
		'Prefer' => 'return=representation'
	];
      $paymenturl="/v2/checkout/orders/".$_POST["paymentID"]."/capture";
      $paymentresponse=Cart_paypalbuttonV2::paypal_post(cart_maybejson($payment["body"]),null,$paymenturl,"application/json",$payment["headers"]);
      logger("[cart-ppbutton] PAYMENT EXECUTE: ".json_encode($payment,JSON_PRETTY_PRINT),LOGGER_DATA);
      $ordermeta = cart_getorder_meta($orderhash);
      $timestamp = time();
      $ordermeta["paypal_button_history"][$timestamp]["resquest"]=$payment;
      $ordermeta["paypal_button_history"][$timestamp]["response"]=$paymentresponse;
      $ordermeta["paypal_button"]["mostrecent"]=$timestamp;
      cart_updateorder_meta ($ordermeta,$orderhash);
      logger("[cart-ppbutton] PAYMENT RESULTS: ".json_encode($paymentresponse,JSON_PRETTY_PRINT),LOGGER_DATA);
      if ($paymentresponse["data"]["status"]=="COMPLETED") {
        logger("[cart-ppbutton] PAYMENT SUCCESS!",LOGGER_DEBUG);
    	cart_do_checkout ($order);
        cart_do_checkout_after ($order);
        $hookinfo=Array("order"=>$order);
        cart_do_orderpaid ($hookinfo);
        Cart_paypalbuttonV2::fulfill_order ($order);

        header("Content-Type: application/json");
        header("Cache-Control: no-store");
        echo json_encode($paymentresponse["data"]);
      } else {
        http_response_code(500);
      }
      exit;
    }

    static function fulfill_order(&$hookdata) {
      $orderhash=$hookdata["order_hash"];
      logger("[cart-ppbutton] - FULFILLORDER: ".print_r($orderhash,true),LOGGER_DATA);
      foreach ($hookdata["items"] as $item) {
        logger("[cart-ppbutton] - Fulfill: ".print_r($item,true),LOGGER_DATA);
        if (!$item["item_fulfilled"]) {
          $itemtofulfill=Array('order_hash'=>$orderhash,'id'=>$item["id"]);
          logger("[cart-ppbutton] FULFILL ITEM: ".print_r($itemtofulfill,true),LOGGER_DATA);
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

    static function buttonhook_create(&$hookdata){

      header("Content-Type: application/json");
      header("Cache-Control: no-store");

      $orderhash = cart_getorderhash(false);
      logger("PAYPAL CREATE PAYMENT FOR: ".$orderhash,LOGGER_DEBUG);

    	if (!$orderhash) {
    		notice (t('Order not found.') . EOL );
    		goaway(z_root() . '/cart/' . argv(1) . '/order');
    	}

    	$order = cart_loadorder($orderhash);

      cart_do_checkout_before($order);

      call_hooks('cart_calc_totals',$order);
      $page_uid = ((App::$profile_uid) ? App::$profile_uid : local_channel());
      $paypal_currency=get_pconfig($page_uid,'cart','cart_currency');
      $payment["body"]=Array (
        'intent'=>"CAPTURE",
        //'payer' => Array('payment_method'=>['payee_preferred'=>'IMMEDIATE_PAYMENT_REQUIRED']),
        'purchase_units' => [
          [ //'invoice_id' => $orderhash,
	    'amount'=>
            [ 
		'currency_code'=>$paypal_currency,
		'value'=>$order["totals"]["OrderTotal"]
            ]
            ]
          ],
	  'application_context'=> [
		'user_action'=>'PAY_NOW',
            	"return_url"=>z_root() . '/cart/' . argv(1) . '/order/'.$orderhash,
          	"cancel_url"=>z_root() . '/cart/' . argv(1) . '/checkout/start'
	  ]
      );

      $paymentresponse=Cart_paypalbuttonV2::paypal_post(cart_maybejson($payment["body"]),null,'/v2/checkout/orders');

      $ordermeta = cart_getorder_meta($orderhash);
      $timestamp = time();
      $ordermeta["paypal_button_history"][$timestamp]["resquest"]=$payment;
      $ordermeta["paypal_button_history"][$timestamp]["response"]=$paymentresponse;
      $ordermeta["paypal_button"]["mostrecent"]=$timestamp;

      cart_updateorder_meta ($ordermeta,$orderhash);
      logger("PAYPAL CREATE: Request: ".json_encode($payment['body'],JSON_PRETTY_PRINT),LOGGER_DATA);
      logger("PAYPAL CREATE: Response: ".json_encode($paymentresponse,JSON_PRETTY_PRINT),LOGGER_DATA);
	$paymentresponse['data']['order_id']=$paymentresponse['data']['id'];
logger("RETURNING: ".json_encode($paymentresponse['data']),LOGGER_DATA);
      echo json_encode($paymentresponse['data']);
    }

    static function checkout_cancel(&$hookdata) {

    }

    static function checkout_complete (&$hookdata) {

      Cart_paypalbuttonV2::enabled();

    	$orderhash = cart_getorderhash(false);
      /*
        if ($_POST["orderhash"] != $orderhash) {
            notice (t('Error: order mismatch. Please try again.') . EOL );
            goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
      	}
      */
    }

    static function register (&$hookdata) {
      global $id;

            $nick = argv(1);
            $owner = channelx_by_nick($nick);
            if(! $owner) {
                    notice( t('Invalid channel') . EOL);
                    goaway('/' . argv(0));
            }

    	$enabled = get_pconfig(App::$profile['uid'],'cart','paypalbutton_v2_enable');
    	$enabled = isset($enabled) ? $enabled : false;
            //logger ("[cart] PAYPAL BUTTON ($nick , ".$id.") ? ".print_r($enabled,true),LOGGER_DEBUG);

    	if ($enabled) {
    		$hookdata["paypalbutton"]=Array('title'=>'PAYPAL','html'=>"<b>Pay with Paypal</b>");
    	}
        return;
    }

    static function get_paypaldata($button_history) {
       if (!is_array($button_history)) { return Array(); }
       $paypaldata=Array();
       foreach ($button_history as $timestamp=>$entry) {
          if (!isset($entry["response"])) { continue; }
          $entry = $entry["response"];
          if (isset($entry["data"]["id"])) {
            $id = $entry["data"]["id"];
            if (!isset($paypaldata[$id])) {
              $paypaldata[$id] = Array("id"=>$id);
            }

            $paypaldata[$id]["timestamp"]=date("Y-m-d h:i:sa T",intval($timestamp));
            $paypaldata[$id]["intent"]=isset($entry["data"]["intent"]) ? $entry["data"]["intent"] : null;
            $paypaldata[$id]["state"]=isset($entry["data"]["state"]) ? $entry["data"]["state"] : null;
            $paypaldata[$id]["payer"]=isset($entry["data"]["payer"]["payer_info"]["email"]) ? $entry["data"]["payer"]["payer_info"]["email"] : null;
            $paypaldata[$id]["amount"]=isset($entry["data"]["transactions"][0]["amount"]["total"]) ?
                                             $entry["data"]["transactions"][0]["amount"]["total"] : 0;
            $paypaldata[$id]["currency"]=isset($entry["data"]["transactions"][0]["amount"]["currency"]) ?
                                             $entry["data"]["transactions"][0]["amount"]["currency"] : 0;
            $paypaldata[$id]["transactions"]=isset($entry["data"]["transactions"]) ?
                                             $entry["data"]["transactions"] :
                                                Array();

          }
       }
       return $paypaldata;
    }

    static function admin_payment_display (&$hookdata) {
        $order=$hookdata["order"];
        $paypaldata = Cart_paypalbuttonV2::get_paypaldata($order["order_meta"]["paypal_button_history"]);
        $template = get_markup_template('ppbutton_txndetails.tpl','addon/cart/submodules/');
        $display = replace_macros($template, Array("transactions"=>$paypaldata));
        //$hookdata["content"].="<div><pre>".print_r($order["order_meta"]["paypal_button_history"],true)."</pre></div>";
        //$hookdata["content"].="<div><pre>".print_r($paypaldata,true)."</pre></div>";
        $hookdata["content"].=$display;

    }

    static function currency_filter(&$currencies) {
      $paypal_currencies = Array(
        "AUD","BRL","CAD","CZK","DKK","EUR","HKD","HUF","INR","ILS","JPY","MYR","MXN","NOK",
        "NZD","PHP","PLN","GBP","RUB","SGD","SEK","CHF","TWD","THB","USD"
      );
      foreach ($currencies as $c) {
        if (!in_array($c["code"],$paypal_currencies)) {
          unset($currencies[$c["code"]]);
        }
      }
    }
}

$cart_paypalbutton = new Cart_paypalbuttonV2();
