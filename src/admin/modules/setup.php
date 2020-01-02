<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-2-2010 12:55
 */

if (!defined('NV_IS_FILE_MODULES')) {
    die('Stop!!!');
}

$array_site_cat_module = [];
if ($global_config['idsite']) {
    $_module = $db->query('SELECT module FROM ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_site_cat t1 INNER JOIN ' . $db_config['dbsystem'] . '.' . $db_config['prefix'] . '_site t2 ON t1.cid=t2.cid WHERE t2.idsite=' . $global_config['idsite'])->fetchColumn();
    if (!empty($_module)) {
        $array_site_cat_module = explode(',', $_module);
    }
}

$contents = '';

// Thiet lap module moi
$setmodule = $nv_Request->get_title('setmodule', 'get', '', 1);

if (!empty($setmodule) and preg_match($global_config['check_module'], $setmodule)) {
    if ($nv_Request->get_title('checkss', 'get') == md5('setmodule' . $setmodule . NV_CHECK_SESSION)) {
        $sample = $nv_Request->get_int('sample', 'get', 0);
        $hook_files = $nv_Request->get_title('hook_files', 'get', '');
        $hook_mods = $nv_Request->get_title('hook_mods', 'get', '');
        $hook_files = explode('|', $hook_files);
        $hook_mods = explode('|', $hook_mods);

        $hook_data = [];
        foreach ($hook_files as $fkey => $file) {
            if (!empty($hook_mods[$fkey]) and !isset($sys_mods[$hook_mods[$fkey]])) {
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
            $hook_data[$file] = $hook_mods[$fkey];
        }

        $sth = $db->prepare('SELECT basename, table_prefix FROM ' . $db_config['prefix'] . '_setup_extensions WHERE title=:title AND type=\'module\'');
        $sth->bindParam(':title', $setmodule, PDO::PARAM_STR);
        $sth->execute();
        $modrow = $sth->fetch();

        if (!empty($modrow)) {
            if (!empty($array_site_cat_module) and !in_array($modrow['basename'], $array_site_cat_module)) {
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }

            // Kiểm tra các module liên quan nếu module này có hook
            $array_hooks = [];
            if (is_dir(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/hooks')) {
                $hooks = nv_scandir(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/hooks', '/^[a-zA-Z0-9\_]+\.php$/');
                if (!empty($hooks)) {
                    foreach ($hooks as $hook) {
                        $plugin_area = nv_get_plugin_area(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/hooks/' . $hook);
                        if (sizeof($plugin_area) == 1) {
                            $require_module = nv_get_hook_require(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/hooks/' . $hook);
                            if (!isset($hook_data[$hook]) or (!empty($require_module) and (!isset($sys_mods[$hook_data[$hook]]) or $sys_mods[$hook_data[$hook]]['module_file'] != $require_module))) {
                                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
                            }
                            $array_hooks[] = [
                                'plugin_file' => $hook,
                                'plugin_area' => $plugin_area[0],
                                'hook_module' => $hook_data[$hook]
                            ];
                        }
                    }
                }
            } else {
                $array_hooks = [];
            }

            $weight = $db->query('SELECT MAX(weight) FROM ' . NV_MODULES_TABLE)->fetchColumn();
            $weight = intval($weight) + 1;

            $module_version = [];
            $custom_title = preg_replace('/(\W+)/i', ' ', $setmodule);
            $version_file = NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/version.php';

            if (file_exists($version_file)) {
                include $version_file;
                if ($setmodule == $modrow['basename'] and isset($module_version['name'])) {
                    $custom_title = $module_version['name'];
                }
            }

            $_admin_file = (file_exists(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/admin.functions.php') and file_exists(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/admin/main.php')) ? 1 : 0;
            $_main_file = (file_exists(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/functions.php') and file_exists(NV_ROOTDIR . '/modules/' . $modrow['basename'] . '/funcs/main.php')) ? 1 : 0;
            $_module_data = (strlen($modrow['table_prefix']) > 30) ? trim(substr($modrow['table_prefix'], 0, 20), '_') . '_' . NV_CURRENTTIME : $modrow['table_prefix'];

            try {
                $sth = $db->prepare("INSERT INTO " . NV_MODULES_TABLE . " (
                    title, module_file, module_data, module_upload, module_theme, custom_title, admin_title, set_time, main_file,
                    admin_file, theme, mobile, description, keywords, groups_view, weight, act, admins, rss, sitemap
                ) VALUES (
                    :title, :module_file, :module_data, :module_upload, :module_theme, :custom_title, '',
                    " . NV_CURRENTTIME . ", " . $_main_file . ", " . $_admin_file . ", '', '', '', '', '6', " . $weight . ", 0, '', 1, 1
                )");
                $sth->bindParam(':title', $setmodule, PDO::PARAM_STR);
                $sth->bindParam(':module_file', $modrow['basename'], PDO::PARAM_STR);
                $sth->bindParam(':module_data', $_module_data, PDO::PARAM_STR);
                $sth->bindParam(':module_upload', $setmodule, PDO::PARAM_STR);
                $sth->bindParam(':module_theme', $modrow['basename'], PDO::PARAM_STR);
                $sth->bindParam(':custom_title', $custom_title, PDO::PARAM_STR);
                $sth->execute();
            } catch (PDOException $e) {
                trigger_error($e->getMessage());
            }

            $nv_Cache->delMod('modules');
            $return = nv_setup_data_module(NV_LANG_DATA, $setmodule, $sample);
            if ($return == 'OK_' . $setmodule) {
                nv_setup_block_module($setmodule);

                $sth = $db->prepare('UPDATE ' . NV_MODULES_TABLE . ' SET act=1 WHERE title=:title');
                $sth->bindParam(':title', $setmodule, PDO::PARAM_STR);
                $sth->execute();

                // Cài đặt hook
                if (!empty($array_hooks)) {
                    foreach ($array_hooks as $hook) {
                        try {
                            // Lấy vị trí mới
                            $_sql = 'SELECT max(weight) FROM ' . $db_config['prefix'] . '_plugin WHERE plugin_lang=' . $db->quote(NV_LANG_DATA) . ' AND plugin_area=' . $db->quote($hook['plugin_area']) . ' AND hook_module=' . $db->quote($hook['hook_module']);
                            $weight = $db->query($_sql)->fetchColumn();
                            $weight = intval($weight) + 1;

                            $db->query('INSERT INTO ' . $db_config['prefix'] . '_plugin (
                                plugin_lang, plugin_file, plugin_area, plugin_module_name, plugin_module_file, hook_module, weight
                            ) VALUES (
                                ' . $db->quote(NV_LANG_DATA) . ',
                                ' . $db->quote($hook['plugin_file']) . ',
                                ' . $db->quote($hook['plugin_area']) . ',
                                ' . $db->quote($setmodule) . ',
                                ' . $db->quote($modrow['basename']) . ',
                                ' . $db->quote($hook['hook_module']) . ',
                                ' . $weight . '
                            )');
                        } catch (PDOException $e) {
                            trigger_error(print_r($e, true));
                        }
                    }
                    nv_save_file_config_global();
                }

                nv_insert_logs(NV_LANG_DATA, $module_name, $nv_Lang->getModule('modules') . ' ' . $setmodule, '', $admin_info['userid']);
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=edit&mod=' . $setmodule);
            }
        }
    }

    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
}

$page_title = $nv_Lang->getModule('modules');
// Hệ thống module file có phân biệt chữ hoa chữ thường
$modules_exit = array_flip(nv_scandir(NV_ROOTDIR . '/modules', $global_config['check_module']));
$modules_data = $module_file_db = [];

$is_delCache = false;

$sql_data = 'SELECT * FROM ' . $db_config['prefix'] . '_setup_extensions WHERE type=\'module\' ORDER BY addtime ASC';
$result = $db->query($sql_data);

while ($row = $result->fetch()) {
    if (array_key_exists($row['basename'], $modules_exit)) {
        $modules_data[$row['title']] = $row;
        $module_file_db[$row['basename']] = $row['basename'];
    } else {
        // Xóa khỏi CSDL các module bị xóa thủ công bằng tay
        $sth = $db->prepare('DELETE FROM ' . $db_config['prefix'] . '_setup_extensions WHERE title= :title AND type=\'module\'');
        $sth->bindParam(':title', $row['title'], PDO::PARAM_STR);
        $sth->execute();

        $sth = $db->prepare('UPDATE ' . NV_MODULES_TABLE . ' SET act=2 WHERE title=:title');
        $sth->bindParam(':title', $row['title'], PDO::PARAM_STR);
        $sth->execute();

        $is_delCache = true;
    }
}

if ($is_delCache) {
    $nv_Cache->delMod('modules');
}

$check_addnews_modules = false;
$arr_module_news = array_diff_key($modules_exit, $module_file_db);

// Thêm các module chưa có trong CSDL do upload thủ công
foreach ($arr_module_news as $module_file_i => $arr) {
    $check_file_main = NV_ROOTDIR . '/modules/' . $module_file_i . '/funcs/main.php';
    $check_file_functions = NV_ROOTDIR . '/modules/' . $module_file_i . '/functions.php';

    $check_admin_main = NV_ROOTDIR . '/modules/' . $module_file_i . '/admin/main.php';
    $check_admin_functions = NV_ROOTDIR . '/modules/' . $module_file_i . '/admin.functions.php';

    if ((file_exists($check_file_main) and filesize($check_file_main) != 0 and file_exists($check_file_functions) and filesize($check_file_functions) != 0) or (file_exists($check_admin_main) and filesize($check_admin_main) != 0 and file_exists($check_admin_functions) and filesize($check_admin_functions) != 0)) {
        $check_addnews_modules = true;

        $module_version = [];
        $version_file = NV_ROOTDIR . '/modules/' . $module_file_i . '/version.php';

        if (file_exists($version_file)) {
            require_once $version_file;
        }

        if (empty($module_version)) {
            $timestamp = NV_CURRENTTIME - date('Z', NV_CURRENTTIME);
            $module_version = [
                'name' => $module_file_i,
                'modfuncs' => 'main',
                'is_sysmod' => 0,
                'virtual' => 0,
                'version' => $global_config['version'],
                'date' => date('D, j M Y H:i:s', $timestamp) . ' GMT',
                'author' => '',
                'note' => ''
            ];
        }

        $date_ver = intval(strtotime($module_version['date']));

        if ($date_ver == 0) {
            $date_ver = NV_CURRENTTIME;
        }

        $version = $module_version['version'] . ' ' . $date_ver;
        $note = $module_version['note'];
        $author = $module_version['author'];
        $module_data = preg_replace('/(\W+)/i', '_', strtolower($module_file_i));
        $module_title = strtolower($module_file_i);

        // Chỉ cho phép ảo hóa module khi virtual = 1, Khi virtual = 2, chỉ đổi được tên các func
        $module_version['virtual'] = ($module_version['virtual'] == 1) ? 1 : 0;

        $sth = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_setup_extensions (
            type, title, is_sys, is_virtual, basename, table_prefix, version, addtime, author, note
        ) VALUES (
            \'module\', :title, ' . intval($module_version['is_sysmod']) . ', ' . intval($module_version['virtual']) . ',
            :basename, :table_prefix, :version, ' . NV_CURRENTTIME . ', :author, :note
        )');

        $sth->bindParam(':title', $module_title, PDO::PARAM_STR);
        $sth->bindParam(':basename', $module_file_i, PDO::PARAM_STR);
        $sth->bindParam(':table_prefix', $module_data, PDO::PARAM_STR);
        $sth->bindParam(':version', $version, PDO::PARAM_STR);
        $sth->bindParam(':author', $author, PDO::PARAM_STR);
        $sth->bindParam(':note', $note, PDO::PARAM_STR);
        $sth->execute();
    }
}

if ($check_addnews_modules) {
    $result = $db->query($sql_data);
    while ($row = $result->fetch()) {
        $modules_data[$row['title']] = $row;
    }
}

// Các module đã có trong CSDL theo ngôn ngữ
$modules_for_title = [];
$modules_for_file = [];

$result = $db->query('SELECT * FROM ' . NV_MODULES_TABLE . ' ORDER BY weight ASC');
while ($row = $result->fetch()) {
    $modules_for_title[$row['title']] = $row;
    if ($row['title'] == $row['module_file']) {
        $modules_for_file[$row['module_file']] = $row;
    }
}

// Kiểm tra module mới
$news_modules_for_file = array_diff_key($modules_data, $modules_for_file);

$array_modules = $array_virtual_modules = $mod_virtual = [];

foreach ($modules_data as $row) {
    if (in_array($row['basename'], $modules_exit)) {
        if (!empty($array_site_cat_module) and !in_array($row['basename'], $array_site_cat_module)) {
            continue;
        }

        if (array_key_exists($row['title'], $news_modules_for_file)) {
            $mod = [];
            $mod['title'] = $row['title'];
            $mod['is_sys'] = $row['is_sys'];
            $mod['virtual'] = $row['is_virtual'];
            $mod['module_file'] = $row['basename'];
            $mod['version'] = preg_replace_callback('/^([0-9a-zA-Z]+\.[0-9a-zA-Z]+\.[0-9a-zA-Z]+)\s+(\d+)$/', 'nv_parse_vers', $row['version']);
            $mod['addtime'] = nv_date('H:i:s d/m/Y', $row['addtime']);
            $mod['author'] = nv_htmlspecialchars($row['author']);
            $mod['note'] = $row['note'];
            $mod['url_setup'] = array_key_exists($row['title'], $modules_for_title) ? '' : NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;setmodule=' . $row['title'] . '&amp;checkss=' . md5('setmodule' . $row['title'] . NV_CHECK_SESSION);

            if (strtolower($mod['module_file']) == $mod['title']) {
                // Chỉ hiển thị những module gốc chưa thiết lập
                if (!empty($mod['url_setup'])) {
                    $array_modules[] = $mod;
                }

                if ($row['is_virtual']) {
                    $mod_virtual[] = $mod['title'];
                }
            } else {
                $array_virtual_modules[] = $mod;
            }
        }
    }
}

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);

$tpl->assign('ARRAY_MODULES', $array_modules);
$tpl->assign('VIRTUAL_MODULES', $array_virtual_modules);

$contents = $tpl->fetch('setup_modules.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
