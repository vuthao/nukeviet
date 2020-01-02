<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-2-2010 12:55
 */

if (!defined('NV_IS_FILE_THEMES')) {
    die('Stop!!!');
}

$select_options = [];
$theme_array = nv_scandir(NV_ROOTDIR . '/themes', [
    $global_config['check_theme'],
    $global_config['check_theme_mobile']
]);

foreach ($theme_array as $themes_i) {
    $select_options[NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=blocks_func&amp;selectthemes=' . $themes_i] = $themes_i;
}

$selectthemes_old = $nv_Request->get_string('selectthemes', 'cookie', $global_config['site_theme']);
$selectthemes = $nv_Request->get_string('selectthemes', 'get', $selectthemes_old);

if (!in_array($selectthemes, $theme_array)) {
    $selectthemes = $global_config['site_theme'];
}

if ($selectthemes_old != $selectthemes) {
    $nv_Request->set_Cookie('selectthemes', $selectthemes, NV_LIVE_COOKIE_TIME);
}

$selectedmodule = '';
$selectedmodule = $nv_Request->get_title('module', 'get', '', 1);
$func_id = $nv_Request->get_int('func', 'get', 0);

if ($func_id > 0) {
    $selectedmodule = $db->query('SELECT in_module FROM ' . NV_MODFUNCS_TABLE . ' WHERE func_id=' . $func_id)->fetchColumn();
} elseif (!empty($selectedmodule)) {
    $sth = $db->prepare("SELECT func_id FROM " . NV_MODFUNCS_TABLE . " WHERE func_name='main' AND in_module= :module");
    $sth->bindParam(':module', $selectedmodule, PDO::PARAM_STR);
    $sth->execute();
    $func_id = $sth->fetchColumn();
}

if (empty($func_id) or empty($selectedmodule)) {
    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=blocks');
}

$page_title = $nv_Lang->getModule('blocks_by_funcs') . ': ' . $selectthemes;

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);

$array_modules = [];
$sql = 'SELECT title, custom_title FROM ' . NV_MODULES_TABLE . ' ORDER BY weight ASC';
$result = $db->query($sql);
while (list ($m_title, $m_custom_title) = $result->fetch(3)) {
    $array_modules[] = [
        'key' => $m_title,
        'title' => $m_custom_title
    ];
}
$tpl->assign('ARRAY_MODULES', $array_modules);

$sth = $db->prepare('SELECT func_id, func_custom_name
    FROM ' . NV_MODFUNCS_TABLE . '
    WHERE in_module=:module AND show_func=1
    ORDER BY subweight ASC');
$sth->bindParam(':module', $selectedmodule, PDO::PARAM_STR);
$sth->execute();

$array_functions = [];
while (list ($f_id, $f_custom_title) = $sth->fetch(3)) {
    $array_functions[] = [
        'key' => $f_id,
        'title' => $f_custom_title
    ];
}
$tpl->assign('ARRAY_FUNCTIONS', $array_functions);

$blocks_positions = [];
$sth = $db->prepare('SELECT t1.position, COUNT(*)
    FROM ' . NV_BLOCKS_TABLE . '_groups t1
    INNER JOIN ' . NV_BLOCKS_TABLE . '_weight t2 ON t1.bid = t2.bid
    WHERE t2.func_id=' . $func_id . ' AND t1.theme = :theme
    GROUP BY t1.position');
$sth->bindParam(':theme', $selectthemes, PDO::PARAM_STR);
$sth->execute();

while (list ($position, $numposition) = $sth->fetch(3)) {
    $blocks_positions[$position] = $numposition;
}

// Load position file
$xml = simplexml_load_file(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/config.ini');
$content = $xml->xpath('positions');
$positions = $content[0]->position;

$sth = $db->prepare('SELECT t1.*, t2.func_id, t2.weight as bweight
    FROM ' . NV_BLOCKS_TABLE . '_groups t1
    INNER JOIN ' . NV_BLOCKS_TABLE . '_weight t2 ON t1.bid = t2.bid
    WHERE t2.func_id = ' . $func_id . ' AND t1.theme = :theme
    ORDER BY t1.position ASC, t2.weight ASC');
$sth->bindParam(':theme', $selectthemes, PDO::PARAM_STR);
$sth->execute();

$array_blocks = [];
while ($row = $sth->fetch()) {
    $array_blocks[$row['bid']] = [
        'bid' => $row['bid'],
        'title' => $row['title'],
        'module' => $row['module'],
        'file_name' => $row['file_name'],
        'act' => $row['act'],
        'numposition' => $blocks_positions[$row['position']],
        'bweight' => $row['bweight'],
        'positionnum' => sizeof($positions) - 1,
        'positions' => $positions,
        'position' => $row['position']
    ];
}

$tpl->assign('ARRAY_BLOCKS', $array_blocks);
$tpl->assign('BLOCKREDIRECT', '');
$tpl->assign('FUNC_ID', $func_id);
$tpl->assign('SELECTEDMODULE', $selectedmodule);

$set_active_op = 'blocks';

$contents = $tpl->fetch('blocks_func.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
