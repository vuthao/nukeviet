<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-1-2010 22:5
 */

if (!defined('NV_IS_FILE_EXTENSIONS')) {
    die('Stop!!!');
}

$page_title = $nv_Lang->getModule('login_pagetitle');

$request = [];
$request['username'] = $nv_Request->get_title('username', 'post', '');
$request['password'] = $nv_Request->get_title('password', 'post', '');
$request['redirect'] = $nv_Request->get_title('redirect', 'post,get', '');

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);
$tpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$tpl->assign('MODULE_NAME', $module_name);
$tpl->assign('REQUEST', $request);

if (!empty($request['username']) and !empty($request['password'])) {
    // Fixed request
    $request['lang'] = NV_LANG_INTERFACE;
    $request['basever'] = $global_config['version'];
    $request['mode'] = 'login';
    $request['domain'] = NV_MY_DOMAIN;

    $NV_Http = new NukeViet\Http\Http($global_config, NV_TEMP_DIR);
    $stored_cookies = nv_get_cookies();

    // Debug
    $args = [
        'headers' => [
            'Referer' => NUKEVIET_STORE_APIURL,
        ],
        'cookies' => $stored_cookies,
        'body' => $request
    ];

    $array = $NV_Http->post(NUKEVIET_STORE_APIURL, $args);

    $cookies = $array['cookies'];
    $array = !empty($array['body']) ? (is_serialized_string($array['body']) ? unserialize($array['body']) : []) : [];

    $respon = [
        'status' => 'error',
        'message' => '',
        'url' => ''
    ];

    $error = '';
    if (!empty(NukeViet\Http\Http::$error)) {
        $error = nv_http_get_lang(NukeViet\Http\Http::$error);
    } elseif (empty($array['status']) or !isset($array['error']) or !isset($array['data']) or !isset($array['pagination']) or !is_array($array['error']) or !is_array($array['data']) or !is_array($array['pagination']) or (!empty($array['error']) and (!isset($array['error']['level']) or empty($array['error']['message'])))) {
        $error = $nv_Lang->getGlobal('error_valid_response');
    } elseif (!empty($array['error']['message'])) {
        $error = $array['error']['message'];
    }

    // Show error
    if (!empty($error)) {
        $respon['message'] = $error;
        nv_jsonOutput($respon);
    }

    // Lưu Cookie lại
    nv_store_cookies(nv_object2array($cookies), $stored_cookies);

    $redirect = $request['redirect'] ? nv_redirect_decrypt($request['redirect']) : NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name;

    $respon['status'] = 'success';
    $respon['url'] = $redirect;
    nv_jsonOutput($respon);
}

$contents = $tpl->fetch($op . '.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
