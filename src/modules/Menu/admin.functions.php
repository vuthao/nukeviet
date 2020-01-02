<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 21-04-2011 11:17
 */

if (! defined('NV_ADMIN') or ! defined('NV_MAINFILE') or ! defined('NV_IS_MODADMIN')) {
    die('Stop!!!');
}

define('NV_IS_FILE_ADMIN', true);

//Document
$array_url_instruction['main'] = 'https://wiki.nukeviet.vn/nukeviet4:admin:menu';
$array_url_instruction['menu'] = 'https://wiki.nukeviet.vn/nukeviet4:admin:menu#lấy_menu_tự_dộng_từ_ten_cac_chuyen_mục_module';
$array_url_instruction['rows'] = 'https://wiki.nukeviet.vn/nukeviet4:admin:menu#xem_sửa_khối';

$allow_func = array( 'main', 'menu', 'rows', 'link_menu', 'link_module', 'change_weight_row', 'del_row', 'change_active' );

// Loai lien ket
$type_target = array();
$type_target[1] = $nv_Lang->getModule('type_target1');
$type_target[2] = $nv_Lang->getModule('type_target2');
$type_target[3] = $nv_Lang->getModule('type_target3');

require NV_ROOTDIR . '/modules/' . $module_file . '/admin.class.php';
$nv_menu = new nv_menu($module_data, $module_name, $admin_info);

/**
 * nv_list_menu()
 *
 * @return
 */
function nv_list_menu()
{
    global $db, $module_data;

    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . ' ORDER BY id ASC';
    $result = $db->query($sql);

    $list = array();
    while ($row = $result->fetch()) {
        $list[$row['id']] = array(
            'id' => $row['id'],
            'title' => $row['title'],
        );
    }

    return $list;
}

/**
 * @param int $id
 * @param array $array_item
 * @param string $sp_i
 */
function nv_menu_get_submenu($id, $alias_selected, $array_item, $sp_i)
{
    global $array_submenu, $sp, $mod_name;
    foreach ($array_item as $item2) {
        if (isset($item2['parentid']) and $item2['parentid'] == $id) {
            $item2['title'] = $sp_i . $item2['title'];
            $item2['module'] = $mod_name;
            $item2['selected'] = ($item2['alias'] == $alias_selected) ? ' selected="selected"' : '';

            $array_submenu[]= $item2;
            nv_menu_get_submenu($item2['key'], $alias_selected, $array_item, $sp_i . $sp);
        }
    }
}

/**
 * nv_menu_insert_id()
 *
 * @param mixed $mid
 * @param mixed $parentid
 * @param mixed $title
 * @param mixed $weight
 * @param mixed $sort
 * @param mixed $lev
 * @param mixed $mod_name
 * @param mixed $op_mod
 * @param mixed $groups_view
 * @return
 *
 */
function nv_menu_insert_id($mid, $parentid, $title, $weight, $sort, $lev, $mod_name, $op_mod, $groups_view)
{
    global $module_data, $db;

    $sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_rows (parentid, mid, title, link, note, weight, sort, lev, subitem, groups_view, module_name, op, target, css, active_type, status) VALUES (
		" . $parentid . ",
		" . $mid . ",
		:title,
		:link,
		:note,
		" . $weight . ",
		" . $sort . ",
		" . $lev . ",
		'',
		:groups_view,
		:module_name,
		:op,
		1,
		'',
		1,
		1
	)";

    $link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $mod_name;
    if (! empty($op_mod)) {
        $link .= '&amp;' . NV_OP_VARIABLE . '=' . $op_mod;
    }
    $data_insert = array();
    $data_insert['title'] = $title;
    $data_insert['link'] = $link;
    $data_insert['note'] = '';
    $data_insert['groups_view'] = $groups_view;
    $data_insert['module_name'] = $mod_name;
    $data_insert['op'] = $op_mod;
    return $db->insert_id($sql, 'id', $data_insert);
}

/**
 * @param int $mid
 * @param int $parentid
 * @param int $sort
 * @param int $lev
 * @param string $mod_name
 * @param array $array_item
 * @param int $key
 */
function nv_menu_insert_submenu($mid, $parentid, &$sort, $lev, $mod_name, $array_item, $key)
{
    global $db, $module_data;

    $array_sub_id = array();
    $subweight = 0;
    $sublev = $lev + 1;
    foreach ($array_item as $subkey => $subitem) {
        if (isset($subitem['parentid']) and $subitem['parentid'] == $key) {
            ++$subweight;
            ++$sort;
            $groups_view = (isset($subitem['groups_view'])) ? $subitem['groups_view'] : '6';
            $subparentid = nv_menu_insert_id($mid, $parentid, $subitem['title'], $subweight, $sort, $lev, $mod_name, $subitem['alias'], $groups_view);
            $array_sub_id[] = $subparentid;

            nv_menu_insert_submenu($mid, $subparentid, $sort, $sublev, $mod_name, $array_item, $subkey);
        }
    }

    if (! empty($array_sub_id)) {
        $db->query("UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_rows SET subitem='" . implode(',', $array_sub_id) . "' WHERE id=" . $parentid);
    }
}
