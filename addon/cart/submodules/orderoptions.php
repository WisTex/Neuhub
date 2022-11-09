<?php
/**
 * Name: OrderOptions
 * Description: Submodule for the Hubzilla Cart system to
 *              enable the gathering of additional information
 *		about the configuration or other parameters of items
 *		or added information about the order itself
 * Version: 1.0
 * MinCartVersion: 0.9.5
 * Author: Matthew Dent <dentm42@dm42.net>
 * MinVersion: 2.8
 */

use Zotlabs\Lib\Apps;
use Zotlabs\Lib\PConfig;
use Zotlabs\Extend\Hook;

class Cart_orderoptions {

    public static $catalog=array();

	private static $validopttypes = [
		'text' => 'Text',
		'textarea' => 'Textarea'
	];

    public function __construct() {
      load_config("cart-orderoptions");
    }

    static public function load (){
      Hook::register('cart_addon_settings', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::settings',1,1002);
      Hook::register('cart_addon_settings_post', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::settings_post',1,1002);
      Hook::register('cart_addon_settings_morepanels', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::settings_morepanels',1,1002);
      Hook::register('cart_myshop_menufilter', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::myshop_menuitems',1,1002);
      Hook::register('cart_addon_settings_morepanels_post', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::edit_orderoptions_post',1,1003);
      Hook::register('cart_post_edit_itemoptions_post', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::edit_orderoptions_item_post',1,1002);
      Hook::register('cart_submodule_activation', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::module_activation',1,1002);
      Hook::register('cart_order_before_additem_orderoptions', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::filter_before_add',1,1002);
      Hook::register('itemedit_formextras', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::itemedit_form',1,1002);
      Hook::register('cart_display_before', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::display_before',1,1002);
      Hook::register('cart_order_additem', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::order_additem',1,1002);
      Hook::register('cart_do_updateitem', 'addon/cart/submodules/orderoptions.php', 'Cart_orderoptions::update_item_hook',1,1002);
      Hook::register('cart_post_update_item','addon/cart/submodules/orderoptions.php','Cart_orderoptions::update_orderopts',1,1002);
      Hook::register('cart_addons_myshop_prep_display','addon/cart/submodules/orderoptions.php','Cart_orderoptions::myshop_display',1,1002);
    }

    static public function unload () {
      Hook::unregister_by_file('addon/cart/submodules/orderoptions.php');
    }

    static public function module_activation (&$hookdata) {
      logger("MODULE ACTIVATION: orderoptions",LOGGER_DEBUG);
    }

    static public function module_deactivation (&$hookdata) {
      logger("MODULE DEACTIVATION: orderoptions",LOGGER_DEBUG);
    }

    static public function settings (&$s) {
      $id = local_channel();
      if (! $id)
        return;

      if (! Apps::addon_app_installed($id, 'cart')) {
         return;
      }
      $enable_orderoptions = get_pconfig ($id,'cart_orderoptions','enable');
      $s .= replace_macros(get_markup_template('field_checkbox.tpl'), array(
                 '$field'	=> array('enable_cart_orderoptions', t('Enable Order/Item Options'),
                   (isset($enable_orderoptions) ? intval($enable_orderoptions) : 0),
                   '',array(t('No'),t('Yes')))));
    }

    static public function settings_post () {
      if(!local_channel())
        return;

      if (! Apps::addon_app_installed(local_channel(), 'cart')) {
        return;
      }

      $enable_cart_orderoptions = isset($_POST['enable_cart_orderoptions']) ? intval($_POST['enable_cart_orderoptions']) : 0;

      set_pconfig( local_channel(), 'cart_orderoptions', 'enable', $enable_cart_orderoptions );

      self::unload();
      self::load();
    }

  static public function get_item($sku=null) {
		$catalog = cart_get_catalog(false);
		if ($sku && !isset($catalog[$sku])) {
			return null;
		} elseif ($sku) { 
    			$item = PConfig::Get(Cart::get_seller_id(),'cart-orderoptions','sku-'.$sku);
		} else {
    			$item = PConfig::Get(Cart::get_seller_id(),'cart-orderoptions','order');
		}
		$item = cart_maybeunjson($item);
		if (!is_array($item)) {
			$item = [
				'item_sku'=>$sku,
				'itemoptions'=>[]
			];
		}
    		return $item;
  }

  static public function save_item($skudata) {
	if (isset($skudata['item_sku'])) {
    		set_pconfig(Cart::get_seller_id(),'cart-orderoptions','sku-'.$skudata["item_sku"],cart_maybejson($skudata));
	} else {
    		set_pconfig(Cart::get_seller_id(),'cart-orderoptions','order',cart_maybejson($skudata));
	}
  }

  static public function edit_orderoptions_post() {
    if ($_REQUEST['cart_posthook']!='edit_orderoptions_post') {
		return;
	}
    $orderoptenabled = get_pconfig( local_channel(), 'cart_orderoptions', 'enable', 0 );
    if (!local_channel() || !$orderoptenabled) {
		return;
	}
    if (!check_form_security_token()) {
  		return;
  	}

    $orderoptorder = $_REQUEST['orderoptorder'];
    $orderoptlabels = $_REQUEST['itemoption_label'];
    $orderoptdefaults = $_REQUEST['itemoption_default'];
    $orderoptinstructions = $_REQUEST['itemoption_instructions'];
    $orderopttypes = $_REQUEST['itemoption_type'];
    $orderoptrequired = $_REQUEST['itemoption_required'];
    //foreach ($_REQUEST['orderoptorder'] as $itemid) {
    foreach ($orderoptlabels as $itemid=>$label) {
	if ($itemid == "' + itemidx + '" || $itemid == 'order') {
		continue;
	}
	// validate entries.
	$optid = $itemid;
	if (strpos($optid,'new_')===0) {
		$optid = new_uuid();
	}
	$options[$optid]['uuid']=$optid;
	$options[$optid]['label']=htmlentities(strip_tags($orderoptlabels[$itemid]));
	if ($options[$optid]['label'] == '') {
		continue;
	}
	//$options[$optid]['instructions']=strip_tags($orderoptinstructions[$itemid]);
	$options[$optid]['instructions']=trim(z_input_filter($orderoptinstructions[$itemid]));
	$options[$optid]['default']=strip_tags($orderoptdefaults[$itemid]);
	$options[$optid]['required']=intval($orderoptrequired[$itemid]);

	$curitemtype = $orderopttypes[$itemid];
	$options[$optid]['type']= isset(self::$validopttypes[$curitemtype]) ? $curitemtype : 'text';

	$values=[];
	switch ($options[$optid]['type']) {

		case 'select':
			$values=explode($orderoptvalues[$itemid],"\n");
			foreach ($values as $value) {
				if (strpos($value,'|')) {
					preg_match("/([^|]*)|(.*)/",$value,$matches);
					if (isset($matches[2])) {
						$key = $matches[1];
						$value = $matches[2];
					} else {
						$key = $matches[1];
						$value = $matches[2];
					}
				} else {
					$key = $value;
					$value = $value;
				}
				$key=htmlentities(strip_tags($key));
				$value=htmlentities(strip_tags($value));
				$options[$optid]['values'][$key] = $value;
			}
			break;
		default:
			$options[$optid]['values']='';
	}
	$optorder[]=$optid;
	$count++;
    }
    $item["orderoptions"] = $options;
    $item["optorder"] = $optorder;
    self::save_item($item);
  }

  static public function edit_orderoptions_item_post() {
    $orderoptenabled = get_pconfig( local_channel(), 'cart_orderoptions', 'enable', 0 );
    if (!local_channel() || !$orderoptenabled) {
		return;
	}
    if (!check_form_security_token()) {
  		notice (check_form_security_std_err_msg());
  		return;
  	}

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile['profile_uid']) ? true : false);
    if (!$is_seller) {
      notice ("Access Denied.".EOL);
      return;
    }

    $sku = isset($_POST["item_sku"]) ? preg_replace("[^a-zA-Z0-9\-]",'',$_POST["item_sku"]) : null;
    if (trim($sku)=='') {
      notice ("Invalid SKU.".EOL);
      return;
    }
    $skudata=self::get_item($sku);

    if (!is_array($skudata)) {
      notice ("Invalid SKU.".EOL);
      return;
    }

    $item=$skudata;
    $options = [];
    $count=0;

    $itemoptorder = $_REQUEST['itemoptorder'];
    $itemoptlabels = $_REQUEST['itemoption_label'];
    $itemoptdefaults = $_REQUEST['itemoption_default'];
    $itemoptinstructions = $_REQUEST['itemoption_instructions'];
    $itemopttypes = $_REQUEST['itemoption_type'];
    $itemoptrequired = $_REQUEST['itemoption_required'];
    //foreach ($_REQUEST['itemoptorder'] as $itemid) {
    foreach ($itemoptlabels as $itemid=>$label) {
	// validate entries.
	$optid = $itemid;
	if (strpos($itemid,'new_')===0) {
		$optid = new_uuid();
	}
	$options[$optid]['uuid']=$optid;
	$options[$optid]['label']=htmlentities(strip_tags($itemoptlabels[$itemid]));
	if ($options[$optid]['label'] == '') {
		continue;
	}
	//$options[$optid]['instructions']=strip_tags($itemoptinstructions[$itemid]);
	$options[$optid]['instructions']=trim(z_input_filter($itemoptinstructions[$itemid]));
	$options[$optid]['default']=strip_tags($itemoptdefaults[$itemid]);
	$options[$optid]['required']=intval($itemoptrequired[$itemid]);

	$curitemtype = $itemopttypes[$itemid];
	$options[$optid]['type']= isset(self::$validopttypes[$curitemtype]) ? $curitemtype : 'text';

	$values=[];
	switch ($options[$optid]['type']) {

		case 'select':
			$values=explode($itemoptvalues[$itemid],"\n");
			foreach ($values as $value) {
				if (strpos($value,'|')) {
					preg_match("/([^|]*)|(.*)/",$value,$matches);
					if (isset($matches[2])) {
						$key = $matches[1];
						$value = $matches[2];
					} else {
						$key = $matches[1];
						$value = $matches[2];
					}
				} else {
					$key = $value;
					$value = $value;
				}
				$key=htmlentities(strip_tags($key));
				$value=htmlentities(strip_tags($value));
				$options[$optid]['values'][$key] = $value;
			}
			break;
		default:
			$options[$optid]['values']='';
	}
	$optorder[]=$optid;
	$count++;
    }
    $item["itemoptions"] = $options;
    $item["optorder"] = $optorder;
    self::save_item($item);
  }

  static public function filter_before_add(&$hookdata) {

  }

  static public function settings_morepanels(&$panels) {
    $orderoptenabled = get_pconfig( local_channel(), 'cart_orderoptions', 'enable', 0 );

    if (!local_channel() || !$orderoptenabled) {
		return;
	}

/*
    $is_seller = ((local_channel()) && (local_channel() == \App::$profile["profile_uid"]) ? true : false);
    if (!$is_seller) {
      return;
    }
*/
    head_add_js('/addon/cart/submodules/view/js/jquery-ui-1.12.1/jquery-ui.min.js',99);
    head_add_js('/addon/cart/submodules/view/js/jquery.ui.touch-punch.min.js',100);
    head_add_css('/addon/cart/submodules/view/js/jquery-ui-1.12.1/jquery-ui.min.css',99);
    $seller_uid = Cart::get_seller_id();
    $skudata= self::get_item();

    $itemoptions = $skudata['orderoptions'];

    $formelements["submit"]=t("Submit");
    $formelements["uri"]=strtok($_SERVER["REQUEST_URI"],'?').'?SKU='.$sku;
    $curopts = '';
    foreach ($itemoptions as $option) {
	$opttype = $option['type'];
	if (!isset(self::$validopttypes[$opttype])) {
		continue;
	}
	$tpl = 'itemoption_edit_'.$option['type'].'.tpl';
	$optinfo = [
		'uuid' => isset($option['uuid']) ? $option['uuid'] : new_uuid(),
		'type' => isset($option['type']) ? $option['type'] : 'text',
		'label' => isset($option['label']) ? $option['label'] : "New",
		'value' => isset($option['value']) ? $option['value'] : "",
		'instructions' => isset($option['instructions']) ? $option['instructions'] : "",
		'default' => isset($option['default']) ? $option['default'] : "",
		'required' => isset($option['required']) ? $option['required'] : 0
	];
	$vars = [
		'option' => $optinfo,
		'textstrings' => [
			'label' => t('Label'),
			'required' => t('Required'),
			'default' => t('Default'),
			'instructions' => t('Instructions').' '.'(BBCODE allowed)',
			'yes' => t('Yes'),
			'no' => t('No')
			],
	];
	$curopts .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'),$vars);
    }

	foreach (self::$validopttypes as $type=>$name) {
		$tpl = 'itemoption_edit_'.$type.'.tpl';
		$option = [
			'uuid' => "' + itemidx + '",
			'type' => "' + opttype + '",
			'label' => "New",
			'value' => "",
			'required' => 0
		];

		$vars = [
			'option' => $option,
			'textstrings' => [
				'label' => t('Label'),
				'required' => t('Required'),
				'default' => t('Default'),
				'instructions' => t('Instructions').' '.'(BBCODE allowed)',
				'yes' => t('Yes'),
				'no' => t('No')
				],
			];

		$templates .= "<div id='opttemplate-".$type."'>'";
		$opttpl = replace_macros(get_markup_template($tpl,'addon/cart/submodules/'),$vars);
		$opttpl = trim(preg_replace('/\s+/', ' ', $opttpl));
		$templates .= $opttpl;
		$templates .= "'</div>\n\n";
	}

    $macrosubstitutes=[
		"security_token"=>get_form_security_token(),
		'sku'=>'',
		"formelements"=>$formelements,
		'itemtypeopts'=>self::$validopttypes,
		'templates'=>$templates,
		'curopts'=>$curopts,
		"sectitle" => 'Order Options',
		];
    $pagecontent = replace_macros(get_markup_template('orderoption_edit.tpl','addon/cart/submodules/'), $macrosubstitutes);
    $newpanels = $panels;
    $newpanels[] = [
		'title'=>$macrosubstitutes['sectitle'],
		'order'=>100,
		'html'=>$pagecontent
	];
    $panels = $newpanels;
  }

  static public function itemedit_form(&$pagecontent) {
    $orderoptenabled = get_pconfig( local_channel(), 'cart_orderoptions', 'enable', 0 );
    if (!local_channel() || !$orderoptenabled) {
		return;
	}

    $is_seller = ((local_channel()) && (local_channel() == \App::$profile["profile_uid"]) ? true : false);
    if (!$is_seller) {
      return;
    }

    head_add_js('/addon/cart/submodules/view/js/jquery-ui-1.12.1/jquery-ui.min.js',99);
    head_add_js('/addon/cart/submodules/view/js/jquery.ui.touch-punch.min.js',100);
    head_add_css('/addon/cart/submodules/view/js/jquery-ui-1.12.1/jquery-ui.min.css',99);
    $seller_uid = Cart::get_seller_id();
    $sku=$_REQUEST['SKU'];
    $skudata= self::get_item($sku);

    $itemoptions = $skudata['itemoptions'];

    $formelements["submit"]=t("Submit");
    $formelements["uri"]=strtok($_SERVER["REQUEST_URI"],'?').'?SKU='.$sku;
    $curopts = '';
    foreach ($itemoptions as $option) {
	$opttype = $option['type'];
	if (!isset(self::$validopttypes[$opttype])) {
		continue;
	}
	$tpl = 'itemoption_edit_'.$option['type'].'.tpl';
	$optinfo = [
		'uuid' => isset($option['uuid']) ? $option['uuid'] : new_uuid(),
		'type' => isset($option['type']) ? $option['type'] : 'text',
		'label' => isset($option['label']) ? $option['label'] : "New",
		'value' => isset($option['value']) ? $option['value'] : "",
		'instructions' => isset($option['instructions']) ? $option['instructions'] : "",
		'default' => isset($option['default']) ? $option['default'] : "",
		'required' => isset($option['required']) ? $option['required'] : 0
	];
	$vars = [
		'option' => $optinfo,
		'textstrings' => [
			'label' => t('Label'),
			'required' => t('Required'),
			'default' => t('Default'),
			'instructions' => t('Instructions').' '.'(BBCODE allowed)',
			'yes' => t('Yes'),
			'no' => t('No')
			],
	];
	$curopts .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'),$vars);
    }

	foreach (self::$validopttypes as $type=>$name) {
		$tpl = 'itemoption_edit_'.$type.'.tpl';
		$option = [
			'uuid' => "' + itemidx + '",
			'type' => "' + opttype + '",
			'label' => "New",
			'value' => "",
			'required' => 0
		];

		$vars = [
			'option' => $option,
			'textstrings' => [
				'label' => t('Label'),
				'required' => t('Required'),
				'default' => t('Default'),
				'instructions' => t('Instructions').' '.'(BBCODE allowed)',
				'yes' => t('Yes'),
				'no' => t('No')
				],
			];

		$templates .= "<div id='opttemplate-".$type."'>'";
		$opttpl = replace_macros(get_markup_template($tpl,'addon/cart/submodules/'),$vars);
		$opttpl = trim(preg_replace('/\s+/', ' ', $opttpl));
		$templates .= $opttpl;
		$templates .= "'</div>\n\n";
	}

    $macrosubstitutes=[
		"security_token"=>get_form_security_token(),
		"sku"=>$sku,
		"sectitle" => 'Item Options',
		"formelements"=>$formelements,
		'itemtypeopts'=>self::$validopttypes,
		'templates'=>$templates,
		'curopts'=>$curopts,
	];
    $pagecontent .= replace_macros(get_markup_template('itemoption_edit.tpl','addon/cart/submodules/'), $macrosubstitutes);
  }


  static public function myshop_menuitems (&$menu) {
    $orderoptenabled = get_pconfig( local_channel(), 'cart_orderoptions', 'enable', 0 );
    if (!local_channel() || !$orderoptenabled) {
		return;
	}
  }

  static public function myshop_display(&$hookdata) {
	$data = $hookdata;
	$catgalog = cart_get_catalog(false);

	foreach ($data['items'] as $key=>$item) {
		$itemopts = isset($item['item_meta']['item_opts']) ? $item['item_meta']['item_opts'] : [];
		if ($catalog[$item['item_sku']]['item_type']=='subscription') {
			$subinfo = Cart_subscriptions::get_subinfo($item["item_sku"]);
			$sku=$subinfo["item_sku"];
		} else {
			$sku=$item['item_sku'];
		}
		$catalogopts = self::get_item($sku);
		$catalogopts = $catalogopts['itemoptions'];
		$itemextras='';
		$confirmed = $data['order_checkedout'] > NULL_DATE ;

		foreach ($catalogopts as $optkey=>$opt) {
			$type = $opt['type'];
			$type = isset(self::$validopttypes[$type]) ? $type : 'text';
			$itemoption = $itemopts[$opt['uuid']];
			if (isset($itemopts[$opt['uuid']])) {
				$opt['value'] = $itemoption['value'];
			} else {
				$opt['default'] = isset($opt['default']) ? $opt['default'] : '';
			}
			$tpl = 'itemoption_'.$type.'.tpl';
			$opt['itemid']=$key;
			$opt['confirmed']=$confirmed;
    			$itemextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
			unset($itemopts[$opt['uuid']]);
		}
		foreach ($itemopts as $opt) {
			$type = $opt['type'];
			$type = isset(self::$validopttypes[$type]) ? $type : 'text';
			$itemoption = $itemopts[$opt['uuid']];
			$tpl = 'itemoption_'.$type.'.tpl';
			$opt['itemid']=$key;
			$opt['confirmed']=$confirmed;
    			$itemextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
		}

		$data['items'][$key]['meta']['data']['html'] .= $itemextras ? $itemextras : null;
	}

	$orderopts = self::get_item();
	$orderopts = $orderopts['orderoptions'];
	$curropts = $data['order_meta']['orderoptions'];
	$orderextras='';
	foreach ($orderopts as $optkey=>$opt) {
		$type = $opt['type'];
		$type = isset(self::$validopttypes[$type]) ? $type : 'text';
		$orderoption = $curropts[$opt['uuid']];
		if (isset($orderopts[$opt['uuid']])) {
			$opt['value'] = $orderoption['value'];
		} else {
			$opt['value'] = isset($opt['default']) ? $opt['default'] : '';
		}
		$tpl = 'itemoption_'.$type.'.tpl';
		$opt['itemid']='order';
		$opt['confirmed']=$confirmed;
    		$orderextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
		if ($opt['required'] && !isset($opt['value'])) {
			$data['readytopay']=0;
		}
		unset($curopts[$opt['uuid']]);
	}
	foreach ($curopts as $opt) {
		$type = $opt['type'];
		$type = isset(self::$validopttypes[$type]) ? $type : 'text';
		$orderoption = $orderopts[$opt['uuid']];
		$tpl = 'itemoption_'.$type.'.tpl';
		$opt['itemid']='order';
		$opt['confirmed']=$confirmed;
    		$orderextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
	}

	if ($orderextras != '') {
		$data['orderextras'] = $orderextras;
	}

	$hookdata = $data;
  }

  static public function display_before(&$hookdata) {
	$data = $hookdata;	
	$catalog = cart_get_catalog(false);
	$confirmed = $data['order_checkedout'] > NULL_DATE ;
	foreach ($hookdata['items'] as $key=>$item) {
		$itemopts = isset($item['item_meta']['item_opts']) ? $item['item_meta']['item_opts'] : [];
		if ($catalog[$item['item_sku']]['item_type']=='subscription') {
			$subinfo = Cart_subscriptions::get_subinfo($item["item_sku"]);
			$sku=$subinfo["item_sku"];
		} else {
			$sku=$item['item_sku'];
		}
		$catalogopts = self::get_item($sku);
		$catalogopts = $catalogopts['itemoptions'];
		$itemextras='';
		foreach ($catalogopts as $optkey=>$opt) {
			$type = $opt['type'];
			$type = isset(self::$validopttypes[$type]) ? $type : 'text';
			$itemoption = $itemopts[$opt['uuid']];
			if (isset($itemopts[$opt['uuid']])) {
				$opt['value'] = $itemoption['value'];
			} else {
				$opt['default'] = isset($opt['default']) ? $opt['default'] : '';
			}
			$tpl = 'itemoption_'.$type.'.tpl';
			$opt['itemid']=$key;
			$opt['confirmed']=$confirmed;
    			$itemextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
			if ($opt['required'] && !isset($opt['value'])) {
				$data['readytopay']=0;
			}
			unset($itemopts[$opt['uuid']]);
		}
		foreach ($itemopts as $opt) {
			$type = $opt['type'];
			$type = isset(self::$validopttypes[$type]) ? $type : 'text';
			$itemoption = $itemopts[$opt['uuid']];
			$tpl = 'itemoption_'.$type.'.tpl';
			$opt['itemid']=$key;
			$opt['confirmed']=$confirmed;
    			$itemextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
		}

		$data['items'][$key]['itemextras'] = $itemextras;
	}
	$orderopts = self::get_item();
	$orderopts = $orderopts['orderoptions'];
	$curropts = $data['order_meta']['orderoptions'];
	$orderextras='';
	//foreach ($data['orderoptions'] as $optkey=>$opt) {
	foreach ($orderopts as $optkey=>$opt) {
		$type = $opt['type'];
		$type = isset(self::$validopttypes[$type]) ? $type : 'text';
		$orderoption = $curropts[$opt['uuid']];
		if (isset($orderopts[$opt['uuid']])) {
			$opt['value'] = $orderoption['value'];
		} else {
			$opt['value'] = isset($opt['default']) ? $opt['default'] : '';
		}
		$tpl = 'itemoption_'.$type.'.tpl';
		$opt['itemid']='order';
		$opt['confirmed']=$confirmed;
    		$orderextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
		if ($opt['required'] && !isset($opt['value'])) {
			$data['readytopay']=0;
		}
		unset($curopts[$opt['uuid']]);
	}
	foreach ($curopts as $opt) {
		$type = $opt['type'];
		$type = isset(self::$validopttypes[$type]) ? $type : 'text';
		$orderoption = $orderopts[$opt['uuid']];
		$tpl = 'itemoption_'.$type.'.tpl';
		$opt['itemid']='order';
		$opt['confirmed']=$confirmed;
    		$orderextras .= replace_macros(get_markup_template($tpl,'addon/cart/submodules/'), $opt);
	}

	$data['orderextras'] = $orderextras;
	$hookdata = $data;
  }

  static public function update_item_hook(&$hookdata) {
	$itemid = $hookdata["itemid"];
	$itemoptions=[];
	foreach($_REQUEST["itemoption"][$itemid] as $uuid) {
		$value = htmlentities(trim($_REQUEST["itemoption_value"][$itemid][$uuid]));
		if ($value) {
			$itemoptions[$uuid]=[
				'label' => $_REQUEST["itemoption_label"][$itemid][$uuid],
				'value' => $value
			];
		}
	}
	$data = $hookdata;
	$data["iteminfo"]["item_meta"]["item_opts"]=$itemoptions;
	$hookdata = $data;
  }

  static public function update_orderopts() {

	$orderhash = cart_getorderhash();
	if (!$orderhash) { return; }
        $order=cart_loadorder($orderhash);
        if ($order["confirmed"]) { return; }
        $ordermeta=$order["order_meta"];


	$orderoptions=[];
	foreach($_REQUEST["itemoption_value"]['order'] as $uuid=>$value) {
		//$value = htmlentities(trim($_REQUEST["itemoption_value"]["order"][$uuid]));
		$value = htmlentities(trim($value));
		if ($value) {
			$orderoptions[$uuid]=[
				'label' => $_REQUEST["itemoption_label"]['order'][$uuid],
				'value' => $value
			];
		}
	}

	$ordermeta["orderoptions"]=$orderoptions;
	cart_updateorder_meta($ordermeta,$orderhash);
  }

}

$Cart_orderoptions = new Cart_orderoptions();
