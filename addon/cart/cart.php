<?php

use Zotlabs\Lib\Apps;
use Zotlabs\Extend\Route;

/**
 * Name: cart
 * Description: Core cart utilities for orders and payments
 * Version: 1.0.0
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 3.6
 */

/* Architecture notes:
 *    The cart addon adds shopping cart, fulfillment
 *    and payment processing capabilities to Hubzilla in a modular
 *    manner.  Each component (cart, fulfillment, payment) can be
 *    extended by additional addons using HOOKS
 *
 */

 /* DEVNOTES
  *  App::$config['system']['addon'] contains a comma-separated list of names
         of plugins/addons which are used on this system.
  */


class Cart {
	public static $cart_version="1.0.0";
	public static $seller;
	public static $buyer;

	public static function check_min_version($platform,$minver) {
		switch ($platform) {
			case 'hubzilla':
				$curver = STD_VERSION;
				break;
			case 'cart':
				$curver = Cart::$cart_version;
				break;
			default:
				return false;
		}

		if(version_compare($curver, $minver) >= 0)
			return true;

		return false;
	}

  public static function get_seller_id() {
	if (argv(0) == "settings" && argv(1) == "cart") {
		return local_channel();
	}
        return (isset(\App::$profile["profile_uid"]) && \App::$profile["profile_uid"] != null) ? \App::$profile["profile_uid"] : Cart::$seller["channel_id"];
  }

  public static function z6trans_seller($hash) {

        $x = q("select * from xchan where xchan_hash = '%s'",
                dbesc($hash)
        );

        if ($x) {

		$channels = [];

                // include xchans for all zot-like networks
                $xchans = q("select xchan_hash,xchan_network from xchan where xchan_hash = '%s' OR ( xchan_guid = '%s' AND xchan_pubkey = '%s' ) ",
                        dbesc($hash),
                        dbesc($x[0]['xchan_guid']),
                        dbesc($x[0]['xchan_pubkey'])
                );

                if ($xchans) {
			foreach ($xchans as $xchan) {
				$channels[$xchan['xchan_network']] = $xchan['xchan_hash'];
			}
		}

		if (array_key_exists('zot6',$channels) && array_key_exists('zot',$channels)) {
			q("update cart_orders set seller_channel = '%s' where seller_channel = '%s'",
				$channels['zot6'],
				$channels['zot']
			  );
		}

		return $channels['zot6'];
	}


  }

	private static $xchanhash_cache = [];

	public static function get_xchan_hashes ($hash) {
		if (isset(self::$xchanhash_cache[$hash])) {
			return self::$xchanhash_cache[$hash];
		}

    		$xchanhashes = [];
		$secids = get_security_ids(null,$hash);
		$xchanhashes = $secids['allow_cid'];

		self::$xchanhash_cache[$hash] = $xchanhashes;

		return (self::$xchanhash_cache[$hash]);
	}

	public static function channel_hashes_sql ($hashes,$field) {
		$hashes_sql = $field." in ('".implode("','",$hashes)."')";

		return $hashes_sql;
	}

  public static function z6trans_buyer($hash) {

        $x = q("select * from xchan where xchan_hash = '%s'",
                dbesc($hash)
        );

        if ($x) {

		$channels = [];

                // include xchans for all zot-like networks
                $xchans = q("select xchan_hash,xchan_network from xchan where xchan_hash = '%s' OR ( xchan_guid = '%s' AND xchan_pubkey = '%s' ) ",
                        dbesc($hash),
                        dbesc($x[0]['xchan_guid']),
                        dbesc($x[0]['xchan_pubkey'])
                );

                if ($xchans) {
			foreach ($xchans as $xchan) {
				$channels[$xchan['xchan_network']] = $xchan['xchan_hash'];
			}
		}

		if (array_key_exists('zot6',$channels) && array_key_exists('zot',$channels)) {
			q("update cart_orders set buyer_xchan = '%s' where buyer_xchan = '%s'",
				$channels['zot6'],
				$channels['zot']
			  );
		}
	}

  }

  public static function set_seller_by_hash($channel_hash) {
    Cart::$seller=Array();
    $params=Array("channel_id","channel_account_id","channel_primary","channel_name","channel_address","channel_hash","channel_timezone");
    //$channel=channelx_by_hash($channel_hash);
    //if (!$channel) {
      $channel_hash = Cart::z6trans_seller($channel_hash);
      $channel = channelx_by_hash($channel_hash);
    //}
    if ($channel) {
      foreach($params as $key) {
        Cart::$seller[$key]=$channel[$key];
      }
      Cart::$seller["channel_address"]=Cart::$seller["channel_address"].'@'.App::get_hostname();
      return true;
    } else {
      Cart:$seller=null;
      return false;
    }
  }

  public static function set_buyer_by_hash($channel_hash) {
    Cart::$buyer=Array();
    //$channel = channelx_by_hash($channel_hash);
    //if (!$channel) {
      $channel_hash = Cart::z6trans_buyer($channel_hash);
      $channel = channelx_by_hash($channel_hash);
    //}
    if ($channel) {
        $params=Array("channel_id","channel_account_id","channel_primary","channel_name","channel_address","channel_hash","channel_timezone");
        foreach($params as $key) {
          Cart::$buyer[$key]=$channel[$key];
        }
        Cart::$buyer["channel_address"]=Cart::$buyer["channel_address"].'@'.App::get_hostname();
        return true;
    } else {
        $params=Array("channel_id"=>"channel_id","channel_account_id"=>"channel_account_id","channel_primary"=>"channel_primary","channel_timezone"=>"channel_timezone","hash"=>"channel_hash","address"=>"channel_address","name"=>"channel_name");
        $channel=xchan_fetch(Array("hash"=>$channel_hash));
        if ($channel) {
          foreach($params as $xkey=>$key) {
            Cart::$buyer[$key]=isset($channel[$xkey]) ? $channel[$xkey] : null;
          }
          return true;
        } else {
          return false;
        }
      }
    }
}

$cart_version = 0.9;
load_config("cart");
global $cart_submodules;
$cart_submodules=Array("paypalbuttonV2","hzservices","subscriptions","manualcat","orderoptions");

$cart_manualpayments = cart_getcartconfig('enable_manual_payments');
if ($cart_manualpayments) {
	require_once("./manual_payments.php");
}


function cart_maybeunjson ($value) {

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

function cart_maybejson ($value,$options=0) {

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


function cart_dbCleanup () {

	$success=UPDATE_SUCCESS;
	call_hooks("cart_dbcleanup",$success);
	if ($success!=UPDATE_SUCCESS) {
		notice(t("DB Cleanup Failure").EOL);
		logger("DB Cleanup Failure in cart-dbcleanup hooks",LOGGER_NORMAL);
	}


	$sqlstmts[DBTYPE_MYSQL] = Array (
	    1 => Array (
		"DROP TABLE IF EXISTS cart_orders",
		"DROP TABLE IF EXISTS cart_orderitems",
	    )
        );
        $sqlstmts[DBTYPE_POSTGRES] = Array (
	   1 => Array (
	     	"DROP TABLE IF EXISTS cart_orders",
		"DROP TABLE IF EXISTS cart_orderitems",
	   )
	);
        $dbsql=$sqlstmts[ACTIVE_DBTYPE];
	foreach ($dbsql as $updatever=>$sql) {
	  foreach ($sql as $query) {
                  logger ('[cart] UNINSTALL db query: '.$query,LOGGER_DEBUG);
		  $r = q($query);
		  if (!$r) {
			  logger ('[cart] Error running dbCleanup. sql query failed: '.$query,LOGGER_NORMAL);
			  $success = UPDATE_FAILED;
		  }
	  }
	}
	if ($success==UPDATE_SUCCESS) {
	  notice ('[cart] dbCleanup successful.');
	  logger ('[cart] dbCleanup successful.',LOGGER_NORMAL);
	  cart_delsysconfig("dbver");
  } else {
		notice ('[cart] Error in dbCleanup. Check the log for details.');
	  logger ('[cart] Error in dbCleanup.',LOGGER_NORMAL);
	}
        $response = UPDATE_SUCCESS;
        call_hooks("cart_dbcleanup",$response);
	return $response;
}

function cart_dbUpgrade () {
	$dbverconfig = cart_getsysconfig("dbver");
	logger ('[cart] Current sysconfig dbver:'.$dbverconfig,LOGGER_NORMAL);

	$dbver = $dbverconfig ? $dbverconfig : 0;

	$dbsql[DBTYPE_MYSQL] = Array (
		1 => Array (
			// order_currency = ISO4217 currency alphabetic code
			// buyer_altid = email address or other unique identifier for the buyer
			"CREATE TABLE cart_orders (
				id int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				seller_channel varchar(191),
				buyer_xchan varchar(191),
				buyer_altid varchar(191),
				order_hash varchar(191) NOT NULL,
				order_expires datetime,
				order_checkedout datetime,
				order_paid datetime,
				order_currency varchar(10) default 'USD',
				order_meta text,
				UNIQUE (order_hash)
				) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
			",
			"alter table cart_orders add index (seller_channel)",
			"CREATE TABLE cart_orderitems (
				id int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
				order_hash varchar(191),
				item_lastupdate datetime,
				item_type varchar(25),
				item_sku varchar(25),
				item_desc varchar(191),
				item_qty int(10) UNSIGNED,
				item_price numeric(7,2),
				item_tax_rate numeric (4,4),
				item_confirmed tinyint(1) NOT NULL DEFAULT 0,
				item_fulfilled tinyint(1) NOT NULL DEFAULT 0,
				item_exception tinyint(1) NOT NULL DEFAULT 0,
				item_meta text
				) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
			",
			"alter table cart_orderitems add index (order_hash)"
		),
		2 => Array (
			"alter table cart_orders modify order_meta mediumtext;"
		),
		3 => Array (
			"alter table cart_orderitems modify item_price numeric(10,4);",
			"alter table cart_orderitems modify item_meta mediumtext;"
			)
	);

	$dbsql[DBTYPE_POSTGRES] = Array (
		1 => Array (
			// order_currency = ISO4217 currency alphabetic code
			// buyer_altid = email address or other unique identifier for the buyer
			"CREATE TABLE cart_orders (
				id serial NOT NULL,
				seller_channel varchar(255),
				buyer_xchan varchar(255),
				buyer_altid varchar(255),
				order_hash varchar(255) NOT NULL,
				order_expires timestamp,
				order_checkedout timestamp,
				order_paid timestamp,
				order_currency varchar(10) DEFAULT 'USD',
				order_meta text,
				PRIMARY KEY (id),
				UNIQUE (order_hash)
				);
			",
			"CREATE INDEX idx_seller_channel ON cart_orders (seller_channel);",
			"CREATE TABLE cart_orderitems (
				id serial NOT NULL,
				order_hash varchar(255),
				item_lastupdate timestamp,
				item_type varchar(25),
				item_sku varchar(25),
				item_desc varchar(255),
				item_qty int,
				item_price numeric(10,4),
				item_tax_rate numeric (4,4),
				item_confirmed smallint NOT NULL DEFAULT 0,
				item_fulfilled smallint NOT NULL DEFAULT 0,
				item_exception smallint NOT NULL DEFAULT 0,
				item_meta text,
				PRIMARY KEY (id)
				);
			",
			"CREATE INDEX idx_order_hash ON cart_orderitems (order_hash);"
		),
		2 => Array (),
		3 => Array ()
	);

	foreach ($dbsql[ACTIVE_DBTYPE] as $ver => $sql) {
		if ($ver <= $dbver) {
			continue;
		}
		foreach ($sql as $query) {
	                logger ('[cart] dbSetup:'.$query,LOGGER_DATA);
			$r = q($query);
			if (!$r) {
				notice ('[cart] Error running dbUpgrade.');
				logger ('[cart] Error running dbUpgrade. sql query: '.$query);
				return UPDATE_FAILED;
			}
		}
		cart_setsysconfig("dbver",$ver);
	}
        $response = UPDATE_SUCCESS;
        logger("CART: run db_upgrade hooks",LOGGER_DEBUG);
	load_hooks();
        call_hooks("cart_dbupgrade",$response);
	return $response;
}


function cart_loadorder ($orderhash) {
        // @TODO: Only allow loading of orders where BUYER or SELLER hash = logged in user hash
	$r = q ("select * from cart_orders where order_hash = '%s' LIMIT 1",dbesc($orderhash));
	if (!$r) {
		return Array("order"=>null,"items"=>null);
	}

	$order = $r[0];
        Cart::set_seller_by_hash($order["seller_channel"]);
        Cart::set_buyer_by_hash($order["buyer_xchan"]);
	$order["order_meta"]=cart_maybeunjson($order["order_meta"]);
	$order["totals"]=$order["order_meta"]["totals"];
        $xchan = xchan_fetch(Array('hash'=>$order["buyer_xchan"]));
        $order["buyer_channelname"]=$xchan["name"]." (".$xchan["address"].")";
	$r = q ("select * from cart_orderitems where order_hash = '%s'",dbesc($orderhash));
        $flags=Array("confirmed"=>true,"fulfilled"=>true,"exception"=>false,"lastupdate"=>"0000-00-00");

	if (!$r) {
                logger ("[cart] Cart Has No Items",LOGGER_DEBUG);
                $order["items"]=Array();
                $order["flags"]["confirmed"]=false;
                $order["flags"]["fulfilled"]=false;
                $order["flags"]=$flags;
                $hookdata=$order;
	        call_hooks("cart_loadorder",$hookdata);
                return $hookdata;
	}
	$items=Array();
	foreach ($r as $key=>$iteminfo) {
		$items[$iteminfo["id"]]=$iteminfo;
                $item=$iteminfo;
                $itemprice=$items[$iteminfo["id"]]["item_price"];
		$linetotal=floatval($item["item_qty"])*floatval($itemprice);
		$items[$iteminfo["id"]]["extended"]=$linetotal;
                $items[$iteminfo["id"]]["item_meta"]=cart_maybeunjson($iteminfo["item_meta"]);
                if($iteminfo["item_confirmed"] == false) $flags["confirmed"]=false;
                if($iteminfo["item_fulfilled"] == false) $flags["fulfilled"]=false;
                if($iteminfo["item_exception"] == true) $flags["exception"]=true;
                if($iteminfo["item_lastupdate"] > $flags["lastupdate"]) $flags["lastupdate"]=$iteminfo["item_lastupdate"];
	}
	$order["items"]=$items;
        $order["flags"]=$flags;
        $hookdata=$order;
	call_hooks("cart_loadorder",$hookdata);
	return $hookdata;
}

function cart_getorderhash ($create=false) {

  $query_orderhash = isset($_GET["cart"]) ? $_GET["cart"] : null;
	$session_orderhash = isset($_SESSION["cart_order_hash"]) ? $_SESSION["cart_order_hash"] : null;
  $orderhash = isset($query_orderhash) ? $query_orderhash : $session_orderhash;
  $session_orderhash = $orderhash;
	$observerhash = get_observer_hash();
	if ($observerhash === '') { $observerhash = null; }
	$cartemail = isset($_SESSION["cart_email_addy"]) ? $_SESSION["cart_email_addy"] : null;
	$channel=channelx_by_n(Cart::get_seller_id());
	$channel_hash=$channel["channel_hash"];

	$buyerhashes=Cart::get_xchan_hashes($observerhash);
	logger("BUYERHASHES = ".json_encode($buyerhashes));
	$sellerhashes=Cart::get_xchan_hashes($channel_hash);
	logger("SELLERHASHES = ".json_encode($sellerhashes));

	if ($orderhash) {
		$r = q("select * from cart_orders where order_hash = '%s' limit 1",dbesc($orderhash));
		if (!$r) {
			$orderhash=null;
		} else {
		    $order = $r[0];

                    $orderhash = $order["order_hash"];


		    //if ($order["buyer_xchan"]!=$observerhash) {
		    if (!in_array($order["buyer_xchan"],$buyerhashes)) {
			$orderhash=null;
		    }

		    if (!in_array($order["seller_channel"],$sellerhashes)) {
			$orderhash=null;
		    }

		    if ($order["order_checkedout"]!=null) {
			$orderhash=null;
		    }
               }
	}
	if (!$orderhash) {

		$buyerhashes_sql = Cart::channel_hashes_sql($buyerhashes,'buyer_xchan');
		$sellerhashes_sql = Cart::channel_hashes_sql($sellerhashes,'seller_channel');

		$r = q("select * from cart_orders where
			           $buyerhashes_sql AND
	               		   $sellerhashes_sql
                 and order_checkedout is null limit 1");

      if (!$r) {
          $orderhash=null;
      } else {
          $order = $r[0];
          $orderhash = $order["order_hash"];
     }

  }

	if (!$orderhash && $create === true) {
		//$channel=\App::get_channel();
		$orderhash=hash('whirlpool',microtime().$observerhash.$channel_hash);
		q("insert into cart_orders (seller_channel,buyer_xchan,order_hash) values ('%s', '%s', '%s')",
				dbesc($channel_hash),dbesc($observerhash),dbesc($orderhash));
	}

	$_SESSION["cart_order_hash"]=$orderhash;
	return $orderhash;
}

function cart_additem_hook (&$hookdata) {

        $order=$hookdata["order"];
        if (!isset($hookdata["item"])) return;
	$item=$hookdata["item"];
        if ($item["item_qty"] < 1) return;
        $item["order_hash"] = $order["order_hash"];
	if (isset($item["item_meta"])) {
		$item["item_meta"] = cart_maybejson($item["item_meta"]);
	}
	$keys = Array (
		"order_hash"=>Array("key"=>"order_hash","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_desc"=>Array("key"=>"item_desc","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_type"=>Array("key"=>"item_type","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_sku"=>Array("key"=>"item_sku","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_qty"=>Array("key"=>"item_qty","cast"=>"%d","escfunc"=>"intval"),
		"item_price"=>Array("key"=>"item_price","cast"=>"%f","escfunc"=>"floatval"),
		"item_tax_rate"=>Array("key"=>"item_tax_rate","cast"=>"%f","escfunc"=>"floatval"),
		"item_meta"=>Array("key"=>"item_meta","cast"=>"'%s'","escfunc"=>"dbesc"),
		);

	$colnames = '';
	$valuecasts = '';
	$params = Array();
	$count=0;
	foreach ($keys as $key=>$cast) {
		if (isset($item[$key])) {
			$colnames .= ($count > 0) ? "," : '';
			$colnames .= $cast["key"];
			$valuecasts .= ($count > 0) ? "," : '';
			$valuecasts .= $cast["cast"];
                        $escfunc = $cast["escfunc"];
			$params[] = $escfunc($item[$key]);
			$count++;
		}
	}

	$sql = "insert into cart_orderitems (".$colnames.") values (".$valuecasts.")";
	array_unshift($params,$sql);
	$r=call_user_func_array('q', $params);
}

//function cart_do_additem (array $iteminfo,&$c) {
function cart_do_additem (&$hookdata) {

  $startcontent = $hookdata["content"];
	$iteminfo=$hookdata["iteminfo"];
        $cart_itemtypes = cart_getitemtypes();
	$required = Array("item_sku","item_qty","item_desc","item_price");
	foreach ($required as $key) {
		if (!array_key_exists($key,$iteminfo)) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]='';
			$hookdata["error"][]="[cart] Cannot add item, missing required parameter.";
			return;
		}
	}
	$order=cart_loadorder(cart_getorderhash(true));

	$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;

	if ($itemtype && !in_array($iteminfo['item_type'],$cart_itemtypes)) {
		unset ($iteminfo['item_type']);
	}
	$calldata=[];
        $calldata['order'] = $order;
        $calldata['item']=$iteminfo;
	//$calldata = Array('order'=>$order,'item'=>$iteminfo);
	$itemtype = isset($calldata['item']['item_type']) ? $calldata['item']['item_type'] : null;

	if ($itemtype) {
		$itemtypehook='cart_order_before_additem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] :'';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
			return;
		}
	}

	if (!isset($calldata["item"])) { return; }
	call_hooks('cart_order_before_additem',$calldata);

	$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
		$hookdata["content"]=$startcontent;
		$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
		$hookdata["error"][]=$calldata["error"];
		unset($calldata["error"]);
		return;
	}

	if (!isset($calldata["item"])) { return; }

	if ($itemtype) {
		$itemtypehook='cart_order_additem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] :'';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
		}
	}

	if (!isset($calldata["item"])) { return; }
	call_hooks('cart_order_additem',$calldata);
	$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] :'';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
		$hookdata["content"]=$startcontent;
		$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
		$hookdata["error"][]=$calldata["error"];
		unset($calldata["error"]);
		return;
	}

	if ($itemtype) {
		$itemtypehook='cart_order_after_additem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] : '';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
		}
	}
	call_hooks('cart_order_after_additem',$calldata);
	$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
		$hookdata["content"]=$startcontent;
		$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
		$hookdata["error"][]=$calldata["error"];
		unset($calldata["error"]);
	}
        notice (t('[cart] Item Added').EOL);
}

function cart_getorder_meta ($orderhash=null) {
	$orderhash = $orderhash ? $orderhash : cart_getorderhash();

	if (!$orderhash) {
		return null;
	}

	$r=q("select order_meta from cart_orders where order_hash = '%s'",
			dbesc($orderhash));

	if (!$r) {return Array();}
	$meta=$r[0]["order_meta"];
	return (cart_maybeunjson($meta));
}

function cart_getitem_meta ($itemid,$orderhash=null) {
	$orderhash = $orderhash ? $orderhash : cart_getorderhash();

	if (!$orderhash) {
		return null;
	}

	$r=q("select item_meta from cart_orderitems where order_hash = '%s' and id = %d",
			dbesc($orderhash),intval($itemid));

	if (!$r) {return Array();}
	$meta=$r[0]["item_meta"];
	return (cart_maybeunjson($meta));
}

function cart_updateorder_meta ($meta,$orderhash=null) {

        if (!$orderhash) { cart_getorderhash(); }

	if (!$orderhash) {
		return null;
	}

	$storemeta = cart_maybejson($meta);

	$r=q("update cart_orders set order_meta = '%s' where order_hash = '%s'",
			dbesc($storemeta),dbesc($orderhash),intval($itemid));

	return;
}

function cart_updateitem_meta ($itemid,$meta,$orderhash=null) {
	$orderhash = $orderhash ? $orderhash : cart_getorderhash();
	if (!$orderhash) {
		return null;
	}

	$storemeta = cart_maybejson($meta);

	$r=q("update cart_orderitems set item_meta = '%s' where order_hash = '%s' and id = %d",
			dbesc($storemeta),dbesc($orderhash),intval($itemid));

	return;
}

function cart_updateitem_hook (&$hookdata) {

	$order=$hookdata["order"];
	$item=$hookdata["item"];

	$string_components = Array ( "item_sku","item_desc" );
	$int_components = Array ( "item_qty","item_confirmed","item_fulfilled","item_exception" );
	$decimal_components = Array ("item_price","item_tax_rate");

	$params = Array();
	$dodel=false;

	if (isset($item["item_qty"]) && $item["item_qty"] == 0) {
		$sql = "delete from cart_orderitems ";
		$dodel=true;
	} else {
		$sql = "update cart_orderitems set ";
		foreach ($item as $key=>$val) {
			$prepend = '';
			if (count($params) > 0) {
				$prepend = ',';
			}
			if (in_array($key,$string_components)) {
				$sql .= $prepend." $key"." = '%s' ";
				$params[] = dbesc($val);
			} else
			if (in_array($key,$int_components)) {
				$sql .= $prepend." $key"." = %d ";
				$params[] = intval($val);
			} else
			if (in_array($key,$decimal_components)) {
				$sql .= $prepend." $key"." = %f ";
				$params[] = floatval($val);
			}
		}
	}

	if ($dodel || count ($params) >0) {
		$orderhash = cart_getorderhash(false);
		if (!$orderhash) {return;}
		$sql .= " where order_hash = '%s' and id = %d ";
		$params[] = dbesc($order["order_hash"]);
		$params[] = intval($item["id"]);

		array_unshift($params,$sql);
		$r=call_user_func_array('q', $params);

		if($dodel) {
			$r = q("select * from cart_orderitems where order_hash = '%s'",
				dbesc($order["order_hash"])
			);
			if(! $r) {
				q("delete from cart_orders where order_hash = '%s'",
					dbesc($order["order_hash"])
				);
			}
		}
	}

	if (isset($item["item_meta"])) {
		cart_updateitem_meta ($item["id"],$item["item_meta"],$order["order_hash"]);
	}
}

function cart_do_updateitem (&$hookdata) {

	$iteminfo=$hookdata["iteminfo"];


	$required = Array("id");
	foreach ($required as $key) {
		if (!array_key_exists($key, $iteminfo)) {
			$hookdata["errorcontent"][]="[cart] Cannot update item, missing $key.";
			$hookdata["error"][]=$calldata["error"];
			return;
		}
	}

	$orderhash = cart_getorderhash();
	if (!$orderhash) { return; }
	$order=cart_loadorder($orderhash);
	$startcontent=$hookdata["content"];
        $cart_itemtypes = cart_getitemtypes();

	$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
        if ($itemtype && !in_array($iteminfo['item_type'],$cart_itemtypes)) {
		unset ($iteminfo['item_type']);
	}

	$calldata = Array('order'=>$order,'item'=>$iteminfo);

	$itemtype = isset($calldata['item']['item_type']) ? $calldata['item']['item_type'] : null;

	if ($itemtype) {
		$itemtypehook='cart_order_before_updateitem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			return;
		}
	}

	if (!isset($calldata["item"])) { return; }

	call_hooks('cart_order_before_updateitem',$calldata);
	$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			return;
	}


	if (!isset($calldata["item"])) { return; }

	if ($itemtype) {
		$itemtypehook='cart_order_updateitem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
		}
	}

	if (!isset($calldata["item"])) { return; }

	call_hooks('cart_order_updateitem',$calldata);
	$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
	}

	if ($itemtype) {
		$itemtypehook='cart_order_after_updateitem_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
		unset($calldata["content"]);
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			unset($calldata["error"]);
		}
	}
	call_hooks('cart_order_after_updateitem',$calldata);
	$hookdata["content"].= isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
		$hookdata["content"]=$startcontent;
		$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
		$hookdata["error"][]=$calldata["error"];
		unset($calldata["error"]);
	}
}

function cart_display_item (&$hookdata) {
	$item = $hookdata["item"];
	$hookdata["content"].=replace_macros(get_markup_template('cart_item_basic.tpl','addon/cart/'), array('$item'	=> $item ));

}


function cart_calc_totals(&$hookdata) {
	$orderhash=isset($hookdata["order_hash"]) ? $hookdata["order_hash"] : null;
	if (!$orderhash) {return;}
	$order=cart_loadorder($orderhash);
	if ($order["checkedout"]!=null) { return; }
	$ordermeta=$order["order_meta"];
	$items=$order["items"];
	$subtotal=0;
	$taxtotal=0;
	$ordertotal=0;

	foreach ($items as $key=>$item) {
		$linetotal=floatval($item["item_qty"])*floatval($item["item_price"]);
		$hookdata["order"]["items"][$key]["extended"]=$linetotal;

		$linetax=floatval($linetotal) * floatval($item["item_tax_rate"]);

		$subtotal = floatval($subtotal) + floatval($linetotal);
		$taxtotal = floatval($taxtotal) + floatval($linetax);
	}
	$ordertotal = $subtotal+$taxtotal;
	$order["order_meta"]["totals"]["Tax"]=cart_formatamount($taxtotal);
	$order["order_meta"]["totals"]["Subtotal"]=cart_formatamount($subtotal);
	$order["order_meta"]["totals"]["OrderTotal"]=cart_formatamount($ordertotal);

/*
	$order["order_meta"]["totals"]["Tax"]=number_format(round($taxtotal,2),2);
	$order["order_meta"]["totals"]["Subtotal"]=number_format(round($subtotal,2),2);
	$order["order_meta"]["totals"]["OrderTotal"]=number_format(round($ordertotal,2),2);
*/
	//Preserve order_meta from overwriting by filter
	$ordermeta=$order["order_meta"];
	call_hooks("cart_calc_totals_filter",$order);
	//Import results of the totals_filter
	$ordermeta["totals"]=$order["order_meta"]["totals"];
	//Save order meta data with new totals
	cart_updateorder_meta($ordermeta,$orderhash);
	//set return values
        $hookdata["order_meta"]=$ordermeta;
	$hookdata["totals"]=$order["order_meta"]["totals"];
}

function cart_checkout_hook(&$hookdata) {
	$orderhash = isset($hookdata["order_hash"]) ? $hookdata["order_hash"] : null;

	if (!$orderhash) {
		/*  No order given. */
		return;
	}

	$order=cart_loadorder($orderhash);

	if ($order["order_checkedout"] != null) {
		/* Order previously checked out */
		return;
	}

	q("update cart_orders set order_checkedout=NOW() where order_hash='%s'",dbesc($orderhash));

	return;
	}

function cart_config_additemtype ($itemtype) {
	$itemtypes=cart_getsysconfig("itemtypes");
	$itemtypes["$itemtype"]=$itemtype;
        cart_setsysconfig("itemtypes",$itemtypes);
}

function cart_getitemtypes() {
  $itemtypes = cart_getsysconfig("itemtypes");
  $itemtypes = is_array($itemtypes) ? $itemtypes : Array();
  return $itemtypes;
}

function cart_do_checkout_before (&$hookdata) {

        $cart_itemtypes = cart_getitemtypes();
	if (isset($hookdata["error"]) && $hookdata["error"]!=null) {
		return;
	}

	$orderhash = isset($hookdata["order_hash"]) ? $hookdata["order_hash"] : cart_getorderhash();
	$hookdata["error"]=null;
	if (!$orderhash) {
		$hookdata["errorcontent"][]="<h1>Order Not Found</h1>";
		$hookdata["error"][]="No active order";
		return;
	}

	$order=cart_loadorder($orderhash);
	$error=null;
	$startcontent=$hookdata["content"];

	if ($order["order_checkedout"] != null) {
		$hookdata["errorcontent"][]="";
		$hookdata["error"]="Order previously checked out";
		logger ('[cart] Attempt to checkout_before already checked out cart (order id:'.$order["id"].')',LOGGER_DEBUG);
		return;
	}

	foreach ($order["items"] as $iteminfo) {
		$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
                if ($itemtype && !in_array($iteminfo['item_type'],$cart_itemtypes)) {
			continue;
		}

		$calldata = Array('itemid'=>$iteminfo,'error'=>null,'content'=>$hookdata["content"]);

		if ($itemtype) {
			$itemtypehook='cart_before_checkout_'.$itemtype;
			call_hooks($itemtypehook,$calldata);
			$hookdata["content"] = isset($calldata["content"]) ? $calldata["content"] : '';
			unset($calldata["content"]);
			if (isset($calldata["error"]) && $calldata["error"]!=null) {
				$hookdata["content"]=$startcontent;
				$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
				$hookdata["error"][]=$calldata["error"];
				return;
			}
		}
	}

	if (!$error) {
		$order=cart_loadorder($orderhash);
		unset($calldata);
		$calldata = Array('order_hash'=>$orderhash,'error'=>null);
		call_hooks('cart_before_checkout',$calldata);
		$hookdata["content"]=isset($calldata["content"]) ? $calldata["content"] : '';
		if (isset($calldata["error"]) && $calldata["error"]!=null) {
			$hookdata["content"]=$startcontent;
			$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
			$hookdata["error"][]=$calldata["error"];
			return;
		}
	}
}

function cart_do_checkout (&$hookdata) {

	$orderhash = isset($hookdata["order_hash"]) ? $hookdata["order_hash"] : cart_getorderhash();

	if (!$orderhash) {
                notice ("[cart] Order not found." . EOL);
		return;
	}

	$order=cart_loadorder($orderhash);


	if ($order["order_checkedout"] != null) {
		notice ( t('Order already checked out.') . EOL );
		logger ('[cart] Attempt to check out already checked out cart (order id:'.$order["id"].')',LOGGER_DEBUG);
		return;
	}

	unset($calldata);
	$calldata=Array('order_hash'=>$orderhash);
	call_hooks('cart_checkout',$calldata);
	return;
}

function cart_do_checkout_after (&$hookdata) {

        $cart_itemtypes = cart_getitemtypes();

	$orderhash = isset($hookdata["order_hash"]) ? $hookdata["order_hash"] : cart_getorderhash();
	if (!$orderhash) {
                logger ("[cart] cart_do_checkout_after - no \$hookdata[order_hash]",LOGGER_DEBUG);
		return;
	}

	$order=cart_loadorder($orderhash);

	foreach ($order["items"] as $iteminfo) {
		$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
                if ($itemtype && !in_array($iteminfo['item_type'],$cart_itemtypes)) {
			continue;
		}
		$calldata = Array('item'=>$iteminfo);
		$itemtype = isset($calldata['item']['item_type']) ? $calldata['item']['item_type'] : null;
		if ($itemtype) {
			$itemtypehook='cart_after_checkout_'.$itemtype;
			call_hooks($itemtypehook,$calldata);
		}
		unset($calldata);
	}

	$calldata=Array('order_hash'=>$orderhash);
	call_hooks('cart_after_checkout',$calldata);

	return;
}

function cart_orderpaid_hook (&$hookdata) {
	$items = $hookdata["order"]["items"];
/*
	foreach ($items as $item) {
		q ("update cart_orderitems set paid = NOW() where order_hash = %s and id = %d",
				dbesc($hookdata["order"]["order_hash"]),
				intval($item["id"])
		);
	}
*/
		q ("update cart_orders set order_paid = NOW() where order_hash = '%s'",
				dbesc($hookdata["order"]["order_hash"]));
}

function cart_do_orderpaid (&$hookdata) {
	$orderhash=$hookdata["order"]["order_hash"];
	$order=cart_loadorder($orderhash);
        $cart_itemtypes = cart_getitemtypes();
        $payment=isset($hookdata["payment"]) ? $hookdata["payment"] : Array();
	$startdata=isset($hookdata["content"]) ? $hookdata["content"] : null;
	foreach ($order["items"] as $iteminfo) {
		$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
                if ($itemtype && !in_array($iteminfo['item_type'],$cart_itemtypes)) {
			continue;
		}

		$calldata = Array('item'=>$iteminfo,'error'=>null,'content'=>null);
		$itemtype = isset($calldata['item']['item_type']) ? $calldata['item']['item_type'] : null;

		if ($itemtype) {
			$itemtypehook='cart_orderpaid_'.$itemtype;
			call_hooks($itemtypehook,$calldata);
			$hookdata["content"] .= isset($calldata["content"]) ? $calldata["content"] : '';
			unset($calldata["content"]);
			if (isset($calldata["error"]) && $calldata["error"]!=null) {
				$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
				$hookdata["error"][]=$calldata["error"];
			}
		}
	}

	unset($calldata);
	$calldata=Array('order'=>$order,'payment'=>$payment,"error"=>null,"content"=>null);
	call_hooks('cart_orderpaid',$calldata);
	$hookdata["content"].=isset($calldata["content"]) ? $calldata["content"] : '';
	unset($calldata["content"]);
	if (isset($calldata["error"]) && $calldata["error"]!=null) {
		$hookdata["errorcontent"][]=isset($calldata["errorcontent"]) ? $calldata["errorcontent"] : null;
		$hookdata["error"][]=$calldata["error"];
	}
	return;
}

function cart_checkver() {
	global $cart_version;
	if (cart_getsysconfig("appver") == $cart_version) {
		return true;
	}

	cart_setsysconfig("status","version-mismatch");
	return false;
}

function cart_getsysconfig($param) {
	$val = get_config("cart",$param);
	$val=cart_maybeunjson($val);
	return $val;
}

function cart_setsysconfig($param,$val) {
	  $val=cart_maybejson($val);
		return set_config("cart",$param,$val);
}

function cart_delsysconfig($param) {
		return del_config("cart",$param);
}

function cart_getcartconfig($param) {
        $id = (isset(\App::$profile["profile_uid"]) && \App::$profile["profile_uid"] != null) ? \App::$profile["profile_uid"] : Cart::$seller["channel_id"];
        $id = ($id) ? $id : local_channel();
	$cartconfig=cart_maybeunjson(get_pconfig($id,"cart",$param));
        return $cartconfig;
}

function cart_delcartconfig($param) {
	if (! local_channel()) {
		return null;
	}

	return del_pconfig(local_channel(),"cart",$param);
}

function cart_setcartconfig($param,$val) {
		if (! local_channel()) {
		return null;
	}

	return set_pconfig(local_channel(),"cart",$param,$val);
}

function cart_install() {
		logger ('[cart] Install start.',LOGGER_DEBUG);
	if (cart_dbUpgrade () == UPDATE_FAILED) {
		notice ('[cart] Install error - Abort installation.');
		logger ('[cart] Install error - Abort installation.',LOGGER_NORMAL);
		cart_setsysconfig("status","install error");
		return;
	}
	notice ('[cart] Installed successfully.');
	logger ('[cart] Installed successfully.',LOGGER_NORMAL);
	cart_setsysconfig("appver",$cart_version);
	cart_setsysconfig("status","ready");
	cart_setsysconfig("dropTablesOnUninstall",0);
}

function cart_uninstall() {
	$dropTablesOnUninstall = intval(cart_getsysconfig("dropTablesOnUninstall"));
  	logger ('[cart] Uninstall start.',LOGGER_DEBUG);
  	logger ('[cart] drop tables? '.$dropTablesOnUninstall,LOGGER_DEBUG);
	if ($dropTablesOnUninstall == 1) {
  	      logger ('[cart] DB Cleanup table.',LOGGER_DEBUG);
		      cart_dbCleanup ();
	        cart_delsysconfig("dbver");
	}

	cart_delsysconfig("appver");
	notice ('[cart] Uninstalled.');
	logger ('[cart] Uninstalled.',LOGGER_NORMAL);
	cart_setsysconfig("status","uninstalled");
	logger ('[cart] Set sysconfig as uninstalled.',LOGGER_DEBUG);
}

function cart_load(){
        // HOOK REGISTRATION
	Zotlabs\Extend\Hook::register('construct_page', 'addon/cart/cart.php', 'cart_construct_page',1);
	Zotlabs\Extend\Hook::register('channel_apps', 'addon/cart/cart.php', 'cart_channel_apps');
	Zotlabs\Extend\Hook::register('cart_do_additem','addon/cart/cart.php','cart_do_additem',1);
	Zotlabs\Extend\Hook::register('cart_order_additem','addon/cart/cart.php','cart_additem_hook',1);
	Zotlabs\Extend\Hook::register('cart_do_updateitem','addon/cart/cart.php','cart_do_updateitem',1,1);
	Zotlabs\Extend\Hook::register('cart_order_updateitem','addon/cart/cart.php','cart_updateitem_hook',1,1);
	Zotlabs\Extend\Hook::register('cart_order_before_updateitem','addon/cart/cart.php','cart_updateitem_qty_hook',1,32000);
	Zotlabs\Extend\Hook::register('cart_order_before_updateitem','addon/cart/cart.php','cart_updateitem_delsku_hook',1,32000);
	Zotlabs\Extend\Hook::register('cart_checkout','addon/cart/cart.php','cart_checkout_hook',1);
	Zotlabs\Extend\Hook::register('cart_do_checkout','addon/cart/cart.php','cart_do_checkout',1);
	Zotlabs\Extend\Hook::register('cart_orderpaid','addon/cart/cart.php','cart_orderpaid_hook',1);
	Zotlabs\Extend\Hook::register('cart_do_orderpaid','addon/cart/cart.php','cart_do_orderpaid',1);
	Zotlabs\Extend\Hook::register('cart_before_checkout','addon/cart/cart.php','cart_calc_totals',1,10);
	Zotlabs\Extend\Hook::register('cart_calc_totals','addon/cart/cart.php','cart_calc_totals',1,10);
	Zotlabs\Extend\Hook::register('cart_display_before','addon/cart/cart.php','cart_calc_totals',1,99);
        Zotlabs\Extend\Hook::register('cart_display_before','addon/cart/cart.php','cart_display_before_addcheckoutlink',1,31000);
        Zotlabs\Extend\Hook::register('cart_display_before','addon/cart/cart.php','cart_display_before_formatcurrency',1,31001);
	Zotlabs\Extend\Hook::register('cart_display','addon/cart/cart.php','cart_display_applytemplate',1,31000);
	Zotlabs\Extend\Hook::register('cart_mod_content','addon/cart/cart.php','cart_mod_content',1,99);
	Zotlabs\Extend\Hook::register('cart_post_add_item','addon/cart/cart.php','cart_post_add_item');
	Zotlabs\Extend\Hook::register('cart_post_update_item','addon/cart/cart.php','cart_post_update_item',1,1);
	Zotlabs\Extend\Hook::register('cart_checkout_start','addon/cart/cart.php','cart_checkout_start');
	Zotlabs\Extend\Hook::register('cart_post_checkout_choosepayment','addon/cart/cart.php','cart_post_choose_payment',1,32000);
	Zotlabs\Extend\Hook::register('cart_aside_filter','addon/cart/cart.php','cart_render_aside',1,10000);
	Zotlabs\Extend\Hook::register('cart_after_fulfill','addon/cart/cart.php','cart_after_fulfill_finishorder',1,32000);
	Zotlabs\Extend\Hook::register('cart_after_fulfill','addon/cart/cart.php','cart_fulfillitem_markfulfilled',1,31000);
	Zotlabs\Extend\Hook::register('cart_after_cancel','addon/cart/cart.php','cart_cancelitem_unmarkfulfilled',1,31000);
	Zotlabs\Extend\Hook::register('cart_get_catalog','addon/cart/cart.php','cart_get_test_catalog',1,0);
	Route::register('addon/cart/Settings/Cart.php','settings/cart');

        // WIDGET REGISTRATION
        if (Cart::check_min_version ('hubzilla','3.7.1')) {
                Zotlabs\Extend\Widget::register('addon/cart/widgets/cartbutton.php','cartbutton');
                Zotlabs\Extend\Widget::register('addon/cart/widgets/catalogitem.php','catalogitem');
        }

	//$manualpayments = get_pconfig ($id,'cart','enable_manual_payments');
	//if ($manualpayments) {
	//}
	require_once("manual_payments.php");
	cart_manualpayments_load();
	require_once("myshop.php");
	cart_myshop_load();
	global $cart_submodules;
	foreach ($cart_submodules as $module) {
                logger ("Submodule-load: $module",LOGGER_DEBUG);
		require_once('submodules/'.$module.".php");
		$moduleclass = 'Cart_'.$module;
		$moduleclass::load();
	}
        call_hooks('cart_submodule_activation');
	cart_dbupgrade();
}

function cart_unload(){
        Zotlabs\Extend\Hook::unregister_by_file('addon/cart/cart.php');

        // WIDGET UNREGISTRATION
        if (Cart::check_min_version ('hubzilla','3.7.1')) {
                Zotlabs\Extend\Widget::unregister('addon/cart/widgets/cartbutton.php','cartbutton');
                Zotlabs\Extend\Widget::unregister('addon/cart/widgets/catalogitem.php','catalogitem');
        }

	Route::unregister('addon/cart/Settings/Cart.php','settings/cart');

	require_once("manual_payments.php");
	cart_manualpayments_unload();
	require_once('myshop.php');
	cart_myshop_unload();
        global $cart_submodules;
	foreach ($cart_submodules as $module) {
		require_once('submodules/'.$module.".php");
		$moduleclass = 'Cart_'.$module;
		$moduleclass::unload();
	}
        call_hooks('cart_submodule_deactivation');
	cart_delsysconfig("itemtypes");
}

function cart_module() { return; }

function cart_getcurrencies () {
        $currencylist = file_get_contents ( dirname(__FILE__).'/currencycodes.json' );
        $currencylist = cart_maybeunjson($currencylist);

        call_hooks('cart_currency_filter',$currencylist);
        return $currencylist;
}

function cart_getcurrency($code) {
	$currencies=cart_getcurrencies();
	if (isset($currencies[$code])) {
		return $currencies[$code];
	} else {
		return $currencies["USD"];
	}
}

function cart_getcurrencyformat() {
	//$currency = get_pconfig(\App::$profile['profile_uid'],'cart','cart_currency');
        $currency = cart_getcartconfig("cart_currency");
	$currency = cart_getcurrency($currency);
	$precision = $currency["decimal_digits"];
	$format="%.0".$precision."f";
	return $format;
}

function cart_formatamount($amount) {
	return sprintf(cart_getcurrencyformat(),$amount);
}

function cart_plugin_admin_post() {

  $prev_dropval = cart_getsysconfig("dropTablesOnUninstall");

  $dropdbonuninstall = intval($_POST["cart_uninstall_drop_tables"]);

  if ($dropdbonuninstall != $prev_dropval) {
      cart_setsysconfig("dropTablesOnUninstall",$dropdbonuninstall);
  }
}

function cart_plugin_admin(&$s) {

    $dropdbonuninstall = intval(cart_getsysconfig("dropTablesOnUninstall"));

    $sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
			 '$field'	=> array('cart_uninstall_drop_tables', t('Drop database tables when uninstalling.'),
				 (isset($dropdbonuninstall) ? $dropdbonuninstall : 0),
				 '',array(t('No'),t('Yes')))));
	$sc .= "<div class='warn'>If set to yes, ALL CART DATA will be lost when the cart module is disabled.</div>";

	$s .= replace_macros(get_markup_template('generic_addon_settings.tpl'), array(
				     '$addon' 	=> array('cart',
							 t('Cart Settings'), '',
							 t('Submit')),
				     '$content'	=> $sc));

}

function cart_channel_apps(&$hookdata) {
	$channelid = App::$profile['uid'];
	$enablecart = Apps::addon_app_installed($channelid, 'cart');

	if($enablecart) {
		$hookdata['tabs'][] = [
			'label' => t('Shop'),
			'url'   => z_root() . '/cart/' . $hookdata['nickname'] . '/catalog',
			'sel'   => ((argv(0) == 'cart') ? 'active' : ''),
			'title' => t('Shop'),
			'id'    => 'cart-tab',
			'icon'  => 'shopping-cart'
		];
	}
}

function cart_getnick () {
    $nick = null;
    if (argc() > 1)
        $nick = argv(1); // if the channel name is in the URL, use that

    if (! $nick && local_channel()) { // if no channel name was provided, assume the current logged in channel
        $channel = \App::get_channel();
        if ($channel && $channel['channel_address']) {
            $nick = $channel['channel_address'];
            goaway(z_root() . '/cart/' . $nick);
        }
    }
    if (! $nick) {
        notice( t('Profile Unavailable.') . EOL);
        goaway(z_root());
    }
    return $nick;

}

function cart_init() {
    $nick = cart_getnick();

    profile_load($nick);

    //head_add_css("/addon/cart/view/css/cart.css");

}

function cart_post_add_item () {
	//@TODO: Add output of errors someplace
	if (!get_observer_hash()) {
		return;
	}
	$items=Array();
	call_hooks('cart_get_catalog',$items);
	$item_sku = preg_replace('[^0-9A-Za-z\-]','',$_POST["add"]);
	$newitem = $items[$item_sku];
	$qty=isset($_POST["qty"]) ? preg_replace('[^0-9\.]','',$_POST['qty']) : 1;
        $newitem["item_qty"]=$qty;

	$hookdata=Array("content"=>'',"iteminfo"=>$newitem);
	call_hooks('cart_do_additem',$hookdata);

}

function cart_post_update_item () {
	$orderhash = cart_getorderhash(false);
	if (!$orderhash) {
		notice (t("Order Not Found").EOL);
		return;
	}

	$order = cart_loadorder($orderhash);

	foreach ($order["items"] as $itemid=>$item) {
		if ($order["order_checkedout"]) {
						continue;
		}
		$hookdata=Array("content"=>'',"itemid"=>$itemid,"iteminfo"=>$item);
		call_hooks('cart_do_updateitem',$hookdata);
	}
}

function cart_updateitem_qty_hook(&$hookdata) {
        //POSTVAR qty-$item_id
        $item=$hookdata["item"];
        if(!is_array($item)) {return;}
        $postvar="qty-".$item["id"];
        $hookdata["item"]["item_qty"]=isset($_POST[$postvar]) ? preg_replace('[^0-9\.]','',$_POST[$postvar]) : intval($item["item_qty"]);
}

function cart_updateitem_delsku_hook(&$hookdata) {
	      $item=$hookdata["item"];
              $delsku = isset($_POST["delsku"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["delsku"]) : null;
              if($delsku && $item["item_sku"]==$delsku) {
                 $hookdata["item"]["item_qty"]=0;
              }
}


function cart_post(&$a) {
	$cart_formname=preg_replace('/[^a-zA-Z0-9\_]/','',$_POST["cart_posthook"]);
	$formhook = "cart_post_".$cart_formname;
	if (strlen($cart_formname) == 0) {
		if (argv(2) == "custom") {
		  $cart_formname=argv(3);
			$formhook="cart_post_custom_".$cart_formname;
			call_hooks($formhook);
			exit;
		}
	}
	call_hooks($formhook);

        if($_GET['returnurl']) {
            goaway(urldecode($_GET['returnurl']));
        }

	$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
	$url = $base_url . $_SERVER["REQUEST_URI"];
	goaway($url);
}


/* @todo: rework as filter
*/
function cart_mod_content(&$arr) {

	if(! Apps::addon_app_installed(App::$profile['uid'], 'cart')) {
		//Do not display any associated widgets at this point
		App::$pdl = '';
		$papp = Apps::get_papp('Cart');
		$arr['content'] = Apps::app_render($papp, 'module');
		return;
	}

	$arr['content'] = cart_pagecontent($a);

	$aside = '';
	call_hooks ('cart_aside_filter',$aside);
	\App::$page['aside'] =  $aside;

	$arr['replace'] = true;
	return;
}

function cart_get_catalog($filtered=true) {
	$items=Array();
	call_hooks('cart_get_catalog',$items);
	if ($filtered) {
	  call_hooks('cart_filter_catalog_display',$items);
	}
	return $items;
}

function cart_do_display($order) {
                call_hooks('cart_display_before',$order);
                call_hooks('cart_display',$order);
                call_hooks('cart_display_after',$order);
		return($order["content"]);
}

function cart_pagecontent($a=null) {

    if(observer_prohibited(true)) {
        return login();
    }

    if(!get_observer_hash()) {
	//$observerhash = get_observer_hash();
        notice ( t('You must be logged into the Grid to shop.') );
        $return_url = ltrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),"/");
        $_SESSION['return_url'] = $return_url;
        return login();
    }

    $sellernick = argv(1);

    $seller = channelx_by_nick($sellernick);

    if(! $seller) {
          notice( t('Invalid channel') . EOL);
          goaway('/' . argv(0));
    }

    $observer_hash = get_observer_hash();

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);

    // Determine if the observer is the channel owner so the ACL dialog can be populated
    if ($is_seller) {
		// DO Seller Specific Setup
		nav_set_selected('Cart');
	  }

	if ((argc() >= 3) && (argv(2) === 'order')) {
		$orderhash=argv(3);
		if ($orderhash == '') {
			$orderhash = cart_getorderhash(false);
			$_SESSION["cart_order_hash"] = $orderhash;
		}

		if (!$orderhash) {
			notice ( t('Order not found.' . EOL));
			return "<h1>Order Not Found</h1>";
		} else {
	                $observerhash = get_observer_hash();
			$r = null;
	                if ($observerhash === '') {
				$observerhash = null;
			} else {
				$buyerhashes=Cart::get_xchan_hashes($observerhash);
				$buyerhashes_sql = Cart::channel_hashes_sql ($buyerhashes,'buyer_xchan');
		        	$r = q("select * from cart_orders where order_hash = '%s' and %s limit 1",
                                 	dbesc($orderhash),$buyerhashes_sql);
			}
                        if (!$r) {
			  notice ( t('Access denied.' . EOL));
			  return "<h1>Access denied</h1>";
        		}
      		}
                $order=cart_loadorder($orderhash);
		return cart_do_display($order);
	}

    if ((argc() >= 3) && (argv(2) == 'catalog')) {
		$items = Array();

		call_hooks('cart_get_catalog',$items);
		call_hooks('cart_filter_catalog_display',$items);

		$total_qty = 0;
		$orderhash = cart_getorderhash(false);
		if ($orderhash) {
			$order = cart_loadorder($orderhash);

			$x = [];
			foreach($order['items'] as $oitem) {
				if(array_key_exists($oitem['item_sku'], $items)) {
					$x[$oitem['item_sku']]=$x[$oitem['item_sku']]+$oitem['item_qty'];
				}
				$items[$oitem['item_sku']]['order_qty'] = $x[$oitem['item_sku']];
			}

			$total_qty = cart_get_order_total_qty($orderhash);
		}


		if (count($items)<1) {
			return "<H1>Catalog has no items</H1>";
		}

		$templateinfo = array('name'=>'basic_catalog.tpl','path'=>'addon/cart/');
		call_hooks('cart_filter_catalogtemplate',$templateinfo);
		$template = get_markup_template($templateinfo['name'],$templateinfo['path']);
		return replace_macros($template, array(
			'$items' => $items,
			'$total_qty' => $total_qty,
			'$sellernick' => $sellernick
		));
	}

	if ((argc() >= 3) && (argv(2) == 'checkout')) {
		if (argc() == 3) {
			goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
		}
		$orderhash = cart_getorderhash(false);

		if (!$orderhash) {
			return "<h1>".t("No Order Found")."</h1>";
		}

		$order = cart_loadorder($orderhash);

		$hookname='cart_checkout_'.argv(3);
		$order["checkoutdisplay"]='';
		call_hooks($hookname,$order);
		if ($order["checkoutdisplay"]=='' && argc(3)!='start') {
			notice(t("An unknown error has occurred Please start again.") . EOL );
			goaway(z_root() . '/cart/' . $sellernick . '/checkout/start');
		}
		return $order["checkoutdisplay"];
	}

	$menu = '';
	$templatevalues = Array("menu"=>$menu);
	call_hooks('cart_mainmenu_filter',$templatevalues);

        $template = get_markup_template('menu.tpl','addon/cart/');
	$page = replace_macros($template, $templatevalues);

  if ((argc() > 2)) {
    $hookname=preg_replace('/[^a-zA-Z0-9\_]/','',argv(2));
		call_hooks('cart_main_'.$hookname,$page);
  }
	return $page;

}

function cart_display_before_addcheckoutlink(&$order) {
	$order["links"]["checkoutlink"]=z_root().'/cart/'.argv(1).'/checkout/start?cart='.$order["order_hash"];
}

function cart_display_before_formatcurrency(&$order) {
	foreach ($order["items"] as $item) {
          $order["items"][$item["id"]]["extended"]=cart_formatamount($item["extended"]);
          $order["items"][$item["id"]]["item_price"]=cart_formatamount($item["item_price"]);
	}
}

function cart_display_applytemplate(&$order) {
	$templateinfo = array('name'=>'basic_cart.tpl','path'=>'addon/cart/');
	call_hooks('cart_filter_carttemplate',$templateinfo);
	$template = get_markup_template($templateinfo['name'],$templateinfo['path']);
	call_hooks('cart_show_order_filter',$cart_template);
	$order["content"] = replace_macros($template, $order);
}


$cart_aside = Array();

function cart_insert_aside ($html,$slug,$priority=35000) {
	global $cart_aside;
	/*
	*  html - HTML to add to aside
	*  slug - unique slug
	*  priority - display priority
	*/

	$cart_aside[$slug][$priority]="<div class='cart-aside-entry cart-aside-'".$slug.">".$html."</div>";
}

function cart_del_aside ($slug) {
  global $cart_aside;

	unset($cart_aside['slug']);
}

function cart_render_aside (&$aside) {
	$rendered = '';
	$orderhash = cart_getorderhash(false);
	$itemscount = cart_get_order_total_qty($orderhash);

        $rendered .= "<li><a class='nav-link' href='/" . argv(0) . "/" . argv(1) . "/catalog'>Catalog</a></li>\n";

	if($itemscount) {
		$rendered .= "<li><a class='nav-link' href='".z_root() . '/cart/' . argv(1) . '/checkout/start'."'>Checkout (" . $itemscount . " items)</a></li>\n";
	}

	$templatevalues['content'] = $rendered;
	$template = get_markup_template('cart_aside.tpl', 'addon/cart/');
	$rendered = replace_macros($template, $templatevalues);
	$rendered .= $aside;
	$aside = '<ul class="nav nav-pills flex-column">' . $rendered . '</ul>' . $aside;
}

function cart_get_order_total_qty($orderhash) {
	if(! $orderhash)
		return;

	$order = cart_loadorder($orderhash);

	$order_total_qty = 0;
	foreach($order['items'] as $item) {
		$order_total_qty = $order_total_qty + $item['item_qty'];
	}

	return $order_total_qty;
}

function cart_checkout_pay (&$hookdata) {

	call_hooks ("cart_before_payment",$hookdata);

	if ($hookdata["checkoutdisplay"]=='') {
		$paytype=$hookdata["order_meta"]["paytype"];
		$paymentopts = Array();
		call_hooks('cart_paymentopts',$paymentopts);
		$hookdata["paymentopts"] = $paymentopts;
		if (!isset($paymentopts[$paytype])) {
			notice("Unknown Payment Type.  Please try again." . EOL);
			goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
		}
		goaway(z_root() . '/cart/' . argv(1) . '/checkout/pay_'.$paytype);
	}

}

function cart_checkout_start (&$hookdata) {
	$display = $hookdata["checkoutdisplay"];
	cart_do_checkout_before($hookdata);

	$paymentopts = Array();
	call_hooks('cart_paymentopts',$paymentopts);
	/*
	 * @todo: filter $paymentopts by "enabled" & properly configured payment options
	 */

	$hookdata["paymentopts"] = $paymentopts;
	/*
	 * Each element of the ["paymentopts"] array is expected to have the following structure:
	 * ["{paymenttypeslug}"] => Array (
	 *                          "Name" => {name of payment type}
	 * 							"Description" => {Description of payment type}
	 * 							"html" => {html to present - (link to ../checkout/confirm/paymenttypeslug)}
	 * 							)
	 * NOTE: Slugs can only contain the characters A-Za-z0-9_-
	 */

	$orderhash = cart_getorderhash(false);

	if (!$orderhash) {
		return "<h1>".t("No Order Found")."</h1>";
	}

	$order = cart_loadorder($orderhash);
	$ordermeta = cart_getorder_meta($orderhash);
	unset($ordermeta["paytype"]);
	cart_updateorder_meta($ordermeta,$orderhash);
	$hookdata["order_meta"]=$ordermeta;
	$hookdata["readytopay"]=1;
	$hookdata['text']['readytopayrequirementsnotmet'] = t('Requirements not met.').' '.t('Review your order and complete any needed requirements.');
	call_hooks('cart_before_checkout',$hookdata);
	call_hooks('cart_display_before',$hookdata);

	$template = get_markup_template('basic_checkout_start.tpl','addon/cart/');

	$nick = App::$profile['channel_address'];

	$hookdata["links"]["cataloglink"] = z_root() . '/cart/' . $nick . '/catalog';
	$hookdata["links"]["checkoutlink"] = z_root() . '/cart/' . $nick . '/checkout/start?cart='.$order["order_hash"];

	$display = replace_macros($template, $hookdata);

	$hookdata["checkoutdisplay"] = $display;
	call_hooks ('cart_checkout_start_filter',$hookdata);
	return $hookdata["checkoutdisplay"];
}

function cart_post_choose_payment () {

    if (isset($_POST["paymenttypeslug"])) {
        $paymentopts = Array();
        call_hooks('cart_paymentopts',$paymentopts);
        $hookdata["paymentopts"] = $paymentopts;
        $payslug = preg_replace("/[^a-zA-Z0-9\-_]/",'',$_POST["paymenttypeslug"]);
        if (!isset($paymentopts[$payslug])) {
 		notice(t('Invalid Payment Type.  Please start again.') . EOL);
	  	goaway(z_root() . '/cart/' . argv(1) . '/checkout/start');
        }

	$orderhash = cart_getorderhash(false);

	if (!$orderhash) {
  	  notice(t("Order not found"));
	    goaway(z_root() . '/cart/' . argv(1));
	}

	$ordermeta = cart_getorder_meta($orderhash);
        $ordermeta["paytype"]=$payslug;
        cart_updateorder_meta($ordermeta,$orderhash);
        goaway(z_root() . '/cart/' . argv(1) . '/checkout/'.$payslug);
      }

      goaway(z_root() . '/cart/' . argv(1) . '/checkout/pay');
}

function cart_get_test_catalog (&$items) {
	//$testcatalog = get_pconfig ( \App::$profile['profile_uid'] ,'cart','enable_test_catalog');
	$testcatalog = cart_getcartconfig ('enable_test_catalog');
	$testcatalog = $testcatalog ? $testcatalog : 0;
	if (!$testcatalog) { return; }

	if (!is_array($items)) {$items = Array();}

	$items= array_merge($items,Array (
		"sku-1"=>Array("item_sku"=>"sku-1","item_desc"=>"Description Item 1","item_price"=>5.55),
		"sku-2"=>Array("item_sku"=>"sku-2","item_desc"=>"Description Item 2","item_price"=>6.55),
		"sku-3"=>Array("item_sku"=>"sku-3","item_desc"=>"Description Item 3","item_price"=>7.55),
		"sku-4"=>Array("item_sku"=>"sku-4","item_desc"=>"Description Item 4","item_price"=>8.55),
		"sku-5"=>Array("item_sku"=>"sku-5","item_desc"=>"Description Item 5","item_price"=>9.55),
		"sku-6"=>Array("item_sku"=>"sku-6","item_desc"=>"Description Item 6","item_price"=>10.55)
	));

}

function cart_do_fulfillitem ($iteminfo) {
  $orderhash=$iteminfo["order_hash"];
  $order=cart_loadorder($orderhash);
  $iteminfo = isset($iteminfo["item_type"]) ? $iteminfo : $order["items"][$iteminfo["id"]];
  //$iteminfo = $order["items"][$iteminfo["id"]];

  $valid_itemtypes = cart_getitemtypes();
	$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
  if ($itemtype && !in_array($iteminfo['item_type'],$valid_itemtypes)) {
		$itemtype=null;
	}

	$calldata=Array();
  $calldata["orderid"]=$order["id"];
  $calldata['item']=$iteminfo;

	if ($itemtype) {
		$itemtypehook='cart_before_fulfill_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		if (isset($calldata["error"])) {
			$hookdata["error"]=$calldata["error"];
			cart_fulfillitem_error($calldata["error"],$iteminfo["id"],$iteminfo["order_hash"]);
			return;
		}
	}

	call_hooks('cart_before_fulfill',$calldata);
	if (isset($calldata["error"])) {
		$hookdata["error"]=$calldata["error"];
		cart_fulfillitem_error($calldata["error"],$iteminfo["id"],$iteminfo["order_hash"]);
		return;
	}

	if ($itemtype) {
		$itemtypehook='cart_fulfill_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
	}

	$calldata["fulfillment_errors"]=Array();
	call_hooks('cart_order_fulfill',$calldata);
	foreach($calldata["fulfillment_errors"] as $error) {
		if (is_array($error)) {
		  cart_fulfillitem_error(print_r($error,true),$iteminfo["id"],$iteminfo["order_hash"]);
	  } else {
			cart_fulfillitem_error($error,$iteminfo["id"],$iteminfo["order_hash"]);
		}
	}

	if ($itemtype) {
		$itemtypehook='cart_after_fulfill_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
	}

	call_hooks('cart_after_fulfill',$calldata);
}

function cart_do_cancelitem ($iteminfo) {
  $orderhash=$iteminfo["order_hash"];
  $order=cart_loadorder($orderhash);
  //$iteminfo = $order["items"][$iteminfo["id"]];
  $iteminfo = isset($iteminfo["item_type"]) ? $iteminfo : $order["items"][$iteminfo["id"]];
  $valid_itemtypes = cart_getitemtypes();
	$itemtype = isset($iteminfo["item_type"]) ? $iteminfo["item_type"] : null;
  if ($itemtype && !in_array($iteminfo['item_type'],$valid_itemtypes)) {
	$itemtype=null;
  }

  $calldata=Array();
  $calldata["orderid"]=$order["id"];
  $calldata['item']=$iteminfo;

	if ($itemtype) {
		$itemtypehook='cart_before_cancel_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
		if (isset($calldata["error"])) {
			$hookdata["error"]=$calldata["error"];
			cart_fulfillitem_error($calldata["error"],$iteminfo["id"],$iteminfo["order_hash"]);
			return;
		}
	}
	call_hooks('cart_before_cancel',$calldata);
	if (isset($calldata["error"])) {
		$hookdata["error"]=$calldata["error"];
		cart_fulfillitem_error($calldata["error"],$iteminfo["id"],$iteminfo["order_hash"]);
		return;
	}

	if ($itemtype) {
	  $itemtypehook='cart_cancel_'.$itemtype;
	  call_hooks($itemtypehook,$calldata);
	}

	$calldata["rollback_errors"]=Array();
	call_hooks('cart_order_cancel',$calldata);
	foreach($calldata["rollback_errors"] as $error) {
		if (is_array($error)) {
		  cart_fulfillitem_error(print_r($error,true),$iteminfo["id"],$iteminfo["order_hash"]);
	  } else {
			cart_fulfillitem_error($error,$iteminfo["id"],$iteminfo["order_hash"]);
		}
	}

	if ($itemtype) {
		$itemtypehook='cart_after_cancel_'.$itemtype;
		call_hooks($itemtypehook,$calldata);
	}

	call_hooks('cart_after_cancel',$calldata);
}

function cart_fulfillitem_markfulfilled(&$hookdata) {
  $orderhash=$hookdata["item"]["order_hash"];
  $itemid=$hookdata["item"]["id"];


  $r=q("update cart_orderitems set item_fulfilled = 1 where order_hash = '%s' and id=%d",
			dbesc($orderhash),intval($itemid));
  $item_meta=cart_getitem_meta ($itemid,$orderhash);
  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Item Fulfilled";
  cart_updateitem_meta($itemid,$item_meta,$orderhash);

}

function cart_fulfillitem_unmarkfulfilled(&$hookdata) {
  $orderhash=$hookdata["item"]["order_hash"];
  $itemid=$hookdata["item"]["id"];
  $r=q("update cart_orderitems set item_fulfilled = 0 where order_hash = '%s' and id=%d",
			dbesc($orderhash),intval($itemid));
  $item_meta=cart_getitem_meta ($itemid,$orderhash);
  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Item fulfillment rolled back.";
  cart_updateitem_meta($itemid,$item_meta,$orderhash);
}

function cart_add_error($errors,$new_error) {
	if (!is_array($errors)) {
		$firsterr=$errors;
		$errors=Array();
		if ($firsterr) {
			$errors[]=$firsterr;
		}
	} else {
		$errors[]=$new_error;
	}
	return $errors;
}

function cart_item_note($note,$itemid,$orderhash) {
	$item_meta=cart_getitem_meta ($itemid,$orderhash);
	if (is_array($error)) {
		foreach ($error as $errtxt) {
		  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ").$errtxt;
		}
	} else {
	  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ").$error;
	}
	cart_updateitem_meta($itemid,$item_meta,$orderhash);
}

function cart_fulfillitem_error($error,$itemid,$orderhash) {
	$item_meta=cart_getitem_meta ($itemid,$orderhash);
	if (is_array($error)) {
		foreach ($error as $errtxt) {
		  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Error fulfilling item: ".$errtxt;
		}
	} else {
	  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Error fulfilling item: ".$error;
	}

  if ($exception) {
	  $r=q("update cart_orderitems set item_exception = 1 where order_hash = '%s' and id = %d",
			dbesc($orderhash),intval($itemid));
	  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Exception Set";
  }

	cart_updateitem_meta($itemid,$item_meta,$orderhash);
}

function cart_after_fulfill_finishorder(&$hookdata) {
	$iteminfo=$hookdata["item"];
	$orderhash=$iteminfo["order_hash"];

	$r=q("SELECT cart_orderitems.id FROM cart_orderitems WHERE
		cart_orderitems.item_fulfilled = 0 AND
		cart_orderitems.order_hash = '%s' LIMIT 1",
		dbesc($orderhash)
	);

	if ($r) {
		return;
	}

	$calldata = [ 'orderhash' => $orderhash ];
	call_hooks('cart_after_orderfulfilled', $calldata);
}


function cart_cancelitem_unmarkfulfilled(&$hookdata) {

  if (isset($hookdata["item"]["proxy_item"])) {
    return;
  }
  $orderhash=$hookdata["item"]["order_hash"];
  $itemid=$hookdata["item"]["id"];
  $r=q("update cart_orderitems set item_fulfilled = 0 where order_hash = '%s' and id=%d",
			dbesc($orderhash),intval($itemid));
  $item_meta=cart_getitem_meta ($itemid,$orderhash);
  $item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Item Cancelled (rollback fulfillment)";
  cart_updateitem_meta($itemid,$item_meta,$orderhash);
}

function cart_cancelitem_error($error,$itemid,$orderhash) {
	$item_meta=cart_getitem_meta ($itemid,$orderhash);
	$item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Error cancelling item: ".$error;

	$r=q("update cart_orderitems set item_exception = 1 where order_hash = '%s' and id = %d",
			dbesc($orderhash),intval($itemid));

	$item_meta["notes"][]=date("Y-m-d h:i:sa T - ")."Exception Set";
	cart_updateitem_meta($itemid,$item_meta,$orderhash);
}

/*
function cart_ordersearch_params($params) {

	$keys = Array (
		"order_hash"=>Array("key"=>"order_hash","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_desc"=>Array("key"=>"item_desc","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_type"=>Array("key"=>"item_type","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_sku"=>Array("key"=>"item_sku","cast"=>"'%s'","escfunc"=>"dbesc"),
		"item_qty"=>Array("key"=>"item_qty","cast"=>"%d","escfunc"=>"intval"),
		"item_price"=>Array("key"=>"item_price","cast"=>"%f","escfunc"=>"floatval"),
		"item_tax_rate"=>Array("key"=>"item_tax_rate","cast"=>"%f","escfunc"=>"floatval"),
		"item_meta"=>Array("key"=>"item_meta","cast"=>"'%s'","escfunc"=>"dbesc"),
		);

	$colnames = '';
	$valuecasts = '';
	$params = Array();
	$count=0;
	foreach ($keys as $key=>$cast) {
		if (isset($search[$key])) {
			$colnames .= ($count > 0) ? "," : '';
			$colnames .= $cast["key"];
			$valuecasts .= ($count > 0) ? "," : '';
			$valuecasts .= $cast["cast"];
                        $escfunc = $cast["escfunc"];
			$params[] = $escfunc($item[$key]);
			$count++;
		}
	}
}

function cart_search_orders() {


}
/* FUTURE/TODO

function cart_myshop_searchparams ($search) {

*/

function cart_add_item_note($orderhash,$itemid,$note) {
     $item_meta=cart_getitem_meta ($itemid,$orderhash);
     $item_meta["notes"][]=date("Y-m-d h:i:sa T - ").$note;
     cart_updateitem_meta($itemid,$item_meta,$orderhash);
}
