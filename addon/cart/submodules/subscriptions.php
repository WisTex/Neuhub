<?php
//require_once("/opt/hubzdev/appdir/addon/cart/cart.php");
/**
 * Name: subscriptions
 * Description: Submodule for the Hubzilla Cart system to track subscriptions.
 * Version: 0.2
 * MinCartVersion: 0.8
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 2.8
 */

use Zotlabs\Lib\Apps;

class Cart_subscriptions {

    public function __construct() {
      load_config("cart-subscriptions");
    }

    static public function load (){
      Zotlabs\Extend\Hook::register('cart_addon_settings', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::addon_settings',1);
      Zotlabs\Extend\Hook::register('cart_addon_settings_post', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::addon_settings_post',1);
      //Zotlabs\Extend\Hook::register('cart_myshop_menufilter', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::myshop_menuitems',1,1000);
      Zotlabs\Extend\Hook::register('cart_myshop_subscriptions', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::subscriptionadmin',1,1000);
      Zotlabs\Extend\Hook::register('cart_fulfill_subscription', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::item_fulfill',1,1000);
      Zotlabs\Extend\Hook::register('cart_cancel_subscription', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::rollback_subscriptions',1,1000);
      Zotlabs\Extend\Hook::register('cart_get_catalog', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::get_catalog',1,1000);
      //Zotlabs\Extend\Hook::register('cart_filter_catalog_display', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::filter_catalog_display',1,1000);
      Zotlabs\Extend\Hook::register('cart_post_subscriptions_itemedit', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::itemedit_post',1,1000);
      //Zotlabs\Extend\Hook::register('cart_post_subscriptions_itemactivation', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::itemedit_activation_post',1,1000);
      //Zotlabs\Extend\Hook::register('cart_post_subscriptions_itemdeactivation', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::itemedit_deactivation_post',1,1000);
      Zotlabs\Extend\Hook::register('cart_submodule_activation', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::module_activation',1,1000);
      Zotlabs\Extend\Hook::register('cart_submodule_deactivation', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::module_deactivation',1,1000);
      Zotlabs\Extend\Hook::register('cart_post_subscriptions', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::subedit_post',1,1000);
      Zotlabs\Extend\Hook::register('cart_dbcleanup', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::dbCleanup',1,1000);
      Zotlabs\Extend\Hook::register('cart_dbupgrade', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::dbUpgrade',1,1000);
      Zotlabs\Extend\Hook::register('itemedit_formextras', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::itemedit_formextras',1,1000);
      Zotlabs\Extend\Hook::register('cron', 'addon/cart/submodules/subscriptions.php', 'Cart_subscriptions::cron',1,107);
    }

    static public function unload () {
      Zotlabs\Extend\Hook::unregister_by_file('addon/cart/submodules/subscriptions.php');
    }

    static public function module_activation (&$hookdata) {
      cart_config_additemtype("subscription");
      logger("MODULE ACTIVATE: subscription",LOGGER_DEBUG);
    }

    static public function module_deactivation (&$hookdata) {
      //cart_config_delitemtype("subscription");
    }


    static public function dbCleanup (&$success) {
    	$dbverconfig = cart_getsysconfig("subscription-dbver");

    	$dbver = $dbverconfig ? intval($dbverconfig) : 0;

    	$dbsql[DBTYPE_MYSQL] = Array (
           1 => Array (
               "DROP TABLE IF EXISTS cart_subscriptions"
           )
        );
      $dbsql[DBTYPE_POSTGRES] = Array (
           1 => Array (
               "DROP TABLE IF EXISTS cart_subscriptions"
           )
        );
      $dbsql=$dbsql[ACTIVE_DBTYPE];

      $sql = $dbsql[$dbver];
      logger("DBVER: ".$dbver,LOGGER_DEBUG);
      if (!is_array($sql)) { return; }
    	foreach ($sql as $query) {
    		$r = q($query);
    		if (!$r) {
    			logger ('[cart] Error running dbCleanup. sql query: '.$query,LOGGER_NORMAL);
          $success=UPDATE_FAILED;
    		}
    	}
    	cart_delsysconfig("subscription-dbver");

      return;
    }

    static public function dbUpgrade (&$success) {
    	$dbverconfig = cart_getsysconfig("subscription-dbver");
    	logger ('[cart-subscription] Current dbver:'.$dbverconfig,LOGGER_NORMAL);

    	$dbver = $dbverconfig ? $dbverconfig : 0;

    	$dbsql[DBTYPE_MYSQL] = Array (
        1 => Array (
          "CREATE TABLE cart_subscriptions (
    				id int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    				master_order_hash varchar(191) NOT NULL,
            master_itemid int(10) UNSIGNED NOT NULL,
            sub_order_hash varchar(191) NOT NULL,
            sub_itemid int(10) UNSIGNED NOT NULL,
    				sub_expires datetime,
            sub_nexttrigger datetime,
    				sub_meta mediumtext
    				) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
            "
          )
    	);

    	$dbsql[DBTYPE_POSTGRES] = Array (
        1 => Array (
          "CREATE TABLE cart_subscriptions (
            id serial NOT NULL,
            master_order_hash varchar(255),
            master_itemid int,
            sub_order_hash varchar(255),
            sub_itemid int,
    				sub_expires timestamp,
            sub_nexttrigger timestamp,
    				sub_meta mediumtext,
            PRIMARY KEY (id)
          );"
          )
    	);

    	foreach ($dbsql[ACTIVE_DBTYPE] as $ver => $sql) {
    		if ($ver <= $dbver) {
    			continue;
    		}
    		foreach ($sql as $query) {
    	    logger ('[cart-subscription] dbSetup:'.$query,LOGGER_DATA);
    			$r = q($query);
    			if (!$r) {
    				logger ('[cart] Error running dbUpgrade. sql query: '.$query);
    				$success = UPDATE_FAILED;
    			}
    		}
    		cart_setsysconfig("subscription-dbver",$ver);
    	}
    }

    static public function addon_settings (&$sc) {
      $id = local_channel();
      if (! $id)
        return;

      if (! Apps::addon_app_installed($id, 'cart')) {
         return;
      }
      $enable_subscriptions = cart_getcartconfig ('subscriptions-enable');
      $sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'	=> array('enable_cart_subscriptions', t('Enable Subscription Management Module'),
                   (isset($enable_subscriptions) ? intval($enable_subscriptions) : 0),
                   '',array(t('No'),t('Yes')))));

    }

    static public function addon_settings_post () {
      if(!local_channel())
        return;

      if (! Apps::addon_app_installed(local_channel(), 'cart')) {
        return;
      }

      $prev_enable = cart_getcartconfig('subscriptions-enable');

      $enable_cart_subscriptions = isset($_POST['enable_cart_subscriptions']) ? intval($_POST['enable_cart_subscriptions']) : 0;
      cart_setcartconfig('subscriptions-enable', $enable_cart_subscriptions );

      Cart_subscriptions::unload();
      Cart_subscriptions::load();
    }

    static public function get_subinfo($sku) {
      logger("get_subinfo of: ".$sku,LOGGER_DEBUG);
      $configparam = "subs-".$sku;
      $subinfo = cart_getcartconfig($configparam);
      return $subinfo;
    }

    static public function set_subinfo($sku,$subinfo) {
      if ($sku == "") {return;}
      $subskus = cart_maybeunjson(cart_getcartconfig("subskus"));
      if (!is_array($subskus)) { $subskus = Array(); }
      if (!isset($subskus[$sku])) {
        $subskus[$sku]=$sku;
        cart_setcartconfig("subskus",cart_maybejson($subskus));
      }
      $json = cart_maybejson($subinfo);
      $configparam = "subs-".$sku;
      logger("subinfo (".$sku."): ".$json,LOGGER_DEBUG);
      cart_setcartconfig($configparam,$json);
    }

    static public function del_subinfo($sku) {
      $subskus = cart_maybeunjson(cart_getcartconfig("subskus"));
      if (!is_array($subskus)) { $subskus = Array(); }
      if (isset($subskus[$sku])) {
        unset($subskus[$sku]);
        cart_setcartconfig("subskus",cart_maybejson($subskus));
      }
      cart_delcartconfig($configparam);
    }

    static public function before_additem(&$hookdata)  {
      $item = $hookdata["item"];
      $ordermeta = $hookdata["order_meta"];
      $ordersub = isset($ordermeta["subinfo"]) ? $ordermeta["subinfo"] : Array ();

      $subinfo = Cart_subscriptions::get_subinfo($item["sku"]);

      if (!$subinfo) { return; }

      if (!isset($ordersub["term"])) {
        $hookdata["order_meta"]["subinfo"]["term"]=subinfo["term"];
        $hookdata["order_meta"]["subinfo"]["term"]=subinfo["termcount"];
        cart_updateorder_meta($hookdata["order_hash"],$hookdata["order_meta"]);
        return;
      }

      if (($ordersub["term"] != $subinfo["term"]) ||
          ($ordersub["termcount"] != $subinfo["termcount"])) {
            $hookdata["error"]=t("Cannot include subscription items with different terms in the same order.");
            unset($hookdata["item"]);
      }
    }

    static public function get_mysqlinterval($subinfo) {
       $interval = $subinfo["interval"]." ".$subinfo["term"];
       return $interval;
    }

    static public function get_pgsqlinterval($subinfo) {
       $interval = $subinfo["interval"]." ".$subinfo["term"];
       return $interval;
    }

    static public function rollback_subscriptions(&$orderitem) {
      $subinfo = Cart_subscriptions::get_subinfo($orderitem["item"]["item_sku"]);
      if (!$subinfo) { return; }

      $subscriptionitem=$orderitem["item"];
      $subscriptionitem["item_sku"]=$subinfo["item_sku"];
      $catalog = cart_get_catalog(false);
      $subscriptionitem["item_type"]=$catalog[$subinfo["item_sku"]]["item_type"];
      $subscriptionitem["proxy_item"]=1;
      cart_do_cancelitem ($subscriptionitem);
      $master_order = $orderitem["item"]["order_hash"];
      $master_itemid = $orderitem["item"]["id"];

      $r = q("update cart_subscriptions set sub_expires=null, sub_nexttrigger=null
                    where master_itemid=%d;",$master_itemid);

      if (!$r) {
        $orderitem["error"] = cart_add_error($orderitem["error"],"Subscription cancellation not registered.");
        logger("Subscription cancellation not recorded",LOGGER_DEBUG);
      }
    }

    static public function item_fulfill(&$orderitem) {
      $subinfo = Cart_subscriptions::get_subinfo($orderitem["item"]["item_sku"]);
      if (!$subinfo) { return; }

      $subscriptionitem=$orderitem["item"];
      $subscriptionitem["item_sku"]=$subinfo["item_sku"];
      $catalog = cart_get_catalog(false);
      $subscriptionitem["item_type"]=$catalog[$subinfo["item_sku"]]["item_type"];
      cart_do_fulfillitem ($subscriptionitem);

      $master_order = $orderitem["item"]["order_hash"];
      $master_itemid = $orderitem["item"]["id"];

      if (isset($orderitem["item"]["item_meta"]["subscription"])) {
        $master_order = $orderitem["item"]["item_meta"]["subscription"]["master_order"];
        $master_itemid = $orderitem["item"]["item_meta"]["subscription"]["master_itemid"];

        $r = q("select * from cart_subscriptions where master_order_hash = '%s'
                    and master_itemid = %d order by id desc limit 1;",
                    $master_order,$master_itemid
                  );
      } else {
         $r = null;
      }

      if (!$r || $r[0]["sub_expires"] == null) {  // FIRST order in subscription.
        $interval=Cart_subscriptions::get_mysqlinterval($subinfo);
        $r = q("insert into cart_subscriptions
                      (master_order_hash,master_itemid,sub_order_hash,
                          sub_itemid,sub_expires) values
                      ('%s',%s,'%s',%s,NOW() + interval %s);
                          ",dbesc($orderitem["item"]["order_hash"]),
                            intval($orderitem["item"]["id"]),
                            dbesc($orderitem["item"]["order_hash"]),
                            intval($orderitem["item"]["id"]),
                            dbesc($interval));
      } else { // Subscription is being extended
        $current_subscription = $r[0];
        $prev_expires=$current_subscription["sub_expires"];
        $interval=Cart_subscriptions::get_mysqlinterval($subinfo);
        $r = q("update cart_subscriptions set sub_expires=null, sub_nexttrigger=null
                      where id=%d;",$current_subscription["id"]);
        if (!$r) {
            logger("[cart-subscription] WARNING: Could not remove subscription timestamps on subscription id ("
                         .$current_subscription["id"].")",LOGGER_NORMAL);
        }
        $r = q("insert into cart_subscriptions
                  (master_order_hash,master_itemid,sub_order_hash,
                      sub_itemid,sub_expires) values
                  ('%s',%d,'%s',%d,'%s' + interval %s);
                      ",dbesc($master_order),intval($master_itemid),
                        dbesc($orderitem["item"]["order_hash"]),
                        intval($orderitem["item"]["id"]),
                        dbesc($current_subscription['sub_expires']),
                        dbesc($interval));
      }

      if (!$r) {
        $orderitem["error"] = cart_add_error($orderitem["error"],"Subscription could not be added/extended.");
        logger("Subscription could not be extended",LOGGER_DEBUG);
      }
      $itemmeta=$orderitem["item"]["item_meta"];
      $itemmeta["subscription"]=Array("master_order"=>$master_order,"master_itemid"=>$master_itemid,"subinfo"=>$subinfo);
      $newitem=$orderitem;
      $newitem["item"]["item_meta"]=$itemmeta;
      $orderitem=$newitem;
      cart_updateitem_meta($master_itemid,$itemmeta,$master_order);
    }

	static public function get_catalog(&$catalog) {
		// 		"sku-1"=>Array("item_sku"=>"sku-1","item_desc"=>"Description Item 1","item_price"=>5.55),
		$subskus = cart_maybeunjson(cart_getcartconfig("subskus"));
		if(is_array($subskus)) {
			foreach ($subskus as $subsku) {
				$subinfo = Cart_subscriptions::get_subinfo($subsku);
				$active = isset($subinfo["item_active"]) ? $subinfo["item_active"] : false;
				if ($active) {
					$catalog[$subsku] = Array("item_sku"=>$subsku,
						"item_desc"=>$subinfo["item_description"],
						"item_price"=>$subinfo["item_price"],
						"item_type"=>"subscription"
					);
				}
			}
		}
	}

	static public function itemedit_formextras(&$pagecontent) {
		$sku = isset($_REQUEST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_REQUEST["SKU"]) : null;
		$formelements = "";

		$subskus = cart_maybeunjson(cart_getcartconfig("subskus"));
		$subscriptions = Array("new"=>"New");

		if(is_array($subskus)) {
			foreach ($subskus as $subsku) {
				$subinfo=Cart_subscriptions::get_subinfo($subsku);
				if ($subinfo["item_sku"] == $sku) {
					$subscriptions[$subsku] = $subinfo["item_description"]."(".$subinfo["interval"]." ".$subinfo["term"].")";
					$subscriptions[$subsku] .= " (cost: ".$subinfo["item_price"].")";
					if ($subinfo["item_active"]) {
						$subscriptions[$subsku] .= " (active)";
					} else {
						$subscriptions[$subsku] .= " (inactive)";
					}
				}
			}
		}

		$formelements .= replace_macros(get_markup_template('field_select.tpl'), array(
			"field" => Array (
				"SKU",
				t('Select Subscription to Edit'),
				"new",
				"",
				$subscriptions
			)
		));
		$uri=strtok($_SERVER["REQUEST_URI"],'?').'?SKU='.urlencode($sku);

		$macrosubstitutes=Array("security_token"=>get_form_security_token(),"sku"=>$sku,"formelements"=>$formelements,"submit"=>t("Edit Subscriptions"),"uri"=>$uri);
		$pagecontent.=replace_macros(get_markup_template('subscription.itemedit_formextras.tpl','addon/cart/submodules/'), $macrosubstitutes);
	}

    static public function subscriptionadmin(&$pagecontent) {

      $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);
      if (!$is_seller) {
        return;
      }
      /*have SKU - display edit*/
      $sku = preg_replace("[^a-zA-Z0-9\-]",'',$_REQUEST["SKU"]);
      if (!$sku) {$sku = "new";}
      if ($sku) {
        $pagecontent.=Cart_subscriptions::subscriptionadmin_form($sku);
        return;
      }
    }

    static public function subscriptionadmin_form($sku) {
      logger("subadmin_form: $sku",LOGGER_DEBUG);
      $formelements=[];
      $subinfo = Cart_subscriptions::get_subinfo($sku);
      $itemsku = isset($subinfo["item_sku"]) ? $subinfo["item_sku"] : null;
      $session_itemsku = isset($_SESSION["sub_item_sku"]) ? $_SESSION["sub_item_sku"] : null;
      $itemsku = $itemsku ? $itemsku : $session_itemsku;
      if (!$itemsku) {
        notice("Invalid Request: unknown item (".$itemsku.")".EOL);
        return;
      }
        $formelements["submit"]=t("Submit");
        $formelements["uri"]=strtok($_SERVER["REQUEST_URI"],'?').'?SKU='.urlencode($sku);
      if ($sku=="new") {
        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_input.tpl'), array(
                  '$field'	=> array('SKU', t('Subscription SKU'),
                  "")));
      } else {
        $formelements["itemdetails"] .= "<input type='hidden' name='SKU' value='".$sku."'>";
        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_input.tpl'), array(
                  '$field'	=> array('item_description', t('Catalog Description'),
                  (isset($subinfo["item_description"]) ? $subinfo["item_description"] : "New Subscription"))));

        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
     				     '$field'	=> array('item_active', t('Subscription available for purchase.'),
  							 $subinfo["item_active"],
  							 '',array(t('No'),t('Yes')))));

        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_input.tpl'), array(
        				     '$field'	=> array('maxsubscriptions', t('Maximum active subscriptions to this item per account.'),
       							 (isset($subinfo["item_maxsubscriptions"]) ? intval($subinfo["item_maxsubscriptions"]) : 1))));
        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_input.tpl'), array(
        				     '$field'	=> array('item_price', t('Subscription price.'),
       							 (isset($subinfo["item_price"]) ? floatval($subinfo["item_price"]) : ""))));

        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_input.tpl'), array(
                  '$field'	=> array('subscription_interval', t('Quantity'),
                  (isset($subinfo["interval"]) ? intval($subinfo["interval"]) : 1))));

        $formelements["itemdetails"] .= replace_macros(get_markup_template('field_select.tpl'), array(
          "field" => Array ("subscription_term", t('Term'),
          isset($subinfo["term"]) ? $subinfo ["term"] : "month", "",
          Array("minute"=>"Minutes","hour"=>"Hours","day"=>"Days","week"=>"Weeks",
                            "month"=>"Months","year"=>"Years")
          )));
      }
      $macrosubstitutes=Array("security_token"=>get_form_security_token(),"itemsku"=>$itemsku,"sku"=>$sku,"formelements"=>$formelements);
      return replace_macros(get_markup_template('subscription.itemedit.tpl','addon/cart/submodules/'), $macrosubstitutes);
    }

    static public function subedit_post() {
      if (!check_form_security_token()) {
    		notice (check_form_security_std_err_msg());
    		return;
    	}
      $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);
      if (!$is_seller) {
        notice ("Access Denied.".EOL);
        return;
      }

      $item_sku = isset($_POST["item_sku"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["item_sku"]) : null;

      $catalog=cart_get_catalog(false);
      if (isset($catalog[$item_sku]) && $catalog[$item_sku]["item_type"] == "subscription") {
          unset($catalog[$item_sku]);
      }

      $sku = isset($_POST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["SKU"]) : 'new';

      if($sku=='new' && !isset($catalog[$item_sku])) {
        notice ("Invalid Request: Unable to create subscriptions for sku: $item_sku [".$catalog[$item_sku]["item_type"]."]".EOL);
        goaway(z_root() . '/cart/' . argv(1) . '/myshop');
      }

      if ($sku=='new') {
        $_SESSION["sub_item_sku"] = $item_sku;
        goaway(z_root() . '/cart/' . argv(1) . '/myshop/subscriptions?SKU='.urlencode($sku));
      }

      $subinfo = Cart_subscriptions::get_subinfo($sku);
      if (!is_array($subinfo)) {
        $subinfo = Array();
      }

      if (isset($_POST["item_active"]) && $_POST["item_active"]==1) {
        $subinfo["item_active"]=1;
      } else {
        $subinfo["item_active"]=isset($_POST["item_description"]) ? false : $subinfo["item_active"];
      }

      $subinfo["item_sku"] = $item_sku;

      if ($_POST["item_description"]) {
        $description = isset($_POST["item_description"]) ?
                   preg_replace("[^a-zA-Z0-9\-\ ]",'',$_POST["item_description"]) :
                   'New Subscription';
        $subinfo["item_description"] = $description;
      }

      $term = isset($_POST["subscription_term"]) ?
                   preg_replace("[^a-zA-Z0-9\-]",'',$_POST["subscription_term"]) :
                   null;
      if (!in_array($term,Array("minute","hour","day","week","month","year"))) {
          $term=null;
      }
      $subinfo["item_maxsubscriptions"]=isset($_POST["maxsubscriptions"]) ? intval($_POST["maxsubscriptions"]) : $subinfo["item_maxsubscriptions"];
      $subinfo["item_price"]=isset($_POST["item_price"]) ? floatval($_POST["item_price"]) : $subinfo["item_price"];
      $interval = intval($_POST["subscription_interval"]);

      if ($term && $interval) {
        $subinfo["term"]=$term;
        $subinfo["interval"]=$interval;
      } else {
        $subinfo["subscription_enable"]=false;
      }
      if ($sku != "new") {
        Cart_subscriptions::set_subinfo($sku,$subinfo);
      }

        // @TODO: ACTIONS: Before expire, On expire, After expire
      goaway(z_root() . '/cart/' . argv(1) . '/myshop/subscriptions?SKU='.urlencode($sku));
    }

    static public function cron () {
      require_once (dirname(__FILE__)."/../cart.php");
      $r = q("select * from cart_subscriptions where sub_expires is not null
                        and sub_expires < NOW();"
                  );
      if (!$r) { return; }

      foreach ($r as $subscription) {

        $v = q("select * from cart_subscriptions where sub_expires > NOW() AND
                    master_itemid = %d",$subscription["master_itemid"]);

        if (!$v) { //Don't cancel items with active subscriptions
          $s = q("select * from cart_orderitems where id=%d",$subscription["master_itemid"]);
          if (!$s) { continue; }
          $cancelsub = $s[0];
          cart_do_cancelitem($s[0]);
          cart_item_note("Subscription Cancelled",$s["id"],$s["order_hash"]);
          logger("Cancel sub",LOGGER_DEBUG);
        }

        $t = q("update cart_subscriptions set sub_expires=null where master_itemid = %d and
                              sub_expires < NOW()",
                       $subscription["master_itemid"]);
      }
    }
}
