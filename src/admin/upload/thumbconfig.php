<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) {
    die('Stop!!!');
}

if ($nv_Request->isset_request('submit', 'post')) {
    $thumb_type = $nv_Request->get_typed_array('thumb_type', 'post', 'int', []);
    $thumb_width = $nv_Request->get_typed_array('thumb_width', 'post', 'int', []);
    $thumb_height = $nv_Request->get_typed_array('thumb_height', 'post', 'int', []);
    $thumb_quality = $nv_Request->get_typed_array('thumb_quality', 'post', 'int', []);

    $did = $nv_Request->get_int('other_dir', 'post', 0);
    $other_type = $nv_Request->get_int('other_type', 'post', 0);
    if ($did and $other_type) {
        $thumb_type[$did] = $other_type;
        $thumb_width[$did] = $nv_Request->get_int('other_thumb_width', 'post', 0);
        $thumb_height[$did] = $nv_Request->get_int('other_thumb_height', 'post', 0);
        $thumb_quality[$did] = $nv_Request->get_int('other_thumb_quality', 'post', 0);
    }
    foreach ($thumb_type as $did => $type) {
        $did = intval($did);
        $type = intval($type);
        $width = intval($thumb_width[$did]);
        if ($type == 2) {
            $width = 0;
        } elseif ($width > 1000 or $width < 1) {
            $width = 100;
        }
        $height = intval($thumb_height[$did]);
        if ($type == 1) {
            $height = 0;
        } elseif ($height > 1000 or $height < 1) {
            $height = 100;
        }
        $quality = $thumb_quality[$did];
        if ($quality > 100 or $quality < 20) {
            $quality = 90;
        }
        $db->query('UPDATE ' . NV_UPLOAD_GLOBALTABLE . '_dir SET
            thumb_type = ' . $type . ', thumb_width = ' . $width . ',
            thumb_height = ' . $height . ', thumb_quality = ' . $quality . '
        WHERE did = ' . $did);
    }
}

if ($nv_Request->isset_request('getexample', 'post')) {
    if (!defined('NV_IS_AJAX')) {
        die('Wrong URL');
    }

    $thumb_dir = $nv_Request->get_int('did', 'post', 0);
    $thumb_type = $nv_Request->get_int('t', 'post', 0);
    $thumb_width = $nv_Request->get_int('w', 'post', 0);
    $thumb_height = $nv_Request->get_int('h', 'post', 0);
    $thumb_quality = $nv_Request->get_int('q', 'post', 0);

    if ((!empty($thumb_dir) and !in_array($thumb_dir, $array_dirname)) or $thumb_type <= 0 or $thumb_width <= 0 or $thumb_height <= 0 or $thumb_quality <= 0 or $thumb_quality > 100) {
        nv_jsonOutput([
            'status' => 'error',
            'message' => nv_theme_alert($nv_Lang->getModule('prViewExampleError1'), $nv_Lang->getModule('prViewExampleError'))
        ]);
    }

    $return = ['status' => 'error'];

    // Tìm ảnh demo
    $image_demo = [];

    if ($thumb_dir) {
        $select_dir = array_intersect($array_dirname, [$thumb_dir]);
        $select_dir = key($select_dir);

        foreach ($array_dirname as $dirname => $did) {
            if (!empty($image_demo)) {
                break;
            }
            if (strpos($dirname, $select_dir) === 0) {
                $image_demo = $db->query('SELECT * FROM ' . NV_UPLOAD_GLOBALTABLE . '_file tb1, ' . NV_UPLOAD_GLOBALTABLE . '_dir tb2 WHERE tb1.did=tb2.did AND tb1.type=\'image\' AND tb1.did=' . $did . ' ORDER BY RAND() LIMIT 1')->fetch();
            }
        }
    }

    if (empty($image_demo)) {
        $image_demo = $db->query('SELECT * FROM ' . NV_UPLOAD_GLOBALTABLE . '_file tb1, ' . NV_UPLOAD_GLOBALTABLE . '_dir tb2 WHERE tb1.did=tb2.did AND tb1.type=\'image\' ORDER BY RAND() LIMIT 1')->fetch();
    }

    if (empty($image_demo)) {
        nv_jsonOutput([
            'status' => 'error',
            'message' => nv_theme_alert($nv_Lang->getModule('file_no_exists'), $nv_Lang->getModule('prViewExampleError2'))
        ]);
    }

    $image_demo['sizes'] = explode('|', $image_demo['sizes']);
    $result = [];
    $result['status'] = 'success';
    $result['src'] = NV_BASE_SITEURL . $image_demo['dirname'] . '/' . $image_demo['title'];
    $result['width'] = $image_demo['sizes'][0];
    $result['height'] = $image_demo['sizes'][1];
    $result['thumbsrc'] = NV_BASE_SITEURL . $image_demo['dirname'] . '/' . $image_demo['title'];
    $result['thumbwidth'] = $image_demo['sizes'][0];
    $result['thumbheight'] = $image_demo['sizes'][1];

    $file_tmp_name = 'thumbdemo_' . NV_CACHE_PREFIX . '.' . $image_demo['ext'];
    $file_tmp = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $file_tmp_name;
    if (file_exists($file_tmp)) {
        nv_deletefile($file_tmp);
    }
    $image = new NukeViet\Files\Image(NV_ROOTDIR . '/' . $image_demo['dirname'] . '/' . $image_demo['title'], NV_MAX_WIDTH, NV_MAX_HEIGHT);
    if ($thumb_type == 4) {
        $_thumb_width = $thumb_width;
        $_thumb_height = $thumb_height;
        $maxwh = max($_thumb_width, $_thumb_height);
        if ($image->fileinfo['width'] > $image->fileinfo['height']) {
            $thumb_width = 0;
            $thumb_height = $maxwh;
        } else {
            $thumb_width = $maxwh;
            $thumb_height = 0;
        }
    }
    if ($image->fileinfo['width'] > $thumb_width or $image->fileinfo['height'] > $thumb_height) {
        $image->resizeXY($thumb_width, $thumb_height);
        if ($thumb_type == 4) {
            $image->cropFromCenter($_thumb_width, $_thumb_height);
        }
        $image->save(NV_ROOTDIR . '/' . NV_TEMP_DIR, $file_tmp_name, $thumb_quality);
        $create_Image_info = $image->create_Image_info;
        $error = $image->error;
        $image->close();
        if (empty($error)) {
            $result['thumbsrc'] = NV_BASE_SITEURL . NV_TEMP_DIR . '/' . $file_tmp_name . '?t=' . NV_CURRENTTIME;
            $result['thumbwidth'] = $image->create_Image_info['width'];
            $result['thumbheight'] = $image->create_Image_info['height'];
        }
    }

    nv_jsonOutput($result);
}

$page_title = $nv_Lang->getModule('thumbconfig');

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);
$tpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);

$thumb_type = [];
$i = 0;
$nv_Lang->setModule('thumb_type_0', '');

$sql = 'SELECT * FROM ' . NV_UPLOAD_GLOBALTABLE . '_dir ORDER BY dirname ASC';
$result = $db->query($sql);

$array_dirs = $array_other_dirs = [];

while ($data = $result->fetch()) {
    if ($data['did'] == 0) {
        $data['dirname'] = $nv_Lang->getModule('thumb_dir_default');
        $forid = 1;
    } else {
        $forid = 0;
    }
    if ($data['thumb_type']) {
        $data['forid'] = $forid;
        $array_dirs[] = $data;
    } else {
        $array_other_dirs[] = $data;
    }
}

$tpl->assign('ARRAY_DIRS', $array_dirs);
$tpl->assign('ARRAY_OTHER_DIRS', $array_other_dirs);

$contents = $tpl->fetch('thumbconfig.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
