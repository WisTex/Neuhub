<?php
/**
 * Name: NavBanner Options
 * Description: Add some more options to the banner of your Hub.
 * Version: 1.2  
 * Author: Dale Hitchenor <dale@hitchenor.com>
 * Maintainer: none
 */

use Zotlabs\Extend\Hook;


function navbanner_options_load() {
    Hook::register('get_banner', 'addon/navbanner_options/navbanner_options.php', 'navbanner_options_main');
    logger("loaded navbanner_options");
}
 
function navbanner_options_unload() {
    Hook::unregister('get_banner', 'addon/navbanner_options/navbanner_options.php', 'navbanner_options_main');
    logger("unloaded navbanner_options");
}


function navbanner_options_main(&$banner) {
    
    $accountid = \App::$account['account_id'];
    $hostname = \App::get_hostname();
    
    $sitename = \App::$config['system']['sitename'];
    $channelname = \App::$channel['channel_name'];
    $channeladdr = \App::$channel['channel_address'];
    $fullname = \App::$observer['xchan_name'];
    $accountemail = \App::$account['account_email'];
    $serviceclass = \App::$account['account_service_class'];
    $accountlevel = \App::$account['account_level'];
    

    if ($_SESSION['authenticated'] != 1) {
        $banner = $sitename;
    } else {
        $oldbanner = get_config('system','banner');
    $old = array();
        $old[0] = '/channel_name/';
        $old[1] = '/channel_address/';
        $old[2] = '/account_email/';
        $old[3] = '/full_name/';
        $old[4] = '/host_name/';
        $old[5] = '/site_name/';
        $old[6] = '/account_id/';
        $old[7] = '/service_class/';
        $old[8] = '/account_level/';
    $new = array();
        $new[0] = $channelname;
        $new[1] = $channeladdr."@".$hostname;
        $new[2] = $accountemail;
        $new[3] = $fullname;
        $new[4] = $hostname;
        $new[5] = $sitename;
        $new[6] = $accountid;
        $new[7] = $serviceclass;
        $new[8] = $accountlevel;
        
    ksort($old);
    ksort($new);
    $banner = preg_replace($old, $new, $oldbanner);
    }
}
