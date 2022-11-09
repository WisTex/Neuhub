<?php
/**
 * Name: manualcat
 * Description: Submodule for the Hubzilla Cart system to allow premium
 *              services.
 * Version: 0.2
 * MinCartVersion: 0.8
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 2.8
 */

use Zotlabs\Lib\Apps;

class Cart_manualcat {

    public static $catalog=array();

    public function __construct() {
      load_config("cart-manualcat");
    }

    static public function load (){
      Zotlabs\Extend\Hook::register('cart_addon_settings', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::settings',1,1002);
      Zotlabs\Extend\Hook::register('cart_addon_settings_post', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::settings_post',1,1002);
      Zotlabs\Extend\Hook::register('cart_myshop_menufilter', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::myshop_menuitems',1,1002);
      Zotlabs\Extend\Hook::register('cart_myshop_manualcat', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::itemadmin',1,1002);
      Zotlabs\Extend\Hook::register('cart_fulfill_manualcat', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::fulfill_manualcat',1,1002);
      Zotlabs\Extend\Hook::register('cart_cancel_manualcat', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::rollback_manualcat',1,1002);
      Zotlabs\Extend\Hook::register('cart_get_catalog', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::get_catalog',1,1002);
      Zotlabs\Extend\Hook::register('cart_filter_catalog_display', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::filter_catalog_display',1,1002);
      Zotlabs\Extend\Hook::register('cart_post_manualcat_itemedit', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::itemedit_post',1,1002);
      Zotlabs\Extend\Hook::register('cart_post_manualcat_itemactivation', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::itemedit_activation_post',1,1002);
      Zotlabs\Extend\Hook::register('cart_post_manualcat_itemdeactivation', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::itemedit_deactivation_post',1,1002);
      Zotlabs\Extend\Hook::register('cart_submodule_activation', 'addon/cart/submodules/manualcat.php', 'Cart_manualcat::module_activation',1,1002);
      Zotlabs\Extend\Hook::register('cart_order_before_additem_manualcat', 'addon/cart/submodule/manualcat.php', 'Cart_manualcat::filter_before_add',1,1002);
    }

    static public function unload () {
      Zotlabs\Extend\Hook::unregister_by_file('addon/cart/submodules/manualcat.php');
    }

    static public function module_activation (&$hookdata) {
      logger("MODULE ACTIVATION: manualcat",LOGGER_DEBUG);
      cart_config_additemtype("manualcat");
    }

    static public function module_deactivation (&$hookdata) {
      //cart_config_delitemtype("manualcat");
    }

    static public function settings (&$s) {
      $id = local_channel();
      if (! $id)
        return;

      if (! Apps::addon_app_installed($id, 'cart')) {
         return;
      }
      $enable_manualcat = get_pconfig ($id,'cart_manualcat','enable');
      $s .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'	=> array('enable_cart_manualcat', t('Enable Manual Cart Module'),
                   (isset($enable_manualcat) ? intval($enable_manualcat) : 0),
                   '',array(t('No'),t('Yes')))));
    }

    static public function settings_post () {
      if(!local_channel())
        return;

      if (! Apps::addon_app_installed(local_channel(), 'cart')) {
        return;
      }

      $enable_cart_manualcat = isset($_POST['enable_cart_manualcat']) ? intval($_POST['enable_cart_manualcat']) : 0;

      set_pconfig( local_channel(), 'cart_manualcat', 'enable', $enable_cart_manualcat );

      Cart_manualcat::unload();
      Cart_manualcat::load();
    }

  static public function item_fulfill(&$orderitem) {
    // LOCK SKU from future edits.
    $sku=Cart_manualcat::get_item($orderitem["item"]["item_sku"]);
    $sku["locked"]=true;
    Cart_manualcat::save_item($sku);
  }

  static public function get_catalog(&$catalog) {
    logger("manualcat - get catalog",LOGGER_DEBUG);
    if (count(Cart_manualcat::$catalog) > 0) return Cart_manualcat::$catalog;
    // 		"sku-1"=>Array("item_sku"=>"sku-1","item_desc"=>"Description Item 1","item_price"=>5.55),
    $itemlist = Cart_manualcat::get_itemlist();
    logger("manualcat - itemlist = ".print_r($itemlist,true),LOGGER_DEBUG);
	foreach ($itemlist as $item) {
		$skudata=Cart_manualcat::get_item($item);
		$catalog[$item] = [
			"item_sku"=>$item,
			"item_desc"=>$skudata["item_description"] ?? '',
			"item_price"=>$skudata["item_price"] ?? 0,
			"item_photo_url"=>$skudata["item_photo_url"] ?? '',
			"item_meta"=> isset($skudata["item_meta"]) ? cart_maybeunjson($skudata["item_meta"]) : [],
			"item_type"=>"manualcat",
			"locked"=>$skudata["locked"] ?? 0
		];
		logger("ADD CATALOG ITEM: ".print_r($catalog[$item],true),LOGGER_DEBUG);
	}
  }

  static public function filter_catalog_display(&$catalog) {
    logger("FILTER CATALOG (manualcat)",LOGGER_DEBUG);
    $itemlist = Cart_manualcat::get_itemlist();
    foreach ($itemlist as $item) {
      $skudata=Cart_manualcat::get_item($item);
      if (!isset($skudata["item_active"]) || $skudata["item_active"] == 0 ) {
        unset($catalog[$item]);
      }
    }
  }

  static public function get_itemlist() {
    //$skus = get_pconfig(local_channel(),'cart-manualcat','skus');
    $skus = get_pconfig(Cart::get_seller_id(),'cart-manualcat','skulist');
    $skus = cart_maybeunjson($skus);
    if (!is_array($skus)) {$skus=Array();}
    return $skus;
  }

  static public function get_item($sku) {
    $sku = get_pconfig(Cart::get_seller_id(),'cart-manualcat','sku-'.$sku);
    logger("GETITEM: ".print_r($sku,true),LOGGER_DEBUG);
    $sku = cart_maybeunjson($sku);
    logger("GETITEM_unjsoned: ".print_r($sku,true),LOGGER_DEBUG);
    return $sku;
  }

  static public function save_item($skudata) {
    logger("Save Item: ".print_r($skudata,true),LOGGER_DEBUG);
    $items = Cart_manualcat::get_itemlist();
    $items[$skudata["item_sku"]]=$skudata["item_sku"];
    logger("Save Item ITEMLIST: ".print_r($items,true),LOGGER_DEBUG);
    set_pconfig(Cart::get_seller_id(),'cart-manualcat','skulist',cart_maybejson($items));
    set_pconfig(Cart::get_seller_id(),'cart-manualcat','sku-'.$skudata["item_sku"],cart_maybejson($skudata));
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
      $pagecontent=Cart_manualcat::itemedit_form($sku);
      call_hooks('itemedit_formextras',$pagecontent);
      return;
    }

    /*no SKU - List existing SKUs and provide new SKU textbox*/
    $skus = Array();
    Cart_manualcat::get_catalog($skus);
    //Cart_manualcat::filter_catalog($skus);

    ksort($skus,SORT_STRING);
    $skulist = '';
    $templatevalues=Array("security_token"=>get_form_security_token(),"skus"=>$skus);
    $skulist .= replace_macros(get_markup_template('manualcat.itemadmin.skulist.tpl','addon/cart/submodules/'),$templatevalues);

    $formelements= replace_macros(get_markup_template('field_input.tpl'), array(
                '$field'	=> array('SKU', t('New Sku'), "")));
    $formelements.=' <button class="btn btn-sm" type="submit" name="submit"><i class="fa fa-plus fa-fw" aria-hidden="true"></i></button>';
    $macrosubstitutes=Array("security_token"=>get_form_security_token(),"skulist"=>$skulist,"formelements"=>$formelements);

    $pagecontent .= replace_macros(get_markup_template('manualcat.itemadmin.tpl','addon/cart/submodules/'),$macrosubstitutes);
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
    $skus = get_pconfig(local_channel(),'cart-manualcat','skulist');
    $skus = $skus ? cart_maybeunjson($skus) : Array();

    $sku = isset($_POST["SKU"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["SKU"]) : null;
    if (trim($sku)=='') {
      return;
    }
    $skudata=Cart_manualcat::get_item($sku);

    if (!is_array($skudata)) {
      $item=Array();
      $item["item_sku"]=$sku;
    } else {
      $item=$skudata;
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
    if ($item["item_active"]) {
       cart_config_additemtype('manualcat');
    }
    Cart_manualcat::save_item($item);
  }

  static public function fulfill_manualcat(&$calldata) {
    $item=Cart_manualcat::get_item($calldata["item"]["item_sku"]);
    $item["item_locked"]=1;
    Cart_manualcat::save_item($item);
  }

  static public function rollback_manualcat(&$calldata) {

  }

  static public function filter_before_add(&$hookdata) {

  }

  static public function itemedit_form($sku) {

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile["profile_uid"]) ? true : false);
    if (!$is_seller) {
      notice ("Access Denied.".EOL);
      return;
    }
    $seller_uid = Cart::get_seller_id();
    $skudata= Cart_manualcat::get_item($sku);

    $item= (is_array($skudata) && $skudata["item_sku"]=$sku) ? $skudata : Array("item_sku"=>$sku,"locked"=>0,"item_description"=>"New Item","item_price"=>0,"item_photo_url"=>"","item_active"=>false);

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

    $macrosubstitutes=Array("security_token"=>get_form_security_token(),"sku"=>$sku,"formelements"=>$formelements);

    return replace_macros(get_markup_template('manualcat.itemedit.tpl','addon/cart/submodules/'), $macrosubstitutes);
  }

  static public function myshop_menuitems (&$menu) {
    $urlroot = '/' . argv(0) . '/' . argv(1) . '/myshop';
    $menu .= "<li><a class='nav-link' href='".$urlroot."/manualcat'>Add/Remove Manual Catalog Items</a></li>";
  }
}

$Cart_manualcat = new Cart_manualcat();
