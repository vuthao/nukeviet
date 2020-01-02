<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-2-2010 12:55
 */

if (!defined('NV_IS_FILE_SETTINGS')) {
    die('Stop!!!');
}

$page_title = $nv_Lang->getModule('variables');

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);
$tpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);

if ($nv_Request->isset_request('submit', 'post')) {
    $preg_replace = array('pattern' => '/[^a-zA-Z0-9\_]/', 'replacement' => '');

    $array_config_global = array();
    $array_config_global['cookie_prefix'] = nv_substr($nv_Request->get_title('cookie_prefix', 'post', '', 0, $preg_replace), 0, 255);
    $array_config_global['session_prefix'] = nv_substr($nv_Request->get_title('session_prefix', 'post', '', 0, $preg_replace), 0, 255);
    $array_config_global['cookie_secure'] = (int)$nv_Request->get_bool('cookie_secure', 'post', 0);
    $array_config_global['cookie_httponly'] = (int)$nv_Request->get_bool('cookie_httponly', 'post', 0);

    $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = 'sys' AND module = 'global' AND config_name = :config_name");
    foreach ($array_config_global as $config_name => $config_value) {
        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR, 30);
        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
        $sth->execute();
    }

    $array_config_define = array();
    $array_config_define['nv_live_cookie_time'] = 86400 * $nv_Request->get_int('nv_live_cookie_time', 'post', 1);
    $array_config_define['nv_live_session_time'] = 60 * $nv_Request->get_int('nv_live_session_time', 'post', 0);

    $sth = $db->prepare("UPDATE " . NV_CONFIG_GLOBALTABLE . " SET config_value = :config_value WHERE lang = 'sys' AND module = 'define' AND config_name = :config_name");
    foreach ($array_config_define as $config_name => $config_value) {
        $sth->bindParam(':config_name', $config_name, PDO::PARAM_STR, 30);
        $sth->bindParam(':config_value', $config_value, PDO::PARAM_STR);
        $sth->execute();
    }

    nv_save_file_config_global();
    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&rand=' . nv_genpass());
}

$tpl->assign('DATA', $global_config);
$tpl->assign('NV_LIVE_COOKIE_TIME', round(NV_LIVE_COOKIE_TIME / 86400));
$tpl->assign('NV_LIVE_SESSION_TIME', round(NV_LIVE_SESSION_TIME / 60));

$contents = $tpl->fetch('variables.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
