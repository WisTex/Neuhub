<?php
/**
 * Name: hzservices
 * Description: Submodule for the Hubzilla Cart system to allow premium
 *              services.
 * Version: 0.2
 * MinCartVersion: 0.8
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 2.8
 */

use Zotlabs\Lib\Apps;
use Zotlabs\Lib\Connect;
use Zotlabs\Lib\Libsync;
use Zotlabs\Lib\AccessList;

class Cart_hzservices {

    public static $catalog=array();

    public function __construct() {
      load_config("cart-hzservices");
    }

    static public function load (){
      Zotlabs\Extend\Hook::register('cart_addon_settings', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::addon_settings',1);
      Zotlabs\Extend\Hook::register('cart_addon_settings_post', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::addon_settings_post',1);

      Zotlabs\Extend\Hook::register('cart_myshop_menufilter', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::myshop_menuitems',1,1001);
      Zotlabs\Extend\Hook::register('cart_myshop_hzservices', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::itemadmin',1,1001);
      Zotlabs\Extend\Hook::register('cart_fulfill_hzservices', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::fulfill_hzservices',1,1001);
      Zotlabs\Extend\Hook::register('cart_cancel_hzservices', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::rollback_hzservices',1,1001);
      Zotlabs\Extend\Hook::register('cart_get_catalog', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::get_catalog',1,1001);
      Zotlabs\Extend\Hook::register('cart_filter_catalog_display', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::filter_catalog_display',1,1001);
      Zotlabs\Extend\Hook::register('cart_post_hzservices_itemedit', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::itemedit_post',1,1001);
      Zotlabs\Extend\Hook::register('cart_post_hzservices_itemactivation', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::itemedit_activation_post',1,1001);
      Zotlabs\Extend\Hook::register('cart_post_hzservices_itemdeactivation', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::itemedit_deactivation_post',1,1001);
      Zotlabs\Extend\Hook::register('cart_submodule_activation', 'addon/cart/submodules/hzservices.php', 'Cart_hzservices::module_activation',1,1001);
      Zotlabs\Extend\Hook::register('cart_order_before_additem_hzservices', 'addon/cart/submodule/hzservices.php', 'Cart_hzservices::filter_before_add',1,1001);
    }

    static public function unload () {
      Zotlabs\Extend\Hook::unregister_by_file('addon/cart/submodules/hzservices.php');
    }

    static public function module_activation (&$hookdata) {
      logger("MODULE ACTIVATION: hzservices",LOGGER_DEBUG);
      cart_config_additemtype("hzservices");
    }

    static public function module_deactivation (&$hookdata) {
      //cart_config_delitemtype("hzservices");
    }

    static public function addon_settings (&$sc) {
      $id = local_channel();
      if (! $id)
        return;

      if (! Apps::addon_app_installed($id, 'cart')) {
         return;
      }
      $enable_hzservices = get_pconfig ($id,'cart_hzservices','enable');
      $sc .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'	=> array('enable_cart_hzservices', t('Enable Hubzilla Services Module'),
                   (isset($enable_hzservices) ? intval($enable_hzservices) : 0),
                   '',array(t('No'),t('Yes')))));

    }

    static public function addon_settings_post () {
      if(!local_channel())
        return;

      if (! Apps::addon_app_installed(local_channel(), 'cart')) {
        return;
      }

      $enable_cart_hzservices = isset($_POST['enable_cart_hzservices']) ? intval($_POST['enable_cart_hzservices']) : 0;
      set_pconfig( local_channel(), 'cart_hzservices', 'enable', $enable_cart_hzservices );

      Cart_hzservices::unload();
      Cart_hzservices::load();
    }

  static public function item_fulfill(&$orderitem) {
    // LOCK SKU from future edits.
    $skus=Cart_hzservices::get_itemlist();
    $skus[$orderitem["item"]["item_sku"]]["locked"]=true;
    Cart_hzservices::save_itemlist($skus);
  }

  static public function get_catalog(&$catalog) {
    if (count(Cart_hzservices::$catalog) > 0) return Cart_hzservices::$catalog;
    // 		"sku-1"=>Array("item_sku"=>"sku-1","item_desc"=>"Description Item 1","item_price"=>5.55),
    logger("HZServices - get catalog",LOGGER_DEBUG);
    $itemlist = Cart_hzservices::get_itemlist();
    foreach ($itemlist as $item) {
      //$active = isset($item["item_active"]) ? $item["item_active"] : false;
      //if ($active) {
        $catalog[$item["item_sku"]] = Array("item_sku"=>$item["item_sku"],
          "item_desc"=>$item["item_description"],
          "item_price"=>$item["item_price"],
          "item_photo_url"=>$item["item_photo_url"],
          "item_type"=>"hzservices",
          "item_activate_commands"=>$item["activate_commands"],
          "item_deactivate_commands"=>$item["deactivate_commands"],
          "locked"=>false
        );
      //}
    }
  }

  static public function filter_catalog_display(&$catalog) {
    $itemlist = Cart_hzservices::get_itemlist();
    foreach ($itemlist as $item) {
      if (!isset($item["item_active"]) || $item["item_active"] == 0) {
        unset($catalog[$item["item_sku"]]);
      }
    }
  }

  static public function canact($item) {
    //@TODO
    //Verify that all activate commands can be done
    return true;
  }

  static public function get_itemlist() {
    //$skus = get_pconfig(local_channel(),'cart-hzservices','skus');
    $skus = get_pconfig(Cart::get_seller_id(),'cart-hzservices','skus');
    $skus = $skus ? cart_maybeunjson($skus) : Array();
    return $skus;
  }

  static public function save_itemlist($itemlist) {
    $items=cart_maybejson($itemlist);
    set_pconfig(Cart::get_seller_id(),'cart-hzservices','skus',$items);
  }

  static public function itemadmin(&$pagecontent) {
    $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);
    if (!$is_seller) {
      notice ("Access Denied.".EOL);
      return;
    }

    /*have SKU - display edit*/
    $sku = isset($_REQUEST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_REQUEST["SKU"]) : null;
    if ($sku) {
      $pagecontent=Cart_hzservices::itemedit_form($sku);
      call_hooks('itemedit_formextras',$pagecontent);
      return;
    }

    /*no SKU - List existing SKUs and provide new SKU textbox*/
    $skus = get_pconfig(local_channel(),'cart-hzservices','skus');
    $skus = $skus ? cart_maybeunjson($skus) : Array();
    $skulist = '';
    $templatevalues=Array("security_token"=>get_form_security_token(),"skus"=>$skus);
    $skulist .= replace_macros(get_markup_template('hzservices.itemadmin.skulist.tpl','addon/cart/submodules/'),$templatevalues);

    $formelements= replace_macros(get_markup_template('field_input.tpl'), array(
                '$field'	=> array('SKU', t('New Sku'), "")));
    $formelements.=' <button class="btn btn-sm" type="submit" name="submit"><i class="fa fa-plus fa-fw" aria-hidden="true"></i></button>';
    $macrosubstitutes=Array("security_token"=>get_form_security_token(),"skulist"=>$skulist,"formelements"=>$formelements);

    $pagecontent .= replace_macros(get_markup_template('hzservices.itemadmin.tpl','addon/cart/submodules/'),$macrosubstitutes);
  }

  static public function itemedit_post() {

    if (!check_form_security_token()) {
  		notice (check_form_security_std_err_msg());
  		return;
  	}

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);
    if (!$is_seller) {
      notice ("Access Denied.".EOL);
      return;
    }
    $skus = get_pconfig(local_channel(),'cart-hzservices','skus');
    $skus = $skus ? cart_maybeunjson($skus) : Array();

    $sku = isset($_POST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["SKU"]) : null;
    if (trim($sku)=='') {
      return;
    }

    if (!isset($skus[$sku])) {
      $item=Array();
      $item["item_sku"]=$sku;
    } else {
      $item=$skus[$sku];
    }

    if ($item["item_locked"] && isset($_POST["item_locked"])) {
      notice (t("Cannot save edits to locked item.").EOL);
      return;
    }
    $item["item_description"] = isset($_POST["item_description"]) ? $_POST["item_description"] : $item["item_description"];
    $item["item_price"] = isset($_POST["item_price"]) ? $_POST["item_price"]+0 : $item["item_price"];
    $item["item_photo_url"] = isset($_POST["item_photo_url"]) ? $_POST["item_photo_url"] : $item["item_photo_url"];
    $item["item_active"] = isset($_POST["item_active"]) ? true : false;
    $item["item_locked"] = isset($_POST["item_locked"]) ? true : false;
    $skus[$sku]=$item;
    if ($item["item_active"]) {
       cart_config_additemtype('hzservices');
    }
    set_pconfig( local_channel(), 'cart-hzservices', 'skus', cart_maybejson($skus));
  }

  public static $activators = Array (
    "addconnection" => "Add Purchaser as Connection",
    "addtoprivacygroup" => "Add Purchaser to Privacy Group"
  );

  static public function get_groups ($uid,$match='') {
            $grps = array();
            $o = '';

            $r = q("SELECT * FROM pgrp WHERE deleted = 0 AND uid = %d ORDER BY gname ASC",
                    intval($uid)
            );
            $grps[] = array('name' => '', 'hash' => '0', 'selected' => '');
            if($r) {
                    foreach($r as $rr) {
                            $grps[] = array('name' => $rr['gname'], 'id' => $rr['hash'], 'selected' => (($match == $rr['hash']) ? 'true' : ''));
                    }

            }
            return $o;
  }

  static public function itemedit_activation_post () {
    if (!check_form_security_token()) {
  		notice (check_form_security_std_err_msg());
  		return;
  	}
    $items=get_pconfig(local_channel(),'cart-hzservices','skus');
    $items = $items ? cart_maybeunjson($items) : Array();
    $sku = isset($_POST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["SKU"]) : null;

    $item= isset ($items[$sku]) ? $items[$sku] : null;

    if (!$item) {
      notice (t('SKU not found.')."[".$sku."]".EOL);
      return;
    }
    if ($item["item_locked"]) {
      notice ("Cannot save edits to locked item.");
      return;
    }

    if (isset($_POST["cmd"]) && !isset($_POST["del"])) {
     switch (strtolower($_POST["cmd"])) {
      case "addconnection":
        $cmdhash = md5("addconnection");
        $item["activate_commands"][$cmdhash]=Array(
          "cmdhash"=>$cmdhash,
          "cmd"=>"addconnection",
          "params"=>Array()
        );
        $cmdhash = md5("rmvconnection");
        $item["deactivate_commands"][$cmdhash]=Array(
          "cmdhash"=>$cmdhash,
          "cmd"=>"rmvconnection",
          "params"=>Array()
        );
        break;
      case "addtoprivacygroup":
        $privacygroup = isset($_POST['group-selection']) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST['group-selection']) : null;
        $cmdhash = md5("addtoprivacygroup".$privacygroup);
        $item["activate_commands"][$cmdhash]=Array(
          "cmdhash"=>$cmdhash,
          "cmd"=>"addtoprivacygroup",
          "params"=>Array("group"=>$privacygroup)
        );
        $cmdhash = md5("rmvfromprivacygroup".$privacygroup);
        $item["deactivate_commands"][$cmdhash]=Array(
          "cmdhash"=>$cmdhash,
          "cmd"=>"rmvfromprivacygroup",
          "params"=>Array("group"=>$privacygroup)
        );
        break;
      case "setsvcclass":
        if (Cart_hzservices::is_admin_merchant()) {
          $svcclass=$_POST["svcclass"];
          if (!isset(App::$config['service_class'][$svcclass])) {
            logger("Attempt to set invalid service class: ".$svcclass,LOGGER_NORMAL);
            break;
          }
          $cmdhash = md5("setsvcclass".$svcclass);
          $item["activate_commands"][$cmdhash]=Array(
            "cmdhash"=>$cmdhash,
            "cmd"=>"setsvcclass",
            "params"=>Array("class"=>$svcclass)
          );
        } else {
          notice (t('Invalid Activation Directive.').EOL);
        }
        break;
      default:
        notice (t('Invalid Activation Directive.').EOL);
        return;
     }
    } else {
     if ($_POST["del"]) {
        $delcommand = isset($_POST['del']) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST['del']) : null;
        logger ("DEL COMMAND: ".$delcommand,LOGGER_DEBUG);
        if ($delcommand) {
          unset($item["activate_commands"][$delcommand]);
        }
     }
    }

    $items[$sku]=$item;
    set_pconfig( local_channel(), 'cart-hzservices', 'skus', cart_maybejson($items));
  }


  static public function itemedit_deactivation_post () {
    if (!check_form_security_token()) {
  		notice (check_form_security_std_err_msg());
  		return;
  	}
    $items=get_pconfig(local_channel(),'cart-hzservices','skus');
    $items = $items ? cart_maybeunjson($items) : Array();
    $sku = isset($_POST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["SKU"]) : null;

    $item= isset ($items[$sku]) ? $items[$sku] : null;

    if (!$item) {
      notice (t('SKU not found.').EOL);
      return;
    }
    if ($item["item_locked"]) {
      notice ("Cannot save edits to locked item.");
      return;
    }
    if (isset($_POST["cmd"]) && !isset($_POST["del"])) {
     switch (strtolower($_POST["cmd"])) {
      case "rmvconnection":
        $item["deactivate_commands"][]=Array(
          "cmdhash"=>md5("delconnection".$privacygroup),
          "cmd"=>"rmvconnection",
          "params"=>Array()
        );
        $item["deactivate_commands"]=array_unique($item["deactivate_commands"]);
        break;
      case "rmvfromprivacygroup":
        $privacygroup=$_POST["group"];

        $item["deactivate_commands"][]=Array(
          "cmdhash"=>md5("delfromprivacygroup".$privacygroup),
          "cmd"=>"rmvfromprivacygroup",
          "params"=>Array("group"=>$privacygroup)
        );
        $item["deactivate_commands"]=array_unique($item["deactivate_commands"]);
        break;
      case "setsvcclass":
        if (Cart_hzservices::is_admin_merchant()) {
          $svcclass=$_POST["svcclass"];
          if (!isset(App::$config['service_class'][$svcclass])) {
            logger("Attempt to set invalid service class: ".$svcclass,LOGGER_NORMAL);
            break;
          }
          $cmdhash = md5("setsvcclass".$svcclass);
          $item["deactivate_commands"][$cmdhash]=Array(
            "cmdhash"=>$cmdhash,
            "cmd"=>"setsvcclass",
            "params"=>Array("class"=>$svcclass)
          );
        } else {
          notice (t('Invalid Deactivation Directive.').EOL);
        }
        break;
      default:
        notice (t('Invalid Deactivation Directive.').EOL);
        return;
     }
    } else {
     if ($_POST["del"]) {
        $delcommand = isset($_POST['del']) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST['del']) : null;
        if ($delcommand) {
          unset($item["deactivate_commands"][$delcommand]);
        }
     }
    }

    $items[$sku]=$item;
    set_pconfig( local_channel(), 'cart-hzservices', 'skus', cart_maybejson($items));

  }

  static public function fulfill_hzservices(&$calldata) {
    $orderhash=$calldata["item"]["order_hash"];
    $order=cart_loadorder($orderhash);
    $seller_hash=$order["seller_channel"];
    $seller_chaninfo = channelx_by_hash($seller_hash);
    $seller_address = $seller_chaninfo["xchan_addr"];
    $seller_uid = $seller_chaninfo["channel_id"];
    $buyer_xchan = $order["buyer_xchan"];
    $buyer_channel = xchan_fetch(Array("hash"=>$buyer_xchan));
    $skus=get_pconfig(App::$profile['uid'],'cart-hzservices','skus');
    $skus = $skus ? cart_maybeunjson($skus) : Array();
    $sku = $calldata["item"]["item_sku"];

    $item= isset ($skus[$sku]) ? $skus[$sku] : null;

    $commandlist = $item["activate_commands"];

    foreach ($commandlist as $command) {
      switch ($command["cmd"]) {
        case "addtoprivacygroup":
          $grouphash = $command["params"]["group"];
          $grouprecord = AccessList::by_hash($seller_uid,$grouphash);
          if (!$grouprecord) {
            $errortext = "Unable to add buyer to group: [Group Not Found] ".$groupname;
            $calldata["fulfillment_errors"][]=$errortext;
          }
          $groupname = $grouprecord["gname"];
          $r = AccessList::member_add($seller_uid,$groupname,$buyer_xchan);
          if (!$r) {
            $errortext = "Unable to add buyer to group: [Add Failed] ".$groupname;
            $calldata["fulfillment_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
            //continue;
          }
          break;
        case "addconnection":
          notice ("Add connection".EOL);
          $buyer_url=$buyer_channel["address"];

          $result = Connect::connect($seller_chaninfo,$buyer_url);
          if (!$result["success"]){
            $errortext = $result["message"];
            $calldata["fulfillment_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
            return;
          }
          break;
        case "setsvcclass":
          if (Cart_hzservices::buyer_is_local($buyer_xchan)) {
              $r = q("UPDATE account SET account_service_class='%s' WHERE account_id=%d",
                dbesc($command["params"]["class"]),
                intval(Cart_hzservices::get_account_id_from_channel_hash($buyer_xchan))
              );
              if($r) {
                logger("Account (".Cart_hzservices::get_account_id_from_channel_hash($buyer_xchan)
                                .") changed to service class: ".$command["params"]["class"],LOGGER_NORMAL);
              } else {
                $errortext = "FAILURE: Account NOT changed to service class: ".$cmd["params"]["class"];
                $calldata["fullfilment_errors"][]=$errortext;
                logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
              }
          }
          break;
        default:
      }
    }
  }

  static public function set_user_svcclass($uid,$class) {

  }

  static public function rollback_hzservices(&$calldata) {
    $orderhash=$calldata["item"]["order_hash"];
    $order=cart_loadorder($orderhash);

    $seller_hash=$order["seller_channel"];
    $seller_chaninfo = channelx_by_hash($seller_hash);
    $seller_address = $seller_chaninfo["xchan_address"];
    $seller_uid = $seller_chaninfo["channel_id"];
    $buyer_xchan = $order["buyer_xchan"];
    $buyer_channel = xchan_fetch(Array("hash"=>$buyer_xchan));

    $skus=get_pconfig(Cart::$seller["channel_id"],'cart-hzservices','skus');
    $skus = $skus ? cart_maybeunjson($skus) : Array();
    $itemsku = $calldata["item"]["item_sku"];
    $itemid = $calldata["item"]["id"];
    $sku = $skus[$itemsku];
    foreach ($sku["deactivate_commands"] as $command) {
      switch ($command["cmd"]) {
        case "rmvfromprivacygroup":
          $grouphash = $command["params"]["group"];
          $grouprecord = AccessList::by_hash($seller_uid,$grouphash);
          if (!$grouprecord) {
            $errortext = "Unable to remove buyer from group: [Group Not Found] ".$groupname;
            $calldata["rollback_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
          }
          $r = AccessList::member_remove($seller_uid,$groupname,$buyer_xchan);
          if (!$r) {
            $errortext = "Unable to remove buyer from group: ".$groupname;
            $calldata["rollback_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
          }
          break;
        case "rmvconnection":
          $cn = q("SELECT abook_id from abook where abook_channel = %d and abook_self = 0 and abook_xchan = '%s' limit 1",
                  intval($seller_uid),
                  dbesc($buyer_xchan)
                 );
          if (!$cn) {
             continue;
          }

          $removed=contact_remove(Cart::get_seller_id(), $cn[0]['abook_id']);
          Libsync::build_sync_packet($seller_uid,
            array('abook' => array(array(
                  'abook_xchan' => $cn[0]['abook_xchan'],
                  'entry_deleted' => true))
                 )
          );

          if (!$removed) {
            $errortext = "Unable to remove contact";
            $calldata["rollback_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
          }
          break;
          case "setsvcclass":
          if (Cart_hzservices::buyer_is_local($buyer_xchan)) {
              $r = q("UPDATE account SET account_service_class='%s' WHERE account_id=%d",
                dbesc($command["params"]["class"]),
                intval(Cart_hzservices::get_account_id_from_channel_hash($buyer_xchan))
              );
              if($r) {
                logger("Account (".Cart_hzservices::get_account_id_from_channel_hash($buyer_xchan)
                                .") changed to service class: ".$command["params"]["class"],LOGGER_NORMAL);
              } else {
                $errortext = "FAILURE: Account NOT changed to service class: ".$cmd["params"]["class"];
                $calldata["rollback_errors"][]=$errortext;
                logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
              }
          }
          break;
        default:
            $errortext = "Unknown Command";
            $calldata["rollback_errors"][]=$errortext;
            logger($errortext." ORDER: ".$orderhash, LOGGER_NORMAL);
      }
    }
  }

  static public function groupselect($uid,$group='') {
    /* From:  include/groups.php  function mini_groups_select*/
    $grps = array();
    $o = '';

    $r = q("SELECT * FROM pgrp WHERE deleted = 0 AND uid = %d ORDER BY gname ASC",
        intval($uid)
    );
    $grps[] = array('name' => '', 'hash' => '0', 'selected' => '');
    if($r) {
        foreach($r as $rr) {
                $grps[] = array('name' => $rr['gname'], 'id' => $rr['hash'], 'selected' => (($group == $rr['hash']) ? 'true' : ''));
        }

    }

    $o = replace_macros(get_markup_template('group_selection.tpl'), array(
        '$label' => t('Add to this privacy group'),
        '$groups' => $grps
    ));
    return $o;
  }

  static public function service_class_select() {
    $service_classes = isset(\App::$config['service_class']) ? \App::$config['service_class'] : Array ();
    if (count ($service_classes) < 1) {
        return 'No service classes configured.';
    }
    $classes = Array();
    foreach ($service_classes as $class=>$class_info) {
      $classes[$class] = $class;
    }
    $o = replace_macros(get_markup_template('field_select.tpl'), array(
        '$field' => Array('svcclass',t('Set user service class'),'','',$classes)
    ));
    return $o;
  }

  static public function get_account_id_from_channel_hash($hash) {
    $r = q("select channel_account_id,channel_address from channel where channel_hash = '%s'",dbesc($hash));
    if (!$r) { return false; }
    return $r[0]["channel_account_id"];
  }

  static public function buyer_is_local($hash) {
    $accountinfo = Cart_hzservices::get_account_id_from_channel_hash($hash);
    return ( $accountinfo ? true : false );
  }

  static public function filter_before_add(&$hookdata) {

        $order=$hookdata["order"];
        if (!isset($hookdata["item"])) return;
        $item=$hookdata["item"];
        if ($item["item_qty"] < 1) return;
        $hz_catalog=Array();
        Cart_hzservices::get_catalog($hz_catalog);
        if (isset($hz_catalog[$item["sku"]]["activate_commands"])) {
           foreach ($hz_catalog[$item["sku"]]["activate_commands"] as $command) {
             if ($command["cmd"]=="setsvcclass") {
                notice(t("You must be using a local account to purchase this service."));
                unset($hookdata["item"]);
                return;
             }
           }
        }
  }

  static public function is_admin_merchant() {
    $account_id = ((App::$profile['profile_uid']) ? App::$profile['channel_account_id'] : 0 );
    if (!$account_id) {
       return false;
    }
    $merchant_account = get_account_by_id($account_id);
    if ($merchant_account && $merchant_account["account_roles"] == ACCOUNT_ROLE_ADMIN) {
      return true;
    }
    return false;
  }

  static public function itemedit_form($sku) {

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile["profile_uid"]) ? true : false);
    if (!$is_seller) {
      notice ("Access Denied.".EOL);
      return;
    }

    head_add_css("/addon/cart/submodules/view/css/hzservices.css");
    $seller_uid = Cart::get_seller_id();

    $skus = get_pconfig(local_channel(),'cart-hzservices','skus');
    $items = $skus ? cart_maybeunjson($skus) : Array();

    $item= isset ($items[$sku]) ? $items[$sku] : Array("item_sku"=>$sku,"locked"=>0,"item_description"=>"New Item","item_price"=>0,"item_photo_url"=>"","item_active"=>false);

    $formelements["submit"]=t("Submit");
    $formelements["uri"]=strtok($_SERVER["REQUEST_URI"],'?').'?SKU='.$sku;
    // item_locked, item_desc, item_price, item_active
    $formelements["itemdetails"].= replace_macros(get_markup_template('field_checkbox.tpl'), array(
  				     '$field'	=> array('item_locked', t('Changes Locked'),
  							 (isset($item["item_locked"]) ? $item["item_locked"] : 0),
  							 '',array(t('No'),t('Yes')))));
    $formelements["itemdetails"].= replace_macros(get_markup_template('field_checkbox.tpl'), array(
   				     '$field'	=> array('item_active', t('Item available for purchase.'),
							 (isset($item["item_active"]) ? $item["item_active"] : 0),
							 '',array(t('No'),t('Yes')))));
    $formelements["itemdetails"].= replace_macros(get_markup_template('field_input.tpl'), array(
                '$field'	=> array('item_description', t('Description'),
                (isset($item["item_description"]) ? $item["item_description"] : "New Item"))));
    $formelements["itemdetails"].= replace_macros(get_markup_template('field_input.tpl'), array(
                '$field'	=> array('item_price', t('Price'),
                (isset($item["item_price"]) ? $item["item_price"] : "0.00"))));
    $formelements["itemdetails"].= replace_macros(get_markup_template('field_input.tpl'), array(
                '$field'	=> array('item_photo_url', t('Photo URL'),
                (isset($item["item_photo_url"]) ? $item["item_photo_url"] : ''))));
    $formelements["itemactivation"].= "<h3><u>Channel Commands</u></h3>\n";
    $formelements["itemactivation"].= replace_macros(get_markup_template('field_radio.tpl'), array(
   				     '$field'	=> array('cmd', t('Add buyer to privacy group'),
							 "addtoprivacygroup","Add purchaser to the selected privacy group"
							 )));
    $formelements["itemactivation"].=Cart_hzservices::groupselect(App::$profile['uid']);
    $formelements["itemactivation"].= replace_macros(get_markup_template('field_radio.tpl'), array(
   				     '$field'	=> array('cmd', t('Add buyer as connection'),
							 "addconnection","Add purchaser as a channel connection"
							 )));

    if (Cart_hzservices::is_admin_merchant()) {
        $formelements["itemactivation"].= "<div id=\"cart-admin-merchant-activation\">\n";
        $formelements["itemactivation"].= "<h3><u>System Commands</u></h3>\n";
        $formelements["itemactivation"].= replace_macros(get_markup_template('field_radio.tpl'), array(
   				     '$field'	=> array('cmd', t('Set Service Class'),
							 "setsvcclass","Set the service class of the user"
							 )));
        $formelements["itemactivation"].=Cart_hzservices::service_class_select();

        $formelements["itemactivation"].="</div>\n";
    }

    if (isset($item["activate_commands"])) {
      $formelements["activate_commands"]="<UL>\n";
      foreach ($item["activate_commands"] as $command) {
        $cmdtext="";
        switch($command["cmd"]) {
          case "addtoprivacygroup":
            $cmdtext.="Add buyer to privacy group: ";
            $grouprec = AccessList::by_hash($seller_uid,$command["params"]["group"]);
            $cmdtext.=$grouprec["gname"];
            $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
            break;
          case "addconnection":
            $cmdtext.="Add buyer as connection.";
            $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
        }
        if (Cart_hzservices::is_admin_merchant()) {
          switch($command["cmd"]) {
            case 'setsvcclass':
              $cmdtext.="Set service class of user to <b>".$command["params"]["class"]."</b>.";
              $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
              break;
          }
        }


        $formelements["activate_commands"].="<LI>".$cmdtext."</LI>\n";
      }
      $formelements["activate_commands"].="</UL>\n";
    }
    if (isset($item["deactivate_commands"])) {
      if (Cart_hzservices::is_admin_merchant()) {
        $formelements["itemdeactivation"].= "<div id=\"cart-admin-merchant-deactivation\">\n";
        $formelements["itemdeactivation"].= "<h3><u>System Commands</u></h3>\n";
        $formelements["itemdeactivation"].= replace_macros(get_markup_template('field_radio.tpl'), array(
   				     '$field'	=> array('cmd', t('Set Service Class'),
							 "setsvcclass","Set the service class of the user"
							 )));
        $formelements["itemdeactivation"].=Cart_hzservices::service_class_select();

        $formelements["itemdeactivation"].="</div>\n";
      }
      $formelements["deactivate_commands"]="<UL>\n";
      foreach ($item["deactivate_commands"] as $command) {
        $cmdtext="";
        switch($command["cmd"]) {
          case "rmvfromprivacygroup":
            $cmdtext.="Remove buyer from privacy group: ";
            $grouprec = AccessList::by_hash($seller_uid,$command["params"]["group"]);
            $cmdtext.=$grouprec["gname"];
            $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
            break;
          case "rmvconnection":
            $cmdtext.="Remove buyer as connection.";
            $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
        }
        if (Cart_hzservices::is_admin_merchant()) {
          switch($command["cmd"]) {
            case 'setsvcclass':
              $cmdtext.="Set service class of user to <b>".$command["params"]["class"]."</b>.";
              $cmdtext.=' <button class="btn btn-sm" type="submit" name="del" value="'.$command["cmdhash"].'"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></button>';
              break;
          }
        }
        $formelements["deactivate_commands"].="<LI>".$cmdtext."</LI>\n";
      }
      $formelements["deactivate_commands"].="</UL>\n";
    }
    $macrosubstitutes=Array("security_token"=>get_form_security_token(),"sku"=>$sku,"formelements"=>$formelements);

    return replace_macros(get_markup_template('hzservices.itemedit.tpl','addon/cart/submodules/'), $macrosubstitutes);
  }

  static public function myshop_menuitems (&$menu) {
    $urlroot = '/' . argv(0) . '/' . argv(1) . '/myshop';
    $menu .= "<li><a class='nav-link' href='".$urlroot."/hzservices'>Add/Remove Service Items</a></li>";
  }
}

$Cart_hzservices = new Cart_hzservices();
