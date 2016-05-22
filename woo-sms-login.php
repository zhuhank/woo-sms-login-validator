<?php
/*
  Plugin Name: WOO SMS Login (手机短信验证登陆)
  Author: Shudong Zhu
  Author URI:
  Plugin URI:
  Description: This plugin can let buyer login and register with their real phone num. (此插件利用短信验证,使买家用真实的手机号进行注册登陆购物。)
  Version: 0.5
  Text Domain: wooSMS
  Domain Path: /languages/
 */

function woo_sms_init() {
    load_plugin_textdomain('wooSMS', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

add_action('init', 'woo_sms_init');

add_action('admin_menu', 'woo_sms_add_page');

function woo_sms_add_page() {
    $woo_sms_url = plugins_url('woo-dayu-sms-login-validator');
    if (function_exists('add_menu_page')) {
        add_menu_page(__('Woo SMS Login', 'wooSMS'), __('Woo SMS Login', 'wooSMS'), 'manage_options', 'woo_sms', 'woo_sms_do_page', '');
    }
}

add_action('plugin_action_links_' . plugin_basename(__FILE__), 'woo_sms_plugin_actions');

function woo_sms_plugin_actions($links) {
    $new_links = array();
    $new_links[] = '<a href="admin.php?page=woo_sms">' . __('Settings') . '</a>';
    return array_merge($new_links, $links);
}

function showPluginImages() {
    $directory = plugin_dir_path(__FILE__) . '/images';
    $images = scandir($directory);
    foreach ($images as $img) {
        $absImgPath = $directory . "/$img";
        if (exif_imagetype($absImgPath) == IMAGETYPE_PNG) {
            $imgUrl = plugin_dir_url(__FILE__) . "/images/$img";
            echo '<img class="PluginImage" src="' . $imgUrl . '" />';
        }
    }
}

// 设置 Setting
function woo_sms_do_page() {
    $woo_sms_url = plugins_url('woo-dayu-sms-login-validator');
    ?>
    <div class="wrap">
        <h2><?php _e('Dayu SMS For Woo', 'wooSMS'); ?></h2>
        <h3><?php _e('Plugin Summary', 'wooSMS'); ?></h3>
        <p><?php _e('This plugin can let buyer login and register with their real phone num,we integrate Ali DAYU SMS service.', 'wooSMS'); ?></p>
        <h4><?php _e('Price:', 'wooSMS'); ?> 200RMB</h4>
        <h3><?php _e('Introduction of Ali DAYU SMS service', 'wooSMS'); ?></h3>
        <p><a href="http://www.alidayu.com/" target="_blank">http://www.alidayu.com/</a></P>
        <h3><?php _e('Contact  Me', 'wooSMS'); ?></h3>
        <p><strong><?php _e('Mail:', 'wooSMS'); ?></strong><a href="mailto:nkg_hank@126.com?subject=Woo SMS Login">nkg_hank@126.com</a></p>
        <p><strong><?php _e('WeChat Account:', 'wooSMS'); ?></strong> china_njit_dota_hope</p>
        <h3><?php _e('Plugin  Screenshots', 'wooSMS'); ?></h3>
        <?php showPluginImages() ?>
    </div>
    <?php
}
