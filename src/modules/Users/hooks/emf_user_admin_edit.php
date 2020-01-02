<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES ., JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Dec 3, 2010 11:24:58 AM
 */

// Các trường dữ liệu khi gửi email thông tin kích hoạt tài khoản đến email của thành viên
$callback = function($vars, $from_data, $receive_data) {
    $merge_fields = [];

    if (in_array($vars['pid'], $vars['setpids'])) {
        global $nv_Lang;

        // Đọc ngôn ngữ tạm của module
        $nv_Lang->loadModule($receive_data['module_info']['module_file'], false, true);

        $merge_fields['user_full_name'] = [
            'name' => $nv_Lang->getModule('full_name'),
            'data' => '' // Dữ liệu ở đây
        ];
        $merge_fields['user_username'] = [
            'name' => $nv_Lang->getModule('username'),
            'data' => '' // Dữ liệu ở đây
        ];
        $merge_fields['user_password'] = [
            'name' => $nv_Lang->getModule('password'),
            'data' => '' // Dữ liệu ở đây
        ];
        $merge_fields['site_name'] = [
            'name' => $nv_Lang->getGlobal('site_name'),
            'data' => '' // Dữ liệu ở đây
        ];
        $merge_fields['login_url'] = [
            'name' => $nv_Lang->getModule('merge_field_login_link'),
            'data' => '' // Dữ liệu ở đây
        ];
        $merge_fields['send_password'] = [
            'name' => $nv_Lang->getModule('merge_field_send_password'),
            'data' => '' // Dữ liệu ở đây
        ];

        if ($vars['mode'] != 'PRE') {
            $user_info = $vars[0];
            $link = $vars[1];
            $global_config = $vars[2];

            $merge_fields['user_full_name']['data'] = nv_show_name_user($user_info['first_name'], $user_info['last_name'], $user_info['username']);
            $merge_fields['user_username']['data'] = $user_info['username'];
            $merge_fields['user_password']['data'] = $user_info['password1'];
            $merge_fields['site_name']['data'] = $global_config['site_name'];
            $merge_fields['login_url']['data'] = $link;
            $merge_fields['send_password']['data'] = (empty($user_info['password1']) ? false : true);
        }

        $nv_Lang->changeLang();
    }

    return $merge_fields;
};
nv_add_hook($module_name, 'get_email_merge_fields', $priority, $callback, $hook_module, $pid);
